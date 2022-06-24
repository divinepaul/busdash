<?php

class Input {
    public string $type = "text";
    public string $id;
    public string $name;
    public string $label;
    public string $placeholder;
    public string $value;
    public $selectOptions = array();
    public $errors = array();
    public $minLength = INF;
    public bool $blank = false;
    public $maxLength = INF;

    public function __construct($name){
        $this->name = $name;
        $this->label = $name;
        $this->placeholder = &$this->label;
        $this->value = "";
    }
    public function validate() {

        if( !$this->blank &&
            isset($this->value) &&
            empty($this->value) ) {

            array_push($this->errors,"{$this->label} cannot be empty.");
        }
        if( $this->minLength != INF &&
            strlen($this->value) < $this->minLength ) {

            array_push($this->errors,"{$this->label} cannot be less than {$this->minLength} characters.");
        }

        if( $this->maxLength != INF &&
            strlen($this->value) > $this->maxLength ) {

            array_push($this->errors,"{$this->label} cannot exceed {$this->maxLength} characters.");
        }


        if(count($this->errors)) {
            return false;
        } else {
            return true;
        }

    }
    public function render() {
        echo "<label for=\"{$this->name}\">{$this->label}</label>";
        if ($this->type!="text" && $this->type == "select") {
            echo "<select name=\"{$this->name}\">";
            foreach ($this->selectOptions as $value => $label) {
                echo "<option value=\"{$value}\">{$label}</option>";
            }
            echo "</select><br><br>";

        } else { 
            echo "<input type=\"{$this->type}\" value=\"{$this->value}\" name=\"{$this->name}\" placeholder=\"{$this->placeholder}\"  />";
        }

        foreach ($this->errors as $i => $error) {
            echo "<p class=\"error\">{$error}</p>";
        }
    }
}

class Form {

    public $inputs = array();
    public string $method = "POST";

    public function __construct($POST,Input ...$inputs){
        $this->inputs = $inputs;
    }

    public function validate() {
        $is_valid = true;
        foreach ($this->inputs as $i => $input) {
            if(isset($_POST[$input->name])){
                $input->value = $_POST[$input->name]; 
            } else {
                $input->value = ""; 
            }
            $is_valid ? $is_valid = $input->validate() : $input->validate(); 
            
        }
        return $is_valid;
    }

    public function save() {

    }

    public function render(){
        global $csrf_token;
        echo "<form method=\"{$this->method}\">";
        foreach ($this->inputs as $i => $input) {
            $input->render();
        }

        echo "<input type=\"hidden\" name=\"csrf_token\" value=\"{$csrf_token}\" />";
        echo "<input type=\"submit\" value=\"Submit\" />";

        echo "</form>";

    echo "<br>";
    echo "<br>";
    echo "Form Obj: ";
    echo "<br>";
    echo '<pre>' , var_dump($this->inputs) , '</pre>';

    }
}

?>

<?php
class Input {
    public string $type = "text";
    public string $id;
    public string $name;
    public string $label;
    public string $placeholder;
    public string $value;
    public string $mysqli_type;
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
        $this->mysqli_type = "s";
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
        if($this->maxLength != INF &&
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
            echo "<select name=\"{$this->name}\" >";
            foreach ($this->selectOptions as $value => $label) {
                $isSelected = $value == $this->value ? "selected=true" : null; 

                echo "<option value=\"{$value}\" {$isSelected} >{$label}</option>";
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
    public string $sql_table;
    public int $sql_id;


    public function __construct(Input ...$inputs){
        $this->inputs = $inputs;
    }
    public function validate() {
        check_csrf_or_error($_POST['csrf_token']);
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
        global $db;
        if(isset($this->sql_id)) {
            if(isset($this->sql_table)){
                $sqlStatement = "UPDATE $this->sql_table SET";
                foreach ($this->inputs as $i => $input) {
                    $sqlStatement.=" $input->name=?,";
                }
                $sqlStatement = rtrim($sqlStatement, ",");
                $sqlStatement.= " WHERE id=?";


                $stmt = $db->prepare($sqlStatement);
                $values = array();
                $datatypes = "";
                foreach ($this->inputs as $i => $input) {
                    if($input->type == "password") {
                        $password = password_hash($input->value,PASSWORD_DEFAULT);
                        array_push($values,$password);
                    } else {
                        array_push($values,$input->value);
                    }
                    $datatypes.=$input->mysqli_type;
                }
                array_push($values,$this->sql_id);
                $datatypes.="i";
                $stmt->bind_param($datatypes, ...$values);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("sql_table is not set on the form");
            }
        } else {
            if(isset($this->sql_table)){
                $sqlStatement = "INSERT INTO $this->sql_table (";
                foreach ($this->inputs as $i => $input) {
                    $sqlStatement.=" $input->name,";
                }
                $sqlStatement = rtrim($sqlStatement, ",");
                $sqlStatement.=" ) VALUES ( ";

                foreach ($this->inputs as $i => $input) {
                    $sqlStatement.=" ?,";
                }
                $sqlStatement = rtrim($sqlStatement, ",");
                $sqlStatement.=" )";

                $stmt = $db->prepare($sqlStatement);
                $values = array();
                $datatypes = "";
                foreach ($this->inputs as $i => $input) {
                    if($input->type == "password") {
                        $password = password_hash($input->value,PASSWORD_DEFAULT);
                        array_push($values,$password);
                    } else {
                        array_push($values,$input->value);
                    }
                    $datatypes.=$input->mysqli_type;
                }
                $stmt->bind_param($datatypes, ...$values);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("sql_table is not set on the form");
            }
        }
    }

    public function fetch_values(){
        global $db;
        if(isset($this->sql_id)) {
            $stmt = $db->prepare("SELECT * FROM $this->sql_table WHERE id=?");
            $stmt->bind_param("i",$this->sql_id);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            foreach ($row as $attribute => $value) {
                foreach ($this->inputs as $i => $input) {
                    if($input->name == $attribute && $input->type != "password"){
                        $this->inputs[$i]->value = $value;
                    }
                }
            }
        } 
    }

    public function render(){
        $this->fetch_values();
        global $csrf_token;
        echo "<form method=\"{$this->method}\">";
        foreach ($this->inputs as $i => $input) {
            $input->render();
        }

        echo "<input type=\"hidden\" name=\"csrf_token\" value=\"{$csrf_token}\" />";
        echo "<input type=\"submit\" value=\"Submit\" />";
        echo "</form>";
        echo "<br>";

    }
}

?>

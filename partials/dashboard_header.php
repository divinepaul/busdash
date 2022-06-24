<html>
    <head>
        <link rel="stylesheet" href="/static/css/defaults.css"> 
        <link rel="stylesheet" href="/static/css/sidebar.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/static/css/forms.css"> 
        <base href="/">
        <title><?php echo $Title; ?></title>
    </head>
<body>
<div class="top-nav">
        <a class="top-nav-heading" href="/"><h1 >BusDash</h1></a>
    <div class="top-nav-right">
        <?php 
            if(!is_authenticated()) {
                echo "<a href='/auth/login.php'>Login</a>";
            } else {
                echo "<a href='/dashboard'>Dashboard</a>";
                echo "<a href='/auth/logout.php'>Logout</a>";
            }
        ?>
        <!--<a href="/auth/register.php">Register</a> -->
    </div>
</div>

<main>

<div class="sidebar">
    <a href="/dashboard/users/">
        <div class="sidebar-item">
            <i class="fa-solid fa-user"></i>
            Users
        </div>
    </a>
    <a href="/dashboard/buses.php">
        <div class="sidebar-item">
            <i class="fa-solid fa-bus"></i>
            Buses
        </div>
    </a>
    <a href="/dashboard/roles.php">
        <div class="sidebar-item">
            <i class="fa-solid fa-award"></i>
            Roles
        </div>
    </a>
    <a href="/">
        <div class="sidebar-item">
            <i class="fa-solid fa-shop"></i>
            Bus Stops
        </div>
    </a>
    <a href="/">
        <div class="sidebar-item">
            <i class="fa-solid fa-clock"></i>
            Bus Schedules
        </div>
    </a>
</div>
<div class="content">

<?php
define('BASE_URL', '/php-final-project/');
session_start();

// extract file name from a given path
$page = basename($_SERVER['PHP_SELF']);
$title = '';

// dynamically change the title of the page based on the page
switch ($page){
    case "index.php":
        $title = "Home Page";
        break;
    case "courses.php":
        $title = "Our Courses";
        break;
    case "about.php":
        $title = "About Us";
        break;
    case "contact.php":
        $title = "Contact Us";
        break;
    case "signUp.php":
        $title = "Sign Up";
        break;
    case "login.php":
        $title = "Sign In";
        break;
    default:
        $title = "Welcome to Learn2code.io";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="<?php echo BASE_URL; ?>styles/style.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title><?php echo $title; ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand text-primary fw-bold" href="<?php echo BASE_URL; ?>index.php">Learn2Code.io</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL; ?>index.php">Home</a>
                </li>
                <?php
                    if(isset($_SESSION['Active']) && $_SESSION['Active']){
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="'. BASE_URL . 'src/courses.php">Courses</a></li>';
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>src/about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>src/contact.php">Contact</a>
                </li>
                <?php
                if(isset($_SESSION['Active']) && $_SESSION['Active']){
                    echo '<li class="nav-item mt-2"><small class="text-success">User: ';
                    echo $_SESSION['Name'];
                    echo '&nbsp;<a href="' . BASE_URL . 'src/logout.php"><i class="fa-solid fa-arrow-right-from-bracket ml-2"></i></a></small></li>';
                }else {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="' . BASE_URL . 'src/login.php">Sign In</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
<!DOCTYPE html>

<html>
    <head>
        <title>
            Art Store
        </title>
    <style type="text/css">
        <?php include 'log.css'?>
    </style>
    </head>
    <body>
        <?php 
            session_start();
        ?>
    <div class="navbar">
        <div id="homeid">
            <a href="index.php" id="home">
                <p>Art Market</p>
            </a>
        </div>
        <?php if($_SESSION['authenticated']){
            echo' <div id="nav-element">
                    <a href="index.php">
                        <p>Market</p>
                    </a>
                </div>';
             }?>
        <?php if($_SESSION['authenticated']){
        echo '<div id="nav-element">
            <a href="profile.php">
                <p>Profile</p>
            </a>
        </div>';
        }?>
        <?php if(!$_SESSION['authenticated']){
        echo '<div id="nav-element">
                <a href="register.php">
                    <p>Register</p>
                </a>
        </div>';
        }?>
        <?php if(!$_SESSION['authenticated']){
        echo'<div id="nav-element">
                <a href="loginas.php">
                    <p>Log In</p>
                </a>
            </div>';
        }?>
        <?php if($_SESSION['authenticated']){
        echo '<div id="nav-element">
            <a href="logout.php">
                <p>Log out</p>
            </a>
        </div>';}?>
    </div>
<?php require_once 'navbar.php';
    require_once 'connectdb.php';

    $reset = false;

    if($_SESSION['authenticated']){
        header('location: index.php');
        exit;
    }
?>



<?php
if(isset($_POST['submit'])){
    $clean = array();
    $errors = array();

    $trimmed_username = trim($_POST['username']);
    if (strlen($trimmed_username) == 0) {
        $errors['username'] = '<p>Username cannot be empty!</p>';
    } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $trimmed_username)) {
        $errors['username'] = '<p>Username can only have digits, letters and _</p>';
    } else {

        
        $sql = "select * from user where username = :username";
        $stmt = $pdo -> prepare($sql);
        $stmt -> bindParam(":username", $trimmed_username);
        $stmt -> execute();
        
        if ($stmt -> rowCount() > 0)
            $errors['username'] = 'This username already exists!';
        else
            $clean['username'] = $trimmed_username;
    }

    $trimmed_password = trim($_POST['password']);
    if (strlen($trimmed_password) < 6)
        $errors['password'] .= '<p>Password cannot be less than 6 chars!</p>';
    else if(!preg_match('/.*[A-Z].*/',$trimmed_password))
        $errors['password'] .= '<p>Password should contain at least 1 uppercase letter</p>';
    else if(!preg_match('/.*[a-z].*/',$trimmed_password))
        $errors['password'] .= '<p>Password should contain at least 1 lowercase letter</p>';
    else if(!preg_match('/.*\d{2}/',$trimmed_password))
        $errors['password'] .= '<p>Password should contain at least 2 numbers</p>';
    else
        $clean['password'] = $trimmed_password;
    
    
    if (count($errors) === 0) {
        $hashed_password = password_hash($trimmed_password, PASSWORD_DEFAULT);
        $data = array(
        'username' => $clean['username'],
        'user_password' => $hashed_password,
        'user_role' => $_POST['user-role']
        );
        if (insertData($data,"User")) {
            $reset = true;
            echo '<div class="success">
                    User registered successfully!
                </div>';
        } else {
            echo '<div class="fail">
                    User registration failed!</div>';
        }
    }
}


?>


<div id="page">
        <div id="wide-content">
            <div>

            <center> <p id="head-text"><h2>Register</h2> </p>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                
                <label >Choose how you want to register:</label>
                <select name="user-role" >
                    <option value="Artist">Artist</option>
                    <option value="Client" default>Client</option>
                </select><br><br>
                <label>Username</label>
                <input type="text" name="username" value="<?php echo (isset($_POST['username']) && !$reset)? htmlentities($_POST['username']):"" ?>"><br><br>

                <div style="color:darkred">
                    <?php 
                        if(isset($errors['username'])){
                            echo $errors['username'].'<br><br';
                    }?>
                </div>

                <label>Password</label>
                <input type="password" name="password"><br><br>

                <div style="color:darkred">
                    <?php
                        if(isset($errors['password'])){
                            echo $errors['password'].'<br><br>';
                        }
                    ?>
                    
                </div>
                
                <input type="submit" name= "submit" value="Register" style="margin-left:14em;">
        
            
            </form>
            
            </center>
        </div>
    </div>
</div>

<?php require_once 'footer.php'?>
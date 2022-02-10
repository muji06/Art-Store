<?php require_once 'navbar.php';
require_once 'connectdb.php';


#if people try to brute force the entrance to login, redirect them back to login as menu
if(!isset($_COOKIE['user_role'])){
   header('location loginas.php');
   exit;
}

$user = $_COOKIE['user_role'];
$reset = false;

?>



<?php 
if(isset($_POST['submit'])){
   $clean = array();
   $errors = array();
   $trimmed_username = trim($_POST['username']);
   if(strlen($trimmed_username) == 0)
         $errors['username'] = '<p>Username field is empty</p>';
   else 
         $clean['username'] = $trimmed_username;
   $trimmed_password = trim($_POST['password']);
   if(strlen($trimmed_password) === 0)
         $errors['password'] = '<p>Password field is empty</p>';
   else
         $clean['password'] = $trimmed_password;
   if(count($errors) === 0) {
      $sql = 'SELECT * FROM `User` WHERE username =? AND user_role =?';
      $stmt = $pdo -> prepare($sql);
      $stmt -> bindParam(1, $trimmed_username);
      $stmt -> bindParam(2,$user);
      $stmt -> execute();
      if($stmt -> rowCount() == 1) {
         $user_row = $stmt -> fetch();
         if(password_verify($trimmed_password, $user_row['user_password'])) {
            session_start();
            $reset = true;
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $user_row['username'];
            $_SESSION['role'] = $user_row['user_role'];
            
            echo '<div class="success">
                     You are now logged in as '.$_SESSION['username'].'</div>';
            header("location: index.php");//kjo psh qe e cone duhet ta coje te index ? apo do e coje ne nje te ri market place psh
            } else{
               $errors['password'] = 'Incorrect Password!';
            }
         } else{
            $reset = true;
            $errors['username'] = "Username does not exist for $user role.";
      }
   }
}
?>

<div id="page">
			<div id="wide-content">
				<div>

            <center> <p id="head-text"><h2>Log In</h2></p>
               <?php echo '<p style="color: rgb(7, 34, 39)">as '.htmlentities($user).'</p>'?>
            
               <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
               
                  <label>Username</label>
                  <input type="text" name="username" value="<?php echo (isset($_POST['username'])  && !$reset) ? htmlentities($_POST['username']) : ''; ?>"><br><br>
                  <div>
                     <?php
                     if(isset($errors['username'])){
                        echo $errors['username'].'<br><br>';
                     }
                     ?>
                  </div>
                  <label>Password</label>
                  <input type="password" name="password"><br><br>
                  <div>
                     <?php
                        if(isset($errors['password'])){
                           echo $errors['password'].'<br><br>';
                        }
                     ?>
                  </div>
                  
                  <input type="submit" value="Enter" style="margin-left:13em;" name="submit">
                  <hr width="30%">
                  <h5><p>Don't have an account? <a href="register.php">Sign up</a></p></h5>
                  
               </form>
               
            </center>
               

            </div>
			</div>
	   </div>

     

<?php require_once 'footer.php'?>          
<?php require_once 'navbar.php'; 
      require 'connectdb.php';

      if(!isset($_SESSION['authenticated'])){
            header('location loginas.php');
            exit;
      }

?>


<?php 
$name=$_SESSION['username'];
echo "<h2>Hello ".$name."! Welcome to your Profile</h2>";
$role = $_SESSION['role'];

if($role=="Artist"){
      $sql = "SELECT * FROM `Art` WHERE `art_artist` = '$name'";
      $artist_work = sqlQuery($sql);
      echo '<div class="bigbox">
      <div class="buttons">
              <ul>
              <li><a href="#home" id="showList">Your Art Work </a></li>
              <li><a href="createArt.php" id="createArt">Creat New</a></li>
              </ul>
      </div>';
      if(count($artist_work) > 0){
            if($rows['art_artist'] == $rows['art_owner']){
                  $owner = "You";
            }
            else{
                  $owner = $rows['art_owner'];
            }
            echo '
            <div class="main_content_header">
                  <div class="pic"><p>Picture</p></div>
                  <div class="pic-name"><p>Picture-Name</p></div>
                  <div class="price"><p>Price</p></div>
                  <div class="owner"><p>Owner</p></div>
                  <div class="update"><a href="#"><p>Update</p></a></div>
                  <div class="delete"><a href="#"><p>Delte</p></a></div>
            </div>';

            echo '<div id="hidden" style="display:none"><hr></div>';

            foreach($artist_work as $rows){
                  
                  echo '
                  <div class="main_content">
            
                  <div class="pic"><img src="'.$rows['art_link'].'" width="200" height="auto"></div>
                  <div class="pic-name"><p>'.$rows['art_name'].'</p></div>
                  <div class="price"><p>'.$rows['price'].'$</p></div>
                  <div class="owner"><p>'.$owner.'</p></div>
                  <div class="update"><a href="#"><p>Update</p></a></div>
                  <div class="delete"><a href="#"><p>Delte</p></a></div>
            
                  </div>';
            }
      }
      else
      {echo 'no data';}
}

else if($role=="Client"){
      $sql = "SELECT * FROM `Art` WHERE `art_owner` = '$name'";
      $inventory = sqlQuery($sql);
      echo '<div class="bigbox">
      <div class="buttons">
              <ul>
              <li><a href="#home" id="showList">Your Inventory</a></li>
              </ul>
      </div>';
      if(count($inventory) > 0){
            echo '
            <div class="main_content_header">
                  <div class="pic"><p>Picture</p></div>
                  <div class="pic-name"><p>Picture-Name</p></div>
                  <div class="price"><p>Price</p></div>
                  <div class="artist"><p>Made By</p></div>
                  <div class="update"><a href="#"><p>Update</p></a></div>
                  <div class="delete"><a href="#"><p>Delte</p></a></div>
            </div>';

            echo '<div id="hidden" style="display:none"><hr></div>';

            foreach($inventory as $rows){
                  
                  echo '
                  <div class="main_content">
            
                  <div class="pic"><img src="'.$rows['art_link'].'" width="200" height="auto"></div>
                  <div class="pic-name"><p>'.$rows['art_name'].'</p></div>
                  <div class="price"><p>'.$rows['price'].'$</p></div>
                  <div class="artist"><p>'.$rows['art_artist'].'</p></div>
                  <div class="update"><a href="#"><p>Update</p></a></div>
                  <div class="delete"><a href="#"><p>Delte</p></a></div>
            
                  </div>';
            }
      }
      else
      {echo 'no data';}
}
else if($role =="Admin"){
      $sql = "SELECT `username`,`user_role`,(SELECT COUNT(1) FROM `Art` as ta WHERE ta.art_owner = `User`.`username`)as owned from `User`;";
      $userList = sqlQuery($sql);
      echo '<div class="bigbox">
            <div class="buttons">
              <ul>
              <li><a href="#home" id="showList">Show Users</a></li>
              </ul>
      </div>';
      if(count($userList) > 0){
            echo '
            <div class="main_content_header">
                  <div class="artist"><p>Username</p></div>
                  <div class="artist"><p>Role</p></div>
                  <div class="artist"><p>Owned Art Number</p></div>
            </div>';

            echo '<div id="hidden" style="display:none"><hr></div>';

            foreach($userList as $rows){
                 
                  echo '
                  <div class="main_content">
                  <div class="artist"><p>'.$rows['username'].'</p></div>
                  <div class="artist"><p>'.$rows['user_role'].'</p></div>
                  <div class="artist"><p>'.$rows['owned'].'</p></div>
                  </div>';
            }
      }
      else
      {echo 'no data';}

}
else{
      header('location: loginas.php');
      exit;
}

?>


<script>
      document.querySelector('#showList').addEventListener('click',()=>{
            document.querySelector('.main_content_header').style.display = "flex"
            document.querySelectorAll('.main_content').forEach(div =>{
                  div.style.display = "flex"
            })
            document.querySelectorAll('#hidden').forEach(hr =>{
                  hr.style.display = "block"
            })
      })

     
</script>

<style>
      img{
            transition: padding-left 1s ;
            /* transition: width 1s 0.5s;
           transition: height 1s 0.5s; */
      }
      img:hover{
            padding-left: 5em;
            transform: scale(2);
            /* width: 30%;
            height: auto; */
           
      }
</style>

<?php require_once 'footer.php'?>          




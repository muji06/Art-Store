<?php require_once 'navbar.php';
    require 'connectdb.php';
?>
<?php 
    if(!$_SESSION['authenticated']){
        header('location: loginas.php');
        exit;
    }
    //all the photos that are not bought yet
    $sql = "SELECT art_link, art_name, art_artist, price FROM `Art` WHERE `art_artist` = `art_owner`;";
    $list = sqlQuery($sql);
?>

<H2>Market Place</H2>

<table class="market">
    <tr>
        <th></th>
        <th></th>
        <th></th>
    </tr>
<?php 
    echo '<tr class="rows">';
    $count = 0;
    foreach($list as $row){
        $count ++;
        if($count % 4 == 0){
            echo '</tr><tr class="rows">';
        }

        echo '<td>
        <div class="overlay">
            <div id="page">
                <div id="wide-content">
                    <div id="table-preview">
                    <table>
                        <tr><td align="center" colspan=2 ><img src="'.$row['art_link'].'" class="prev-photo"></td></tr>
                        <tr><td align="center" colspan=2 style="color:rgb(7, 34, 39)"><h4>'.$row['art_name'].'</h4></td></tr>
                        <tr><td style="color:rgb(7, 34, 39)"><h5>Made by:</h5></td><td align="right" style="color:rgb(7, 34, 39)"><h5>'.$row['art_artist'].'</h5></td></tr>
                        <tr><td style="color:rgb(7, 34, 39)"><h4>Price:</h4></td><td align="right" style="color:rgb(7, 34, 39)"> <h2>'.$row['price'].'$</h2></td></tr>
                        <tr><td></td><td id="buy" colspan=2><a><h3>&emsp;Buy&emsp;</h3></a></td></tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        </td>';
        
    }
    echo '</tr>';

?>

</table>
<style>

    
    .rows{
        width: 100%;

    }
    .market{
        border:1px;
        width: 100%;
        border-right: 2px;
        border-bottom: 2px;
        border-style: solid;
    }
    .overlay{
        display: flex;
    }
    .prev-photo{
        width: 90%;
        height: auto;
    }

    #wide-content{
        padding: 20px;
        border-radius: 10%;
    }
    .overlay{
        width: 500px;
        height: auto;
    }
    #buy{
        float: right;
        background-color: rgb(7, 34, 39);
        color:rgb(174, 254, 255);
        border-radius: 30%;
    }
      
</style>

<?php require_once 'footer.php'?>
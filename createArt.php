<?php require_once 'navbar.php';
    require 'connectdb.php';
?>


<?php 

if(isset($_POST['submit'])){
    $clean = array();
    $errors = array();
    
    $trimmed_name = trim($_POST['art_name']);
    //check the length
    if(strlen($trimmed_name) > 255){
        $errors['art_name'] .= 'Name must not exceed 255 characters!';
    }
    // only use numbers, letters, hyphen, quotes, comma and full stop
    else if(preg_match('/^[a-zA-Z0-9 \-\'\".,]+$/',$trimmed_name)){
        $clean['art_name'] = $trimmed_name;
    }
    else{
        $errors['art_name'] .= 'The only allowed symbols are _\'".,';
    }
    //if a price is given, we save that price
    if(isset($_POST['art_price'])){
        $clean['art_price'] = $_POST['art_price'];
    }
    else{
    //if not price is given, then we set the price as 0
        $clean['art_price'] = 0;
    }

    $url = $_POST['url'];
    // we check the header content
    $header = get_headers($url,1);
   
    if(strlen($url) >255){
        $errors['url'] = 'URL must not exceed 255 characters';

    } // if Content-Type specifies an image then this what we are searching for
    else if(strpos($header['Content-Type'],'image/') === FALSE){
        $errors['url'] = 'Link is either wrong or does not lead to a picture!';
    }
    else{
        $clean['url'] = $url;
    }

    if(count($errors) === 0){
        $data = array(
        'art_link' => $clean['url'],
        'art_name' => $clean['art_name'],
        'art_artist' => $_SESSION['username'],
        'art_owner' => $_SESSION['username'],
        'price' => $clean['art_price']
        );
        if(insertData($data, 'Art')){
            echo '<div class="success"> 
                    Your art was successfully created!
                </div>';
        }
        else{
            echo '<div class="fail"> 
                    Something went wrong , your art was not created!
                </div>';
        }
    }
}

?>



<div id="page">
    <div id="wide-content">
        <div>
            <center>
                
                <p id="head-text"><h2>Create new Art</h2> </p>
                <table>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <tr>
                    <td><label style="color:rgb(7, 34, 39)">Art Name:</label></td>
                    <td><input type="text" name="art_name" id="art_name"></td>
                </tr>
                <tr><td align="right" style="color:darkred" colspan=2>
                    <?php 
                    if(isset($errors['art_name'])){
                        echo '*'.$errors['art_name'];
                    }?>
                    </td></tr>
                <tr>
                    <td><label style="color:rgb(7, 34, 39)">Price</label></td>
                    <td><input type="number" name="art_price" id="art_price"></td>
                </tr>
                <tr>
                    <td><label style="color:rgb(7, 34, 39)">Upload URL: </label></td>
                    <td><input type="url" name="url" id="url"></td>
                </tr>
                <tr><td align="right" style="color:darkred" colspan=2>
                    <?php 
                    if(isset($errors['url'])){
                        echo '*'.$errors['url'];
                    }?>
                    </td></tr>
                <tr>
                    <td></td>
                    <td align="right"><button type="button" name="preview" id="preview">Preview</button>
                                    <button type="submit" name="submit" id="submit">Submit</button></td>
                </tr>
                </form>
                <tr><td align="right" style="color:darkred" colspan=2 id="errors"></td></tr>
                </table>
            </center>
        </div>
    </div>
</div>

<div class="overlay">
    <center><p id="head-text" style="color:rgb(7, 34, 39)"><h2>Preview</h2> </p></center>
    <div id="page" style="width: 40%;">
        <div id="wide-content">
            <div id="table-preview"></div>
        </div>
    </div>
</div>

<style>
    #table-preview{
        width: 100%;
    }
    .overlay{
        display: none;
    }
    .prev-photo{
        width: 100%;
        height: auto;
    }

</style>
<script>
// button 
var preview = document.querySelector('#preview')
// big class which is hidden
var overlay = document.querySelector('.overlay')
// div where we will insert the data
var data = document.querySelector('#table-preview')
// table element to display errors if we have any
var error = document.querySelector('#errors')

preview.addEventListener('click', ()=>{
    var artName = document.querySelector('#art_name').value
    var artPrice = document.querySelector('#art_price').value
    var artURL = document.querySelector('#url').value
    //only show preview if fields are not empty
    if(artName.length > 0 && String.toString(artPrice).length > 0 && artURL.length > 0){
        overlay.style.display = 'block'
        displayTable(data, artURL, artName, artPrice)
        error.innerHTML = ""
    }
    else{
        error.innerHTML = "*You must fill all the areas!"
        overlay.style.display = 'none'
    }

})

function displayTable(inner, photo, description, price){
    inner.innerHTML = `<table style="width:100%">
                        <tr><td align="center" colspan=2><img src="${photo}" class="prev-photo"></td></tr>
                        <tr><td align="center" colspan=2 style="color:rgb(7, 34, 39)"><h4>${description}</h4></td></tr>
                        <tr><td style="color:rgb(7, 34, 39)"><h5>Made by:</h5></td><td align="right" style="color:rgb(7, 34, 39)"><h5> <?php echo htmlentities($_SESSION['username'])?> </h5></td></tr>
                        <tr><td style="color:rgb(7, 34, 39)"><h4>Price:</h4></td><td align="right" style="color:rgb(7, 34, 39)"> <h2>${price}$</h2></td></tr>
                        </table>`
}
</script>


<?php 
require_once 'footer.php';
?>
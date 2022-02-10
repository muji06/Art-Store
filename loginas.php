<?php require_once 'navbar.php' 

?>

<div id="page">
			<div id="wide-content">
				<div>

                   <center> <p id="head-text"><h2>Welcome</h2> </p></center>
					<div class="flex-container">
						<a href="login.php" id="admin">
							<div>
								<p class="logo"><b>Enter As Admin</b></p>
							
					  		</div>
					  	</a>
						  <a href="login.php" id="artist">
							<div>
								<p class="logo"><b>Enter As Artist</b></p>
							
					  		</div>
					  	</a>
						  <a href="login.php" id="client">
							<div>
								<p class="logo"><b>Enter As Client</b></p>
							
					  		</div>
					  	</a>
					</div>
				  </div>
			</div>
	 </div>
     

<script>
document.querySelector('#admin').addEventListener('click',()=>{
	document.cookie = 'user_role=admin'
})
document.querySelector('#artist').addEventListener('click',()=>{
	document.cookie = 'user_role=artist'
})
document.querySelector('#client').addEventListener('click',()=>{
	document.cookie = 'user_role=client'
})
</script>

<?php require_once 'footer.php'?>
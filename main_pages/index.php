<?php
  session_start();
  if (!isset($_SESSION['email'])) {
  	$_SESSION['ecouncildb'] = "Πρέπει να συνδεθείτε πρώτα";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>E council</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/////styling.css">
  <style>
body {
    background-image: url("images/evoting.jpg");
  min-height: 750px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
}
</style>
</head>
<body>
  <br> <h1 class="text-light">Ecouncil online<br>Forum and voting!</i></h1> <br>
  <header>
	   <div id="header-inner">
		     <a href="index.php" id="logo"></a>
		       <nav>
		           <a href"#" id="menu-icon"></a>
			         <ul>
			              <li><a href="index.php" class="current">home</a></li>
                    <li><a href="#">voting</a></li>
                    <li><a href="#">forum</a></li>
			         </ul>
			     </nav>
		 </div>
	</header>
  <br> <h1 class="text-white"> h psifos sou metra! </i></h1> <br>
     <div class="logout1">
  	    <?php if (isset($_SESSION['success'])) : ?>
          <div class="error success" >
      	     <h3>
               <?php
          	    echo $_SESSION['success'];
          	    unset($_SESSION['success']);
               ?>
      	     </h3>
          </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

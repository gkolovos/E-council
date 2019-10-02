<?php
session_start();
$email = "";
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'ecouncildb');

// LOGIN USER
if (isset($_POST['login_user'])) {
  $user_email = mysqli_real_escape_string($db, $_POST['user_email']);
  $user_pass = mysqli_real_escape_string($db, $_POST['user_pass']);

  if (empty($user_email)) {
  	array_push($errors, "Απαιτείται email");
  }
  if (empty($user_pass)) {
  	array_push($errors, "Απαιτείται κωδικός");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM student WHERE email='$user_email' AND password='$user_pass'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $email;
  	  $_SESSION['success'] = "";
  	  header('Location: index.php');
  	} else {
  		array_push($errors, "Λανθασμένος συνδιασμός user_email/user_password");
  	}
  }
}
?>

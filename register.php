<!doctype html>
<?php
session_start();

if( isset($_SESSION['user'])!="" ){
header("Location: profile.php");
}

include_once 'connect.php';

if ( isset($_POST['sca']) ) {
  $username = trim($_POST['username']);
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $pass = trim($_POST['pass']);
  $password = hash('sha256', $pass);

  $query = "insert into people(username,fname,lname,pass) values(?, ?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$username,$fname,$lname,$password]);
  $rowsAdded = $stmt->rowCount();

  if ($rowsAdded == 1) {
    $message = "Success! Proceed to login";
    unset($fname);
    unset($lname);
    unset($pass);
    header("Location: login.php");
  }
  else
  {
    $message = "Failed! For some reason";
  }
}
?>

<html>
<style>
.myDiv {
  border: 2px solid black;
  background-color: #e7d3d3;
  padding-left: 40px;
  width: 350px;
}
</style>
<head>
    <title>Alex Zheng: Patient Portal</title>
</head>
<body>
<h1>Create an account here!</h1>
<form action="register.php" method="post">
Username: <input type="text" name="username" /><br /><br />
First Name: <input type="text" name="fname" /><br /><br />
Last Name: <input type="text" name="lname" /><br /><br />
Password: <input type="password" name="pass" /><br /><br />
<input type="submit" name="sca" value="Create Account" /> <br />
<p>Passwords will be asked to change every 90 days</p><br><br>
<div class="myDiv">
<p><a href="http://192.168.0.7/htmllab.php">Homepage</a></p><br><br>
</div>
<img src="https://images.pexels.com/photos/4226764/pexels-photo-4226764.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Heart Stethoscope">
</body>
</html>

<!doctype html>
<?php
session_start();

if( isset($_SESSION['user'])!="" ){
   header("Location: profile.php");
}
include_once 'connect.php';

if ( isset($_POST['sca']) ) {
    $username = trim($_POST['username']);
    $pass = trim($_POST['pass']);
    $password = hash('sha256', $pass);
    
    $query = "select userid, username, pass from people where username=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if( $count == 1 && $row['pass']==$password ) {
        $_SESSION['user'] = $row['userid'];
        header("Location: profile.php");
    }
    else {
        $message = "Invalid Login";
    }
    $_SESSION['message'] = $message;
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
<h1>
<?php
  if ( isset($message) ) {
    echo $message;
  }
?>
</h1></p>

<form action="login.php" method="post">
Username: <input type="text" name="username" /><br /><br />
Password: <input type="password" name="pass" /><br /><br />
<input type="submit" name="sca" value="Login" /> <br />
<div class="myDiv">
<p><a href="http://192.168.0.7/htmllab.php">Homepage</a></p>
</div>

<img src="https://images.pexels.com/photos/40568/medical-appointment-doctor-healthcare-40568.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Patient Form">

</form>
<p></p>
</body>
</html>

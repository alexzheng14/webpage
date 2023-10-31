<?php
ob_start();
session_start();
require_once 'connect.php';
if(!isset($_SESSION['user'])){
  header("Location: index.php");
  exit;
}

$query = "SELECT * FROM people WHERE userid=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user']]);
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<html>
<head><title>You are logged in successfully!</title></head>

<style>
.myDiv {
  border: 2px solid black;
  background-color: #e7d3d3;
  padding-left: 40px;
  width: 350px;
}
</style>
<body>
Welcome to your personalized patient portal <?php echo $userRow['fname']; ?>!
<table><tr>
<td><a href="htmllab.php">Home</a></td>
<?php
  if($userRow['role'] == "administrator") {
    echo "<td><a href='edit.php'>EDIT</a></td>";
    echo "<td><a href='adduser.php'>ADD USERS</a></td>";
    echo "<td><a href='removeuser.php'>REMOVE USERS</a></td>";
  }
?>

<div class="myDiv">
<p><a href="logout.php">Logout Here</a></p>
</div>
<img src="https://www.shutterstock.com/image-photo/welcome-plate-hands-medical-doctor-600w-1765243046.jpg" alt"Hospital Welcoming">
</body>
</html>

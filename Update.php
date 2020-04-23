<?php
  session_start();
  if(!isset($_COOKIE['isloggedin'])){
    header('location:Index.php');
    exit();
  }
  $n = $_REQUEST["N"];
  $sa = $_REQUEST["StreetAddress"];
  $s = $_REQUEST["State"];
  $c = $_REQUEST["City"];
  $z = $_REQUEST["Zipcode"];
  $pn = $_REQUEST["PhoneNumber"];
  $i = $_REQUEST["Income"];
  $r = $_REQUEST["Revenue"];
  if(isset($_REQUEST['Add'])){
    $conn = new mysqli("localhost","ebrown92","ebrown92","ebrown92");
    if (!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    $q = $conn->prepare("INSERT INTO zoos (Name, Street_Address, City, State, Zipcode, Phone_Number, Income, Revenue) VALUES
    ('$n','$sa','$c','$s','$z','$pn','$i','$r')");
    $q->execute();
    mysqli_close($conn);
  }
  if(isset($_REQUEST['Delete'])){
    $conn = new mysqli("localhost","ebrown92","ebrown92","ebrown92");
    if (!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    $q = $conn->prepare("DELETE FROM zoos WHERE Name=?");
    $q->bind_param("s",$n);
    $q->execute();
    mysqli_close($conn);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>About Us</title>
    <link rel="stylesheet" href="mini2.css">
  </head>
  <body>
    <div id="left_side"></div>
    <div id="right_side"></div>
    <h1 id="T">About Us</h1>
    <table id="tabs">
      <h3>
        <tr>
          <td><a href="Find.php">Find a Zoo</a></td>
          <td><a href="Income.php">Income/Revenue</a></td>
          <td><a href="Statistics.php">Statistics</a></td>
          <td><a href="Update.php">Update</a></td>
          <td><a href="About.php">About Us</a></td>
        </tr>
      </h3>
    </table>
    <br><br>
    <h2>Add New Zoo</h2>
    <form class="" action="" method="post">
      Name: <input type="text" name="N" placeholder="Name">
      <br><br>Street Address: <input type="text" name="StreetAddress" value="" placeholder="Street Address">
      <br><br>State: <input type="text" name="State" value="" placeholder="ST">
      <br><br>City: <input type="text" name="City" placeholder="City">
      <br><br>Zip: <input type="number" name="Zipcode" placeholder="Zip">
      <br><br>Phone Number: <input type="number" name="PhoneNumber" placeholder="Phone Number">
      <br><br>Income: <input type="number" name="Income" placeholder="Income">
      <br><br>Revenue: <input type="number" name="Revenue" placeholder="Revenue">
      <br><br><input type="submit" name="Add" value="Add">
    </form>
    <br><br>
    <h2>Delete Zoo</h2>
    <form class="" action="" method="post">
      Name: <input type="text" name="N" placeholder="Name">
      <br><br><input type="submit" name="Delete" value="Delete">
    </form>
  </body>
</html>
<style>
.about {
  margin: auto;
  width: 60%;
}
#T{
  font-size:4vw;
}
#P{
  font-size:2vw;
}
</style>

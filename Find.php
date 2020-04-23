<?php
  session_start();
  if(!isset($_COOKIE['isloggedin'])){
    header('location:Index.php');
    exit();
  }
  $s=$_REQUEST['State'];
  $c=$_REQUEST['City'];
  $z=$_REQUEST['Zipcode'];
  $unfilled="";
  if(empty($s)){
    $unfilled="s";
    if(empty($c)){
      $unfilled="sc";
      if(empty($z)){
        $unfilled="scz";
      }
    }elseif(empty($z)){
      $unfilled="sz";
    }
  }elseif(empty($c)){
    $unfilled="c";
    if(empty($z)){
      $unfilled="cz";
    }
  }elseif(empty($z)){
    $unfilled="z";
  }else{
    $unfilled="";
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <br>
    <title>Zoo Near You</title>
    <link rel="stylesheet" href="mini2.css">
  </head>
  <body>
    <h2 id="T3"></h2>
    <h1 id="T1">Find a Zoo Near You!</h1>
    <h2 id="T2">Welcome <?= $_SESSION['username'] ?></h2>
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
    <div id="left_side"></div>
    <div id="right_side"></div>

    <br><br>
    <form class="" action="" method="post">
      State: <input type="text" name="State" value="" placeholder="ST">
      <br><br>City: <input type="text" name="City" placeholder="City">
      <br><br>Zip:<input type="text" name="Zipcode" placeholder="Zip">
      <br><br><input type="submit" name="Submit" value="Search">
    </form>
    <br><br>
    <br><br>
    <h2 id="T4">Results</h2>
    <table id="data" align="center">
      <tr>
        <td>Name</td>
        <td>Street Address</td>
        <td>Phone Number</td>
      </tr>
      <?php
      if(isset($_REQUEST['Submit'])){
        $conn = new mysqli("localhost","ebrown92","ebrown92","ebrown92");
        if (!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }
        if($unfilled == ""){
          $q = $conn->prepare("SELECT Name,Street_Address,Phone_Number FROM zoos WHERE State=? AND City=? AND Zipcode=?");
          $q->bind_param("ssi",$s,$c,$z);
          $q->execute();
          $r = $q->get_result();
        }elseif ($unfilled=="scz") {
          $q = $conn->prepare("SELECT Name,Street_Address,Phone_Number FROM zoos");
          $q->execute();
          $r = $q->get_result();
        }elseif ($unfilled=="s") {
          $q = $conn->prepare("SELECT Name,Street_Address,Phone_Number FROM zoos WHERE City=? AND Zipcode=?");
          $q->bind_param("si",$c,$z);
          $q->execute();
          $r = $q->get_result();
        }elseif ($unfilled=="sc") {
          $q = $conn->prepare("SELECT Name,Street_Address,Phone_Number FROM zoos WHERE Zipcode=?");
          $q->bind_param("i",$z);
          $q->execute();
          $r = $q->get_result();
        }elseif ($unfilled=="c") {
          $q = $conn->prepare("SELECT Name,Street_Address,Phone_Number FROM zoos WHERE State=? AND Zipcode=?");
          $q->bind_param("si",$s,$z);
          $q->execute();
          $r = $q->get_result();
        }elseif ($unfilled=="cz") {
          $q = $conn->prepare("SELECT Name,Street_Address,Phone_Number FROM zoos WHERE State=?");
          $q->bind_param("s",$s);
          $q->execute();
          $r = $q->get_result();
        }elseif ($unfilled=="z") {
          $q = $conn->prepare("SELECT Name,Street_Address,Phone_Number FROM zoos WHERE State=? AND City=?");
          $q->bind_param("ss",$s,$c);
          $q->execute();
          $r = $q->get_result();
        }elseif ($unfilled=="sz") {
          $q = $conn->prepare("SELECT Name,Street_Address,Phone_Number FROM zoos WHERE City=?");
          $q->bind_param("s",$c);
          $q->execute();
          $r = $q->get_result();
        }

        if(empty($row = $r->fetch_assoc())){
          $msg="No Results";
        }else{
          $msg="";
          echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Street_Address"] . "</td><td>" . $row["Phone_Number"] . "</td></tr>";
          while($row = $r->fetch_assoc()){
            echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Street_Address"] . "</td><td>" . $row["Phone_Number"] . "</td></tr>";
          }
        }
        mysqli_close($conn);
      }
      ?>
    </table>
    <h2 id="T5"><?php if($msg=="No Results"){ ?><?= $msg ?><?php } ?></h2>
  </body>
</html>
<script>
  setInterval(function(){
    var endDate = new Date("May 5, 2020").getTime();
    var currentDate = new Date().getTime();
    var difference = Math.floor((endDate - currentDate) / 86400000);

    document.getElementById("T3").innerHTML = difference;
  },100);
</script>
<style>
  #T1{
    font-size:3vw;
    margin-right: 25%;
  }
  #T4{
    font-size:3vw;
  }
  #T2{
    font-size:2vw;
  }
  #T5{
    font-size:2vw;
    color:red;
  }
  #T3{
    font-size:2vw;
    float: left;
    margin-left:25%;
  }
  #data{
    width:45%;
    background-color: #448f33;
    color:white;
  }
</style>

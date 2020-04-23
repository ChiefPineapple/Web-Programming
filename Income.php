<?php
  session_start();
  if(!isset($_COOKIE['isloggedin'])){
    header('location:Index.php');
    exit();
  }
  $n=$_REQUEST['N'];
  $s=$_REQUEST['State'];
  $c=$_REQUEST['City'];
  $z=$_REQUEST['Zipcode'];
  $unfilled="";
  if(empty($s)){
    $unfilled="s";
    if(empty($n)){
      $unfilled="sn";
    }
    if(empty($c)){
      $unfilled="sc";
      if(empty($z)){
        $unfilled="scz";
        if(empty($n)){
          $unfilled="sczn";
        }
      }elseif(empty($n)){
        $unfilled="scn";
      }
    }elseif(empty($z)){
      $unfilled="sz";
      if(empty($n)){
        $unfilled="szn";
      }
    }
  }elseif(empty($c)){
    $unfilled="c";
    if(empty($n)){
      $unfilled="cn";
    }
    if(empty($z)){
      $unfilled="cz";
      if(empty($n)){
        $unfilled="czn";
      }
    }
  }elseif(empty($z)){
        $unfilled="z";
        if(empty($n)){
          $unfilled="zn";
        }
  }elseif(empty($n)){
        $unfilled="n";
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
    <div id="left_side"></div>
    <div id="right_side"></div>
    <h2 id="T">Explore the Income and Revenue of Zoos around the Country!</h2>
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
    <form class="" action="" method="post">
      Name: <input type="text" name="N" placeholder="Name">
      <br><br>State: <input type="text" name="State" value="" placeholder="ST">
      <br><br>City: <input type="text" name="City" placeholder="City">
      <br><br>Zip:<input type="text" name="Zipcode" placeholder="Zip">
      <br><br><input type="submit" name="Submit" value="Search">
    </form>
    <br>
    <h2>Results</h2>
    <table id="data" align="center">
      <tr>
        <td>Name</td>
        <td>State</td>
        <td>City</td>
        <td>Zip Code</td>
        <td>Income</td>
        <td>Revenue</td>
      </tr>
      <?php
        if(isset($_REQUEST['Submit'])){
          $conn = new mysqli("localhost","ebrown92","ebrown92","ebrown92");
          if (!$conn){
            die("Connection failed: " . mysqli_connect_error());
          }
          if($unfilled == ""){
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=? AND City=? AND Zipcode=? AND Name=?");
            $q->bind_param("ssis",$s,$c,$z,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="scz") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE Name=?");
            $q->bind_param("s",$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="s") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE City=? AND Zipcode=? AND Name=?");
            $q->bind_param("sis",$c,$z,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="sc") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE Zipcode=? AND Name=?");
            $q->bind_param("is",$z,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="c") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=? AND Zipcode=? AND Name=?");
            $q->bind_param("sis",$s,$z,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="cz") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=? AND Name=?");
            $q->bind_param("ss",$s,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="z") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=? AND City=? AND Name=?");
            $q->bind_param("sss",$s,$c,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="sz") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE City=? AND Name=?");
            $q->bind_param("ss",$c,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="n") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=? AND City=? AND Zipcode=?");
            $q->bind_param("ssi",$s,$c,$z);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="zn") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=? AND City=?");
            $q->bind_param("ss",$s,$c);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="zn") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=? AND City=?");
            $q->bind_param("ss",$s,$c);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="sczn") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos");
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="czn") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=?");
            $q->bind_param("s",$s);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="cn") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE State=? AND Zipcode=?");
            $q->bind_param("si",$s,$z);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="szn") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE City=?");
            $q->bind_param("s",$c);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="sn") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE City=? AND Zipcode=?");
            $q->bind_param("si",$c,$z);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="scn") {
            $q = $conn->prepare("SELECT Name,State,City, Zipcode, Income, Revenue FROM zoos WHERE Zipcode=?");
            $q->bind_param("i",$z);
            $q->execute();
            $r = $q->get_result();
          }
          if(empty($row = $r->fetch_assoc())){
            $msg="No Results";
          }else{
            $msg="";
            echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["State"] . "</td><td>" . $row["City"] . "</td><td>" . $row["Zipcode"] . "</td><td>" . $row["Income"] . "</td><td>" . $row["Revenue"] . "</td></tr>";
            while($row = $r->fetch_assoc()){
              echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["State"] . "</td><td>" . $row["City"] . "</td><td>" . $row["Zipcode"] . "</td><td>" . $row["Income"] . "</td><td>" . $row["Revenue"] . "</td></tr>";
            }
          }
          mysqli_close($conn);
        }
      ?>
    </table>
<h2 id="T5"><?php if($msg=="No Results"){ ?><?= $msg ?><?php } ?></h2>
  </body>
</html>
<style>
  #T{
    font-size:2vw;
  }
  #T5{
    font-size:2vw;
    color:red;
  }
  #data{
    width:25%;
    background-color: #448f33;
    color:white;
  }
</style>

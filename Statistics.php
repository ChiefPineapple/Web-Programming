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
    <h2 id="T">Compare and Contrast Zoos' Income and Revenue!</h2>
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
    <form class="Results" onSubmit="createGraph()" method="post">
      <?php
        if(isset($_REQUEST['Submit'])){
          $conn = new mysqli("localhost","ebrown92","ebrown92","ebrown92");
          if (!$conn){
            die("Connection failed: " . mysqli_connect_error());
          }
          if($unfilled == ""){
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=? AND City=? AND Zipcode=? AND Name=?");
            $q->bind_param("ssis",$s,$c,$z,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="scz") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE Name=?");
            $q->bind_param("s",$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="s") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE City=? AND Zipcode=? AND Name=?");
            $q->bind_param("sis",$c,$z,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="sc") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE Zipcode=? AND Name=?");
            $q->bind_param("is",$z,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="c") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=? AND Zipcode=? AND Name=?");
            $q->bind_param("sis",$s,$z,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="cz") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=? AND Name=?");
            $q->bind_param("ss",$s,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="z") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=? AND City=? AND Name=?");
            $q->bind_param("sss",$s,$c,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="sz") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE City=? AND Name=?");
            $q->bind_param("ss",$c,$n);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="n") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=? AND City=? AND Zipcode=?");
            $q->bind_param("ssi",$s,$c,$z);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="zn") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=? AND City=?");
            $q->bind_param("ss",$s,$c);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="zn") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=? AND City=?");
            $q->bind_param("ss",$s,$c);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="sczn") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos");
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="czn") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=?");
            $q->bind_param("s",$s);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="cn") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE State=? AND Zipcode=?");
            $q->bind_param("si",$s,$z);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="szn") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE City=?");
            $q->bind_param("s",$c);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="sn") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE City=? AND Zipcode=?");
            $q->bind_param("si",$c,$z);
            $q->execute();
            $r = $q->get_result();
          }elseif ($unfilled=="scn") {
            $q = $conn->prepare("SELECT Name, Income, Revenue FROM zoos WHERE Zipcode=?");
            $q->bind_param("i",$z);
            $q->execute();
            $r = $q->get_result();
          }
          if(empty($row = $r->fetch_assoc())){
            $msg="No Results";
          }else{
            $counter=0;
            $msg="";
            echo "<input type=\"checkbox\" value=\"Yes\" name=\"" . $counter . "\">" . $row["Name"] . "<br><br>";
            $_SESSION['r'][$counter] = $row["Revenue"];
            $_SESSION['i'][$counter] = $row["Income"];
            $_SESSION['n'][$counter] = $row["Name"];
            while($row = $r->fetch_assoc()){
              $counter++;
              echo "<input type=\"checkbox\" value=\"Yes\" name=\"" . $counter . "\">" . $row["Name"] . "<br><br>";
              $_SESSION['r'][$counter] = $row["Revenue"];
              $_SESSION['i'][$counter] = $row["Income"];
              $_SESSION['n'][$counter] = $row["Name"];
            }
            $_SESSION['counter']=$counter;
          }
          mysqli_close($conn);
        }
      ?>
      <?php if($msg=="No Results"){ ?><?= $msg . "<br><br>" ?><?php } ?>
      <input type="submit" name="Create" value="Create">
    </form>
    <br>
    <h2>Graph</h2>
    <h3 id="tester"></h3>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
    <?php
      $conn = new mysqli("localhost","ebrown92","ebrown92","ebrown92");
      $i=0;
      if(isset($_REQUEST['Create'])){
        $counter=$_SESSION[$counter];
        while($i<=$_SESSION['counter']){
          $r=$_SESSION['r'][$i];
          $income = $_SESSION['i'][$i];
          $name= $_SESSION['n'][$i];
          if($_REQUEST[$i]=='Yes'){
            if(isset($sr1)){
              $sr2=$r;
              $si2=$i;
              $sn2=$name;
            }else{
              $sr1=$r;
              $si1=$i;
              $sn1=$name;
            }
          }
          $i++;
        }

      }
      mysqli_close($conn);
    ?>
    window.onload = function createGraph() {
      var chart = new CanvasJS.Chart("chartContainer", {
	title:{
		text: "Income and Revenue"
	},
	axisX: {
		title: "Zoos"
	},
	axisY: {
		title: "Income",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
  axisY2: {
		title: "Revenue",
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E"
	},
	data: [{
		type: "column",
		name: "Income",
		showInLegend: true,
		yValueFormatString: "#,##0.# Thousand Dollars",
		dataPoints: [
      <?php
      if(isset($_REQUEST['Create'])){
        echo "{ label: \"" . $sn1 . "\",  y: " . $si1 . " },";
        echo "{ label: \"" . $sn2 . "\", y: " . $si2 . " },";
      }else{

      }

      ?>
		]
	},
	{
		type: "column",
    name: "Revenue",
		axisYType: "secondary",
		showInLegend: true,
		yValueFormatString: "#,##0.# Thousand Dollars",
		dataPoints: [
      <?php
      if(isset($_REQUEST['Create'])){
        echo "{ label: \"" . $sn1 . "\",  y: " . $sr1 . " },";
        echo "{ label: \"" . $sn2 . "\", y: " . $sr2 . " },";
      }else{

      }

      ?>


		]
	}]
});
chart.render();
function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}
}
</script>
      <div id="chartContainer" style="width:45%; height:10%;margin-left:30%;"></div>
  </body>
</html>
<style>
  #Graph{
    margin-left:25%;
  }
  #T{
    font-size:2.5vw;
  }
</style>

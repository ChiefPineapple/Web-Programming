<?php
  session_start();
  if(!isset($_COOKIE['isloggedin'])){
    header('location:Index.php');
    exit();
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
    <div class="about">
      <p id="P">This site is all about assisting families in getting out and enjoying local zoos!<br><br>
      Via the 'Find a Zoo' tab you can easily find zoos near you by entering a state, city, or zip code. (State should be entered in 'ST' format.)<br><br>
      If families are curious about going to Zoos that may need the extra revenue or would prefer to visit
      a more popular zoo, they can view revenue, (total income), as well as income, (profit), via the Income/Revenue tab.<br><br>
      The Statistics tab can be used to visualize the differences between two specific zoos of their choosing! Simply search the way you would in the
      Income tab and then select two zoos before hitting 'Create' to see their stats!<br><br>
      The final tab, Update, allows users to input or delete zoos from within the database. Simply fill out the required fields and Submit!
      </p>
    </div>
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
  font-size:1vw;
}
</style>

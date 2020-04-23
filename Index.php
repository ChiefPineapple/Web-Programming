<?php
  session_start();
  if(isset($_POST['Submit'])){
    $expectedusername = "HappyTimes";
    $expectedpassword = "HappyDays";
    if($_POST['username']==$expectedusername && $_POST['password']==$expectedpassword){
      $_SESSION['username']=$expectedusername;
      setcookie('isloggedin','yes',time()+86400000);
      header('location: Find.php');
    }else{
      $err='Authentification Failed';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="mini2.css">
  </head>
  <body>
    <h1 id="T">Find a Zoo Near You Log In</h1>
    <div id="left_side"></div>
    <div id="right_side"></div>
    <br>
    <h3 id="T2"><?php if(isset($err)){ ?><?= $err?><?php ;}?></h3>
    <form class="login" method="post" target="_self">
      Username: <input type="text" name="username" value="" placeholder="Username" required>
      <br><br>Password: <input type="text" name="password" placeholder="Password" required>
      <br><br><input type="submit" name="Submit" value="Submit">
    </form>
  </body>
</html>
<style>
#T{
  font-size:3vw;
}
#T2{
  font-size:2vw;
  color:red;
}
</style>

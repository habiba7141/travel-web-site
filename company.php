<?php
require_once 'connect.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
    <style>
      body {
        font-family: Arial, sans-serif;
      }
      
      form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: skyblue;
      }
      
      label {
        display: block;
        margin-bottom: 10px;
      }
      
      input[type="text"], input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
      }
      
      input[type="submit"] {
        background-color: skyblue;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      
      input[type="submit"]:hover {
        background-color: blue;
      }
      
      .signup-link {
        text-align: center;
        margin-top: 10px;
      }
    </style>
  </head>
  <body>
    <form method="POST">
      <h1>Login</h1>
      <label for="company-name">Company Name</label>
      <input type="text" id="company-name" name="company-name" required>
      
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      
     
      
      <input type="submit" value="Login">
      
      <div class="signup-link">
        Don't have an account? <a href="c signup.php">Sign up</a>
      </div>
    </form>
    <?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{
   
    $name= htmlspecialchars($_POST['company-name']);
    $password= htmlspecialchars($_POST['password']);
    $newpass=md5($password);
    $sql="select * from company where cname=:name And password=:pass";
    $stat=$conn->prepare($sql);
    $stat->execute(array(
        ':name'=>$name,
        ':pass'=>$newpass
    ));
    $exist=$stat->fetch(PDO::FETCH_ASSOC);
    if(!$exist)
    echo"Login failed ";
    else
    {
    $_SESSION['companyname']=$exist['name'];
    header('location:trip.php');
    }
 
} 
?>
  </body>
</html>
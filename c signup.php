<?php
require_once 'connect.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up</title>
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
      
     
      
    </style>
  </head>
  <body>
    <form method="POST">
      <h1>Sign up</h1>
      <label for="company-name">Company Name</label>
      <input type="text" id="company-name" name="company-name" required>
      
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      
      <label for="location">Location</label>
      <input type="text" id="location" name="location" required>
      
      <input type="submit" value="sign up">
      
      <div class="login-link">
       <a href="company.php">Back</a>
      </div>
    </form>
    <?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=htmlspecialchars($_POST['company-name']);
        $password=htmlspecialchars($_POST['password']);
        $location=htmlspecialchars($_POST['location']);
        $newpass=md5($password);
        $sql="select * from company where cname=:name";
        $stat=$conn->prepare($sql);
        $stat->execute(array(
            ':name'=>$name
        ));
        $exist=$stat->fetchAll();

        if ($exist)
        echo "user name is already exist";
        else{
            $sql="insert into company (cname,password,location) values (:name,:password,:location)";
            $stat=$conn->prepare($sql);
            $stat->execute(array(
                ':name'=>$name,
                ':password'=>$newpass,
                ':location'=>$location
            ));
         echo "sign up sucsseful";
        }
    }
    ?>
    </body>
    </html>
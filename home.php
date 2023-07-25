<?php
require_once 'connect.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>home</title>
    <style>
      body {
        font-family: Arial, sans-serif;
       
      }
      
      #container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        background-color: skyblue;
      }
      
      #container h1 {
        flex-basis: 100%;
        text-align: center;
      }
      
    
      
      #container form {
        flex-basis: 50%;
        padding: 20px;
      }
      
      input[type="submit"] {
        background-color:skyblue;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      
      input[type="submit"]:hover {
        background-color:blue;
      }
    </style>
  </head>
  <body>
    <div id="container">
      <h1>welcome to our website </h1>
     
      <h1>Are you a traveler or a company?</h1>
    <form method="POST">
      <label>
        <input type="radio" name="user-type" value="traveler">
        Traveler
      </label>
      <br>
      <label>
        <input type="radio" name="user-type" value="company">
        Company
      </label>
      <br>
      <input type="submit" value="Submit">
      </form>
    </div>
    <?php
    session_start();
     if($_SERVER["REQUEST_METHOD"]=="POST")
     {
        $type=htmlspecialchars($_POST["user-type"]);
        if($type=="traveler")
        {
        header("location:traveler.php");
       
        }
       if($type=="company")
        {
        header("location:company.php");
    
        }



     }
    ?>
  </body>
</html>
<?php
require_once "connect.php";
if(!isset($_SESSION['companyname']))
{
  header("location:company.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add trip</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }
      
      form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 5px;
        background-color: white;
        box-shadow: 0 0 10px #ccc;
      }
      
      h1 {
        text-align: center;
        margin-bottom: 20px;
      }
      
      label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
      }
      
      input[type="text"], input[type="number"], input[type="date"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 16px;
      }
      
      input[type="submit"] {
        background-color:  rgba(120, 140, 200, 0.5);
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
      }
      
      input[type="submit"]:hover {
        background-color: blue;
      }
    </style>
  </head>
  <body>
    <form method="POST">
      <h1>Add A New Trip</h1>
      <label for="company-name">Name of Company</label>
      <input type="text" id="company-name" name="company-name" required>

      <label for="place">Place</label>
      <input type="text" id="place" name="place" required>

      <label for="price">Price</label>
      <input type="number" id="price" name="price" required>
      
      <label for="date">Date</label>
      <input type="text" id="date" name="date" required>
      
      
    <?php 
     session_start();
     if($_SERVER["REQUEST_METHOD"]=="POST")
     {
         $name=htmlspecialchars($_POST['company-name']);
         $place=htmlspecialchars($_POST['place']);
         $price=htmlspecialchars($_POST['price']);
         $date=htmlspecialchars($_POST['date']);
             $sql="insert into trip (tcname,place,price,date) values (:name,:place,:price,:date)";
             $stat=$conn->prepare($sql);
             $stat->execute(array(
                 ':name'=>$name,
                 ':place'=>$place,
                 ':price'=>$price,
                 ':date'=>$date
             ));
          echo "your trip is added";
          if($stat){
						echo "<a href='company logout.php'>Log Out</a>";
         }
        }
     
    ?>
     <input type="submit" value="finish">
    </form>
  </body>
</html>
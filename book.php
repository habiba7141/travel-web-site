<?php
require_once "connect.php";
if(!isset($_SESSION['username']))
{
  header("location:traveler.php");
  exit();
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book</title>
    <style>
      body {
        background-color: beige;
      }
      
      h1 {
        color: skyblue;
        text-align: center;
        margin-top: 50px;
      }
      
      table {
        border-collapse: collapse;
        width: 80%;
        margin: 50px auto;
        background-color: white;
        box-shadow: 0 0 10px #ccc;
      }
      
      th, td {
        text-align: center;
        padding: 10px;
        border: 1px solid #ccc;
      }
      
      th {
        background-color: skyblue;
        color: white;
      }
      
      td {
        background-color: beige;
      }
      
    
      
      .submit-button {
        display: block;
        margin: 20px auto;
        padding: 10px;
        background-color: skyblue;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1.2rem;
        cursor: pointer;
      }
      
      .submit-button:hover {
        background-color: dodgerblue;
      }
      label {
        display: block;
        margin-bottom: 10px;
        color:skyblue;
        display: block;
        margin: 20px auto;
        padding: 10px;
        text-align:center;
        font-weight: bold;
      }
      
      input[type="number"] {
        width: 40%;
        box-sizing: border-box;
        display: block;
        margin: 20px auto;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 1.2rem;
       
      }
    </style>
</head>
<body>
    <h1>welcome <?php echo $_SESSION['username'];?> you can book a ticket to:</h1>
    
<?php
$sql="select tid,place,tcname,place,price,date from trip";
$stat=$conn->prepare($sql);
$stat->execute();
if($stat)
{
   
    
    echo"<table>";
    echo"<tr>
    <th>Trip-Id</th>
    <th>Trip</th>
    <th>Company-name</th>
    <th>Price</th>
    <th>Date</th>
    
    <tr>";
    while($table=$stat->fetch(PDO::FETCH_ASSOC))
    {
        
            echo "<tr><td>";
            echo $table['tid'];
            echo "</td><td>";
            echo $table['place'];
            echo "</td><td>";
            echo $table['tcname'];
            echo "</td><td>";
            echo $table['price'];
            echo "</td><td>";
            echo $table['date'];
            echo "</td></tr>";
        
  
    }
    echo "</table>";
    echo"<form method='POST'>";
    echo'<label for="name"> Enter Trip Id</label>
    <input type="number" id="name" name="name" required>';
    echo "<button type='submit' class='submit-button'>Book</button>";
    echo "</form>";
}
if ($_SERVER['REQUEST_METHOD']=="POST")
{
  $sql="insert into persontrip (pid,ptid) values (:pid,:tid)";
  $stat=$conn->prepare($sql);
  $stat->execute(array
  (
    ':pid'=>$_SESSION['id'],
    ':tid'=>$_POST['name']

  ));
  if ($stat)
  {
  $_SESSION['tid']=$_POST['name'];
header("location:pay.php");
  }

}
?>
</body>
</html>
<?php 
require_once "connect.php";
session_start();
if(!isset($_SESSION['username'])&&($_SESSION['role']!="admin"))
{
    header('location:traveler.php');
     exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
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
    <h1>welcome <?php echo $_SESSION['username'];?> </h1>
    
<?php
$sql="select pid,ptid,name,lname,place,price,date,tcname,pnumber,credit from person a,trip b,persontrip c where a.id=c.pid and b.tid=c.ptid ";
$stat=$conn->prepare($sql);
$stat->execute();
if($stat)
{
   
    
    echo"<table>";
    echo"<tr>
    <th>Trip-Id</th>
    <th>Person-Id</th>
    <th>F-Name</th>
    <th>L-Name</th>
    <th>Trip</th>
    <th>Company-name</th>
    <th>Price</th>
    <th>Date</th>
    <th>mobile</th>
    <th>credit</th>
    
    <tr>";
    while($table=$stat->fetch(PDO::FETCH_ASSOC))
    {
        
            echo "<tr><td>";
            echo $table['ptid'];
            echo "</td><td>";
            echo $table['pid'];
            echo "</td><td>";
            echo $table['name'];
            echo "</td><td>";
            echo $table['lname'];
            echo "</td><td>";
            echo $table['place'];
            echo "</td><td>";
            echo $table['tcname'];
            echo "</td><td>";
            echo $table['price'];
            echo "</td><td>";
            echo $table['date'];
            echo "</td><td>";
            echo $table['pnumber'];
            echo "</td><td>";
            echo $table['credit'];
            echo "</td></tr>";
  
    }
    echo "</table>";
    echo"<form method='POST'>";
    echo"<h1>Delete Trip</h1>";
    echo'<label for="name"> Enter Person Id </label>
    <input type="number" id="name" name="pid" required>';
    echo'<label for="name"> Enter Trip Id </label>
    <input type="number" id="name" name="tid" required>';
    echo "<button type='submit' class='submit-button'>Delete</button>";
    echo "<button type='submit' class='submit-button'><a href='logout.php'>Log Out</a></button>";
    echo "</form>";
}
if ($_SERVER['REQUEST_METHOD']=="POST")
{
  $sql="Delete from persontrip where pid=:pid and ptid=:tid";
  $stat=$conn->prepare($sql);
  $stat->execute(array
  (
    ':pid'=>htmlspecialchars($_POST['pid']),
    ':tid'=>htmlspecialchars($_POST['tid'])

  ));
  if ($stat)
  {
  echo "Trip Is Deleted";

  }

}
?>
</body>
</html>

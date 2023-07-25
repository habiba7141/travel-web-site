<?php
session_start();
require_once "connect.php";
if(!isset($_SESSION['username']))
{
  header("location:traveler.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pay</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: beige;
		}
		.container {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
			margin-left: 50px;
		}
		form {
			background-color: white;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px #ccc;
			max-width: 400px;
		}
		h1 {
			text-align: center;
			color: skyblue;
			margin-bottom: 20px;
		}
		input[type="text"], input[type="number"] {
			width: 100%;
			padding: 10px;
			border: none;
			border-bottom: 1px solid #ccc;
			margin-bottom: 20px;
			font-size: 16px;
		}
		input[type="submit"] {
			background-color: skyblue;
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
	<div class="container">
		<form method="POST">
			<h1>Enter Your Mobile and Credit Number</h1>
			<label for="mobile">Mobile Number</label>
			<input type="text" id="mobile" name="mobile" placeholder="Enter mobile number" required>
			<label for="credit">Credit Number</label>
			<input type="text" id="credit" name="credit" placeholder="Enter credit number" required>
			<?php
			if($_SERVER["REQUEST_METHOD"]=="POST") {
				if (isset($_POST['credit']) && isset($_POST['credit'])) {
					$sql= 'update persontrip
					set pnumber=:pnumber
					, credit=:credit
					where pid = :pid and ptid =:tid';
					$statment = $conn->prepare($sql);
					$statment->execute(array(
						':pnumber' => htmlentities($_POST['mobile']),
						':credit' => htmlentities($_POST["credit"]),
						':pid' => $_SESSION['id'],
						':tid' =>  $_SESSION['tid']
					));
					if($statment){
						echo "<p>ticket has been booked</p>" ; 
						echo "<a href='logout.php'>Log Out</a>";
					}
				}
			}
			?>
			<input type="submit" value="Submit">
		</form>
	</div>
</body>
</html>
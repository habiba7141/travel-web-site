<?php
require_once 'config.php';
try{
$conn=new PDO("mysql: host=$servername;dbname=$db",$username,$password);
//echo "sucsseful";
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo"failed".$e->getMessage();
}

?>

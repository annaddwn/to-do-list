<?php
$server="localhost";
$username="root";
$password="";
$database="notes1";
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo "Connection Failed";
}
?>
<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "dbtodo1";

$connection = mysqli_connect($host,$user,$password,$dbname);

if($connection){
    echo 'selamat';
}else{
    echo 'teu hade';
}
?>
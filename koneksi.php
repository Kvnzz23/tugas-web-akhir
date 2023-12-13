<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "proyekweb";

$koneksi    = mysqli_connect($host,$user,$pass,$db);


if(!$koneksi){ //cek koneksi
    die("tidak bisa terkoneksi di database");
}

?>
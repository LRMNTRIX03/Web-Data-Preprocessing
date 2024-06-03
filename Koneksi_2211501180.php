<?php 
// Lutfi Rizaldi Mahida 2211501180
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_pemketir_2211501180";
$conn = mysqli_connect($host, $user, $pass);

if(!$conn) {
 die("Koneksi Mysql Gagal!!". mysqli_connect_error());
 }
 echo ("mysql Berhasil\n");
 
 $sql = mysqli_select_db($conn, $dbname);
 if(!$sql){
 die("Koneksi database gagal!!".mysqli_error($conn));
 }
 echo ("koneksi Database Berhasil");
 ?>
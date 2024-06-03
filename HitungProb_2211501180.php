<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Probabilitas</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
<h1 style=text-align:center>LUTFI RIZALDI MAHIDA 2211501180 </h1>
<table class="table table-bordered table-striped">
        <td colspan="3">
        <button onclick="goBack()">Kembali Ke Form Input Link</button>
        <script>
            function goBack(){
                window.history.back();
            }
        </script>

         </td>
</table>
<br>

<?php
require_once "Koneksi_2211501180.php";
$hapus = "DELETE from probabilitas_kategori_2211501180";
$hapus1 = $conn->query($hapus);
//memunculkan isi dokumen pada tabel preprocessing
$sql = "SELECT * FROM preprocessing_2211501180 where id_kategori is not null order by entry_id";
$result1 = $conn->query($sql);
//untuk mengetahui jumlah kategori yang terdapat pada database
$perintah2 = "SELECT count(*) id_kategori from kategori_2211501180";
$hasil2 = $conn->query($perintah2);
$cek = mysqli_fetch_array($hasil2);
//Hitung jumlah seluruh kategori
$hitung_jum = "SELECT count(*) jml_seluruh from preprocessing_2211501180 ";
$hasil4 = $conn->query($hitung_jum);
$jumlah = mysqli_fetch_array($hasil4);
//Hitung jumlah probabilitas pada tiap kategori

    

if($result1->num_rows == 0){
    echo "Data Tidak Ditemukan";
}
else{
               for($i=1;$i<=$cek['id_kategori'];$i++){
                    $sql3 = "SELECT * From kategori_2211501180 where id_kategori = '$i'";
                    $hasil3 = $conn->query($sql3);
                    $data = mysqli_fetch_array($hasil3);
                    $nama_kategori = $data['nm_kategori'];
                    $jml_data = $jumlah['jml_seluruh'];
                    $sql4 = "SELECT count(*) jml_kategori from preprocessing_2211501180 WHERE id_kategori = '$i'";
                    $hasil6 = $conn->query($sql4);
                    $data_hitung = mysqli_fetch_array($hasil6);
                    $jml_kat = $data_hitung['jml_kategori'];
                    $hitung = $data_hitung['jml_kategori']/$jumlah['jml_seluruh'];
                    $masuk2 = "INSERT INTO probabilitas_kategori_2211501180(id_kategori ,nilai_probabilitas, jml_data_kategori, nm_kategori,jml_data) VALUES ('$i','$hitung', '$jml_kat', '$nama_kategori', '$jml_data')";
                    $hasil7 = $conn->query($masuk2);
               }
               
                    
                
}

$sql = "SELECT * FROM probabilitas_kategori_2211501180";
$result4 = $conn->query($sql);
?>

<table class="table table-bordered table-striped table-hover">
<thead>
    <br></br>
    <tr></tr>
<tr>
    <td colspan="5"><strong>HITUNG DATA PROBABILITAS TIAP KATEGORI</strong></td>
</tr>
<tr bgcolor="#CCCCCC">
<th>No.</th>
<th>Nama kategori</th>
<th>Jumlah Data Tiap Kategori</th>
<th>Nilai Probabilitas</th>
<th>Jumlah Data Seluruhnya</th>
</tr>
</thead>
    <?php
        $i=1;
        while($d = mysqli_fetch_array($result4)){
            ?>
                <tr bgcolor="#FFFFFF">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $d['nm_kategori']; ?></td>
                    <td><?php echo $d['jml_data_kategori']; ?></td>
                    <td><?php echo $d['nilai_probabilitas']; ?></td>
                    <td><?php echo $d['jml_data']; ?></td>

                </tr>
        
        <?php
        $i=$i+1;
        
            }



?>
</table>

    
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Tahap Klasifikasi Data Dengan Algoritma Naive Bayes</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
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

$sql = "UPDATE probabilitas_kata_2211501180 set nilai_probabilitas=0";
$result0 = $conn->query($sql);
$sql = "SELECT * FROM probabilitas_kata_2211501180 order by kata,id_kategori";
$result1 = $conn->query($sql);
if ($result1->num_rows == 0) {
    echo "Data Tidak Ditemukan";
} else {
        $sql = "SELECT count(distinct kata) kosakata from probabilitas_kata_2211501180";
        $result3=$conn->query($sql);
        $d = mysqli_fetch_row($result3);
        $kosakata = $d[0];

        $id = 'x';
        while($d = mysqli_fetch_array($result1)){
            $kata = $d['kata'];
            $id_kategori = $d['id_kategori'];

            if($id != $id_kategori){
                $sql = "SELECT sum(jml_data) N from probabilitas_kata_2211501180 where id_kategori = '$id_kategori'";
                $result3 = $conn->query($sql);
                $d = mysqli_fetch_row($result3);
                $N = $d[0];

                $id = $id_kategori;
            };
            $sql = "SELECT sum(jml_data) NK from probabilitas_kata_2211501180 where kata ='$kata' and id_kategori = '$id'";
            $result2 = $conn->query($sql);
            $d = mysqli_fetch_row($result2);
            $NK = $d[0];

            $nilai = ($NK+1)/($N+$kosakata);

            $q = "UPDATE probabilitas_kata_2211501180 set nilai_probabilitas = '$nilai' where kata ='$kata' and id_kategori = '$id_kategori'";
            $result4 = mysqli_query($conn,$q);

        }   

        
    }


$sql = "SELECT kata, nm_kategori, jml_data, nilai_probabilitas FROM probabilitas_kata_2211501180 a, kategori_2211501180 b
        where a.id_kategori=b.id_kategori order by a.id_kategori,kata";
$result5 = $conn->query($sql);
?>

<table class="table table-bordered table-striped table-hover">
<thead>
    <br></br>
    <tr></tr>
<tr>
    <h1 style="text-align:center" style="text-color:gray">Lutfi Rizaldi Mahida - 2211501180</h1>
</tr>
<tr bgcolor="#CCCCCC">
<th>No.</th>
<th>Kata</th>
<th>Kategori</th>
<th>Jumlah Frekuensi Kata Tiap Kategori</th>
<th>Nilai Probabilitas</th>
</tr>
</thead>
    <?php

        $i=1;
        while($d = mysqli_fetch_array($result5))
        {
        ?>
            <tr bgcolor="#FFFFFF">
                <td><?php echo $i; ?></td>
                <td><?php echo $d[0]; ?></td>
                <td><?php echo $d[1]; ?></td>
                <td><?php echo $d[2]; ?></td>
                <td><?php echo $d[3]; ?></td>
        </tr>
    <?php
    $i=$i+1;
        }
    ?>
</table>
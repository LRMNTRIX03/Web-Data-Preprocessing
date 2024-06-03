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


$sql = "SELECT * FROM probabilitas_kata_2211501180 WHERE id_kategori IS NOT NULL ORDER BY id_kategori";
$result1 = $conn->query($sql);
if ($result1->num_rows == 0) {
    echo "Data Tidak Ditemukan";
} else {
    while ($d = mysqli_fetch_array($result1)) {
        $kata = $d['kata'];
        $id = $d['id_kategori'];

        $sql = "SELECT SUM(jml_data) AS Nilai_kategori FROM probabilitas_kata_2211501180 WHERE kata='$kata' AND id_kategori='$id'";
        $result2 = mysqli_query($conn, $sql);
        $d = mysqli_fetch_row($result2);
        $Nilai_Kategori = $d[0];
        
        $N = "SELECT SUM(jml_data) AS total_nilai FROM probabilitas_kata_2211501180 WHERE id_kategori='$id'";
        $result3 = mysqli_query($conn, $N);
        $d = mysqli_fetch_row($result3);
        $total_nilai = $d[0];
        
        $kosakata = "SELECT COUNT(DISTINCT kata) AS Kosakata FROM probabilitas_kata_2211501180";
        $result4 = mysqli_query($conn, $kosakata);
        $d = mysqli_fetch_row($result4);
        $kata2 = $d[0];
        
        $NilaiProbabilitas = ($Nilai_Kategori+1) / ($total_nilai + $kata2);

        $q = "UPDATE probabilitas_kata_2211501180 SET nilai_probabilitas='$NilaiProbabilitas' WHERE kata='$kata' AND id_kategori='$id'";
        $result5 = mysqli_query($conn, $q);

        
    }
}

$sql = "SELECT kata, id_kategori, jml_data, nilai_probabilitas FROM probabilitas_kata_2211501180";
$result5 = $conn->query($sql);
?>

<table class="table table-bordered table-striped table-hover">
<thead>
    <br></br>
    <tr></tr>
<tr>
    <h1 style="text-align:center" style="text-color:gray">Lutfi Rizaldi Mahida - 2211501180</h1>
    <td colspan = "5"><strong>Vocabulary Pada Setiap Dokumen Data Training</strong></td>
</tr>
<tr bgcolor="#CCCCCC">
<th>No.</th>
<th>Kata</th>
<th>Kategori</th>
<th>Jumlah Seluruh Dokumen Data</th>
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
                <td><?php echo $d['jml_data']; ?></td>
                <td><?php echo $d['nilai_probabilitas']; ?></td>
        </tr>
    <?php
    $i=$i+1;
        }
    ?>
</table>
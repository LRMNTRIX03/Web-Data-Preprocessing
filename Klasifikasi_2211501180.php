<!DOCTYPE html>
<html>
<head>
<title>Tahap Klasifikasi Data Dengan Algoritma Navive Bayes</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
<table class="table table bordered table-striped">
    <td colspan="3">
    <button onclick="goBack()">Kembali Ke Form Input Link</button>
    <script>
        function goBack() {
            window.history.back();
            }
        </script>
        </td>
</table>
<br>

<?php
require_once "Koneksi_2211501180.php";
require_once "Fungsi_2211501180.php";

$sql = "UPDATE classify_2211501180 set id_predicted=null";
$result = mysqli_query($conn,$sql);

$sql = "SELECT * FROM preprocessing_2211501180 where id_kategori is null";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "Data Tidak Ditemukan";
}
else{
    $tmpnilai=0;
    while($d = mysqli_fetch_array($result)) {
                $data = $d['data_bersih'];

                //echo "<br>";
               // echo "Data Uji ==> ".$data;

                $data_array = explode(" ",$data);
                $str_data = array();
                foreach($data_array as $value) {
                    $str_data[] = "".$value;
                    $kata = $value;

                    $sql = "SELECT * FROM probabilitas_kata_2211501180 where kata='$kata'";
                    $result2 = $conn->query($sql);

                    if ($result2->num_rows > 0) {
                        while($d = mysqli_fetch_array($result2)) {
                            $nilai = $d[3];
                            $id = $d[1];
                            $jml = $d[2];

                            //TMP Nilai probabilitas per kategori
                            $tmpnilai = (getTMPNilai($conn,$id));
                            if ($tmpnilai <=0 ) {
                                $tmpnilai = 1;
                            }
                            (float)$totnilai = (float)($tmpnilai*$nilai);

                            $sql = "SELECT * FROM probabilitas_kategori_2211501180 where id_kategori='$id'";
                            $result3 = $conn->query($sql);
                            if ($result3->num_rows > 0){
                                $q = "UPDATE probabilitas_kategori_2211501180 set tmp_nilai=$totnilai where id_kategori='$id'";

                                $result3 = mysqli_query($conn,$q);
                            }
                        }
                    }
                }

            $nilaitertinggi= getNilTertinggi($conn);
            $id_kategori=0;
            if ($nilaitertinggi != 0){
                $id_kategori = getKatTerpilih($conn);
            }

            if ($id_kategori == 0){
                echo " ==> Kategori Tidak Ditemukan";
            }else{
                echo " ==> Kategori Tertinggi : ".getNmKategori($conn,$id_kategori)." (".$nilaitertinggi." )";
            }
                    $sql = "SELECT * FROM classify_2211501180 where data_bersih='$data'";
                    $result4 = $conn->query($sql);

                    if ($result4->num_rows > 0) {
                        $q = "UPDATE classify_2211501180 set id_predicted=$id_kategori where data_bersih='$data'";

                        $result4 = mysqli_query($conn,$q);
                    }else{
                        $q = "INSERT INTO classify_2211501180(data_bersih,id_predicted) VALUES ('$data','$id_kategori')";

                        $result4 = mysqli_query($conn,$q);
                    }

                    $q = "UPDATE probabilitas_kategori_2211501180 set tmp_nilai=0";
                    $result3 = mysqli_query($conn,$q);
                    
    }
}
$per1 = "SELECT * from classify_2211501180";
$hasil1 = $conn->query($per1);
?>
<form action="" method="post">
    <table class="table table-bordered table-striped table-hover">
    <thead>
    <tr></tr>
    <tr>
    <h1 style="text-align:center" style="text-color:gray">Lutfi Rizaldi Mahida - 2211501180</h1>
    <h3>KETERANGAN KATEGORI :</h3>
    <h4>0 = Tidak Ditemukan</h4>
    <h4>1 = Universitas</h4>
    <h4>2 = Ekonomi</h4>
    <h4>3 = Politik</h4>
    </tr>
    <tr bgcolor="#CCCCCC">
    <th>No.</th>
    <th>Data Bersih</th>
    <th>Prediksi Kategori</th>
    </tr>
    </thead>
    <?php

        $i=1;
        while($tangkap = mysqli_fetch_array($hasil1))
        {
        ?>
        
            <tr bgcolor="#FFFFFF">
                <td><?php echo $i; ?></td>
                <td><?php echo $tangkap['data_bersih']; ?></td>
                <td><?php echo $tangkap['id_predicted']; ?></td>
        </tr>
        
    <?php
    $i=$i+1;
        }
    ?>
            </table>
</form>

  

    
        
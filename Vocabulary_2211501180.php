<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

$sql = "delete FROM probabilitas_kata_2211501180";
$result0 = mysqli_query($conn,$sql);

$sql = "SELECT * FROM preprocessing_2211501180 where id_kategori is not null order by entry_id";
$result1 = $conn->query($sql);
if($result1->num_rows == 0){
    echo "Data Tidak Ditemukan";
}
else{
                while($d = mysqli_fetch_array($result1)){
                    $data = $d['data_bersih'];
                    $id_kategori = $d['id_kategori'];

                    $data_array = explode(" ",$data);
                    $str_data = array();
                    foreach($data_array as $value){
                        $str_data[] = "".$value;
                        $kata = $value;

                        $sql = "SELECT * FROM kategori_2211501180";
                        $result2 = $conn->query($sql);

                        if($result2 != false && $result2->num_rows == 0){
                            echo "DATA TIDAK DIETMUKAN";
                        }
                        else{
                            while($d = mysqli_fetch_array($result2)){
                                $id = $d[0];
                                $nm = $d[1];

                                $sql = "SELECT * FROM probabilitas_kata_2211501180 where kata = '$kata' and id_kategori = '$id'";
                                $result3 = $conn->query($sql);

                                if($result3 != false && $result3->num_rows == 0){
                                    $q = "INSERT INTO probabilitas_kata_2211501180(kata,id_kategori)
                                            Values('$kata','$id')";
                                    $result3 = mysqli_query($conn,$q);
                                }
                            }
                        $q="UPDATE probabilitas_kata_2211501180 set jml_data =nvl (jml_data,0) + 1 where kata = '$kata' and id_kategori = '$id_kategori'";
                        $result5 =mysqli_query($conn,$q);
                        }
                    }
                }
}

$sql = "SELECT kata,nm_kategori FROM probabilitas_kata_2211501180 a, kategori_2211501180 b
where a.id_kategori=b.id_kategori order by kata";

$result4 = $conn->query($sql);
?>

<table class="table table-bordered table-striped table-hover">
<thead>
    <br></br>
    <tr></tr>
<tr>
    <td colspan="5"><strong>VOCABULARY PADA SETIAP DOKUMEN DATA TRAINING</strong></td>
</tr>
<tr bgcolor="#CCCCCC">
<th>No.</th>
<th>Kata</th>
<th>Kategori</th>
</tr>
</thead>
    <?php
        $i=1;
        while($d = mysqli_fetch_array($result4)){
            ?>
                <tr bgcolor="#FFFFFF">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $d[0]; ?></td>
                    <td><?php echo $d[1]; ?></td>
                </tr>
        <?php
        $i=$i+1;
            }



?>
</table>

    
</body>
</html>

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

$result =  $conn->query("SELECT data_bersih, id_actual, nm_kategori FROM classify_2211501180 a, kategori_2211501180 b WHERE a.id_predicted = b.id_kategori");
?>
<table class="table table-bordered table-striped table-hover">
<thead>
    <br><br><tr></tr>
<tr>
    <td style="text-align:center" colspan="4"><strong>Menentukan Kategori Aktual Dari Data Uji</strong></td>
</tr>
<tr bgcolor="#CCCCCC">
    <th>No.</th>
    <th>Data Bersih</th>
    <th>Prediksi Kategori</th>
    <th>Aktual Kategori</th>
</tr>
</thead>
    <form action="" method="POST">
        <?php
        $i = 1;
        while($d = mysqli_fetch_array($result)) 
        {
        ?>
        <tr bgcolor="#FFFFFF">
            <td><?php echo $i; ?></td>
            <td><input type='text' name=data_bersih[] value="<?php echo $d[0]; ?>" style="width=800px; border=0px"></td>
            <td><?php echo $d[2]; ?></td>
            <td>
                <?php $aktual=$d[1];?>
                <select class="form-control" name="aktual[]" id="aktual[]">
                    <option value="">Pilih Aktual Kategori</option>
                    <option value='0' <?=($aktual=='0')?'selected="selected"':''?>>Tidak ditemukan</option>
                    <option value='1' <?=($aktual=='1')?'selected="selected"':''?>>Universitas</option>
                    <option value='2' <?=($aktual=='2')?'selected="selected"':''?>>Ekonomi</option>
                    <option value='3' <?=($aktual=='3')?'selected="selected"':''?>>Politik</option>
        </select>
    </td>
</tr>
<?php
    $i=$i+1;
}
?>
</table>
    <input type="submit" name="simpan" value="Simpan Data"><br><br>
    </form>
    
<?php
    $i=$i-1;
    if(isset($_POST['simpan'])) {
        for($j=0;$j<$i;$j++){
            $data_bersih = $_POST['data_bersih'][$j];
            $a = $_POST['aktual'][$j];
            $result1 = $conn->query("SELECT * FROM classify_2211501180 WHERE data_bersih='$data_bersih'");
            if($result1->num_rows > 0){
                mysqli_query($conn, "UPDATE db_pemketir_2211501180.classify_2211501180 SET id_actual = '$a' WHERE data_bersih='$data_bersih'");
            }
        }
?>
<script>
    alert("Proses Simpan Data Selesai");
    window.history.go(-2);
</script>
<?php
    }
?>
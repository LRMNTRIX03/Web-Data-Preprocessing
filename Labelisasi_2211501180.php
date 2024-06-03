<!DOCTYPE html>
<html lang="en">
<head>
    <title> Tahap Labelisasi Data</title>
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
    include 'Koneksi_2211501180.php';
    $q="TRUNCATE TABLE kategori_2211501180";
    $result=mysqli_query($conn,$q);
    
    $q="INSERT into kategori_2211501180 (nm_kategori)
    select substr(galert_title,16) from galert_data_2211501180";
    $result = mysqli_query($conn,$q);

    $sql = "SELECT galert_id,galert_title,id_kategori,substr(galert_title,16) as kategori_2211501180
    from galert_data_2211501180 a, kategori_2211501180 b
    where substr(galert_title,16)=nm_kategori";
    $result = mysqli_query($conn,$sql);

    if($result-> num_rows == 0){
        echo "Data Kategori Tidak Ditemukan!";
    }
    else{
        ?>
        <table class="table table-bordered table-striped table-hover">
        <thread>
        <tr>
            <td colspan="3"><strong>Daftar Kategori</strong></td>
        </tr>
        <tr bgcolor="#CCCCCC">
        <th>No.</th>
        <th>Title</th>
        <th>Nama Kategori</th>
        </tr>
        </thread>
        <?php
        $i=1;
        while($d=mysqli_fetch_array($result)){
            $id = $d['galert_id'];
            $title = $d['galert_title'];
            $id_kategori = $d['id_kategori'];
            $kategori = $d['kategori_2211501180'];
        ?>
        <tr bgcolor="#FFFFFF">
            <td><?php echo $i; ?></td>
            <td><?php echo $title; ?></td>
            <td><?php echo $kategori; ?></td>
        </tr>
        <?php

        $sql = "SELECT * FROM galert_entry_2211501180 where feed_id='$id'";
        $result2 = $conn->query($sql);

        if($result2->num_rows > 0){
            $q = "UPDATE preprocessing_2211501180 set id_kategori='$id_kategori'
                    where entry_id in(SELECT entry_id FROM galert_entry_2211501180 where feed_id = '$id')";
            
            $result2 = mysqli_query($conn,$q);
        }
    $i = $i +1;
    }
    if($result2){
        echo '<strong>BERHASIL!!</strong> Tahap Labelisasi Data Berhasil';
    }
    else{
        echo'<strong>GAGAL!</strong> Tahap Labelisasi Data Tidak Berhasil';
    }

                
    }
?>
<br>
<br>
<?php
    $i =1;
    $sql = "SELECT a.*, nm_kategori
    FROM preprocessing_2211501180 a, kategori_2211501180 b
    WHERE a.id_kategori=b.id_kategori and length(entry_id)!=0";
    $result = $conn->query($sql);

    if($result->num_rows == 0){
        echo "Data Tidak Ditemukan";
    }
    else{
        ?>
        <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <td colspan="3"><strong>Daftar Labelisasi Data</strong></td>
        </tr>
        <tr bgcolor="#CCCCCC">
        <th>No.</th>
        <th>Data Bersih</th>
        <th>Nama Kategori</th>
        </tr>
        </thead>
        <?php
        while($d= mysqli_fetch_array($result)){
            $data_bersih = $d['data_bersih'];
            $id_kategori = $d['id_kategori'];
            $nm_kategori = $d['nm_kategori'];
       
        ?>
            <tr bgcolor="#FFFFFF">
                <td><?php echo $i; ?></td>
                <td><?php echo $data_bersih; ?></td>
                <td><?php echo $nm_kategori; ?></td>
    </tr>
            <?php
            $i = $i+1;

            }
    }

?>
<br>
<br>
</body>
</html>
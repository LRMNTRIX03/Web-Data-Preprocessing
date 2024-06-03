<?php
function getNmKategori($conn,$kat) {
    $sql = "select nm_kategori from kategori_2211501180 where id_kategori='$kat'";
    $rs = $conn->query($sql);
    $d = mysqli_fetch_row($rs);
    $nm_kategori = $d[0];
    return $nm_kategori;
}

    //TMP Nilai probabilitas per kategori
function getTMPNilai($conn,$id) {
    $sql = "select tmp_nilai from probabilitas_kategori_2211501180 where id_kategori='$id'";
    $rs = $conn->query($sql);
    $d = mysqli_fetch_row($rs);
    $tmp_nilai = $d[0];
    return $tmp_nilai;
}
    //kategori dengan nilai tertinggi/maksimal
function getNilTertinggi($conn) {
    $sql = "select max(nilai_probabilitas*tmp_nilai) from probabilitas_kategori_2211501180";
    $rs = $conn->query($sql);
    $d = mysqli_fetch_row($rs);
    $nilai = $d[0];
    return $nilai;
}
    //kategori terpilih
function getKatTerpilih($conn){
    $sql = "select * from probabilitas_kategori_2211501180 
        where (nilai_probabilitas*tmp_nilai)=(select max(nilai_probabilitas*tmp_nilai) from probabilitas_kategori_2211501180)";
    $rs = $conn->query($sql);
    $d = mysqli_fetch_row($rs);
    $id = $d[0];
    return $id;
}
?>
    

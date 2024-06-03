<!DOCTYPE html>
<html lang="en">
<!-- Lutfi Rizaldi Mahida (2211501180) -->
<head>
<link rel="stylesheet" type="text/css" href="myStyle.css">
<h1 style=color:Black;text-align:center;font-weight:bold>Lutfi Rizaldi Mahida 2211501180</h1>
<style>
    
</style>
</head>
<body>
<div class="container-TahapPD">
        <h1>1. TAHAP PENGUMPULAN DATA</h1>
        <div class="container-item-TahapPD">
        <form action="LoadFile_2211501180.php" method="get">
            <h3>Input Link </h3>
            <input type="text" class="inp-link" name="link" size="100"/>
            <br><br>
            <input type="submit" value="Simpan Data">
            <input type="reset" value="Reset">
        </form>
        </div>
</div>
<div class="container-TahapPC">
        <form action = "Preprocessing_2211501180.php" method = "get">
        <br></br>
        <h1>2. TAHAP PREPROCESSING DATA</h1>
        <input type="Submit" value = "Proses Pembersihan Data">
    </form>
</div>
<div class ="container-TahapL">
    <form action = "Labelisasi_2211501180.php" method = "get">
        <h1>3. TAHAP LABELISASI</h1>
        <input type="submit" value="Proses Labelisasi">
    </form>
</div>
<div class="container-TahapKS">
    <div class="container-item-TahapKS">
    <h1>4. TAHAP KLASIFIKASI</h1>
    <form action = " Vocabulary_2211501180.php" method = "get">
        <h2>Tahap 1 Klasifikasi : Vocabulary </h2>
        <input type="submit" value="Proses Vocabulary Data Training">
    </form>
    <form action="HitungProb_2211501180.php" method="get">
        <h2>Tahap 2 Klasifikasi : Hitung Probabilitas Kategori</h2>
        <input type="submit" value="Hitung Kategori">
    </form>
    <form action="Lutfi_2211501180.php" method="get">
        <h2>Tahap 3 Klasifikasi : Hitung Probabilitas Kata</h2>
        <input type="submit" value="Hitung kata Tiap Kategori">
    </form>
</div>
</div>
<div class="container-TahapPKS">
    <div class="container-item-TahapPKS">
    <form action="Klasifikasi_2211501180.php" method="get">
        <br>
        <h1>5. Clasify(Pengklasifikasian)</h1>
        <h2>Tahap 1 : Memasukkan Data Uji</h2>
        <input type="submit" value="Input Data Uji">
    </form>
    <form action="aktual_2211501180.php" method="POST">
        <h2>Tahap 2 : Aktualisasi Kategori Pada Data</h2>
        <input type="submit" value="Aktualisasi data">
    </form>
    </div>
</div>


</body>
</html>
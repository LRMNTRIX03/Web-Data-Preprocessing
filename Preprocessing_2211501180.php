<!DOCTYPE html>
<!-- Lutfi Rizaldi Mahida 2211501180 -->
<html lang="en">
<head>
    <h1>Lutfi Rizaldi Mahida 2211501180</h1>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<h3><a href="FormLoadFile_2211501180.php"> Kembali Ke Form Input Link</a></h3>
</html>
<?php 
//Memanggil file koneksi dan stopword 
include 'Koneksi_2211501180.php';
include "stopword_2211501180.php";
//Memanggil file autoload 
require_once __DIR__ . '/sastrawi/sastrawi/vendor/autoload_2211501180.php';
// Membuat stememr
$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
$stemmer = $stemmerFactory->createStemmer();

echo "<br>";
// Menampilkan kata baku dan tidak baku pada tabel slangword
$sql = "SELECT kata_tbaku,concat(kata_baku,' '),kata_baku from slangword_2211501180";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultSet = $stmt->get_result();
$result = $resultSet->fetch_all();
$arr_slang=array();
foreach($result as $k=>$v){
    $arr_slang[$v[0]] = $v[1];
}
// cek data pada galert entry sekaligus menampilakn isi data
$sql = "SELECT * From galert_entry_2211501180 where length(entry_id)!=0";
$result = $conn->query($sql);
if ($result->num_rows == 0){
    echo "Data Tidak Ditemukan";
}
else{
//Pembuatan tabel untuk menampilkan data
    ?>
    <table border = "1" cellpadding = "1" cellspacing="1" bgcolor ="#999999">
    <tr bgcolor = "#CCCCCC">
    <th>ID</th>
    <th>Content</th>
    <th>Case Folding</th>
    <th>Hapus Simbol</th>
    <th>Filter Slang Word</th>
    <th>Filter Stop Word</th>
    <th>Stiming</th>
</tr>
<?php
//Proses penyesuaian kata
while($d = mysqli_fetch_array($result)){
    $id = $d['entry_id'];
    $content = $d['entry_content'];

    //1. Case Folding
        //echo strtoupper($content);
        //echo strtoupper($content);
        $cf = strtolower($content);

    //2 Penghapus Simbol-simbol (Symbol Removal)
        $simbol = preg_replace("/[^a-zA-Z\\s]/", "", $cf);

    //3 Konversi Slangword
        $rem_slang = explode(" ",$simbol);
        $slangword=str_replace(array_keys($arr_slang), $arr_slang, $simbol);
    //4 Stopword Removal
        $rem_stopword=explode(" ", $slangword);
        $str_data=array();
        foreach($rem_stopword as $value){
            if(!in_array($value, $stopwords2211501388)){
                $str_data[] = "".$value;
            }
        }
        $stopword = implode(" ", $str_data);

    //5 Stemming
        $query1 = implode('', (array)$stopword);
        $stemming = $stemmer->stem($query1);
    
    //6 Tokenisasi
        $tokenisasi_2211501180 = preg_split("/[\s,..:]+/", $stemming);
        $tokenisasi_2211501180 = implode(",", $tokenisasi_2211501180);
    ?>
    <!--Proses pembuatan tabel untuk menampilkan data-->
        <tr bgcolor="#FFFFFF">
            <td><?php echo $id; ?></td>
            <td><?php echo $content; ?></td>
            <td><?php echo $cf; ?></td>
            <td><?php echo $simbol; ?></td>
            <td><?php echo $slangword; ?></td>
            <td><?php echo $stopword; ?></td>
            <td><?php echo $stemming; ?></td>
            <td><?php echo $tokenisasi_2211501180; ?></td>
        </tr>
    <?php
    //Menampilkan isi data dari tabel preprocessing
        $sql = "SELECT * From preprocessing_2211501180 where entry_id='$id'";
        $result1 = $conn->query($sql);

        if ($result1->num_rows == 0){
            //save ke dalam tabel preprocessing
            $q = "INSERT INTO preprocessing_2211501180(entry_id,p_cf,p_simbol,p_tokenisasi,p_sword,p_stopword,p_stemming,data_bersih)
            VALUES('$id','$cf','$simbol','$tokenisasi_2211501180','$slangword', '$stopword','$stemming', '$stemming')";

            $result1 = mysqli_query($conn,$q);
        
            
        }
        else{
            //jika sudah ada maka hanya diperbaharui
                    $q = "UPDATE preprocessing_2211501180 set p_cf='$cf', p_simbol='$simbol', 
                    p_tokenisasi='$tokenisasi_2211501180', p_sword = '$slangword', p_stopword='$stopword', 
                    p_stemming='$stemming', data_bersih='$stemming' WHERE entry_id = '$id'";

                $result1 = mysqli_query($conn,$q);
        }
    }
?>
    </table>
<?php
    if($result1){
        echo '<h4>Preprocessing Data Berhasil</h4>';
    }
    else{
        echo '<h2>Gagal Melakukan Preprocessing Data</h2>';
    }
    }
?>

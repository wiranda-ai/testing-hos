<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_house");

// menambah data baru
if(isset($_POST['addnewdata_klasifikasi'])){
    $tipe_bangunan = mysqli_real_escape_string($conn, $_POST['tipebangunan']);
    $tarif         = mysqli_real_escape_string($conn, $_POST['tarif']);
    $alamat        = mysqli_real_escape_string($conn, $_POST['alamat']);
    $keterangan    = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $addtotable = mysqli_query($conn, 
        "INSERT INTO klasifikasi (tipe_bangunan, tarif, alamat, keterangan) 
         VALUES ('$tipe_bangunan', '$tarif', '$alamat', '$keterangan')"
    );

    if($addtotable){
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}

// menambah data lab
if(isset($_POST['addnewdata_lab'])){
    $nama_lokasi  = mysqli_real_escape_string($conn, $_POST['namalokasi']);
    $tipe_lokasi  = mysqli_real_escape_string($conn, $_POST['tipelokasi']);
    $latitude     = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude    = mysqli_real_escape_string($conn, $_POST['longitude']);
    $alamat       = mysqli_real_escape_string($conn, $_POST['alamat']);
    
    $addtotable = mysqli_query($conn, 
        "INSERT INTO lab (nama_lokasi, tipe_lokasi, latitude, longitude, alamat ) 
         VALUES ('$nama_lokasi', '$tipe_lokasi', '$latitude', '$longitude', '$alamat' )"
    );

    if($addtotable){
        header('Location: lab.php');
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}

// update info data klasifikasi
if(isset($_POST['updatedata'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $tipe_bangunan = mysqli_real_escape_string($conn, $_POST['tipe_bangunan']);
    $tarif = mysqli_real_escape_string($conn, $_POST['tarif']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $update = mysqli_query($conn, "UPDATE klasifikasi SET tipe_bangunan='$tipe_bangunan', tarif='$tarif', alamat='$alamat', keterangan='$keterangan' WHERE id='$id'");
    if($update){
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}

// menghapus data klasifikasi
if(isset($_POST['hapusdata'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $hapus = mysqli_query($conn, "DELETE FROM klasifikasi WHERE id='$id'");
    if($hapus){
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}

// update info data lab
if(isset($_POST['updatenewdata'])){
    $idlab = mysqli_real_escape_string($conn, $_POST['idlab']);
    $nama_lokasi  = mysqli_real_escape_string($conn, $_POST['nama_lokasi']);
    $tipe_lokasi  = mysqli_real_escape_string($conn, $_POST['tipe_lokasi']);
    $latitude     = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude    = mysqli_real_escape_string($conn, $_POST['longitude']);
    $alamat       = mysqli_real_escape_string($conn, $_POST['alamat']);

    $update = mysqli_query($conn, "UPDATE lab SET nama_lokasi='$nama_lokasi', tipe_lokasi='$tipe_lokasi', latitude='$latitude', longitude='$longitude', alamat='$alamat' WHERE idlab='$idlab'");
    if($update){
        header('Location: lab.php');
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}

// menghapus data lab
if(isset($_POST['hapusdatanew'])){
    $idlab = mysqli_real_escape_string($conn, $_POST['idlab']);

    $hapus = mysqli_query($conn, "DELETE FROM lab WHERE idlab='$idlab'");
    if($hapus){
        header('Location: lab.php');
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}
?>

<?php
include 'koneksi.php';

if (!$koneksi) { //cek koneksi
    die("tidak bisa terkoneksi di database");
}

$nim            = "";
$nama           = "";
$jenis_kelamin  = "";
$jurusan        = "";
$alamat         = "";
$id_wali        = "";
$error          = "";
$sukses         = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'edit') {
    $id_mhs= $_GET['id_mhs'];
    $sql2    = "SELECT * from mahasiswa where id_mhs = '$id_mhs'";
    $q1      = mysqli_query($koneksi, $sql2);
    $r1      = mysqli_fetch_array($q1);
    $nim = $r1['nim'];
    $nama = $r1['nama'];
    $jenis_kelamin = $r1['jenis_kelamin'];
    $jurusan = $r1['jurusan'];
    $alamat = $r1['alamat'];
    $id_wali = $r1['id_wali'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if($op == 'delete'){
    $id_mhs    = $_GET['id_mhs'];
    $sql1       = "DELETE from mahasiswa WHERE id_mhs = '$id_mhs'";
    $q1         = mysqli_query($koneksi, $sql1);
    if($q1){
        $sukses = "Data berhasil dihapus";
    }else{
        $error = "Gagal menghapus data";
    }
    header("location:index.php");
}

if (isset($_POST['simpan'])) { //create
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $id_wali = $_POST['id_wali'];

    if ($nim && $nama && $jenis_kelamin && $jurusan && $alamat && $id_wali) {
        if ($op == 'edit') { //untuk update
            $sql1       = $sql1 = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', jenis_kelamin = '$jenis_kelamin', jurusan = '$jurusan', alamat = '$alamat', id_wali = '$id_wali' WHERE id_mhs = '$id_mhs'";            ;
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error  = "Data gagal di update";
            }
        } else { //untuk insert
            $sql1 = $sql1 = "INSERT INTO mahasiswa SET nim = '$nim', nama = '$nama', jenis_kelamin = '$jenis_kelamin', jurusan = '$jurusan', alamat = '$alamat', id_wali = '$id_wali'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukan data baru";
            } else {
                $error = "Gagal memasukan data baru";
            }
        }
    } else {
        $error = "Silakan masukan semua data";
    }
    header("refresh:5;url=index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>DATA KULIAH</title>
    <style>
        .mx-auto {
            width: 800px;
        }
    </style>
</head>
<header>
    <nav class="navbar bg-dark">
        <div class="container-fluid d-flex justify-content-center">
            <span class="navbar-brand text-light mb-0 h1">Sistem Informasi Akademik</span>
        </div>
    </nav>
</header>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav fs-5">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mahasiswa.php">Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wali_mhs.php">Wali Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="admin.php">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main>
    <div class="mx-auto card mt-3">
        <div class="card-header">
            Mahasiswa
        </div>
        <div class="card-body">
            <?php
            if ($error) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
            <?php
            }
            ?>
            <?php
            if ($sukses) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
            <?php
            }
            ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" value="<?php echo $nim ?>">
                    </div>
                <div class="mt-3">
                    <label for="nama" class="form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa" value="<?php echo $nama ?>">
                    </div>
                </div>
                <div class="mt-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin ?>">
                    </div>
                </div>
                <div class="mt-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <div class="col-sm-10">
                       <select class="form-control"name="jurusan" id="jurusan">
                            <option value="">- Pilih Jurusan -</option>
                            <option value="TEKNIK INFORMATIKA" <?php if($jurusan == "TEKNIK INFORMATIKA") echo "selected"?>>TEKNIK INFORMATIKA</option>
                            <option value="TEKNIK MESIN" <?php if($jurusan == "TEKNIK MESIN") echo "selected"?>>TEKNIK MESIN</option>
                            <option value="TEKNIK OTOMOTIF" <?php if($jurusan == "TEKNIK OTOMOTIF") echo "selected"?>>TEKNIK OTOMOTIF</option>
                       </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?php echo $alamat ?>">
                    </div>
                </div>
                <div class="mt-3">
                    <label for="id_wali" class="form-label">ID WALI</label>
                    <div class="col-sm-10">
                       <select class="form-control" id="id_wali" name="id_wali">
                            <option value="">- Pilih ID Wali -</option>
                            <?php
                            include "koneksi.php";
                            $query = mysqli_query($koneksi, "SELECT * FROM wali_mhs") or die(mysqli_error($koneksi));
                            while($id_wali = mysqli_fetch_array($query)){
                                echo "<option value=$id_wali[id_wali]> $id_wali[id_wali]</option>";
                            }
                            ?>
                       </select>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <input type="submit" name="simpan" value="simpan data" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php
include 'koneksi.php';

if (!$koneksi) { //cek koneksi
    die("tidak bisa terkoneksi di database");
}

$nama_wali      = "";
$jenis_kelamin  = "";
$alamat         = "";
$error          = "";
$sukses         = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'edit') {
    $id_wali = $_GET['id_wali'];
    $sql2    = "SELECT * from wali_mhs where id_wali = '$id_wali'";
    $q1      = mysqli_query($koneksi, $sql2);
    $r1      = mysqli_fetch_array($q1);
    $nama_wali = $r1['nama_wali'];
    $jenis_kelamin = $r1['jenis_kelamin'];
    $alamat = $r1['alamat'];

    if ($nama_wali == '') {
        $error = "Data tidak ditemukan";
    }
}
if($op == 'delete'){
    $id_wali    = $_GET['id_wali'];
    $sql1       = "DELETE from wali_mhs WHERE id_wali = '$id_wali'";
    $q1         = mysqli_query($koneksi, $sql1);
    if($q1){
        $sukses = "Data berhasil dihapus";
    }else{
        $error = "Gagal menghapus data";
    }
    header("location:index.php");
}

if (isset($_POST['simpan'])) { //create
    $nama_wali      = $_POST['nama_wali'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $alamat         = $_POST['alamat'];

    if ($nama_wali && $jenis_kelamin && $alamat) {
        if ($op == 'edit') { //untuk update
            $sql1       = "UPDATE wali_mhs set nama_wali = '$nama_wali', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat' WHERE id_wali = '$id_wali'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error  = "Data gagal di update";
            }
        } else { //untuk insert
            $sql1 = "INSERT INTO wali_mhs SET nama_wali='$nama_wali', jenis_kelamin='$jenis_kelamin', alamat='$alamat'";
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
            Wali Mahasiswa
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
                    <label for="nama_wali" class="form-label">Nama Wali</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Nama Wali" value="<?php echo $nama_wali ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?php echo $alamat ?>">
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" name="simpan" value="simpan data" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
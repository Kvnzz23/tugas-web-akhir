<?php
include 'koneksi.php';

if (!$koneksi) { //cek koneksi
    die("tidak bisa terkoneksi di database");
}

$username     = "";
$passwordd = "";
$statuss       = "";
$error          = "";
$sukses         = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'edit') {
    $id_admin = $_GET['id_admin'];
    $sql2    = "SELECT * from admin2 where id_admin = '$id_admin'";
    $q1      = mysqli_query($koneksi, $sql2);
    $r1      = mysqli_fetch_array($q1);
    $username = $r1['username'];
    $passwordd = $r1['passwordd'];
    $statuss = $r1['statuss'];

    if ($username == '') {
        $error = "Data tidak ditemukan";
    }
}
if($op == 'delete'){
    $id_admin    = $_GET['id_admin'];
    $sql1       = "DELETE from admin2 WHERE id_admin = '$id_admin'";
    $q1         = mysqli_query($koneksi, $sql1);
    if($q1){
        $sukses = "Data berhasil dihapus";
    }else{
        $error = "Gagal menghapus data";
    }
    header("location:admin.php");
}

if (isset($_POST['simpan'])) { //create
    $username      = $_POST['username'];
    $passwordd = $_POST['passwordd'];
    $statuss      = $_POST['statuss'];

    if ($username && $passwordd && $statuss) {
        if ($op == 'edit') { //untuk update
            $sql1       = "UPDATE admin2 set username = '$username', passwordd = '$passwordd', statuss = '$statuss' WHERE id_admin = '$id_admin'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error  = "Data gagal di update";
            }
        } else { //untuk insert
            $sql1 = "INSERT INTO admin2 SET username='$username', passwordd='$passwordd', statuss='$statuss'";
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
    // header("refresh:5;url=admin.php");
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
            Admin
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
                    <label for="username" class="form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="paswordd" class="form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="passwordd" name="passwordd" placeholder="Password" value="<?php echo $passwordd ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="statuss" name="statuss" placeholder="Status" value="<?php echo $statuss ?>">
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" name="simpan" value="simpan data" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <div class="mx-auto card mt-3">
        <div class="card-header">
            Data Admin
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q2 = mysqli_query($koneksi, "SELECT * from admin2");
                    $urut = 1;
                    while ($r2 = mysqli_fetch_array($q2)) {
                        $id_admin= $r2['id_admin'];
                        $username = $r2['username'];
                        $passwordd = $r2['passwordd'];
                        $statuss = $r2['statuss'];
                    ?>
                        <tr>
                            <th scope=row><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $username ?></td>
                            <td scope="row"><?php echo $passwordd ?></td>
                            <td scope="row"><?php echo $statuss ?></td>
                            <td scope="row">
                                <a href="admin.php?op=edit&id_admin=<?php echo $id_admin ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                <a href="admin.php?op=delete&id_admin=<?php echo $id_admin ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data??')"><button type="button" class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
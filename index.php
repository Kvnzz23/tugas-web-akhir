<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>DATA MAHASISWA</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .mx-auto {
            width: 900px;
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
            Data Mahasiswa
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">ID Wali</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q2 = mysqli_query($koneksi, "SELECT * from mahasiswa");
                    $urut = 1;
                    while ($r2 = mysqli_fetch_array($q2)) {
                        $id_mhs = $r2['id_mhs'];
                        $nim = $r2['nim'];
                        $nama = $r2['nama'];
                        $jenis_kelamin = $r2['jenis_kelamin'];
                        $jurusan = $r2['jurusan'];
                        $alamat = $r2['alamat'];
                        $id_wali = $r2['id_wali'];
                    ?>
                        <tr>
                            <th scope=row><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $nim ?></td>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $jenis_kelamin ?></td>
                            <td scope="row"><?php echo $jurusan ?></td>
                            <td scope="row"><?php echo $alamat ?></td>
                            <td scope="row"><?php echo $id_wali ?></td>
                            <td scope="row">
                                <a href="mahasiswa.php?op=edit&id_mhs=<?php echo $id_mhs ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                <a href="mahasiswa.php?op=delete&id_mhs=<?php echo $id_mhs ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data??')"><button type="button" class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="mx-auto card mt-3">
        <div class="card-header">
            Data Wali Mahasiswa
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Wali</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q2 = mysqli_query($koneksi, "SELECT * from wali_mhs");
                    $urut = 1;
                    while ($r2 = mysqli_fetch_array($q2)) {
                        $id_wali = $r2['id_wali'];
                        $nama_wali = $r2['nama_wali'];
                        $jenis_kelamin = $r2['jenis_kelamin'];
                        $alamat = $r2['alamat'];
                    ?>
                        <tr>
                            <th scope=row><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $nama_wali ?></td>
                            <td scope="row"><?php echo $jenis_kelamin ?></td>
                            <td scope="row"><?php echo $alamat ?></td>
                            <td scope="row">
                                <a href="wali_mhs.php?op=edit&id_wali=<?php echo $id_wali ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                <a href="wali_mhs.php?op=delete&id_wali=<?php echo $id_wali ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data??')"><button type="button" class="btn btn-danger">Delete</button></a>
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
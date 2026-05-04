<?php
require_once __DIR__ . '/config/database.php';

// VALIDASI ID
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location:index.php?msg=ID tidak ditemukan");
    exit;
}

$id = $_GET['id'];

// AMBIL DATA 
$stmt = $conn->prepare("SELECT * FROM kategori WHERE id_kategori=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// kalau data tidak ada
if(!$data){
    header("Location:index.php?msg=Data tidak ditemukan");
    exit;
}

// UPDATE
if($_POST){
    $kode = trim($_POST['kode']);
    $nama = trim($_POST['nama']);
    $deskripsi = trim($_POST['deskripsi']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE kategori 
        SET kode_kategori=?, nama_kategori=?, deskripsi=?, status=? 
        WHERE id_kategori=?");
    $stmt->bind_param("ssssi",$kode,$nama,$deskripsi,$status,$id);
    $stmt->execute();

    header("Location:index.php?msg=Berhasil update");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Kategori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f8f9fa;">

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-8">

<div class="card shadow">
<div class="card-header bg-warning">
<h4 class="mb-0">Edit Kategori</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6">
<div class="mb-3">
<label>Kode</label>
<input type="text" name="kode" class="form-control"
value="<?= $data['kode_kategori'] ?>">
</div>

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control"
value="<?= $data['nama_kategori'] ?>">
</div>
</div>

<div class="col-md-6">
<div class="mb-3">
<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea>
</div>

<div class="mb-3">
<label>Status</label><br>

<input type="radio" name="status" value="Aktif"
<?= $data['status']=='Aktif'?'checked':'' ?>> Aktif

<input type="radio" name="status" value="Nonaktif"
<?= $data['status']=='Nonaktif'?'checked':'' ?>> Nonaktif

</div>
</div>

</div>

<div class="d-flex justify-content-between">
<a href="index.php" class="btn btn-secondary">Kembali</a>
<button class="btn btn-warning">Update</button>
</div>

</form>

</div>
</div>

</div>
</div>
</div>

</body>
</html>
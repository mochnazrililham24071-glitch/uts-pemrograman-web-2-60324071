<?php
require_once __DIR__ . '/config/database.php';

$errors=[];
$kode=$nama=$deskripsi='';
$status='Aktif';

if($_POST){
    $kode=trim($_POST['kode']);
    $nama=trim($_POST['nama']);
    $deskripsi=trim($_POST['deskripsi']);
    $status=$_POST['status'];

    // VALIDASI
    if(empty($kode)) $errors[]="Kode wajib";
    elseif(!preg_match('/^KAT-\d{3}$/',$kode)) $errors[]="Format KAT-001";

    if(empty($nama)) $errors[]="Nama wajib";
    elseif(strlen($nama)<3) $errors[]="Minimal 3 karakter";

    if(!empty($deskripsi) && strlen($deskripsi)>200)
        $errors[]="Deskripsi maksimal 200 karakter";

    if($status!='Aktif' && $status!='Nonaktif')
        $errors[]="Status tidak valid";

    // CEK DUPLIKAT
    $stmt=$conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori=?");
    $stmt->bind_param("s",$kode);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0) $errors[]="Kode sudah ada";

    // INSERT
    if(!$errors){
        $stmt=$conn->prepare("INSERT INTO kategori(kode_kategori,nama_kategori,deskripsi,status) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$kode,$nama,$deskripsi,$status);
        $stmt->execute();

        header("Location:index.php?msg=Berhasil tambah");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Kategori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f8f9fa;">

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-6">

<div class="card shadow">
<div class="card-header">
<h4>Tambah Kategori</h4>
</div>

<div class="card-body">

<?php if($errors): ?>
<div class="alert alert-danger">
<ul>
<?php foreach($errors as $e): ?>
<li><?= $e ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

<form method="POST">

<div class="mb-3">
<label>Kode</label>
<input name="kode" class="form-control" value="<?= $kode ?>">
</div>

<div class="mb-3">
<label>Nama</label>
<input name="nama" class="form-control" value="<?= $nama ?>">
</div>

<div class="mb-3">
<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control"><?= $deskripsi ?></textarea>
</div>

<div class="mb-3">
<label>Status</label><br>

<input type="radio" name="status" value="Aktif"
<?= $status=='Aktif'?'checked':'' ?>> Aktif

<input type="radio" name="status" value="Nonaktif"
<?= $status=='Nonaktif'?'checked':'' ?>> Nonaktif

</div>

<button class="btn btn-primary">Simpan</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

</div>
</div>
</div>

</body>
</html>
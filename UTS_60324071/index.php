<?php
require_once __DIR__ . '/config/database.php';

$stmt = $conn->prepare("SELECT * FROM kategori ORDER BY id_kategori DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<title>Daftar Kategori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h2>Daftar Kategori</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah</a>

<?php if(isset($_GET['msg'])): ?>
<div class="alert alert-success"><?= $_GET['msg'] ?></div>
<?php endif; ?>

<table class="table table-striped">
<tr>
<th>No</th><th>Kode</th><th>Nama</th><th>Deskripsi</th><th>Status</th><th>Aksi</th>
</tr>

<?php $no=1; while($row=$result->fetch_assoc()): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $row['kode_kategori'] ?></td>
<td><?= $row['nama_kategori'] ?></td>
<td><?= $row['deskripsi'] ?></td>
<td>
<?= $row['status']=='Aktif'
? '<span class="badge bg-success">Aktif</span>'
: '<span class="badge bg-danger">Nonaktif</span>' ?>
</td>
<td>
<a href="edit.php?id=<?= $row['id_kategori'] ?>" class="btn btn-warning btn-sm">Edit</a>
<button onclick="hapus(<?= $row['id_kategori'] ?>)" class="btn btn-danger btn-sm">Hapus</button>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>

<script>
function hapus(id){
if(confirm('Yakin hapus?')){
location='delete.php?id='+id;
}
}
</script>

</body>
</html>
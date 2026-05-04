<?php
require_once __DIR__ . '/config/database.php';

$id=$_GET['id'];

$stmt=$conn->prepare("SELECT * FROM kategori WHERE id_kategori=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data=$stmt->get_result()->fetch_assoc();

if(!$data){
header("Location:index.php");
exit;
}

if($_POST){
$kode=$_POST['kode'];
$nama=$_POST['nama'];
$deskripsi=$_POST['deskripsi'];
$status=$_POST['status'];

$stmt=$conn->prepare("UPDATE kategori SET kode_kategori=?,nama_kategori=?,deskripsi=?,status=? WHERE id_kategori=?");
$stmt->bind_param("ssssi",$kode,$nama,$deskripsi,$status,$id);
$stmt->execute();

header("Location:index.php?msg=Berhasil update");
}
?>

<form method="POST">
<input name="kode" value="<?= $data['kode_kategori'] ?>"><br>
<input name="nama" value="<?= $data['nama_kategori'] ?>"><br>
<textarea name="deskripsi"><?= $data['deskripsi'] ?></textarea><br>
<select name="status">
<option <?= $data['status']=='Aktif'?'selected':'' ?>>Aktif</option>
<option <?= $data['status']=='Nonaktif'?'selected':'' ?>>Nonaktif</option>
</select><br>
<button>Simpan</button>
</form>
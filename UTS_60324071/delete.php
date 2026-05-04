<?php
require_once __DIR__ . '/config/database.php';

if(!isset($_GET['id'])){
header("Location:index.php");
exit;
}

$id=$_GET['id'];

$stmt=$conn->prepare("DELETE FROM kategori WHERE id_kategori=?");
$stmt->bind_param("i",$id);
$stmt->execute();

header("Location:index.php?msg=Berhasil hapus");
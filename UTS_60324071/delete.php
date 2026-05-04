<?php
require_once 'config/database.php';

// Validasi ID dari GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?msg=notfound");
    exit();
}

$id = (int) $_GET['id'];

// Cek keberadaan data di database
$stmtCek = $conn->prepare("SELECT id_kategori FROM kategori WHERE id_kategori = ?");
$stmtCek->bind_param("i", $id);
$stmtCek->execute();
$stmtCek->store_result();

if ($stmtCek->num_rows == 0) {
    $stmtCek->close();
    header("Location: index.php?msg=notfound");
    exit();
}
$stmtCek->close();

// Delete data menggunakan prepared statement
$stmt = $conn->prepare("DELETE FROM kategori WHERE id_kategori = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    $stmt->close();
    // Redirect dengan pesan sukses
    header("Location: index.php?msg=deleted");
} else {
    $stmt->close();
    // Redirect dengan pesan error
    header("Location: index.php?msg=error");
}
exit();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php
    require_once 'config/database.php';

    $errors = [];
    $kode = '';
    $nama = '';
    $deskripsi = '';
    $status = 'Aktif';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ambil dan sanitasi data dari form
        $kode      = trim(htmlspecialchars($_POST['kode_kategori'] ?? '', ENT_QUOTES, 'UTF-8'));
        $nama      = trim(htmlspecialchars($_POST['nama_kategori'] ?? '', ENT_QUOTES, 'UTF-8'));
        $deskripsi = trim(htmlspecialchars($_POST['deskripsi'] ?? '', ENT_QUOTES, 'UTF-8'));
        $status    = trim(htmlspecialchars($_POST['status'] ?? '', ENT_QUOTES, 'UTF-8'));

        // Validasi kode kategori
        if (empty($kode)) {
            $errors['kode'] = 'Kode kategori wajib diisi.';
        } elseif (strlen($kode) < 4 || strlen($kode) > 10) {
            $errors['kode'] = 'Kode kategori harus 4–10 karakter.';
        } elseif (substr($kode, 0, 4) !== 'KAT-') {
            $errors['kode'] = 'Kode kategori harus diawali dengan "KAT-".';
        } else {
            // Cek duplikasi kode
            $stmtCek = $conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori = ?");
            $stmtCek->bind_param("s", $kode);
            $stmtCek->execute();
            $stmtCek->store_result();
            if ($stmtCek->num_rows > 0) {
                $errors['kode'] = 'Kode kategori sudah digunakan.';
            }
            $stmtCek->close();
        }

        // Validasi nama kategori
        if (empty($nama)) {
            $errors['nama'] = 'Nama kategori wajib diisi.';
        } elseif (strlen($nama) < 3) {
            $errors['nama'] = 'Nama kategori minimal 3 karakter.';
        } elseif (strlen($nama) > 50) {
            $errors['nama'] = 'Nama kategori maksimal 50 karakter.';
        }

        // Validasi deskripsi (opsional)
        if (!empty($deskripsi) && strlen($deskripsi) > 200) {
            $errors['deskripsi'] = 'Deskripsi maksimal 200 karakter.';
        }

        // Validasi status
        if (!in_array($status, ['Aktif', 'Nonaktif'])) {
            $errors['status'] = 'Status tidak valid.';
        }

        // Jika tidak ada error, insert data
        if (empty($errors)) {
            $stmt = $conn->prepare("INSERT INTO kategori (kode_kategori, nama_kategori, deskripsi, status) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $kode, $nama, $deskripsi, $status);

            if ($stmt->execute()) {
                $stmt->close();
                // Redirect ke index dengan pesan sukses
                header("Location: index.php?msg=created");
                exit();
            } else {
                $errors['db'] = 'Gagal menyimpan data: ' . $conn->error;
            }
            $stmt->close();
        }
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Kategori Baru</h4>
                    </div>
                    <div class="card-body">

                        <!-- Tampilkan error umum (database) -->
                        <?php if (isset($errors['db'])): ?>
                            <div class="alert alert-danger"><?= $errors['db'] ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <!-- Kode Kategori -->
                            <div class="mb-3">
                                <label for="kode_kategori" class="form-label">Kode Kategori <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control <?= isset($errors['kode']) ? 'is-invalid' : '' ?>"
                                       id="kode_kategori"
                                       name="kode_kategori"
                                       value="<?= htmlspecialchars($kode) ?>"
                                       placeholder="Contoh: KAT-001"
                                       required>
                                <?php if (isset($errors['kode'])): ?>
                                    <div class="invalid-feedback"><?= $errors['kode'] ?></div>
                                <?php endif; ?>
                                <small class="text-muted">Format: KAT-XXX, 4–10 karakter</small>
                            </div>

                            <!-- Nama Kategori -->
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>"
                                       id="nama_kategori"
                                       name="nama_kategori"
                                       value="<?= htmlspecialchars($nama) ?>"
                                       placeholder="Nama kategori"
                                       required>
                                <?php if (isset($errors['nama'])): ?>
                                    <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control <?= isset($errors['deskripsi']) ? 'is-invalid' : '' ?>"
                                          id="deskripsi"
                                          name="deskripsi"
                                          rows="3"
                                          placeholder="Deskripsi kategori (opsional, maks. 200 karakter)"><?= htmlspecialchars($deskripsi) ?></textarea>
                                <?php if (isset($errors['deskripsi'])): ?>
                                    <div class="invalid-feedback"><?= $errors['deskripsi'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="statusAktif" value="Aktif"
                                               <?= ($status == 'Aktif') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="statusAktif">Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="statusNonaktif" value="Nonaktif"
                                               <?= ($status == 'Nonaktif') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="statusNonaktif">Nonaktif</label>
                                    </div>
                                </div>
                                <?php if (isset($errors['status'])): ?>
                                    <small class="text-danger"><?= $errors['status'] ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

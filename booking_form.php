<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Form Pemesanan Tiket</h2>
        <form action="proses_pemesanan.php" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pemesan</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="nomor_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe Penerbangan</label>
                <select class="form-select" id="tipe" name="tipe" required>
                    <option value="">Pilih Tipe</option>
                    <option value="domestik">Domestik</option>
                    <option value="international">International</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="destinasi" class="form-label">Destinasi</label>
                <select class="form-select" id="destinasi" name="destinasi" required>
                    <option value="">Pilih Destinasi</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="pesawat" class="form-label">Pesawat</label>
                <select class="form-select" id="pesawat" name="pesawat" required>
                    <option value="">Pilih Pesawat</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pesan</button>
            <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#tipe').change(function () {
                const tipe = $(this).val();
                $('#destinasi').html('<option value="">Loading...</option>');
                $.ajax({
                    url: 'get_destinasi.php',
                    method: 'POST',
                    data: { tipe: tipe },
                    success: function (response) {
                        $('#destinasi').html(response);
                    }
                });
            });

            $('#tanggal').change(function () {
                const tanggal = $(this).val();
                $('#pesawat').html('<option value="">Loading...</option>');
                $.ajax({
                    url: 'get_pesawat.php',
                    method: 'POST',
                    data: { tanggal: tanggal },
                    success: function (response) {
                        $('#pesawat').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
session_start();
require_once 'classs/transaksiRental.php';

$error = "";

if (!isset($_SESSION['daftar_transaksi'])) {
    $_SESSION['daftar_transaksi'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nama = $_POST['nama'] ?? '';
        $jenis = $_POST['jenis'] ?? '';
        $lama = $_POST['lama'] ?? 0;
        $keterlambatan = $_POST['keterlambatan'] ?? 0;
        $addOn = $_POST['addons'] ?? array();

        $obj = new rental($nama, $jenis, $lama, $keterlambatan, $addOn);
        
        $_SESSION['daftar_transaksi'][] = [
            'nama' => $nama,
            'jenis' => $jenis,
            'lama' => $lama,
            'subtotal' => $obj->hitungSubTotal(),
            'diskon' => $obj->hitungDiskon(),
            'denda' => $obj->hitungDenda(),
            'total' => $obj->hitungTotalBayar()
        ];
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Transaksi Rental</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 15px;
            font-weight: bold;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header.primary {
            background-color: #007bff;
            color: #ffffff;
        }

        .card-header.dark {
            background-color: #343a40;
            color: #ffffff;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
        }

        .checkbox-group {
            display: flex;
            gap: 15px;
            margin-top: 5px;
        }

        .checkbox-label {
            font-weight: normal;
            font-size: 14px;
            cursor: pointer;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            width: 100%;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #ffffff;
            font-size: 12px;
            padding: 5px 10px;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #495057;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistem Transaksi Rental Laptop/Elektronik</h2>

    <?php if (!empty($error)): ?>
        <div class="alert-danger">
            <strong>Error:</strong> <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="grid-container">
        <div class="card">
            <div class="card-header primary">
                Form Input Transaksi
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Penyewa</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis Barang/Perangkat</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" required>
                    </div>

                    <div class="form-group">
                        <label for="lama">Lama Sewa (Hari)</label>
                        <input type="number" class="form-control" id="lama" name="lama" placeholder="Minimal 1 hari" required>
                    </div>

                    <div class="form-group">
                        <label for="keterlambatan">Keterlambatan (Hari)</label>
                        <input type="number" class="form-control" id="keterlambatan" name="keterlambatan" value="0" min="0">
                    </div>

                    <div class="form-group">
                        <label>Fitur Tambahan (Add-ons):</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="addons[]" value="mouse"> Mouse (+5k)
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="addons[]" value="tas"> Tas Laptop (+10k)
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Hitung & Simpan Transaksi</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header dark">
                <span>Riwayat Transaksi</span>
                <a href="reset.php" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus seluruh data session?')">Reset Data</a>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Lama</th>
                                <th>Subtotal</th>
                                <th>Diskon</th>
                                <th>Denda</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($_SESSION['daftar_transaksi'])): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada transaksi tersimpan.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($_SESSION['daftar_transaksi'] as $index => $item): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= htmlspecialchars($item['nama']); ?></td>
                                        <td><?= htmlspecialchars($item['jenis']); ?></td>
                                        <td><?= $item['lama']; ?> Hari</td>
                                        <td>Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                        <td>Rp <?= number_format($item['diskon'], 0, ',', '.'); ?></td>
                                        <td>Rp <?= number_format($item['denda'], 0, ',', '.'); ?></td>
                                        <td><strong>Rp <?= number_format($item['total'], 0, ',', '.'); ?></strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
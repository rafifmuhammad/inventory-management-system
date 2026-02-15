<?php
include './functions/function.php';

$id_keluar = $_GET['id_keluar'];

if (deleteProductOut($id_keluar) > 0) {
    echo "
        <script>
            alert('Barang keluar berhasil dihapus');
            window.location.href = 'product_out.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Barang keluar gagal dihapus');
            window.location.href = 'product_out.php';
        </script>
    ";
}
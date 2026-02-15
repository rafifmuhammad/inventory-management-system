<?php
include './functions/function.php';

$id_masuk = $_GET['id_masuk'];

if (deleteProductIn($id_masuk) > 0) {
    echo "
        <script>
            alert('Barang masuk berhasil dihapus!');
            window.location.href = 'product_in.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Barang masuk gagal dihapus!');
            window.location.href = 'product_in.php';
        </script>
    ";
}
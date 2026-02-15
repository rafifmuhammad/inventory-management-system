<?php
include './functions/function.php';

$id_barang = $_GET['id_barang'];

if (deleteBarang($id_barang) > 0) {
    echo "
    <script>
        alert('Barang berhasil dihapus!');
        window.location.href = 'products.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Barang gagal dihapus!');
        window.location.href = 'products.php';
    </script>
    ";
}
?>
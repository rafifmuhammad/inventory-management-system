<?php
include './functions/function.php';

$kd_kategori = $_GET['kd_kategori'];

if (deleteCategory($kd_kategori) > 0) {
    echo "
        <script>
            alert('Kategori berhasil dihapus!');
            window.location.href = 'categories.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Kategori gagal dihapus!');
            window.location.href = 'categories.php';
        </script>
    ";
}
<?php

require './db/conn.php';

function getData($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    if (!$result) {
        return $rows;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Functions for products
function addProduct($data) {
    global $conn;

    $id_barang = uniqid();
    $barcode = htmlspecialchars($data['barcode']);
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $kategori = htmlspecialchars($data['kategori']);
    $satuan = htmlspecialchars($data['satuan']);
    $harga_beli = htmlspecialchars($data['harga_beli']);
    $harga_jual = htmlspecialchars($data['harga_jual']);
    $stok_minimum = htmlspecialchars($data['stok_minimum']);
    $created_at = Date('d-m-Y');

    $barcodeCheck = getData("SELECT COUNT(*) AS jumlah FROM tb_barang WHERE barcode = '$barcode'")[0];
    $barcodeCheck['id_barang'] = $id_barang;

    $query = "INSERT INTO 
        tb_barang (id_barang, barcode, nama_barang, kategori, satuan, harga_beli, harga_jual, stok_minimum, created_at) 
        VALUES ('$id_barang', '$barcode', '$nama_barang', '$kategori', '$satuan', $harga_beli, $harga_jual, $stok_minimum, '$created_at')";
    
    mysqli_query($conn, $query);

    // Tambahkan barang masuk
    addProductIn($data, $id_barang);
    
    return mysqli_affected_rows($conn);
}

function deleteBarang($id) {
    global $conn;

    $query = "DELETE FROM tb_barang WHERE id_barang = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateProduct($data) {
    global $conn;

    $id_barang = htmlspecialchars($data['id_barang']);
    $barcode = htmlspecialchars($data['barcode']);
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $kategori = htmlspecialchars($data['kategori']);
    $satuan = htmlspecialchars($data['satuan']);
    $harga_beli = htmlspecialchars($data['harga_beli']);
    $harga_jual = htmlspecialchars($data['harga_jual']);
    $stok_minimum = htmlspecialchars($data['stok_minimum']);

    $query = "UPDATE tb_barang SET
        barcode = '$barcode',
        nama_barang = '$nama_barang',
        kategori = '$kategori',
        satuan = '$satuan',
        harga_beli = $harga_beli,
        harga_jual = $harga_jual,
        stok_minimum = $stok_minimum
        WHERE id_barang = '$id_barang'";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function for product in
function addProductIn($data, $id_barang) {
    global $conn;

    $id_masuk = uniqid();
    $jumlah = htmlspecialchars($data['jumlah']);
    $tanggal_masuk = date('Y-m-d');
    $tanggal_kadaluwarsa = htmlspecialchars($data['tanggal_kadaluwarsa']);

    $query = "INSERT INTO 
        tb_barang_masuk (id_barang, id_masuk, jumlah, tanggal_masuk, tanggal_kadaluwarsa) 
        VALUES ('$id_barang', '$id_masuk', $jumlah, '$tanggal_masuk', '$tanggal_kadaluwarsa')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateProductIn($data) {
    global $conn;

    $id_masuk = htmlspecialchars($data['id_masuk']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $tanggal_kadaluwarsa = htmlspecialchars($data['tanggal_kadaluwarsa']);

    $query = "UPDATE tb_barang_masuk SET
        jumlah = $jumlah,
        tanggal_kadaluwarsa = '$tanggal_kadaluwarsa'
        WHERE id_masuk = '$id_masuk';
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteProductIn($id) {
    global $conn;

    $query = "DELETE FROM tb_barang_masuk WHERE id_masuk = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Functions for product out
function deleteProductOut($id) {
    global $conn;

    $query = "DELETE FROM tb_barang_keluar WHERE id_keluar = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Functions for category
function addCategory($data) {
    global $conn;

    $nama_kategori = htmlspecialchars($data['nama_kategori']);

    $kd_kategori = uniqid();

    // Insert ke database
    $query = "INSERT INTO tb_kategori (kd_kategori, nama_kategori) VALUES ('$kd_kategori', '$nama_kategori')";
    mysqli_query($conn, $query);

    // Kembalikan jumlah baris yang terpengaruh
    return mysqli_affected_rows($conn);
}

function deleteCategory($id) {
    global $conn;

    $query = "DELETE FROM tb_kategori WHERE kd_kategori = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
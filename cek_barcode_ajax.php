<?php
include './functions/function.php';

$barcode = $_POST['barcode'];

$data = getData("SELECT id_barang, nama_barang FROM tb_barang WHERE barcode = '$barcode'");

if(count($data) > 0){
    echo json_encode([
        "status" => "exists",
        "id_barang" => $data[0]['id_barang'],
        "nama_barang" => $data[0]['nama_barang']
    ]);
}else{
    echo json_encode([
        "status" => "new"
    ]);
}

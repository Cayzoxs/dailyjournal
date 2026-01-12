<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
</head>
<body>
    <div class="container">
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gallery
    </button>
    <div class="row">
        <div class="table-responsive" id="gallery_data"></div>
    </div>
</div>

<script>
$(document).ready(function(){
    load_data();
    $(document).on('click', '.halaman', function(e){
        e.preventDefault();
        load_data($(this).attr("id"));
    });
});

function load_data(hlm){
    $.ajax({
        url : "gallery_data.php",
        method : "POST",
        data : { hlm: hlm },
        success : function(data){
            $('#gallery_data').html(data);
        }
    });
} 
</script>

<?php
include "koneksi.php";
include "upload_foto.php";

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $tanggal = date("Y-m-d H:i:s");
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('" . $cek_upload['message'] . "'); document.location='admin.php?page=gallery';</script>";
            die;
        }
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            if($_POST['gambar_lama'] != '' && file_exists("img/" . $_POST['gambar_lama'])) {
                unlink("img/" . $_POST['gambar_lama']);
            }
        }
        $stmt = $conn->prepare("UPDATE gallery SET judul=?, gambar=?, tanggal=? WHERE id=?");
        $stmt->bind_param("sssi", $judul, $gambar, $tanggal, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO gallery (judul, gambar, tanggal) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $judul, $gambar, $tanggal);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Simpan sukses'); document.location='admin.php?page=gallery';</script>";
    }
    $stmt->close();
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];
    if ($gambar != '' && file_exists("img/" . $gambar)) {
        unlink("img/" . $gambar);
    }
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id =?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Hapus sukses'); document.location='admin.php?page=gallery';</script>";
    }
    $stmt->close();
}
?>

<div class="container">
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gallery
    </button>
    <div class="row">
        <div class="table-responsive" id="gallery_data"></div>
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah Gallery</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    load_data();
    $(document).on('click', '.halaman', function(e){
        e.preventDefault();
        load_data($(this).attr("id"));
    });
});
function load_data(hlm){
    $.ajax({
        url : "gallery_data.php",
        method : "POST",
        data : { hlm: hlm },
        success : function(data){
            $('#gallery_data').html(data);
        }
    });
} 
</script>
</body>
</html>
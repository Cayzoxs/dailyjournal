<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usert</title>
</head>
<body>
    <?php
include "koneksi.php";
include "upload_foto.php";

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $_POST['password_lama'];
    $foto = '';
    $nama_foto = $_FILES['foto']['name'];

    if ($nama_foto != '') {
        $cek_upload = upload_foto($_FILES["foto"]);
        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];
            if(!empty($_POST['foto_lama']) && file_exists("img/" . $_POST['foto_lama'])) {
                unlink("img/" . $_POST['foto_lama']);
            }
        }
    } else {
        $foto = $_POST['foto_lama'];
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $stmt = $conn->prepare("UPDATE user SET username=?, password=?, foto=? WHERE id=?");
        $stmt->bind_param("sssi", $username, $password, $foto, $_POST['id']);
    } else {
        $stmt = $conn->prepare("INSERT INTO user (username, password, foto) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $foto);
    }
    $stmt->execute();
    echo "<script>document.location='admin.php?page=user';</script>";
}
?>
<div class="container">
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah User</button>
    <div id="user_data"></div>
</div>
<script>
$(document).ready(function(){
    load_user(1);
    $(document).on('click', '.halaman', function(e){
        e.preventDefault();
        load_user($(this).attr("id"));
    });
});
function load_user(hlm){
    $.ajax({
        url : "user_data.php",
        method : "POST",
        data : { hlm: hlm },
        success : function(data){ $('#user_data').html(data); }
    });
}
</script>
</body>
</html>
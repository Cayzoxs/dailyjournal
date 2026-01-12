<?php
include "koneksi.php";
include "upload_foto.php";

if (isset($_POST['simpan'])) {
    $username_input = $_POST['username_form'];
    $password_input = $_POST['password_form'];
    $foto = '';
    $nama_foto = $_FILES['foto']['name'];

    if ($nama_foto != '') {
        $cek_upload = upload_foto($_FILES["foto"]);
        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];
        } else {
            echo "<script>alert('" . $cek_upload['message'] . "'); document.location='admin.php?page=user';</script>";
            die;
        }
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $foto_final = ($nama_foto == '') ? $_POST['foto_lama'] : $foto;
        
        if ($nama_foto != '' && $_POST['foto_lama'] != '' && file_exists("img/" . $_POST['foto_lama'])) {
            unlink("img/" . $_POST['foto_lama']);
        }

        if (!empty($password_input)) {
            $pass_hash = md5($password_input);
            $stmt = $conn->prepare("UPDATE user SET username=?, password=?, foto=? WHERE id=?");
            $stmt->bind_param("sssi", $username_input, $pass_hash, $foto_final, $id);
        } else {
            $stmt = $conn->prepare("UPDATE user SET username=?, foto=? WHERE id=?");
            $stmt->bind_param("ssi", $username_input, $foto_final, $id);
        }
    } else {
        $pass_hash = md5($password_input);
        $stmt = $conn->prepare("INSERT INTO user (username, password, foto) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username_input, $pass_hash, $foto);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Simpan user sukses'); document.location='admin.php?page=user';</script>";
    }
    $stmt->close();
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $foto = $_POST['foto'];
    if ($foto != '' && file_exists("img/" . $foto)) {
        unlink("img/" . $foto);
    }
    $stmt = $conn->prepare("DELETE FROM user WHERE id =?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Hapus user sukses'); document.location='admin.php?page=user';</script>";
    }
    $stmt->close();
}
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Manajemen User</h4>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            <i class="bi bi-plus-lg"></i> Tambah User
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="user_data"></div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahUser" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username_form" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password_form" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" name="foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    load_data_user();
    $(document).on('click', '.halaman-user', function(e){
        e.preventDefault();
        load_data_user($(this).attr("id"));
    });
});

function load_data_user(hlm){
    $.ajax({
        url : "user_data.php",
        method : "POST",
        data : { hlm: hlm },
        success : function(data){
            $('#user_data').html(data);
        }
    });
} 
</script>
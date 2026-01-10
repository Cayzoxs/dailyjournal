<div class="container">
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Article
    </button>
    <div class="row">
        <div class="table-responsive" id="article_data"></div>

        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah Article</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" required>
                            </div>
                            <div class="mb-3">
                                <label>Isi</label>
                                <textarea class="form-control" placeholder="Tuliskan Isi Artikel" name="isi" required></textarea>
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
    // Panggil fungsi saat pertama kali halaman dimuat
    load_data();

    // Gunakan delegasi event agar tombol pagination yang baru dimuat tetap berfungsi
    $(document).on('click', '.halaman', function(e){
        e.preventDefault();
        var hlm = $(this).attr("id");
        load_data(hlm);
    });
});

// Deklarasikan fungsi di luar document.ready agar bersifat global
function load_data(hlm){
    $.ajax({
        url : "article_data.php",
        method : "POST",
        data : { hlm: hlm },
        success : function(data){
            $('#article_data').html(data);
        }
    });
} 
</script>

<?php
include "koneksi.php"; // Pastikan koneksi disertakan
include "upload_foto.php";

// --- LOGIKA SIMPAN (INSERT & UPDATE) ---
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('" . $cek_upload['message'] . "'); document.location='admin.php?page=article';</script>";
            die;
        }
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // UPDATE
        $id = $_POST['id'];
        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            if($_POST['gambar_lama'] != '' && file_exists("img/" . $_POST['gambar_lama'])) {
                unlink("img/" . $_POST['gambar_lama']);
            }
        }
        $stmt = $conn->prepare("UPDATE article SET judul=?, isi=?, gambar=?, tanggal=?, username=? WHERE id=?");
        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
    } else {
        // INSERT
        $stmt = $conn->prepare("INSERT INTO article (judul, isi, gambar, tanggal, username) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Simpan sukses'); document.location='admin.php?page=article';</script>";
    }
    $stmt->close();
}

// --- LOGIKA HAPUS ---
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];
    if ($gambar != '' && file_exists("img/" . $gambar)) {
        unlink("img/" . $gambar);
    }
    $stmt = $conn->prepare("DELETE FROM article WHERE id =?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Hapus sukses'); document.location='admin.php?page=article';</script>";
    }
    $stmt->close();
}
?>
<?php
include "koneksi.php";

$hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
$limit = 5; 
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

$sql = "SELECT * FROM user ORDER BY id DESC LIMIT $limit_start, $limit";
$hasil = $conn->query($sql);
?>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hasil->fetch_assoc()) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><strong><?= $row["username"] ?></strong></td>
                <td>
                    <?php if ($row["foto"] != '' && file_exists('img/' . $row["foto"])) { ?>
                        <img src="img/<?= $row["foto"] ?>" width="50" class="rounded-circle">
                    <?php } else { ?>
                        <img src="img/default_user.png" width="50" class="rounded-circle">
                    <?php } ?>
                </td>
                <td>
                    <a href="#" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEditU<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                    <a href="#" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapusU<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

                    <div class="modal fade" id="modalEditU<?= $row["id"] ?>" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content text-dark">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Edit User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <input type="hidden" name="foto_lama" value="<?= $row["foto"] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username_form" value="<?= $row["username"] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password (Kosongkan jika tidak ganti)</label>
                                            <input type="password" class="form-control" name="password_form">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Foto Profil</label>
                                            <input type="file" class="form-control" name="foto">
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

                    <div class="modal fade" id="modalHapusU<?= $row["id"] ?>" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content text-dark">
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <p>Yakin hapus user "<strong><?= $row["username"] ?></strong>"?</p>
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <input type="hidden" name="foto" value="<?= $row["foto"] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <input type="submit" value="hapus" name="hapus" class="btn btn-danger">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$sql_total = "SELECT * FROM user";
$hasil_total = $conn->query($sql_total);
$total_records = $hasil_total->num_rows;
$jumlah_page = ceil($total_records / $limit);
?>

<div class="d-flex justify-content-between align-items-center mt-3">
    <p>Total User: <?= $total_records; ?></p>
    <nav>
        <ul class="pagination pagination-sm mb-0">
            <?php
            for($i = 1; $i <= $jumlah_page; $i++){
                $active = ($hlm == $i)? ' active' : '';
                echo '<li class="page-item halaman-user '.$active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
include "koneksi.php";
$hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
$limit = 5;  
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

$hasil = $conn->query("SELECT * FROM user LIMIT $limit_start, $limit");
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
            <td><?= $row["username"] ?></td>
            <td><img src="img/<?= $row["foto"] ?>" width="50" class="rounded-circle"></td>
            <td></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>
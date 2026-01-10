<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];
  
  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['pass']);

	//prepared statement
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

	//parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string
  
  //database executes the statement
  $stmt->execute();
  
  //menampung hasil eksekusi
  $hasil = $stmt->get_result();
  
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  if (!empty($row)) {
    $_SESSION['username'] = $row['username'];

    header("location:admin.php");
  } else {
    header("location:login.php");
  }

  $stmt->close();
  $conn->close();
} else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | My Personal Journal</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="icon" href="img/logo.png" />
  </head>
  <body class="bg-danger-subtle">
<?php
$notification = "";

// set variable username dan password dummy
$username_dummy = "admin";
$password_dummy = "123456";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

// check apakah ada request dengan method POST yang dilakukan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form input
    $input_user = htmlspecialchars($_POST['user']);
    $input_pass = htmlspecialchars($_POST['pass']); 

    // check apakah username dan password yang di POST sama dengan data dummy
    if($input_user == $username_dummy && $input_pass == $password_dummy){
        $notification_class = 'alert-success';
        $status_text = 'Username dan Password Benar.';
    } else {
        $notification_class = 'alert-warning';
        $status_text = 'Username atau Password Salah.';
    }
    
    $notification = '
        <div class="alert ' . $notification_class . ' mt-4 fade show" role="alert">
            ' . $status_text . '
            <hr class="alert-divider">
            <ul class="list-unstyled mb-0">
                <li>Username : <strong>' . $input_user . '</strong></li>
                <li>Password : <strong>' . $input_pass . '</strong></li>
            </ul>
        </div>';
};
?>
<div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-12 col-sm-8 col-md-6 m-auto">
      <div class="card border-0 shadow rounded-5">
        <div class="card-body">
          <div class="text-center mb-3">
            <i class="bi bi-person-circle h1 display-4"></i>
            <p>Welcome to My Daily Journal</p>
            <hr />
          </div>
          <form action="" method="post">
            <input
              type="text"
              name="user"
              class="form-control my-4 py-2 rounded-4"
              placeholder="Username"
              required
            />
            <input
              type="password"
              name="pass"
              class="form-control my-4 py-2 rounded-4"
              placeholder="Password"
              required
            />
            <div class="text-center my-3 d-grid">
              <button class="btn btn-danger rounded-4" type="submit">Login</button>
            </div>
          </form>
        </div>
      </div>
      
      <?php echo $notification; ?>
      
    </div>
  </div>
</div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
<?php
}
?>
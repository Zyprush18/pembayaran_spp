<?php
try {
    include 'databases/connections.php';
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = mysqli_query($connect, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");
        
       if ($query) {
        if (mysqli_num_rows($query) > 0) {
            session_start();
            $_SESSION['user'] = mysqli_fetch_array($query);
            header('location: index.php');
        }else{
            echo "<script>alert('Username atau password salah');location.href='index.php'</script>";
        }
       }
    }
} catch (\Throwable $th) {
    throw $th;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./asset/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="./asset/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="card" style="width: 30rem; height: 23rem;">
                <div class="card-body">
                    <h1 class="text-center">Login</h1>
                    <p class="text-center">login your account</p>


                    <form method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username/NISN</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="masukkan username atau nisn">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="masukkan password atau nis">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>



</body>

</html>
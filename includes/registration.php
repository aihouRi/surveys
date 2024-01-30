<?php include "header.php"; ?>
<?php include "db.php"; ?>

<?php

if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if (!empty($username) && !empty($password)) {
        
        $stmt = $dbh->prepare("INSERT INTO users (user_name, user_password, created_at) VALUES (:username, :password, NOW())");
 
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

        $stmt->execute();

        $message = "Your registration has been submitted";
    } else {
        $message = "Fields cannot be empty";
    }
} else {
    $message = "";
}
?>

<!-- Navigation -->




<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center bg-danger"><?php echo $message; ?></h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>

                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <br>

                            <div class="text-center">
                            既にアカウントを持っている場合は、 <a href="../index.php">こちら</a>からログインしてください
                            </div>

                            <br>

                            <div class="text-center">
                                <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                            </div>
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
<?php session_start(); ?>

<?php include "includes/header.php" ?>
<?php include "includes/db.php"?>


<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {

        $stmt = $dbh->prepare("SELECT user_password FROM users WHERE user_name = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['user_password'])) {
                $_SESSION['user_name'] = $username;
                header("Location: includes/surveys.php");
                exit;
            } else {
                $message = 'Invalid username or password.';
            }
        } else {
            $message = 'Invalid username or password.';
        }
    } else {
        $message = 'Please enter username and password.';
    }
} else {
    $message = '';
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
                        <h1>Login</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center bg-danger"><?php echo $message; ?></h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Your Username">
                            </div>

                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <br>

                            <div class="text-center">
                            アカウントをお持ちでない場合は、 <a href="includes/registration.php">こちら</a>からサインアップしてください
                            </div>
                            
                            <br>

                            <div class="text-center">
                                <input type="submit" name="login" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Login">
                            </div>
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
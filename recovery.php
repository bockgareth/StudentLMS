<?php
/**
 * Created by PhpStorm.
 * User: Gareth Bock
 * Date: 5/19/2018
 * Time: 1:58 PM
 */
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">
    <title>Install Wizard</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content center">
                    <?php

                    function loadForm($email = "") { ?>
                        <span class="card-title">Password Recovery. Please enter you email address</span>
                        <div class="row">
                            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                <div class="input-field col s12">
                                    <input id="email" type="text" name="email" value="<?php echo $email ?>" required>
                                    <label for="email">Email</label>
                                </div>
                                <input type="submit" name="form" value="reset" class="btn">
                                <a href="login.php" class="btn">Login</a>
                            </form>
                        </div><?php
                    }

                    if (isset($_POST["form"])) {
                        include "connection.php";

                        $email = htmlentities($_POST["email"]);

                        $_SESSION['email'] = $email;

                        $sql = "select * from students where email = '".$email."'";

                        if ($result = $conn->query($sql)) {
                            $rowCount = $result->num_rows;
                            if ($rowCount > 0) { unset($_POST["form"]); ?>
                                <span class="card-title">Enter new password</span>
                                <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" name="password" value="" required>
                                        <label for="pass">Password</label>
                                    </div>
                                    <input type="submit" name="newPassword" value="reset" class="btn">
                                    <a href="login.php" class="btn">Login</a>
                                </form>
                                <?php
                            } else {
                                echo "<h4>Email address does not exist</h4>";
                                ?><a href="login.php" class="btn">Login</a> <?php
                            }

                        }
                    } else {
                        loadForm();
                    }

                    if (isset($_POST["newPassword"])) {
                        $pass = htmlentities($_POST['password']);
                        $hashed = md5($pass);
                        $sql = "update students set password = '".$hashed."' where email = '".$_SESSION['email']."'";

                        include "connection.php";

                        require_once('PHPMailer/PHPMailerAutoload.php');

                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'ssl';
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = '465';
                        $mail->isHTML();
                        $mail->Username = 'studentlearnersystem@gmail.com';
                        $mail->Password = 'student21!';
                        $mail->setFrom('no-reply@studentlms.com');
                        $mail->Subject = 'Password reset';
                        $mail->Body = '
                            <html>
                            <body>
                            <h4>Good day</h4>
                            <p>Your new password is '.$pass.'</p>
                            </body>
                            </html>
                        ';
                        $mail->addAddress($_SESSION['email']);

                        $mail->send();

                        $conn->query($sql);
                        echo "<h5>Password successfully changed &#9989;</h5>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</body>
</html>


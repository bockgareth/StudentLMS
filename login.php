<?php
/**
 * Created by PhpStorm.
 * User: Gareth Bock
 * Date: 5/19/2018
 * Time: 11:47 AM
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
    <title>Student LMS</title>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <div class="container">
            <a href="#" class="brand-logo">Student LMS</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <?php

                    function loadForm($number = "", $pass = "") { ?>
                        <span class="card-title">Please consider logging in</span>
                        <div class="row">
                            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                <div class="input-field col s12">
                                    <input id="studentNo" type="text" name="studentNo" value="<?php echo $number ?>" required>
                                    <label for="studentNo">Student number</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="pass" type="password" name="pass" value="<?php echo $pass ?>" required>
                                    <label for="pass">Password</label>
                                </div>
                                <input type="submit" name="form" value="Login" class="btn">
                                <a href="recovery.php" class="btn">Password recovery</a>
                                <a href="signup.php" class="btn">Sign up</a>
                            </form>
                        </div><?php
                    }

                    if (isset($_POST["form"])) {
                        include "connection.php";

                        $studentNo = htmlentities($_POST["studentNo"]);
                        $pass = htmlentities($_POST["pass"]);

                        $hashed = md5($pass);


                        $sql = "select * from students where student_no = '".$studentNo."'";

                        if ($result = $conn->query($sql)) {

                            $rowCount = $result->num_rows;
                            if ($rowCount > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    if ($row["student_no"] == $studentNo && $row["password"] == trim($hashed)) {

                                        $_SESSION['first'] = $row["first_name"];
                                        $_SESSION['last'] = $row["last_name"];
                                        $_SESSION['address'] = $row["email"];
                                        $_SESSION['studentNo'] = $row["student_no"];
                                        ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="center">
                                            <h5>Logged in as <?php echo $row["first_name"]." ".$row["last_name"]; ?></h5>
                                            <h4>First name:</h4>
                                            <h2><?php echo $row["first_name"]; ?></h2>
                                            <h4>Last name:</h4>
                                            <h2><?php echo $row["last_name"]; ?></h2>
                                            <h4>Email:</h4>
                                            <h2><?php echo $row["email"]; ?></h2>
                                            <h4>Student number:</h4>
                                            <h2><?php echo $row["student_no"]; ?></h2>
                                            <a href="login.php" class="btn">Log out</a>
                                            <input class="btn" type="submit" name="data" value="Email user data">
                                        </form>
                                        <?php
                                    } else {
                                        echo "<br><p>Failed to login</p><br>";
                                        loadForm($studentNo, $pass);
                                    }

                                }
                            } else { ?>
                                <br><h4>This user is not registered. Would you like to sign up?</h4><br>
                                <a href="signup.php"><input type="button" value="Sign up" class="btn"></a><?php
                            }
                        }
                    } else {
                        loadForm();
                    }

                    if (isset($_POST['data'])) {
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
                        $mail->Subject = 'Student data';
                        $mail->Body = '
                            <html>
                            <body>
                                <h4>First name:</h4>
                                <h2>'.$_SESSION['first'].'</h2>
                                <h4>Last name:</h4>
                                <h2>'.$_SESSION['last'].'</h2>
                                <h4>Email:</h4>
                                <h2>'.$_SESSION['address'].'</h2>
                                <h4>Student number:</h4>
                                <h2>'.$_SESSION['studentNo'].'</h2>
                            </body>
                            </html>
                        ';
                        $mail->addAddress($_SESSION['address']);

                        $mail->send();

                        echo "<h4>Email has been sent to ".$_SESSION['address']."</h4>";
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

<?php
/**
 * Created by PhpStorm.
 * User: Gareth Bock
 * Date: 5/19/2018
 * Time: 12:53 PM
 */

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
    <title>Sign up</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <?php

                    function loadForm($first = "", $last = "", $email = "", $pass = "") { ?>
                    <span class="card-title">Please consider signing up</span>
                    <div class="row">
                        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                            <div class="input-field col s12">
                                <input id="first" type="text" name="first" value="<?php echo $first ?>" required>
                                <label for="first">First name</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="last" type="text" name="last" value="<?php echo $last ?>" required>
                                <label for="last">Last name</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="email" type="text" name="email" value="<?php echo $email ?>" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="pass" type="password" minlength="8" name="pass" value="<?php echo $pass ?>" required>
                                <label for="pass">Password</label>
                            </div>
                            <input type="submit" name="form" value="Sign up" class="btn">
                        </form>
                    </div>
                    <?php
                    }

                    if (isset($_POST["form"])) {

                        include "connection.php";

                        $first = htmlentities($_POST["first"]);
                        $last = htmlentities($_POST["last"]);
                        $email = htmlentities($_POST["email"]);
                        $pass = md5(htmlentities($_POST["pass"]));

                        $sql = "select * from students where email = '".$email."'";

                        if ($result = $conn->query($sql)) {
                            $rowCount = $result->num_rows;
                            if ($rowCount > 0) {
                                echo "<p>This email address has been taken</p>";
                                loadForm($first, $last, $email, $pass);
                            } else {

                                $genStudentNo = rand(100000000, 999999999);
                                $sql = "insert into students (first_name, last_name, email, student_no, password)
			                    values ('".$first."', '".$last."', '".$email."', '".$genStudentNo."', '".$pass."')";

                                $conn->query($sql);
                                echo "<p>Student '".$first." ".$last."' added with the student number ".$genStudentNo." &#9989;</p><br>";
                                echo "<h4>Thank you for signing up!</h4>";
                                ?><a href="login.php" class="btn">Login</a> <?php
                            }

                        }
                    } else {
                        loadForm();
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

<?php
/**
 * Created by PhpStorm.
 * User: Gareth Bock
 * Date: 5/19/2018
 * Time: 11:47 AM
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
    <title>Student LMS</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <?php

                    function loadForm($email = "", $pass = "") { ?>
                        <span class="card-title">Please consider logging in</span>
                        <div class="row">
                            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                <div class="input-field col s12">
                                    <input id="email" type="text" name="email" value="<?php echo $email ?>" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="pass" type="password" name="pass" value="<?php echo $pass ?>" required>
                                    <label for="pass">Email</label>
                                </div>
                                <input type="submit" name="form" value="Login" class="btn">
                            </form>
                        </div><?php
                    }

                    loadForm();
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

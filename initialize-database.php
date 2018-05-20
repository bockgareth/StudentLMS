<?php
/**
 * Created by PhpStorm.
 * User: Gareth Bock
 * Date: 5/19/2018
 * Time: 11:38 AM
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
    <title>Install complete</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content center">
                    <h3>Database successfully populated</h3><br>
                    <h5>Proceed to Login?<h5><br><br>
                    <a href="index.php" class="btn">Login</a><br><br>
                    <?php

                    include "connection.php";

                    $users = file("students.csv");

                    foreach ($users as $user) {
                        $data = explode(",", $user);
                        $sql = "insert into students (first_name, last_name, email, student_no, password)
			                    values ('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."')";

                        $conn->query($sql);
                        echo "<p>Student '".$data[0]."' added &#9989;</p><br>";

                    }

                    include "load.php";
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


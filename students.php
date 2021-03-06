<?php
/**
 * Created by PhpStorm.
 * User: Gareth Bock
 * Date: 5/19/2018
 * Time: 4:33 PM
 */

session_start();
if (isset($_POST["attendance"])) {
    $attend = $_POST["attend"];

    include "connection.php";

    $sql = "select * from students where id ='" . $attend . "'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();


    $newSql = "insert into attendance (first_name, last_name, email, student_no)
			values ('" . $row['first_name'] . "', '" . $row['last_name'] . "', '" . $row['email'] . "', '" . $row['student_no'] . "')";

    $exist = $conn->query("select * from attendance where email = '" . $row['email'] . "'");

    $rowCount = $exist->num_rows;

    if ($rowCount == 0) {
        $conn->query($newSql);
        $conn->query("update students set present = '1' where email = '".$row['email']."'");
    }




}
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
    <title>Students</title>
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
                    <span class="card-title">Logged in as <?php echo $_SESSION['security']?></span>
                    <img src="img/guard.PNG" width="75" height="75" alt="">
                    <span class="card-title">Students</span>
                    <?php
                    include "connection.php";

                    $sql = "select * from students";

                    if ($result = $conn->query($sql)) {
                        $rowCount = $result->num_rows;
                        if ($rowCount > 0) { ?>
                            <table>
                                <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Student no</th>
                                    <th>Picture</th>
                                    <th>Present</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row["first_name"]; ?></td>
                                        <td><?php echo $row["last_name"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["student_no"]; ?></td>
                                        <td><a href="#modal<?php echo $row['id'] ?>"
                                               class="btn waves-effect waves-light modal-trigger">Show picture</a></td>

                                        <td>
                                            <?php if ($row["present"] > 0) : ?>
                                                &#9989;
                                            <?php else : ?>
                                                &#10060;
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                                <input type="submit" name="attendance" class="btn-flat" value="mark present">
                                                <input type="hidden" value="<?php echo $row['id'] ?>" name="attend">
                                            </form>
                                        </td>
                                    </tr>
                                    <div id="modal<?php echo $row['id'] ?>" class="modal center">
                                        <div class="modal-content">
                                            <img src="img/<?php echo $row['id'] ?>.PNG" height='350' width='350'>
                                        </div>
                                    </div>
                                <?php } ?>
                                </tbody>
                            </table>

                            <?php
                        }
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
<script type="text/javascript">
    $(function () {
        $('.modal').modal();
    });

    function studentPresent(id) {
        let mark = document.querySelector("#present" + id);
        mark.innerHTML = '&#9989';
    }

</script>
</body>
</html>

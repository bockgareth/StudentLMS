<?php
/**
 * Created by PhpStorm.
 * User: Gareth Bock
 * Date: 5/19/2018
 * Time: 11:38 AM
 */

include "connection.php";

$users = file("students.csv");

foreach ($users as $user) {
    $data = explode(",", $user);

    echo "<pre>";
    print_r($data);
    echo "</pre>";

}
<?php
/**
 * Created by PhpStorm.
 * User: Gareth Bock
 * Date: 5/19/2018
 * Time: 11:33 AM
 */

$conn = @new mysqli("localhost", "root", "", "test");

if (!$conn) {
    echo "Unable to connect to database" . $conn->connect_errno;
}
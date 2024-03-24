<?php
session_start();
include '../dbconnect.php';
if ($_SESSION['email'] == null || $_SESSION['email'] == "") {
    header('Location: login.php');
}
if ($_SESSION['isAdmin'] == false) {
    header('Location: login.php');
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointment WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0 &&  $_SESSION['isAdmin'] == true) {
        $sql = "DELETE FROM appointment WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header('Location: appointments.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        header('Location: appointments.php');
    }
}

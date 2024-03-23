<?php
session_start();
include './dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Workshop</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <main>
        <section id="hero-section" class="flex justify-around align-center" style="height: 80vh;padding:2rem;">
            <div>
                <h1 style="font-size:3rem;">Welcome to the ULTIMATE <br><span class="text-primary" style="font-weight: 600;">CAR WORKSHOP</span></h1>
                <p>Get your car fixed by professionals</p>
                <a href="book-appointment.php"> <button class="button" style="margin-top: 10px;">BOOK AN APPOINTMENT</button>
                </a>
            </div>
            <div><img src="./img/hero-img.png" alt=""></div>
        </section>
    </main>
    <?php include './components/footer.php'; ?>
</body>

</html>
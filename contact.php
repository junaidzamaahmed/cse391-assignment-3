<?php
session_start();
include './dbconnect.php';

if ($_SESSION['email'] == null || $_SESSION['email'] == "") {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $text = $_POST['text'];
    $uid = $_SESSION['id'];

    $sql = "INSERT INTO message (text, uid) VALUES ('$text', '$uid')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Message sent successfully!')</script>";
        header('Location: contact.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <main style="height: 80vh;">
        <section class="flex justify-around align-center" style="height: 80vh;padding:2rem;">
            <div>
                <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Leave us a message!</h1>
                <form action="contact.php" method="POST">
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="text">Message</label>
                        <textarea type="text" name="text" id="text" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;"></textarea>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="button">Send</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include './components/footer.php'; ?>
</body>

</html>
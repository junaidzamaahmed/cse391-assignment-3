<?php
session_start();
require './dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $user = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $user);

    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('Account does not exist!')</script>";
        die();
    }
    $row = mysqli_fetch_assoc($result);
    $verify = password_verify($_POST['pass'], $row['pass']);
    if (!$verify) {
        echo "<script>alert('Incorrect password!')</script>";
    } else if ($row["email"] === $email && $verify) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['isAdmin'] = $row['isAdmin'];
        header('Location: index.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <main style="height: 80vh;">
        <section class="flex justify-around align-center" style="height: 80vh;padding:2rem;">
            <div>
                <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Login</h1>
                <form action="login.php" method="POST">
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction: column;margin-bottom:10px;">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <p id="error" class="text-primary"></p>
                    <button type="submit" class="button">Login</button>
                </form>
                <br>
                <a href="register.php" class="text-primary">Or, create new account.</a>
            </div>
        </section>
    </main>
    <?php include './components/footer.php'; ?>
</body>

</html>
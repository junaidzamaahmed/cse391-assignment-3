<?php
session_start();
require './dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $emailCheck = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $emailCheck);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists!')</script>";
    } else {
        $sql = "INSERT INTO user (name, phone, email, pass) VALUES ('$name', '$phone', '$email', '$pass')";

        if (mysqli_query($conn, $sql)) {
            $user = "SELECT * FROM user WHERE email='$email'";
            $result = mysqli_query($conn, $user);
            $row = mysqli_fetch_assoc($result);
            $verify = password_verify($_POST['pass'], $row['pass']);
            if ($row["email"] === $email && password_verify($_POST['pass'], $row['pass'])) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['isAdmin'] = $row['isAdmin'];
                header('Location: index.php');
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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
                <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Register</h1>
                <form action="register.php" method="POST">
                    <div class="flex" style="flex-direction: column;margin-bottom:10px;">
                        <label for="name">Full name</label>
                        <input type="text" name="name" id="name" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction: column;margin-bottom:10px;">
                        <label for="phone">Phone</label>
                        <input pattern="[0]{1}[1]{1}[0-9]{9}" type="tel" name="phone" id="phone" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction: column;margin-bottom:10px;">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <p class="text-primary"></p>
                    <button type="submit" class="button">Submit</button>
                </form>
                <br>
                <a href="login.php" class="text-primary">Or, login to your existing account.</a>
            </div>
        </section>
    </main>
    <?php include './components/footer.php'; ?>
</body>

</html>
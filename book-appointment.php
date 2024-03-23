<?php
session_start();
include './dbconnect.php';
if ($_SESSION['email'] == null || $_SESSION['email'] == "") {
    header('Location: login.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $color = $_POST['color'];
    $license_no = $_POST['license_no'];
    $engine_no = $_POST['engine_no'];
    $mid = $_POST['mid'];
    $uid = $_SESSION['id'];

    $sameDateCheck = "SELECT * FROM appointment WHERE uid='$uid' AND date='$date'";
    $result = mysqli_query($conn, $sameDateCheck);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('You already have an appointment on the same date!')</script>";
    } else {
        $maxAppointmentsCheck = "SELECT * FROM appointment WHERE mid='$mid' AND date='$date'";
        $result = mysqli_query($conn, $maxAppointmentsCheck);
        $rows = mysqli_num_rows($result);

        $maxAppointments = "SELECT maxCars FROM mechanic WHERE id='$mid'";
        $result = mysqli_query($conn, $maxAppointments);
        $row = mysqli_fetch_assoc($result);
        $maxCars = $row['maxCars'];
        if ($rows >= $maxCars) {
            echo "<script>alert('This mechanic has reached the maximum number of appointments for this date!')</script>";
        } else {
            $sql = "INSERT INTO appointment (date, color, license_no, engine_no, mid, uid) VALUES ('$date', '$color', '$license_no', '$engine_no', '$mid', '$uid')";

            if (mysqli_query($conn, $sql)) {
                header('Location: success.php');
                echo "<script>alert('Appointment booked successfully!')</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an appointment</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <main style="height: 80vh;">
        <section class="flex justify-around align-center" style="height: 80vh;padding:2rem;">
            <div>
                <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Book Appointment</h1>
                <form action="book-appointment.php" method="POST">
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="color">Color</label>
                        <input type="text" name="color" id="color" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="license_no">License Number</label>
                        <input type="number" name="license_no" id="license_no" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="engine_no">Engine Number</label>
                        <input type="number" name="engine_no" id="engine_no" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="mid">Mechanic</label>
                        <select required name="mid" id="mid" style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                            <?php
                            $sql = "SELECT * FROM mechanic";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option style='padding: 10px; border-radius:10px; border:1px solid lightgray;' value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="button">BOOK</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include './components/footer.php'; ?>
</body>

</html>
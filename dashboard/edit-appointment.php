<?php
session_start();
include '../dbconnect.php';
$id = $_GET['id'];
if ($_SESSION['email'] == null || $_SESSION['email'] == "") {
    header('Location: login.php');
}
if ($_SESSION['isAdmin'] == false) {
    header('Location: login.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $mid = $_POST['mid'];
    $sameDateCheck = "SELECT * FROM appointment WHERE id='$id' AND date='$date'";
    $result = mysqli_query($conn, $sameDateCheck);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Client already has an appointment on the same date!')</script>";
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
            $sql = "UPDATE appointment SET date='$date', mid=$mid WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                header('Location: ../success.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}
$sql = "SELECT * FROM appointment WHERE id=" . $id;
$result = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit appointment</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <main style="height: 80vh;">
        <section class="flex justify-around align-center" style="height: 80vh;padding:2rem;">
            <div>
                <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Edit Appointment</h1>
                <form action="edit-appointment.php" method="POST">
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="date">Date</label>
                        <input value="<?php echo $row1['date'] ?>" type="date" name="date" id="date" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                    </div>
                    <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                        <label for="mid">Mechanic</label>
                        <select required name="mid" id="mid" style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                            <?php
                            $sql = "SELECT * FROM mechanic";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row1['mid'] == $row['id']) {
                                    echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                } else {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                            }

                            ?>
                        </select>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="button">SAVE</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include '../components/footer.php'; ?>
</body>

</html>
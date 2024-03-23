<?php
session_start();
include '../dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Appointments</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <main style="height: 80vh;">
        <section class="flex" style="padding:2rem;">
            <!-- Admin panel sidebar section-->
            <div style="border:1px solid lightgray !important; height:60vh;padding:1rem;" class="sidebar flex-col flex">
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="./dashboard.php">Dashboard</a>
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="../appointments.php">Appointments</a>
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="../mechanics.php">Mechanics</a>
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="../users.php">Users</a>
            </div>
            <!-- Admin Dashboard panel with appointments list table -->
            <div style="padding:1rem; width:100%;">
                <div class="flex justify-between align-center">
                    <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Appointments</h1>
                    <a href="../book-appointment.php"><button class="button">Book Appointment</button></a>
                </div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Color</th>
                            <th>License Number</th>
                            <th>Engine Number</th>
                            <th>Mechanic</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM appointment";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['color'] . "</td>";
                            echo "<td>" . $row['license_no'] . "</td>";
                            echo "<td>" . $row['engine_no'] . "</td>";
                            $sql2 = "SELECT * FROM mechanic WHERE id=" . $row['mid'];
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            echo "<td>" . $row2['name'] . "</td>";
                            echo "<td><a style='text-decoration:none;' class='text-primary' href='edit-appointment.php?id=$row[id]'>Edit</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </section>
    </main>
    <?php include '../components/footer.php'; ?>
</body>

</html>
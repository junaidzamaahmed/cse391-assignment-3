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
            <div style="border:1px solid lightgray !important; height:60vh;padding:1rem;" class="sidebar flex-col flex">
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="./dashboard.php">Dashboard</a>
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="../appointments.php">Appointments</a>
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="../mechanics.php">Mechanics</a>
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="../users.php">Users</a>
            </div>
            <div style="padding:1rem; width:100%;">
                <div class="flex justify-between align-center">
                    <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Appointments</h1>
                    <a href="../book-appointment.php"><button class="button">Book Appointment</button></a>
                </div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>License Number</th>
                            <th>Date</th>
                            <th>Mechanic</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT appointment.id,name,phone,license_no,date,mid FROM appointment, user WHERE appointment.uid=user.id";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['license_no'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            $sql2 = "SELECT * FROM mechanic WHERE id=" . $row['mid'];
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            echo "<td>" . $row2['name'] . "</td>";
                            echo "<td><a style='text-decoration:none;' class='text-primary' href='edit-appointment.php?id=$row[id]'>Edit</a></td>";
                            echo "<td><a style='text-decoration:none;' class='text-primary' href='delete-appointment.php?id=$row[id]'>Delete</a></td>";
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
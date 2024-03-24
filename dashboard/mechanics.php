<?php
session_start();
include '../dbconnect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mechanics</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <main style="height: 80vh;">
        <section class="flex" style="padding:2rem;">
            <div style="border:1px solid lightgray !important; height:60vh;padding:1rem;" class="sidebar flex-col flex">
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="./appointments.php">Appointments</a>
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="./mechanics.php">Mechanics</a>
                <a style="color: black !important; border-bottom:1px solid lightgray;" href="./messages.php">Messages</a>
            </div>
            <div style="padding:1rem; width:100%;">
                <div class="flex justify-between align-center">
                    <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Mechanics</h1>
                    <a href="./add-mechanic.php"><button class="button">Add Mechanic</button></a>
                </div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Daily Count</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM mechanic";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['maxCars'] . "</td>";
                            echo "<td><a style='text-decoration:none;' class='text-primary' href='edit-mechanic.php?id=$row[id]'>Edit</a></td>";
                            echo "<td><a style='text-decoration:none;' class='text-primary' href='delete-mechanic.php?id=$row[id]'>Delete</a></td>";
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
<?php
session_start();
include '../dbconnect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Messages</title>
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
                    <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Messages</h1>
                </div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM message,user WHERE message.uid=user.id";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['text']; ?></td>
                                    <td><a class="text-primary" href="mailto:<?php echo $row['email']; ?>">Reply</a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4'>No messages found!</td></tr>";
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
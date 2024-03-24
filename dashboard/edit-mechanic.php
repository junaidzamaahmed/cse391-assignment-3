<?php
session_start();
include '../dbconnect.php';

if ($_SESSION['email'] == null || $_SESSION['email'] == "") {
    header('Location: login.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM mechanic WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $maxCars = $_POST['maxCars'];

    $sql = "UPDATE mechanic SET name='$name', maxCars='$maxCars' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: mechanics.php');
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
            </div>
            <div style="padding:1rem; width:100%;">
                <div class="flex justify-around align-center" style="padding:2rem;">
                    <div>
                        <h1 style="font-size:2rem; font-weight:500;" class="text-primary">Edit Mechanic</h1>
                        <form action="edit-mechanic.php?id=<?php echo $row['id'] ?>" method="POST">
                            <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                                <label for="name">Name</label>
                                <input value=<?php echo $row['name'] ?> type="text" name="name" id="name" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                            </div>
                            <div class="flex" style="flex-direction:column; margin-bottom:10px;">
                                <label for="maxCars">Daily Count(max)</label>
                                <input value=<?php echo $row['maxCars'] ?> type="number" name="maxCars" id="maxCars" required style="padding: 10px; border-radius:10px; border:1px solid lightgray;">
                            </div>
                            <div class="flex justify-center">
                                <button type="submit" class="button">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
    </main>
    </div>

    </section>
    </main>
    <?php include '../components/footer.php'; ?>
</body>

</html>
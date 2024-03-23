<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <main style="height: 80vh;">
        <section class="flex flex-col justify-center align-center text-primary" style="height: 80vh;padding:2rem;">
            <p style="font-size:5rem;">SUCCESSFUL!</p>
            <button class="button" onclick="history.back()">GO BACK</button>
        </section>
    </main>
    <?php include './components/footer.php'; ?>
</body>

</html>
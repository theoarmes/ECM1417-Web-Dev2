<!-- index.php - Landing Page -->
<?php
include 'includes/functions.php';
$isRegistered = isUserRegistered();
$avatar = getUserAvatar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pairs Game</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; renderNavbar($isRegistered, $avatar); ?>
    <div id="main" style="text-align: center; padding: 50px;">
        <h1>Welcome to Pairs</h1>
        <?php if ($isRegistered): ?>
            <a href="pairs.php"><button>Click here to play</button></a>
        <?php else: ?>
            <p>You're not using a registered session? <a href="registration.php">Register now</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
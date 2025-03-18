<?php
// navbar.php - Navigation Bar (included in all pages)
function renderNavbar($isRegistered, $avatar) {
    echo '<nav style="background: blue; padding: 10px; font-family: Verdana; font-size: 12px; font-weight: bold;">';
    echo '<a href="index.php" name="home" style="color: white; margin-right: 20px;">Home</a>';
    echo '<a href="pairs.php" name="memory" style="color: white; margin-right: 20px;">Play Pairs</a>';
    if ($isRegistered) {
        echo '<a href="leaderboard.php" name="leaderboard" style="color: white; margin-right: 20px;">Leaderboard</a>';
    } else {
        echo '<a href="registration.php" name="register" style="color: white;">Register</a>';
    }
    if ($avatar) {
        echo '<img src="' . $avatar . '" style="height: 30px; margin-left: 10px;">';
    }
    echo '</nav>';
}
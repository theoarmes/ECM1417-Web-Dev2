<?php
// leaderboard.php - Stores and Displays High Scores Using Cookies
session_start();

// Load existing scores from cookies
$scores = isset($_COOKIE['scores']) ? json_decode($_COOKIE['scores'], true) : [];

// Check if a new score was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['score'])) {
    $username = htmlspecialchars($_POST['username']);
    $score = (int) $_POST['score'];
    
    // Save new score
    $scores[] = ['username' => $username, 'score' => $score];
    
    // Sort scores in ascending order (lower attempts = better score)
    usort($scores, function ($a, $b) {
        return $a['score'] - $b['score'];
    });
    
    // Store updated scores in a cookie
    setcookie('scores', json_encode($scores), time() + (86400 * 30), "/"); // Expires in 30 days
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="pairs.php">Play Pairs</a>
    </nav>
    <div id="main">
        <h2>Leaderboard</h2>
        <table border="1" style="border-spacing: 2px; width: 50%; margin: auto;">
            <tr><th>Username</th><th>Best Score</th></tr>
            <?php foreach ($scores as $entry): ?>
                <tr><td><?php echo $entry['username']; ?></td><td><?php echo $entry['score']; ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
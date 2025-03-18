<?php
// pairs.php - Game Page with Dynamic Emoji Assets and Score Submission
session_start();

// Check username from cookies (default: Guest)
$username = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : 'Guest';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Play Pairs</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Include Navbar -->
    <?php include('includes/navbar.php'); ?>

    <div id="main">
        <h2>Pairs Game</h2>

        <!-- Difficulty Selector -->
        <label for="difficulty">Choose Difficulty:</label>
        <select id="difficulty">
            <option value="simple">Simple (3 pairs)</option>
            <option value="medium">Medium (5 pairs)</option>
            <option value="complex">Complex (Progressive)</option>
        </select>

        <button id="start-game">Start the game</button>

        <!-- Game board container -->
        <div id="game-board"></div>

        <!-- Score submission form -->
        <form id="score-form" action="leaderboard.php" method="POST" style="display:none;">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <input type="hidden" name="score" id="score">
            <button type="submit">Submit Score</button>
        </form>
    </div>

    <!-- JavaScript game logic included separately -->
    <script src="assets/js/game.js"></script>
</body>
</html>

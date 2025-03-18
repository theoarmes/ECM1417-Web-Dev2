<!-- registration.php - Registration Page -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $avatar = htmlspecialchars($_POST['avatar']);
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $error = "Invalid characters in username.";
    } else {
        setcookie('username', $username, time() + (86400 * 30), "/");
        setcookie('avatar', $avatar, time() + (86400 * 30), "/");
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Select Avatar:</label>
        <select name="avatar">
            <option value="assets/images/avatar1.png">Avatar 1</option>
            <option value="assets/images/avatar2.png">Avatar 2</option>
        </select>
        <button type="submit">Register</button>
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
<?php
require_once('includes/load.php'); // Include necessary files and database connection

$known_password = 'Har123'; // Replace this with the plain text password you want to test

// Fetch the stored hash from the database
$username = 'Har'; // Replace this with the username whose password you want to test

$sql = "SELECT password FROM users WHERE username = '{$username}' LIMIT 1";
$result = $db->query($sql);

if ($result && $db->num_rows($result)) {
    $user = $db->fetch_assoc($result);
    $stored_hash = $user['password'];

    if (password_verify($known_password, $stored_hash)) {
        echo "Password is correct";
    } else {
        echo "Password is incorrect";
    }
} else {
    echo "User not found";
}
?>

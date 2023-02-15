<?php
session_start();

if (isset($_SESSION['google_user'])) { // If the user is signed in with Google, display the user information
    $user = $_SESSION['google_user'];

    echo '<p>Hello ' . $user['name'] . '!</p>';
    echo '<img src="' . $user['picture'] . '" alt="' . $user['name'] . '">';

    echo '<p><a href="logout.php">Sign out</a></p>';
} else { // If the user is not signed in with Google, display the sign-in button
    echo '<p>Please sign in with Google:</p>';
    echo '<a href="google_signin.php"><img src="google_signin.png" alt="Sign in with Google"></a>';
}


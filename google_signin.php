<?php
session_start();

require_once 'vendor/autoload.php'; // Include the Google API PHP client library

// Set the client ID and secret from the Google Cloud console
$client_id = '998113155356-vuau1ie39pe97pdk7hacf111pvl6tbot.apps.googleusercontent.com';
$client_secret = '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';

// Create a new Google client object
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri('https://' . $_SERVER['HTTP_HOST'] . '/google_signin.php'); // Set the redirect URI

// Set the scopes for accessing the user's basic profile and email address
$client->addScope('https://www.googleapis.com/auth/userinfo.profile');
$client->addScope('https://www.googleapis.com/auth/userinfo.email');

if (isset($_GET['code'])) { // If the authorization code is present in the URL, exchange it for an access token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Get the user's profile information
    $oauth2 = new Google_Service_Oauth2($client);
    $user = $oauth2->userinfo->get();

    // Store the user's information in the session
    $_SESSION['google_user'] = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'picture' => $user->picture
    ];

    header('Location: index.php'); // Redirect to the main page
    exit();
} else { // If the authorization code is not present in the URL, redirect the user to the Google sign-in page
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    exit();
}


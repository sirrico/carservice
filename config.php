<?php require ("vendor/autoload.php");
$g_client = new Google_Client();

$g_client->setClientId(""); //set
$g_client->setClientSecret(""); //set
$g_client->setRedirectUri(""); //set website to redirect after login
$g_client->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email");
$g_client->setApplicationName(""); //set name

$login_url = $g_client->createAuthUrl();
?> 
		

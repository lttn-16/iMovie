<?php

require_once "config.php";

if (isset($_SESSION['access_token']))
	$gClient->setAccessToken($_SESSION['access_token']);
else if (isset($_GET['code'])) {
	$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
	$_SESSION['access_token'] = $token;
} else {
	header('Location: login.php');
	exit();
}

$oAuth = new Google_Service_Oauth2($gClient);
$userData = $oAuth->userinfo_v2_me->get();

$_SESSION['user_role'] = 'subcriber';

$_SESSION['userId'] = rand(1, 10000);

$_SESSION['username'] = $userData['givenName'];

$_SESSION['user_email'] = $userData['email'];

header('Location: index.php');
exit();

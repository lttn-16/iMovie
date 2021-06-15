<?php
	session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("809386260979-de8sv7qioa5224rhcgp5tq97mav7k3aq.apps.googleusercontent.com");
	$gClient->setClientSecret("at83eWkyGcZD_Pzu3qKaApnV");
	$gClient->setApplicationName("iMovie");
	$gClient->setRedirectUri("http://localhost/iMovie/g-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>

<?php 
require_once "core/controller.Class.php";
require_once "config.php";

if(isset($_GET['code'])){
	$token = $g_client->fetchAccessTokenWithAuthCode($_GET['code']);
}
else{
	header('Location: index.php');
	exit();
}

if(!isset($token["error"])){
	$oAuth = new Google_Service_Oauth2($g_client);
	$userData = $oAuth->userinfo_v2_me->get();

	//insert data
	$Controller = new Controller;
	echo $Controller -> insertData(
		array(
			'email' => $userData['email'],
			'avatar' => $userData['picture'],
			'picture' => $userData['picture'],
			'familyName' => $userData['familyName'],
			'givenName' => $userData['givenName']
		)
	);

}
else{
	header('Location: index.php');
	exit();
}
?> 
		

<?php
	/*
	*	BUFFY Gift Recommendation Engine
	*	Team Avengers: July 2012
	*/
	session_start();
	ini_set('register_globals', 'on');
	ini_set('session.bug_compat_warn', 'off');
	error_reporting(E_ALL & ~E_NOTICE);

	//Amazon Sales Key
	global $sAWS_Key; $sAWS_Key = "";
	global $sRoot; $sRoot = $_SERVER['DOCUMENT_ROOT'];

	//FB Application ID:
	global $iFacebookApplicationID; $iFacebookApplicationID = "202766349852627";
	global $sFacebookApplicationSecret; $sFacebookApplicationSecret = "48bf1f7d388344bad51f6ecfce42f2f2";

	//Include Paths:
	set_include_path(get_include_path() . PATH_SEPARATOR . "{$sRoot}");

	//Requires
	require_once("class.facebook.php");
	require_once("recommender.php");
	require_once("viewWrapper.php");


	//Create the FB Access
	$cFacebook = new Facebook(array(
		'appId'  => $iFacebookApplicationID,
		'secret' => $sFacebookApplicationSecret
	));


?>
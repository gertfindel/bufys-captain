<?php
	/*
	*	BUFYS Gift Recommendation Engine
	*	Team Avengers: July 2012
	*/

	//Config:
	require_once("ini.php");

	//State variable stored in session if its not set in URL:
	$sBuffyState = ($_GET['buffyState'] != "") ? $_GET['buffyState'] : $_SESSION['buffyState'];
	//Save the state
	$_SESSION['buffyState'] = $_GET['buffyState'];
	//Set default state:
	if ($sBuffyState == "") { $sBuffyState = "splash"; }

	//Create the FB Access
	$cFacebook = new Facebook(array(
	'appId'  => $iFacebookApplicationID,
	'secret' => $sFacebookApplicationSecret
	));

	//Check if we have a connection//user:
	$cFBUser = $cFacebook->getUser();

	//Validate we have a real user:
	if ($cFBUser) {
		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$cFBUserProfile = $cFacebook->api('/me');
		} catch (FacebookApiException $e) {
			error_log($e);
			$cFBUser = null;
		}
	}

	//Switch between different modes:
	//-> 1. Splash Screen (connect to FB)
	//-> 2. Get user friends, display in list, select friend.
	//-> 3. Get friend's interests, compile into keyword list:
	//-> 4. Send list to amazon
	//-> 5. Get amazon results, display for user:
	switch ($sBuffyState) {

		//-> No State: Display the FB Connect
		case "splash":
			view("splash.php", null);
			break;


		//-> 1. Start the connection to facebook
		case 'fbConnect':

			//We have a real user: so go back and do the next
			if($cFBUser) {
				//We're already logged in:
				header('Location: index.php?buffyState=fbLoggedIn');

			} else {
				// 2.5 No active session, redirect to FB Login: this will come back *here* once authorised:
				$sLoginURL = $cFacebook->getLoginUrl(array(
					'scope' => 'email, friends_interests,  friends_likes ',
					'display' => 'page',
					'redirect_uri'=> "http://captain.acid.cl//index.php?buffyState=fbLoggedIn"
				));
				header("Location: $sLoginURL");
			}
			break;



		//-> 2. We're logged in: Display our friends in a list:
		case 'fbLoggedIn':
			//Verify we're logged in
			try{
				$cFBUserProfile = $cFacebook->api('/me');
			} catch (Exception $e) { }
			if(!empty($cFBUserProfile)){

				//-> We're IN: 2.1: Get the user friends List
				$cFBUserFriends = $cFacebook->api('/me/friends');

				//Initialise array:
				$cFriends = array();

				//-> Loop over friends, make a link for each:
				foreach ($cFBUserFriends['data'] as $cFriend) {
					$cFriends[] = $cFriend;
				}

				view("friends.php", $cFriends);

			} else {
				header("Location: http://captain.acid.cl");
			}
			break;



		//-> 3.0 Get the friend's interests
		case 'fbSelectFriend':
			try{
				$cFBUserProfile = $cFacebook->api('/me');
			} catch (Exception $e) { }
			if(!empty($cFBUserProfile)) {
				//-> Get the friends interests:
				$aInterests = array();
				$iFriendID = $_GET['fid'];
				$cFBFriendInterests = $cFacebook->api("/$iFriendID/interests");
				$cFBFriendLikes = $cFacebook->api("/$iFriendID/likes");
				
				$control = 0;
				foreach ($cFBFriendLikes['data'] as $aLike) {
					$aInterests[] = $aLike['name'];
					$control++;
					if($control == 20){
						break;
					}
				}
				//-> 4. Send list to Google Marketplace
				$aProducts = recommend($aInterests);

				//-> 5. Display the Products to User:
				view("products.php", $aProducts);
			} else {
				header("Location: http://captain.acid.cl");
			}
			break;

		default:
			die("Invalid Request -- Select proper BuffyState");
			break;


		}

?>

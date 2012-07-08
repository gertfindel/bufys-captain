<?php
	/*
	*	BUFFY Gift Recommendation Engine
	*	Team Avengers: July 2012
	*/

require_once 'google-api/src/apiClient.php';
require_once 'google-api/src/contrib/apiShoppingService.php';
$client = new apiClient();
$client->setApplicationName("Avengers");

// Visit https://code.google.com/apis/console?api=shopping to generate your
// Simple API Key.
$client->setDeveloperKey('AIzaSyDEEyYH_P4bHYq48YOh-GWAGGJ5NYJaDqQ');
global $service; $service = new apiShoppingService($client);

// Valid source values are "public", "cx:cse", and "gan:pid"
// See http://code.google.com/apis/shopping/search/v1/getting_started.html#products-feed

// For more information about full text search with the shopping API, please
// see http://code.google.com/apis/shopping/search/v1/getting_started.html#text-search

//The order in which the API returns products is defined by a ranking criterion.
// See http://code.google.com/apis/shopping/search/v1/getting_started.html#ranking




function recommend($aParam, $aOptions = array()) {
  	global $service;
	$aOptions["rankBy"]  = "relevancy";
	$aOptions["country"] = "US";

	if(!is_array($aParam)) {
 		$aParam = array($aParam);
  	}

  	$aOut = array();
  	
  	// "restrictBy" => "price=[100,200]"

  	foreach ($aParam as $iKey => $sValue) {
		$aOptions["q"] = $sValue;
  		$results = $service->products->listProducts("public", $aOptions);

		if($results['items'][0]) {
			$aOut[] = $results['items'][0];
		}
  	}
  	return $aOut;
}

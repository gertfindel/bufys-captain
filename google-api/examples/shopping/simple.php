<?php
require_once '../../src/apiClient.php';
require_once '../../src/contrib/apiShoppingService.php';
$client = new apiClient();
$client->setApplicationName("Avengers");

// Visit https://code.google.com/apis/console?api=shopping to generate your
// Simple API Key.
$client->setDeveloperKey('AIzaSyBNGnDm_b4Ijrgfx103ui-uc2Sf_w4pv6c');
$service = new apiShoppingService($client);

// Valid source values are "public", "cx:cse", and "gan:pid"
// See http://code.google.com/apis/shopping/search/v1/getting_started.html#products-feed
$source = "public";

// For more information about full text search with the shopping API, please
// see http://code.google.com/apis/shopping/search/v1/getting_started.html#text-search
$query = "music";
//The order in which the API returns products is defined by a ranking criterion.
// See http://code.google.com/apis/shopping/search/v1/getting_started.html#ranking
$ranking = "relevancy";

$results = $service->products->listProducts($source, array(
  "country" => "US",
  "q" => $query,
  "rankBy" => $ranking,
  "restrictBy" => "price=[100,200]",
));
echo "<h1>Shopping Results</h1><pre>" . print_r($results, true) . "</pre>";

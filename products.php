<?php
	/*
	*	BUFYS Gift Recommendation Engine
	*	Team Avengers: July 2012
	*/

	//Accepts a product array of arrays

	//Variables
	$iRows = 0;
	$aProducts = $aArray;

//Diplay 6-friends per line: divide into rows:
?>
	<div class="row">
		<h2>Products Recommendations</h2>
        	  
	<? foreach ($aProducts as $iKey=>$aProduct) {
		?>
        	<div class="span12 box drop-shadow">
		<div class="row">
			<article class="span6 offset1">
				<h3>(USD <?=$aProduct['product']['inventories'][0]['price']?>) <?=$aProduct['product']['title']?></h3>
				<p><?=$aProduct['product']['description']?></p>
				<h2><a class="signup" href="<?=$aProduct['product']['link']?>">Buy Now!</a></h2>
			</article>
			<div class="span4"> <img src="<?=$aProduct['product']['images'][0]['link']?>" /></div>
		</div>
		</div>
	<? } ?>
        </div>

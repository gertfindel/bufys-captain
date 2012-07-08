<?php
	/*
	*	BUFYS Gift Recommendation Engine
	*	Team Avengers: July 2012
	*/

	//Accepts a array of friends

	//Variables
	$aFriends = $aArray;

	//Diplay 6-friends per line: divide into rows:
?>
	<div class="row">
		<h3 class="span5 offset1" style="float: left;">Who is the lucky one?</h3>
            <input id="search" style="height:42px; width:460px;" type="text" placeholder="Type your firend's name">
            </div>
	<div class="row">
	    <h3 class="span5 offset1">What's your budget?</h3>
	    <div class="span1" style="float:left;"><input class="span1" id="min" style="height:42px; width:30px;"></div>
	    <div class="span4" id="slider-range"></div>
	    
	    <div class="span1" style="float:right"><input id="max" style="height:42px; width:30px;"></div>
	</div>
	<script type="text/javascript">
	$(function() {
		$("#slider-range").slider({
	  		range: true, 
			min: 0, 
			max: 1000,
			step: 10,
			values: [10, 500], 
			slide: function(event, ui) {
				$('#max').val(ui.values[1]); 
				$('#min').val(ui.values[0]);
			} 
		});
		$("#min").val($("slider-range").slider("values")[0]);
		$("#max").val($("slider-range").slider("values")[1]);
	});
	</script>
	
	<div class="container">
	<div class="span12 box">
		            <article class="fbfriends span10 offset1" style="overflow-y: scroll; height: 200px;">
	<? foreach ($aFriends as $iKey=>$aFriend) { ?>
		<div class="friend span2" data-name="<?=$aFriend['name']?>" style="height: 80px; width: 120px; float: left;">
			<a href="index.php?buffyState=fbSelectFriend&fid=<?=$aFriend['id']?>">
				<img src="http://graph.facebook.com/<?=$aFriend['id']?>/picture" />
				<p data-name="<?=$aFriend['name']?>"><?=$aFriend['name']?></p>
			</a> <br/>
		</div>
	<? } ?>
			    </article>
	</div>
    </div>
    <script type="text/javascript">
      function fsearch(itext) {
        exp = $("#search").val().toUpperCase();
        $(".fbfriends div.friend").hide().each(function(){if($(this).attr('data-name').toUpperCase().toString().indexOf(exp) != -1){ $(this).show(); }})
      }
    
      $('#search').live('keyup', function(){ fsearch(); });
      $('#search').live('change', function(){ fsearch(); });
    </script>

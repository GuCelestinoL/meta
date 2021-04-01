<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/main.js"></script>


<?php
if($GLOBALS['enableSlideShow']==true && $_GET['p'] == 'home')
{
?>
	<script type="text/javascript" src="javascript/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    	$(window).load(function() {
    		$('#slider').nivoSlider({
    			effect: 'fade',
    		});
		});
	</script>
<?php 
}

plugins::load('javascript');
	
?>


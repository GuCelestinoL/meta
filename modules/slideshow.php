<?php
if ($GLOBALS['enableSlideShow']==TRUE && !isset($_COOKIE['hideslider']) && $_GET['p']=='home') { ?>
<div class="main_view">
    <div class="window">
		<div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
				<?php website::getSlideShowImages(); ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>

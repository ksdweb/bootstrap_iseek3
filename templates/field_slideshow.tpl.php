<?php
/**
 * @file
 * Template file for field_slideshow
 *
 *
 */

// Should fix issue #1502772
// @todo: find a nicer way to fix this
if (!isset($controls_position)) {
  $controls_position = "after";
}
if (!isset($pager_position)) {
  $pager_position = "after";
}
?>

	<div id="field-slideshow-<?php print $slideshow_id; ?>-wrapper" class="field-slideshow-wrapper">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				  <?php if ($controls_position == "before")  print(render($controls)); ?>

				  <?php if ($pager_position == "before")  print(render($pager)); ?>

				  <?php if (isset($breakpoints) && isset($breakpoints['mapping']) && !empty($breakpoints['mapping'])) {
				    $style = 'height:' . $slides_max_height . 'px';
				  } else {
				    $style = 'width:' . $slides_max_width . 'px; height:' . $slides_max_height . 'px';
				  } ?>

				  <div class="<?php print $classes; ?>" style="<?php print $style; ?>">
				    <?php foreach ($items as $num => $item) : ?>
				      <div class="<?php print $item['classes']; ?>"<?php if ($num) : ?> style="display:none;"<?php endif; ?>>
				        <?php print $item['image']; ?>
				        <?php if (isset($item['caption']) && $item['caption'] != '') : ?>
				          <div class="field-slideshow-caption">
				            <span class="field-slideshow-caption-text"><?php print $item['caption']; ?></span>
				          </div>
				        <?php endif; ?>
				      </div>
				    <?php endforeach; ?>
				  </div>
			</div>
			<div class="col-lg-4 col-md-12">	

				<div class="row" id="mail_print_icon_row">
					<div class="col-lg-12">
						<?php 
							$addblock = module_invoke('forward', 'block_view', 'form');
							$forward_block = render($addblock['content']); 
							$forward_block = preg_replace("/forward_placeholder/", "<i class=\"fa fa-2x fa-envelope-o\"></i>", $forward_block);
							$forward_block = preg_replace("/Email this page/", "<i class=\"fa fa-2x fa-envelope-o\"></i>", $forward_block);
							echo $forward_block;
						?>
				 		<a href="javascript:window.print();"><i class="fa fa-2x fa-print"></i></a>	 
					</div>
				</div>

				  <?php if ($controls_position != "before") print(render($controls)); ?>

				  <?php if ($pager_position != "before") print(render($pager)); ?>
			</div>
		</div>
	</div>

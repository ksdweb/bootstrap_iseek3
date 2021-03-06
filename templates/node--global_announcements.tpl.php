<?php

/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: dddNodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */

$event_bool = count($node->field_announcement_event_date);
$my_href = '/announcements-list/';
$my_title = t('Announcements');
$my_icon = 'fa-list-ul';

if ($event_bool){
  $my_href = '/events-list/';
  $my_title = t('Events');
  $my_icon = 'fa-calendar';
}

?>

<div class="row">
	<div class="col-lg-12">
		<div class="toolkit large-text"><i class="fa <?php print $my_icon;?>"></i> <a href="<?php print $my_href;?>"><?php print $my_title; ?></a> <i class="fa fa-angle-double-right"></i></div>
	</div>
</div>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

	<div class="row">
		<div class="col-lg-10 col-md-12">

			<div class="slug">
				<?php
					if ($node->language == "fr") {
						setlocale(LC_TIME, "fr_FR");
						echo ucfirst(utf8_encode(strftime('%A %e %B %G', strtotime($node->field_announcement_publish_date['und'][0]['value']))));
					} else {
						echo utf8_encode(strftime('%A, %e %B %G', strtotime($node->field_announcement_publish_date['und'][0]['value'])));
					}
				?>
			</div>

			  <?php print render($title_prefix); ?>
			    <h2 id="headline">
			      <?php print $title; ?>
			    </h2>
			  <?php print render($title_suffix); ?>

			  <?php if ($display_submitted): ?>
			    <div class="meta submitted">
			      <?php print $user_picture; ?>
			      <?php print $submitted; ?>
			    </div>
			  <?php endif; ?>

		</div>	
	</div>	

        <div class="row">

                <?php if ($event_bool) { ?>

                        <div class="col-lg-3 col-md-12">

                                <div class="row">
                                        <div class="col-lg-12">
                                                <div class="toolkit" id="event_toolkit">
                                                        <div>
                                                                Global
                                                        </div>
                                                        <div>
                                                                <?php
                                                                        if ($node->language == "fr") {
                                                                                setlocale(LC_TIME, "fr_FR");
                                                                                echo ucfirst(utf8_encode(strftime('%A %e %B %G', strtotime($node->field_announcement_event_date['und'][0]['value']))));
                                                                        } else {
                                                                                echo utf8_encode(strftime('%A, %e %B %G', strtotime($node->field_announcement_event_date['und'][0]['value'])));
                                                                        }
                                                                ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                        </div>

                        <div class="col-lg-7 col-md-12">

                <?php } else { ?>

                        <div class="col-lg-10 col-md-12">

                <?php } ?>



			  <div class="content clearfix"<?php print $content_attributes; ?>>
			    <?php
			      // We hide the comments and links now so that we can render them later.
			      hide($content['comments']);
			      hide($content['links']);
			      // print render($content);
			    ?>

				<div class="content-body">

					<!-- The image -->
	                                <?php print render($content['field_an_optional_image']); ?>

					<?php print render($content['body']); ?>

					<!-- begin common comments -->
          <?php include('sites/iseek.un.org/themes/bootstrap_iseek3/templates/common-comments.tpl.php'); ?>
          <!-- end common comments -->

				

			  <!-- content -->
			  
		<!-- <div class="col-lg-2 col-md-12">
		        <div class="row" id="mail_print_icon_row">
		                <div class="col-lg-12">
		                        <i class="fa fa-2x fa-envelope-o"></i>
		                        <i class="fa fa-2x fa-print"></i>
        		        </div>
        		</div>
		</div>	 -->
	</div>		  
</div><!-- node -->

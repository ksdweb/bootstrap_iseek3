<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

?>

<div class="row">
	<?php if (isset($fields['field_an_optional_image'])): ?>
	<div class="col-md-3">
		<?php print $fields['field_an_optional_image']->content; ?>
	</div>
	<div class="col-md-7">
	<?php else: ?>
	<div class="col-md-10">
	<?php endif; ?>
		<div class="archives-size">
			<div class="archives-title">
				<?php print $fields['title']->content; ?>	
			</div>
			<div class="slug-archive">
				<?php if (isset($fields['field_announcement_event_date'])): print $fields['field_announcement_event_date']->content; ?> <span>|</span> <?php endif; ?>
				<?php
				if ($fields['og_group_ref']->content){
					$ds = trim($fields['og_group_ref']->content, $fields['og_group_ref']->wrapper_prefix);
					$ds = trim($ds, $fields['og_group_ref']->wrapper_suffix);
					$arr_ds = explode(',', $ds);
					$list_ds = "";
					foreach ($arr_ds as $duty) {
						$list_ds .= t($duty) . ', ';
					}
					$list_ds = rtrim($list_ds, ", ");
					print '<div class="slug-archive">' . $list_ds . '</div>';
				}
				?>
			</div>

			<div class="archives-body">
				<?php print $fields['body']->content; ?>
			</div>
				<?php print $fields['nid']->content; ?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="archives-size archives-social">
			<i class="fa fa-comment-o"></i> <?php print $fields['comment_count']->content; ?><br>
			<?php if (user_is_logged_in()): ?>
			<?php print $fields['nid_1']->content; ?>
			<?php else: ?>
			<?php

				global $language;	

                              $login_label = array('en' => 'Log in to post comments and like <i class="fa fa-thumbs-o-up"></i>', 'fr' => 'Identifiez-vous pour poster des commentaires & <i class="fa fa-thumbs-up"></i>');
                              $login_path = array('en' => '/user/login', 'fr' => '/fr/user/login');
                        ?>
                              <a href="<?php print $login_path[$language->language]; ?>?destination=comment/reply/<?php print $fields['nid_1']->raw; ?>#comment-form"><?php print $login_label[$language->language]; ?></a>

			<?php // print '<a href="user/login?destination=comment/reply/'.$fields['nid_1']->raw.'#comment-form">'.t('Log in to post comments or like').'</a>'; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<hr class="archives-hr">
	</div>
</div>

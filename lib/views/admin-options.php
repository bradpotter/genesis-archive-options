<h3><?php _e( 'Post Settings', 'genesis-archive-options' ); ?></h3>
<table class="form-table">
	<tbody>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="genesis-meta[gao_post_amount]">
				<?php _e( 'Posts Per Page', 'genesis-archive-options' ); ?>
			</label>
		</th>
		<td>
			<input name="genesis-meta[gao_post_amount]" id="genesis-meta[gao_post_amount]" type="number" value="<?php echo esc_attr( $tag->meta['gao_post_amount'] ); ?>" size="40" />
			<p class="description">
				<?php _e( 'Enter the number of posts per page. Enter -1 to display all posts in one page', 'genesis-archive-options' ); ?>
			</p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="genesis-meta[gao_post_orderby]">
				<?php _e( 'Order Posts By', 'genesis-archive-options' ); ?>
			</label>
		</th>
		<td>
			<input name="genesis-meta[gao_post_orderby]" id="genesis-meta[gao_post_orderby]" type="text" value="<?php echo esc_attr( $tag->meta['gao_post_orderby'] ); ?>" size="40" />
			<p class="description">
				<?php _e( 'Enter a parameter to order posts by. Example: title, date, author, rand, etc.', 'genesis-archive-options' ); ?>
			</p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="genesis-meta[gao_post_order]">
				<?php _e( 'Post Order', 'genesis-archive-options' ); ?>
			</label>
		</th>
		<td>
			<select name="genesis-meta[gao_post_order]" id="genesis-meta[gao_post_order]" />
				<option value="default"<?php selected( $tag->meta['gao_post_order'], 'default' ); ?>><?php _e( 'Default', 'genesis-archive-options' ); ?></option>
				<option value="DESC"<?php selected( $tag->meta['gao_post_order'], 'DESC' ); ?>><?php _e( 'Descending', 'genesis-archive-options' ); ?></option>
				<option value="ASC"<?php selected( $tag->meta['gao_post_order'], 'ASC' ); ?>><?php _e( 'Ascending', 'genesis-archive-options' ); ?></option>
			</select>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="genesis-meta[gao_post_content_archive]">
				<?php _e( 'Post Content', 'genesis-archive-options' ); ?>
			</label>
		</th>
		<td>
			<select name="genesis-meta[gao_post_content_archive]" id="genesis-meta[gao_post_content_archive]" />
			<option value="default"<?php selected( $tag->meta['gao_post_content_archive'], 'default' ); ?>><?php _e( 'Default', 'genesis-archive-options' ); ?></option>
			<option value="full"<?php selected( $tag->meta['gao_post_content_archive'], 'full' ); ?>><?php _e( 'Content', 'genesis-archive-options' ); ?></option>
			<option value="excerpts"<?php selected( $tag->meta['gao_post_content_archive'], 'excerpts' ); ?>><?php _e( 'Excerpts', 'genesis-archive-options' ); ?></option>
			</select>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="genesis-meta[gao_post_content_limit]"><?php _e( 'Content Limit', 'genesis-archive-options' ); ?></label></th>
		<td>
			<input name="genesis-meta[gao_post_content_limit]" id="genesis-meta[gao_post_content_limit]" type="text" value="<?php echo esc_attr( $tag->meta['gao_post_content_limit'] ); ?>" size="40" />
			<p class="description">
				<?php _e( 'If "Content" is selected in the Post Content setting, limit content to a number of characters.', 'genesis-archive-options' ); ?>
			</p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="genesis-meta[gao_post_image_include]">
				<?php _e( 'Featured Image', 'genesis-archive-options' ); ?>
			</label>
		</th>
		<td>
			<select name="genesis-meta[gao_post_image_include]" id="genesis-meta[gao_post_image_include]">
				<option value="default" <?php selected( $tag->meta['gao_post_image_include'], 'default' ); ?>><?php _e( 'Default', 'genesis-archive-options' ) ?></option>
				<option value="yes" <?php selected( $tag->meta['gao_post_image_include'], 'yes' ); ?>><?php _e( 'Display Image', 'genesis-archive-options' ) ?></option>
				<option value="no" <?php selected( $tag->meta['gao_post_image_include'], 'no' ); ?>><?php _e( 'Remove Image', 'genesis-archive-options' ) ?></option>
			</select>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="genesis-meta[gao_post_image_size]">
				<?php _e( 'Image Size', 'genesis-archive-options' ); ?>
			</label>
		</th>
		<td>
			<select name="genesis-meta[gao_post_image_size]" id="genesis-meta[gao_post_image_size]">
				<?php
				$sizes = genesis_get_image_sizes();
				foreach ( (array) $sizes as $name => $size ) : ?>
					<option value="<?php esc_attr_e( $name ); ?>"<?php selected( $tag->meta['gao_post_image_size'], $name ); ?>><?php esc_html_e( $name ) . ' (' . absint( $size['width'] ) . ' &#x000D7; ' . absint( $size['height'] ) . ')'; ?></option>
				<?php endforeach; ?>
			</select>
			<p class="description">
				<?php _e( 'Adjust image size if "Display Image" is selected above.', 'genesis-archive-options' ); ?>
			</p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="genesis-meta[gao_post_image_align]">
				<?php _e( 'Image Alignment', 'genesis-archive-options' ); ?>
			</label>
		</th>
		<td>
			<select name="genesis-meta[gao_post_image_align]" id="genesis-meta[gao_post_image_align]">
				<option value="default" <?php selected( $tag->meta['gao_post_image_align'], 'default' ); ?>><?php _e( 'Default', 'genesis-archive-options' ) ?></option>
				<option value="alignnone" <?php selected( $tag->meta['gao_post_image_align'], 'alignnone' ); ?>><?php _e( 'None', 'genesis-archive-options' ) ?></option>
				<option value="alignleft" <?php selected( $tag->meta['gao_post_image_align'], 'alignleft' ); ?>><?php _e( 'Left', 'genesis-archive-options' ) ?></option>
				<option value="alignright" <?php selected( $tag->meta['gao_post_image_align'], 'alignright' ); ?>><?php _e( 'Right', 'genesis-archive-options' ) ?></option>
			</select>
		</td>
	</tr>
	</tbody>
</table>
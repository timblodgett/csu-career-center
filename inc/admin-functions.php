<?php
function csu_cc_add_theme_menu() {
	add_menu_page( 'Theme Details', 'Theme Details', 'edit_posts', 'cc-theme-details.php', 'csu_cc_theme_details_page', 'dashicons-clipboard', 999 );
}
add_action( 'admin_menu', 'csu_cc_add_theme_menu' );


function csu_cc_theme_details_page() {
?>
<div class="wrap">
	<h1>CSU Career Center - Theme Details</h1>

	<h2>Recommended Image Sizes</h2>

	<p style="font-style:italic">Note that all images will be cropped to fit the designated sizes.</p>

	<table class="widefat">
		<thead>
			<tr>
				<th class="manage-column" scope="col"><b>Page/Post Type</b></th>
				<th class="manage-column" scope="col"><b>Image Location</b></th>
				<th class="manage-column" scope="col"><b>Min. Width</b></th>
				<th class="manage-column" scope="col"><b>Min. Height</b></th>
				<th class="manage-column" scope="col"><b>Format</b></th>
				<th class="manage-column" scope="col"><b>Other Notes</b></th>
			</tr>
		</thead>

		<tbody>
			<tr style="background:#ededed;">
				<td>Blog Post</td>
				<td>Featured Image</td>
				<td>1200 px</td>
				<td>480 px</td>
				<td>.jpg</td>
				<td>&mdash;</td>
			</tr>

			<tr>
				<td>Blog Post</td>
				<td>Headshot (Guest Author)</td>
				<td>400 px</td>
				<td>400 px</td>
				<td>.jpg</td>
				<td>Image should be square dimensions.</td>
			</tr>

			<tr style="background:#ededed;">
				<td>Employer Resource</td>
				<td>Featured Image</td>
				<td>700 px</td>
				<td>450 px</td>
				<td>.jpg</td>
				<td>&mdash;</td>
			</tr>

			<tr>
				<td>Home Page</td>
				<td>Slide Image</td>
				<td>1920 px</td>
				<td>768 px</td>
				<td>.jpg</td>
				<td>&mdash;</td>
			</tr>

			<tr style="background:#ededed;">
				<td>Home Page</td>
				<td>Stat Image</td>
				<td>200 px</td>
				<td>200 px</td>
				<td>.png, .jpg</td>
				<td>Image should be square dimensions.</td>
			</tr>

			<tr>
				<td>LCD Slide</td>
				<td>Featured Image</td>
				<td>1920 px</td>
				<td>1080 px</td>
				<td>.jpg</td>
				<td>&mdash;</td>
			</tr>

			<tr style="background:#ededed;">
				<td>Partner</td>
				<td>Featured Image</td>
				<td>300 px</td>
				<td>&mdash;</td>
				<td>.png, .jpg</td>
				<td>Background should be either transparent or pure white (#ffffff).</td>
			</tr>

			<tr>
				<td>Resource</td>
				<td>Featured Image</td>
				<td>700 px</td>
				<td>450 px</td>
				<td>.jpg</td>
				<td>&mdash;</td>
			</tr>

			<tr style="background:#ededed;">
				<td>Resource Center</td>
				<td>Featured Image</td>
				<td>1920 px</td>
				<td>540 px</td>
				<td>.jpg</td>
				<td>&mdash;</td>
			</tr>

			<tr>
				<td>Success Story</td>
				<td>Featured Image</td>
				<td>1920 px</td>
				<td>1080 px</td>
				<td>.jpg</td>
				<td>The focus point of this image should be on the right half.</td>
			</tr>

			<tr style="background:#ededed;">
				<td>Success Story</td>
				<td>Headshot</td>
				<td>400 px</td>
				<td>400 px</td>
				<td>.jpg</td>
				<td>Image should be square dimensions.</td>
			</tr>

			<tr>
				<td>Team Member</td>
				<td>Headshot</td>
				<td>400 px</td>
				<td>400 px</td>
				<td>.jpg</td>
				<td>Image should be square dimensions.</td>
			</tr>
		</tbody>
	</table>
</div><!-- .wrap -->
<?php
}

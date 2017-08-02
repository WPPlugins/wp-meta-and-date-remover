<div class='wrap'>
<h2>WP meta and Date Remover<span style="float:right;text-decoration:underline;"><a target="_blank" href="http://bit.ly/2bzAUb6">Buy Premium support</a>
<br/>
<a target="_blank" href="https://wordpress.org/support/view/plugin-reviews/wp-meta-and-date-remover?rate=5#postform">Vote up this plugin</a>
<br/>
<a  href="https://paypal.me/prasadkirpekar">Donate few bucks</a>
<br/>
</span></h2>

<form method='post' action="<?php echo $action_url ?>">

<input type="hidden" name="submitted" value="1" />
<table class="form-table">

<tr>
	<th>Remove from Home page<p>Plugin will remove meta and date from home page</p></th>
	<td><input type="checkbox" value="1" <?php if($from_['home']=="1") echo "checked='checked'" ;?> name="wpmdr_from_home"/></td>
</tr>
<tr>
	<th>Disable PHP removal<p>Plugin will not remove Meta and Date information from source code</p></th>
	<td><input type="checkbox" value="1" <?php if(get_option('wpmdr_disable_php')=="1") echo "checked='checked'" ;?> name="wpmdr_disable_php"/></td>
</tr>
<tr>
	<th>Disable CSS removal<p>Plugin will not hide Meta data classes of theme</p></th>
	<td><input type="checkbox" value="1" <?php if(get_option('wpmdr_disable_css')=="1") echo "checked='checked'" ;?> name="wpmdr_disable_css"/></td>
</tr>
<tr>
	<th>Customize CSS<p>This CSS is being used to hide Meta data classes of theme</p></th>
	<td><a target="_blank" href="http://bit.ly/2bzAUb6">I need help to set up this</a><br/><textarea style="width:50%;height:200px;" name='wpmdr_css'><?php echo $css; ?></textarea></td>
</tr>
<tr>
	<td><?php submit_button(); ?></td>
	<td></td>
</tr>
<tr><td><a href="http://prasadkirpekar.com/wordpress/wordpress-tutorials/how-to-remove-meta-and-date-from-wordpress-posts-or-pages/" target="_blank">Addtional Text like <i>By</i> or <i>posted by</i> is still visible?</a></td><tr>
</table>
</form>

</div>

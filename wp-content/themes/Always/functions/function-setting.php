<?php
add_action('admin_menu','Always_admin_menu');
function Always_admin_menu(){
	add_theme_page('主题设置','Always设置','edit_themes',basename(__FILE__),'Always_setting_page');
	add_action('admin_init','Always_setting');
}

function Always_setting(){
	register_setting('Always_setting_group','Always_options');
}

function Always_setting_page(){
	if ( isset($_REQUEST['settings-updated']) )
		echo '<div id="message" class="updated fade"><p><strong>主题设置已保存!</strong></p></div>';
	if ( 'reset' == isset($_REQUEST['reset']) ){
		delete_option('Always_options');
		echo '<div id="message" class="updated fade"><p><strong>主题设置已重置!</strong></p></div>';
	}
	?>
	<div class="wrap" style="width:780px;margin:40px auto;padding:40px;border:1px solid #ededed;background:#fff;">
		<div id="icon-options-general" class="icon32"><br></div><h2>主题设置</h2><br>
		<form method="post" action="options.php">
			<?php settings_fields('Always_setting_group'); ?>
			<?php $options = get_option('Always_options'); ?>
			<table class="form-table">
				<tbody>
					<tr>
						<th style="border-top:1px solid #ededed;padding:8px 10px 8px 0;">
							
						</th>
						<td style="border-top:1px solid #ededed;padding:8px 0px;font-weight:normal;color:#df846c;text-align:right;">
							基本设置
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>一句话描述网站：</label></th>
						<td>
							<p><input type="text" name="Always_options[description]" class="large-text" value="<?php echo $options['description']; ?>" /></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>网站关键字：</label></th>
						<td>
							<p><input type="text" name="Always_options[keywords]" class="large-text" value="<?php echo $options['keywords']; ?>" /></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>备案信息：</label></th>
						<td>
							<p><input type="text" name="Always_options[registration]" class="large-text" value="<?php echo $options['registration']; ?>" /></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>首页文章布局：</label></th>
						<td id="logo-music">
							<p>
								<label><input type="radio" name="Always_options[layout]" value="0" <?php checked('0',$options['layout']); ?> /><span>布局1（首图摘要）</span></label>
								<label><input type="radio" name="Always_options[layout]" value="1" <?php checked('1',$options['layout']); ?> /><span>布局2（缩略图摘要）</span></label>
								<label><input type="radio" name="Always_options[layout]" value="2" <?php checked('2',$options['layout']); ?> /><span>布局3（more）</span></label>
							</p>
						<td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>首页主体宽度：</label></th>
						<td id="logo-music">
							<p>
								<label><input type="radio" name="Always_options[main_width]" value="0" <?php checked('0',$options['main_width']); ?> /><span>全屏</span></label>
								<label><input type="radio" name="Always_options[main_width]" value="1" <?php checked('1',$options['main_width']); ?> /><span>窄屏</span></label>
							</p>
						<td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>网站底部小工具：</label></th>
						<td id="logo-music">
							<p>
								<label><input type="radio" name="Always_options[footer_widget]" value="1" <?php checked('1',$options['footer_widget']); ?> /><span>仅留言墙</span></label>
								<label><input type="radio" name="Always_options[footer_widget]" value="0" <?php checked('0',$options['footer_widget']); ?> /><span>传统小工具</span></label>
								<label><input type="radio" name="Always_options[footer_widget]" value="2" <?php checked('2',$options['footer_widget']); ?> /><span>不显示</span></label>
							</p>
						<td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>头像缓存：</label></th>
						<td id="logo-music">
							<p>
								<label><input type="radio" name="Always_options[https_avatar]" value="0" <?php checked('0',$options['https_avatar']); ?> /><span>https</span></label>
								<label><input type="radio" name="Always_options[https_avatar]" value="1" <?php checked('1',$options['https_avatar']); ?> /><span>多说</span></label>
								<label><input type="radio" name="Always_options[https_avatar]" value="2" <?php checked('2',$options['https_avatar']); ?> /><span>不使用</span></label>
								<span style="font-size:12px;color:#999;">(选择前两个，可解决访客头像不显示问题)</span>
							</p>
						<td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>首页显示文章中的音乐：</label></th>
						<td id="logo-music">
							<p>
								<label><input type="radio" name="Always_options[index_audio]" value="0" <?php checked('0',$options['index_audio']); ?> /><span>是</span></label>
								<label><input type="radio" name="Always_options[index_audio]" value="1" <?php checked('1',$options['index_audio']); ?> /><span>否</span></label>
								<span style="font-size:12px;color:#999;">(选择“是”，首页文章图片下方将显示文章中的音乐，而不显示文字)</span>
							</p>
						<td>
					</tr>
					<!--基本设置-->
					
					<tr>
						<th style="border-top:1px solid #ededed;padding:8px 10px 8px 0;">
							
						</th>
						<td style="border-top:1px solid #ededed;padding:8px 0px;font-weight:normal;color:#df846c;text-align:right;">
							图片设置
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>网站图标地址：</label></th>
						<td>
							<p><input type="text" name="Always_options[favicon]" class="large-text" value="<?php echo $options['favicon']; ?>" /></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>logo图片地址：</label></th>
						<td>
							<p><input type="text" name="Always_options[logo_img]" class="large-text" value="<?php echo $options['logo_img']; ?>" /></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>首页顶部背景图片地址：</label></th>
						<td>
							<p><input type="text" name="Always_options[header_bg]" class="large-text" value="<?php echo $options['header_bg']; ?>" /></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>文章默认缩略图地址：</label></th>
						<td>
							<p><input type="text" name="Always_options[thumb]" class="large-text" value="<?php echo $options['thumb']; ?>" /></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>文章页背景图片地址：</label></th>
						<td>
							<p><input type="text" name="Always_options[site_bg]" class="large-text" value="<?php echo $options['site_bg']; ?>" /></p>
						</td>
					</tr>
					<!--图片设置-->
					
					<tr>
						<th style="border-top:1px solid #ededed;padding:8px 10px 8px 0;">
							
						</th>
						<td style="border-top:1px solid #ededed;padding:8px 0px;font-weight:normal;color:#df846c;text-align:right;">
							音乐设置
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>logo音乐：</label></th>
						<td id="logo-music">
							<p>
								<label><input type="radio" name="Always_options[auto_play]" value="1" <?php checked('1',$options['auto_play']); ?> /><span>自动播放</span></label>
								<label><input type="radio" name="Always_options[auto_play]" value="0" <?php checked('0',$options['auto_play']); ?> /><span>不自动播放</span></label>
							</p>
							<?php 
								$music_length = 1;
								while ( $options['music' .$music_length. '_name'] ){
									echo '<p class="description">音乐' .$music_length. '名称：</p>';
									echo '<p><input type="text" name="Always_options[music' .$music_length. '_name]" class="bg-text large-text" value="' .$options['music' .$music_length. '_name']. '" /></p>';
									echo '<p class="description">音乐' .$music_length. '地址：</p>';
									echo '<p><input type="text" name="Always_options[music' .$music_length. '_url]" class="bg-text large-text" value="' .$options['music' .$music_length. '_url']. '" /></p>';
									$music_length += 1;
								}
							?>
							<p style="text-align:left;color:#00a0d2;"><span id="add-logo-music" style="cursor:pointer;">+添加音乐</span></p>
							<script>
								jQuery(document).ready(function(){
									var music_length = <?php echo $music_length; ?>,
										str = '';
									jQuery( '#add-logo-music' ).click(function(){
										str = '<p>音乐' + music_length + '名称：</p><p><input type="text" name="Always_options[music' + music_length + '_name]" class="bg-text large-text" value="" /></p><p>音乐' + music_length + '地址：</p><p><input type="text" name="Always_options[music' + music_length + '_url]" class="bg-text large-text" value="" /></p>';
										jQuery(this).parent().before(str);
										music_length += 1;
									});
								});
							</script>
						</td>
					</tr>
					<!--音乐设置-->
				</tbody>
			</table>
			<div class="Always_submit_form">
				<input type="submit" name="save" class="button-primary Always-submit-btm" value="<?php _e('Save Changes'); ?>" />
			</div>
		</form>
		<form method="post" style="margin-top:10px;">
			<div class="Alwaysreset_from">
				<input type="submit" name="reset" value="<?php _e('Reset') ?>" class="button-primary Always-reset-btn" />
				<input type="hidden" name="reset" value="reset" />
			</div>
		</form>
	</div>
	<?php
}
?>
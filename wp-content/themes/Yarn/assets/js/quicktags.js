/* 文本编辑快捷按钮 */
if ( typeof QTags != 'undefined' ) { 
QTags.addButton( 'wp_page', '分页按钮', "<!--nextpage-->\n", "" );
QTags.addButton( 'hr', 'hr 分割线', "\n<hr/>\n", "" );
QTags.addButton( 'h1', 'h1 标题', '<h1>输入内容</h1>');
QTags.addButton( 'h2', 'h2 标题', '<h2>输入内容</h2>');
QTags.addButton( 'h3', 'h3 标题', '<h3>输入内容</h3>');
QTags.addButton( 'h4', 'h4 标题', '<h4>输入内容</h4>');
QTags.addButton( 'chatl', '左边话框', '[chatl][/chatl]', '' );
QTags.addButton( 'chatr', '右边话框', '[chatr][/chatr]', '' ); 
QTags.addButton( 'pullquote', 'Pullquote', '[pullquote]填写内容[/pullquote]', '' ); 
QTags.addButton( 'marker', '荧光笔效果', '<span class="marker">填写内容</span>', '' ); 
QTags.addButton( 'marker-under', '荧光笔效果2', '<span class="marker-under">填写内容</span>', '' );
QTags.addButton( 'red-under', '下画红线', '<span class="red-under">填写内容</span>', '' );
QTags.addButton( 'Yellow-under', '下画黄线', '<span class="yellow-under">填写内容</span>', '' );
QTags.addButton( 'key-word', '关键词', '<span class="key-word">填写内容</span>', '' ); 
QTags.addButton( 'videoin', '视频短代码', '[videoin]填写视频地址[/videoin]');
QTags.addButton( 'code_highlight', 'css 代码高亮', '<pre><code class="language-css">复制代码到此</code></pre>');
QTags.addButton( 'code_highlight2', 'php 代码高亮', '<pre><code class="language-php">转义后的代码复制到此</code></pre>');
QTags.addButton( 'code_highlight3', 'javascript 代码高亮', '<pre><code class="language-javascript">复制代码到此</code></pre>');
QTags.addButton( 'time-line-style-list', '时间轴列表', '<div id="update" class="applicant__timeline"><ul>插入待办/警示/完成事项</ul></div>');
QTags.addButton( 'do-list', '待办', '<li><div>填写项目描述内容<br><span class="time-ago">填写项目时间</span></div></li>');
QTags.addButton( 'warning-list', '警示或特别说明', '<li class="warning"><div>填写说明内容</div></li>');
QTags.addButton( 'finish-list', '完成事项说明', '<li class="success"><div>填写事项内容<br><span class="time-ago">填写时间</span></div></li>');
};

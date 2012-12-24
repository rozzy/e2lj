<?php
	require_once 'p2lj.php';
	
	$e2lj_configure = require_once 'configure.php';
	
	if ($_POST) {
		header('Content-type: application/json');
		$post = p2lj($e2lj_configure['login'], $_POST['password'], $_POST['title'], $_POST['message'], array('taglist' => $_POST['tags']));
		echo is_array($post) ?
			 json_encode(
				array(
					'success' => true,
					'url' => $post['url']
				)
			) : json_encode(
				array(
					'success' => false
				)
			);
		exit;
	}
	?>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="e2lj.js"></script>
	
	<input type="password" name="password" id="pass"> <input type="button" value="e2lj" onclick="e2lj('#pass', 'h1', '.article', '.tags')">
	<h1>Привет, я заголовок</h1>
	<div class="article">А я текст этой записи!</div>
	<div class="tagline" data-output="line">
		<a href="#">test</a>, 
		<a href="#">test2</a>, 
		<a href="#">test3</a>.
	</div>
	<ul class="tags">
		<li>тег</li>
		<li>тег2</li>
		<li>тег3</li>
	</ul>
<?php
	require_once 'p2lj.php';
	
	$e2lj_configure = require_once 'configure.php';
	
	if ($_POST) echo p2lj($e2lj_configure['login'], $_POST['password'], $_POST['title'], $_POST['message'], array('tagslist' => $_POST['tags'])) ? 'Пост запощщен!' : 'Не запощщен!';
	?>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script type="text/javascript" src="e2lj.min.js"></script>
	<form action="" method="post">
		<input type="password" name="password" id="pass"> <input type="submit" value="e2lj" onclick="e2lj('#pass', 'h1', '.article', 'tags')">
		<h1>Привет, я заголовок</h1>
		<div class="article">А я текст этой записи!</div>
		<ul class="tags">
			<li>тег</li>
			<li>тег</li>
			<li>тег</li>
		</ul>
	</form>
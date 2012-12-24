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
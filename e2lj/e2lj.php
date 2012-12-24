<?php
	require_once 'p2lj.php';
	require_once 'e2lj.functions.php'
	$e2lj_configure = require_once 'configure.php';
	
	if ($_POST and $_POST['send'] == 'post') {
		header('Content-type: application/json');
		$e2lj_message = $_POST['message'];

		if (trim($e2lj_configure['entry-prefix']) != '')
			$e2lj_message = e2lj_parse_fixies($e2lj_configure['entry-prefix'], $_POST['currentPage'], $_POST['title']).$e2lj_message;

		if (trim($e2lj_configure['entry-postfix']) != '')
			$e2lj_message = $e2lj_message.e2lj_parse_fixies($e2lj_configure['entry-postfix'], $_POST['currentPage'], $_POST['title']);

		$post = p2lj($e2lj_configure['login'], $_POST['password'], $_POST['title'], $e2lj_message, array('taglist' => $_POST['tags']));
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
<?php
	function e2lj_parse_fixies ($str, $cpage = '', $ctitle = '') {
		return str_replace(array('{url}', '{title}'), array($cpage, $ctitle), $str);
	}
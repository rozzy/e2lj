<br/>
<?php
	$e2lj_config = @require './e2lj/configure.php';
	// $e2lj_list = @require './e2lj/list.php';
	if (isset($e2lj_config['enable-e2lj']) and $e2lj_config['enable-e2lj']):
?>
<div class="e2lj-input e2lj-accent">
	<span class="e2lj-username"><img src="e2lj/profile.gif" alt="<?=$e2lj_config['login']?>"><span class="e2lj-fs e2lj-fulllink"></span><span class="e2lj-fh"><?=$e2lj_config['login']?></span></span> <span class="e2lj-fh">/</span> <input type="password" class="e2lj-fh e2lj-password" id="e2lj-password" placeholder="Пароль от ЖЖ" value="<?=$e2lj_config['init-password']?>"/>
	<a  class="e2lj-button e2lj-fh" onclick="e2lj($('#e2lj-password').val(), 'h1.e2-smart-title', '.text.published', '.tags'); return false;">
		<span><?=$e2lj_config['text-on-button']?></span>
	</a>
</div>
<? endif ?>

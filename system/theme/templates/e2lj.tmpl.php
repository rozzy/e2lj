<br/>
<?php
	$e2lj_config = @require './e2lj/configure.php';
	if (isset($e2lj_config['enable-e2lj']) and $e2lj_config['enable-e2lj']):
?>
<div class="e2lj-input e2lj-accent">
	
	<span class="e2lj-username"><img src="e2lj/profile.gif" alt="<?=$e2lj_config['login']?>"><?=$e2lj_config['login']?></span> / <input type="password" class="e2lj-password" id="e2lj-password" placeholder="Пароль от ЖЖ" value="<?=$e2lj_config['init-password']?>"/>
	<a href="#" class="e2lj-button" onclick="e2lj($('#e2lj-password').val(), 'h1.e2-smart-title', '.text.published', '.tags'); return false;">
		<span>Репост в ЖЖ</span>
	</a>
</div>
<? endif ?>

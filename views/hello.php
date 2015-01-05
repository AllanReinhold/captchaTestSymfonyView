<html>
See on template!
<form action="test.php" method="POST">
<table>
	<tr>
		<td>Message <?= $message ?></td>
	</tr>
	<tr>
		<td>
			<?php if($captcha) { ?>
				Captcha <br>
				<img src="<?= $captcha ?>" ALT =""><br>
				<input type="text" name="myCaptcha">
			<?php } else { ?>
				Captchat EI KUVA, kuna matchib
			<?php } ?>
		</td>
	</tr>
	<tr>
		<td><input type="submit" value="Pressi seda"></td>
	</tr>
</table>
</form>
</html>
<?php
use Gregwar\Captcha\CaptchaBuilder;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

require('vendor/autoload.php');
session_start();

if(isset($_POST['myCaptcha']) && isset($_SESSION['phrase']) && $_POST['myCaptcha'] === $_SESSION['phrase']) {
	$hashids = new Hashids\Hashids('ROCKSALT', 10, 'abcdefghij1234567890');

	$id = $hashids->encode(1);
	//Decode: $numbers = $hashids->decode($id); 
	$message = "Matchib: ".$id;
	$captcha = false;
	/*Destroy session and send stuff */
} else if(isset($_POST['myCaptcha']) && isset($_SESSION['phrase']) && $_POST['myCaptcha'] !== $_SESSION['phrase']) {
    // user phrase is wrong
	$message = "NO MATCH";
	$builder = new CaptchaBuilder;
	$builder->build();
	$captcha = $builder->inline();
	$_SESSION['phrase'] = $builder->getPhrase();
} else if(!isset($_SESSION['phrase']) || !isset($_POST['myCaptcha'])) {
	$message = "WELCOME";
	$builder = new CaptchaBuilder;
	$builder->build();
	$captcha = $builder->inline();
	$_SESSION['phrase'] = $builder->getPhrase();
} else {
	$message = "ERROR";
	$captcha = false;
}

$loader = new FilesystemLoader(__DIR__.'/views/%name%');

$templating = new PhpEngine(new TemplateNameParser(), $loader);

echo $templating->render('hello.php', array('message' => $message, 'captcha' => $captcha));

?>
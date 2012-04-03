<?php
require_once('persian_log2vis.php');

//Check Secound Argument For Display All Reasualt or Just One
if(isset($argv[2]) && $argv[2]=="a")
	$mode="multiline";
else
	$mode="single";

//Retriv source word
$input = $argv[1];

//$input = readline("Enter a word for traslate: ");
if($input=="")
	die("You Enter An Empty Input!");

//search data base for translation
$db="/usr/share/dilmaj/generic.xdb";
$xml = simplexml_load_file($db);
$text="";
if (count($xml->word) > 0) {
	foreach ($xml->word as $node) {
		if($node->in==$input)
			$text = $node->out;


	}
	if($text=="")
		die("There Is Not Resualt Found!");
}

//explode result string to an array and filter long result from array
$text = explode("،",$text);
$index=0;
foreach($text as $item){
	if(mb_strlen(trim($item),"utf8")>10){
		unset($text[$index]);
	}
$index++;			
}
$text = array_values($text);



foreach($text as $item){
	$tmp = $item;
	persian_log2vis($tmp);



	// Create the image
	//    $im = imagecreatetruecolor(80, 25);
	$im = imagecreatetruecolor(120, 25);
    

	// Create some colors
	$white = imagecolorallocate($im, 255, 255, 255);
	$black = imagecolorallocate($im, 0, 0, 0);

    

    // Replace path by your own font path
	$font = '/usr/share/dilmaj/DejaVuSans.ttf';

	// Add the text
	//imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )

	$word_len = mb_strlen($tmp,"utf8");
	if($word_len <6){
		$x=40;
	}elseif($word_len>=6 && $word_len <=8 ){
		$x=20;
	}else{
		$x=0;
	}

    @imagettftext($im, 18, 0, $x, 18, $white, $font, $tmp); 

    

    // Using imagepng() results in clearer text compared with imagejpeg()file_put_contentsop
    imagejpeg($im,"/tmp/dilmaj.jpg");
    imagedestroy($im);

    

	$locate= '/tmp/dilmaj.jpg';
	$image = imagecreatefromjpeg("$locate");
    if ($image) {
	$asciichars = array("@", "#", "+", "*", ";", ":", ",", ".", "`", " ");
	$width = imagesx($image);
	$height = imagesy($image);
	for($y = 0; $y < $height; ++$y) {
		for($x = 0; $x < $width; ++$x) {
			$thiscol = imagecolorat($image, $x, $y);
			$rgb = imagecolorsforindex($image, $thiscol);
			$brightness = $rgb['red'] + $rgb['green'] + $rgb['blue'];
			$brightness = round($brightness / 85);
			$char = $asciichars[$brightness];
			echo $char;
			}
	echo "\n";
	}
}
if($mode=="single"){
	exit(0);
}
echo("+-----------------------------------------------------------------------------------------------------------------------+");
echo "\n";

	}

unlink('/tmp/dilmaj.jpg');
?>


<?php

/**
 * Permet de sécuriser une chaine de caractères
 * @param $string
 * @return string
 */
function str_cleaner($str) {
	 $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
     $allowedTags.='<li><ol><ul><div><br><ins><del>';
    return trim(strip_tags($str,$allowedTags));
}

/**
 * Debug plus lisible des différentes variables
 * @param $var
 */
function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function crypt_pass($dateToCrypt, $passToCrypt){
	$traitPassWellReturn = sha1($passToCrypt);
	return $traitPassWellReturn;
}

function date_rewrite($dateSent, $plusHourOrNot = false){
	$monthTab = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
	$dateConstructShow = '';
	$tabGetFirst = explode(' ', $dateSent);
	if(isset($tabGetFirst[0])){
		$tabGetSecond = explode("-", $tabGetFirst[0]);
		if(count($tabGetSecond) == 3){
			$year = (int) $tabGetSecond[0];
			$month = (int) $tabGetSecond[1];
			if(isset($monthTab[$tabGetSecond[1]-1])){
				$month = $monthTab[$tabGetSecond[1]-1];
			}
			$day = $tabGetSecond[2];
			$dateConstruct = $day.' '.$month.' '.$year;
			$dateConstructShow .= $dateConstruct;
		}

	}
	if(isset($tabGetFirst[1])){
		$plusHourTab = explode(':', $tabGetFirst[1]);
		if(count($plusHourTab) >= 2){
			$minsetAddOn = (int) $plusHourTab[1];
			if((int) $plusHourTab[1] < 10){
				$minsetAddOn = '0'.(int) $plusHourTab[1];
			}
			$plusHour = ' à '.$plusHourTab[0].':'.$minsetAddOn;

			if($plusHourOrNot == true){
				$dateConstructShow .= $plusHour;
			}

		}
	}
	return $dateConstructShow;
}

function getRand($nbWant = 8){
	$characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $nbWant; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendMailTo($mailIdentifier, $subjectGot, $messageContent, $bottomSignature = true){

$bottomLine = "<div style='text-align:center;border-top:1px solid #c0c0c0;padding-top:20px;'>++ Envoyé depuis l'IP: ".$_SERVER['REMOTE_ADDR']." le ".date("d-m-Y à H:i:s")." ++</div>";
$bottomPrinted = ($bottomSignature) ? $bottomLine : '';
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|outlook).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt ="";
$message_html = "<html><head></head><body>
        <div style='font-family:sans-serif,arial;font-size:15px;line-height:25px;color:#333;margin:30px auto;max-width:700px;border:1px solid #c0c0c0;padding:20px;'>

             ".$messageContent.$bottomPrinted."<br/>


</div></body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = $subjectGot;
//=========

//=====Création du header de l'e-mail.
$header = "From: \"".$mailIdentifier['send_from_name']."\"<".$mailIdentifier['send_from_mail'].">".$passage_ligne;
$header.= "Reply-to: \"".$mailIdentifier['send_to_name']."\" <".$mailIdentifier['send_to_mail'].">".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
@mail('pernaude@outlook.com',$sujet,$message,$header);



}




function shapeAndSaveImg($file)
{
$size=getimagesize($file);
$l=$size[0];
$h=$size[1];

$p=strtolower(substr(strrchr($size['mime'],'/'),1));
$new=str_replace(' ','',md5(rand())).'_'.time().'.'.$p;
$_SESSION['n']=$new;
$_SESSION['imgtype']=$p;



if($l>$h)
{
$equa=$l/$h;
$y=350;
$x=$y*$equa;
$dcr=($x-350)/2;
}
elseif($l<$h)
{
$equa=$l/$h;
$x=350;
$y=$x/$equa;
$dcr=($y-350)/6;
}
else
{
$x=350;
$y=350;
}
if($size)
{
if($size['mime']=='image/jpeg')
{
$img_big=imagecreatefromjpeg($file);
$img_new=imagecreate($x,$y);
$img_mini=imagecreatetruecolor($x,$y);
imagecopyresampled($img_mini,$img_big,0,0,0,0,$x,$y,$l,$h);
$nm='src/images/users/squared/'.$new;
imagejpeg($img_mini,$nm);
}
elseif($size['mime']=='image/png')
{
$img_big=imagecreatefrompng($file);
$img_new=imagecreate($x,$y);
$img_mini=imagecreatetruecolor($x,$y);
imagecopyresampled($img_mini,$img_big,0,0,0,0,$x,$y,$l,$h);
$nm='src/images/users/squared/'.$new;
imagepng($img_mini,$nm);
}
elseif($size['mime']=='image/gif')
{
$img_big=imagecreatefromgif($file);
$img_new=imagecreate($x,$y);
$img_mini=imagecreatetruecolor($x,$y);
imagecopyresampled($img_mini,$img_big,0,0,0,0,$x,$y,$l,$h);
$nm='src/images/users/squared/'.$new;
imagegif($img_mini,$nm);
}
$source_image=$nm;
$target_image=$nm;
}




$nm='src/images/users/squared/'.$new;



list($width, $height) = getimagesize($nm);

if($size['mime']=='image/png'){
$myImage = imagecreatefrompng($nm);
}elseif($size['mime']=='image/gif'){
$myImage = imagecreatefromgif($nm);
}else{
$myImage = imagecreatefromjpeg($nm);
}
// calculating the part of the image to use for thumbnail
if ($width > $height) {
  $y = 0;
  $x = ($width - $height) / 2;
  $smallestSide = $height;
} else {
  $x = 0;
  $y = ($height - $width) / 2;
  $smallestSide = $width;
}

// copying the part into thumbnail
$thumbSize = 350;
$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
if($size['mime']=='image/jpeg')
{
imagejpeg($thumb,$nm);	
}elseif($size['mime']=='image/png'){
imagepng($thumb,$nm);	
}elseif($size['mime']=='image/gif'){
imagegif($thumb,$nm);	
}






move_uploaded_file($file,'src/images/users/normals/'.$new);
}
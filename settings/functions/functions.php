<?php

/**
 * Permet de sécuriser une chaine de caractères
 * @param $string
 * @return string
 */
function str_cleaner($str) {
	 $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
     $allowedTags.='<li><ol><ul><span><div><br><ins><del>';
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
	$hashedPass =  mcrypt_create_iv($passToCrypt, MCRYPT_DEV_URANDOM);
	$dategotTab = password_hash($passToCrypt, PASSWORD_DEFAULT);
	return $dategotTab;
}
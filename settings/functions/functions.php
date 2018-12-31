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
	$traitPassWellReturn = sha1($passToCrypt);
	return $traitPassWellReturn;
}

function date_rewrite($dateSent, $plusHourOrNot){
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
			$plusHour = ' à '.$plusHourTab[0].':'.(int) $plusHourTab[1];

			if($plusHourOrNot == 'full'){
				$dateConstructShow .= $plusHour;
			}

		}
	}
	return $dateConstructShow;
}
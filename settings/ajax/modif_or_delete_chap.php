<?php
require_once '../config/config.php';
require_once '../functions/functions.php';
require_once '../classes/Dbase.php';
require_once '../config/db.php';
require_once '../classes/Chapter.php';


$responseConstitute = array();
if(isset($_GET['q'])){

$q = (int) str_cleaner($_GET['q']);



$thisChapInit = new Chapter($q);
$errorTk = $thisChapInit -> getErrorCatch();

$responseConstitute = ['error' => $errorTk];
if($errorTk == 0){
$responseConstitute["chapter"] = ["number" => $thisChapInit -> getchapNumberPlace(), "title" => $thisChapInit -> getChapTitle(), "content" => $thisChapInit -> getChapContent(), "date" => date_rewrite($thisChapInit -> getChapcreatedDate())];

}
}else{
	$responseConstitute[] = ['error' => 2];
}




echo json_encode($responseConstitute, JSON_PRETTY_PRINT);
?>
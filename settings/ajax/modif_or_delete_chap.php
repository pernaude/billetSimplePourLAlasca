<?php
require_once '../config/config.php';
require_once '../functions/functions.php';
require_once '../classes/Dbase.php';
require_once '../config/db.php';
require_once '../classes/Chapter.php';


$responseConstitute = array();
$userAsk = (int) $_SESSION['USER_ID'];
if(isset($_GET['q'])&&isset($_GET['byN'])){

$q = (int) str_cleaner($_GET['q']);
$byN = (int) str_cleaner($_GET['byN']);
if($byN == 1){
	if(isset($_GET['direct']) && ($_GET['direct'] == "n" || $_GET['direct'] == "p")){
	$direct = str_cleaner($_GET['direct']);
	$thisChapInit = Chapter::getSiblingChap($q,$direct);
	if(isset($thisChapInit['chap_number'])&&$thisChapInit['chap_number'] > 0){
	$errorTk = 0;
    $responseConstitute = ['error' => $errorTk];

    $responseConstitute["chapter"] = ["id" => $thisChapInit['chap_id'], "number" => $thisChapInit['chap_number'], "title" => $thisChapInit['chap_title'], "content" => $thisChapInit['chap_content'], "date" => date_rewrite($thisChapInit['chap_date_created'])];
    Chapter::checkIfReadChapter($userAsk, $thisChapInit['chap_id']);


    }
    }
}else{
	$thisChapInit = new Chapter($q);
    $errorTk = $thisChapInit -> getErrorCatch();
    $responseConstitute = ['error' => $errorTk];
    if($errorTk == 0){
    $responseConstitute["chapter"] = ["id" => $q, "number" => $thisChapInit -> getchapNumberPlace(), "title" => $thisChapInit -> getChapTitle(), "content" => $thisChapInit -> getChapContent(), "date" => date_rewrite($thisChapInit -> getChapcreatedDate())];
    Chapter::checkIfReadChapter($userAsk, $q);

}
}





}else{
	$responseConstitute[] = ['error' => 2];
}




echo json_encode($responseConstitute, JSON_PRETTY_PRINT);
?>
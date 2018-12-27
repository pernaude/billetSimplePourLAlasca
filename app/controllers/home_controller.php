<?php


$lastChapTab = Chapter::getLastChapter();

$chapLastId = $lastChapTab['chap_id'];
$chapLastTitle = $lastChapTab['chap_title'];
$chapLastDate = date_rewrite($lastChapTab['chap_date_created'], 'short');
$chapLastContent = substr($lastChapTab['chap_content'],0,800);


$allChapTab = Chapter::getAllChapters();


if(isset($_GET['q'])){

$q = (int) str_cleaner($_GET['q']);

$responseConstitute = array();
$responseConstitute[] = ['pams' => 'King'];

$getTabTest = new Chapter($q);

echo json_encode($responseConstitute);

}





?>
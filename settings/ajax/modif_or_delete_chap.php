<?php
require_once '../config/config.php';
require_once '../functions/functions.php';
require_once '../classes/Dbase.php';
require_once '../config/db.php';
require_once '../classes/Chapter.php';
require_once '../classes/Comment.php';


$userAsk = (int) $_SESSION['USER_ID'];
if(isset($_GET['q'])&&isset($_GET['byN'])){
$responseConstitute = array();
$q = (int) str_cleaner($_GET['q']);
$byN = (int) str_cleaner($_GET['byN']);
if($byN == 1){
	if(isset($_GET['direct']) && ($_GET['direct'] == "n" || $_GET['direct'] == "p")){
	$direct = str_cleaner($_GET['direct']);
	$thisChapInit = Chapter::getSiblingChap($q,$direct);
	if(isset($thisChapInit['chap_number'])&&$thisChapInit['chap_number'] > 0){
	$errorTk = 0;
    $responseConstitute = ['error' => $errorTk];
    $allChapters = Comment::getAllComments($thisChapInit['chap_id']);
    $responseConstitute["chapter"] = ["id" => $thisChapInit['chap_id'], "number" => $thisChapInit['chap_number'], "title" => $thisChapInit['chap_title'], "content" => $thisChapInit['chap_content'], "date" => date_rewrite($thisChapInit['chap_date_created'], true)];
    foreach($allChapters as $key => $value){
        $allChapters[$key]['comment_add_date'] = date_rewrite($value['comment_add_date'], true);
        if($allChapters[$key]['user_dp'] == NULL){
            $allChapters[$key]['user_dp'] = "src/images/layout/dp.png";
        }else{
            if($allChapters[$key]['user_dp'] !== '' && file_exists("../../src/images/users/squared/".$allChapters[$key]['user_dp'])){
            $allChapters[$key]['user_dp'] = "src/images/users/squared/".$allChapters[$key]['user_dp'];
        }else{
            $allChapters[$key]['user_dp'] = "src/images/layout/dp.png";
        }
        }
        $allChapters[$key]['comment_content'] = nl2br($allChapters[$key]['comment_content']);
    }
    
    $responseConstitute["comments"] = $allChapters;
    Chapter::checkIfReadChapter($userAsk, $thisChapInit['chap_id']);


    }else{
        $errorTk = 2;
    }
    }
}else{
	$thisChapInit = new Chapter($q);
    $errorTk = $thisChapInit -> getErrorCatch();
    $responseConstitute = ['error' => $errorTk];
    if($errorTk == 0){
    $allChapters = Comment::getAllComments($q);
    $responseConstitute["chapter"] = ["id" => $q, "number" => $thisChapInit -> getchapNumberPlace(), "title" => $thisChapInit -> getChapTitle(), "content" => $thisChapInit -> getChapContent(), "date" => date_rewrite($thisChapInit -> getChapcreatedDate(), true)];
    foreach($allChapters as $key => $value){
        $allChapters[$key]['comment_add_date'] = date_rewrite($value['comment_add_date'], true);
        if($allChapters[$key]['user_dp'] == null){
            $allChapters[$key]['user_dp'] = "src/images/layout/dp.png";
        }else{
            if($allChapters[$key]['user_dp'] !== '' && file_exists("src/images/users/squared/".$allChapters[$key]['user_dp'])){
            $allChapters[$key]['user_dp'] = "src/images/users/squared/".$allChapters[$key]['user_dp'];
        }else{
            $allChapters[$key]['user_dp'] = "src/images/layout/dp.png";
        }
        }
        $allChapters[$key]['comment_content'] = nl2br($allChapters[$key]['comment_content']);
    }
    $responseConstitute["comments"] = $allChapters;
    Chapter::checkIfReadChapter($userAsk, $q);

}
}


echo json_encode($responseConstitute, JSON_PRETTY_PRINT);


}elseif(isset($_GET['reportId'])&&isset($_GET['reportContent'])){
$reportId = (int) str_cleaner($_GET['reportId']);
$reportContent = str_cleaner($_GET['reportContent']);
if($reportContent !== '' && strlen($reportContent) > 2 && $reportId > 0){
    Comment::reportComment($reportId, $userAsk, $reportContent);
    $responseConstitute = ['error' => 0, 'report_id' => $reportId];
    echo json_encode($responseConstitute, JSON_PRETTY_PRINT);
}
}else{
    $responseConstitute[] = ['error' => 2];
    echo json_encode($responseConstitute, JSON_PRETTY_PRINT);
}

?>
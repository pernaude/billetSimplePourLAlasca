<?php
$redirectAccount = false;
if(isset($_SESSION['USER_CONNECT'])&&isset($_SESSION['USER_ID'])){
$redirectAccount = true;
$userActualId = (int) $_SESSION['USER_ID'];
$theUser = new User((int) $_SESSION['USER_ID']);
$userTab = $theUser -> userGlobal();

$pseudoUser = '';
$firstNameUser = '';
$lastNameUser = '';
$picUser = '';
$roleUser = '';
$lastConnectedUser = '';
$createdDateUser = '';
$emailUser = '';
$nbCommentsAdded = 0;
$nbVisitedChapters = 0;
$visitedChapters = [];
$commentsAdded = [];
$addedCommentMade = "Vous n'avez pas encore ajouté de commentaires";
$visitedChapterMade = "Vous n'avez encore rien lu";


if($theUser -> getIfError() == 0){
$pseudoUser = $userTab['pseudo'];
$firstNameUser = $userTab['first_name'];
$lastNameUser = $userTab['last_name'];
$picUser = $userTab['pic'];
$roleUser = $userTab['role'];
$lastConnectedUser = $userTab['date_last_connected'];
$createdDateUser = date_rewrite($userTab['date_created']);
$emailUser = $userTab['email'];
$nbCommentsAdded = $userTab['number_comments_added'];
$nbVisitedChapters = $userTab['number_chapters_visited'];
$visitedChapters = $userTab['chapters_visited'];
$commentsAdded = $userTab['comments_added'];
if($picUser != '' && file_exists("src/images/users/squared/".$picUser)){ $picUser = "src/images/users/squared/".$picUser; }else{ $picUser = "src/images/layout/dp.png"; }
if($nbVisitedChapters == 1){ $visitedChapterMade = "Vous avez lu un seul chapitre"; }elseif($nbVisitedChapters > 1){ $visitedChapterMade = "Vous avez lu ".$nbVisitedChapters." chapitres"; }
if($nbCommentsAdded == 1){ $addedCommentMade = "Vous avez ajouté un seul commentaire"; }elseif($nbCommentsAdded > 1){ $addedCommentMade = "Vous avez ajouté ".$nbCommentsAdded." commentaires"; }
}

}

$lastChapTab = Chapter::getLastChapter();

$chapLastId = $lastChapTab['chap_id'];
$chapLastTitle = $lastChapTab['chap_title'];
$chapLastDate = date_rewrite($lastChapTab['chap_date_created'], 'short');
$chapLastContent = substr($lastChapTab['chap_content'],0,800);


$allChapTab = Chapter::getAllChapters();





if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commentSent'])) {

$commentSent = str_cleaner($_POST["commentSent"]);
$userComSent = (int) str_cleaner($_POST["userComSent"]);
$chapComAssoc = (int) str_cleaner($_POST["chapComAssoc"]);
$chapNbComAssoc = (int) str_cleaner($_POST["chapNbComAssoc"]);


        $errorReturned="";


        if($commentSent == '' || strlen($commentSent) < 3){
        	$errorReturned .= "commentSent,";
        }else{

        $userVerif = Chapter::checkCommentAdding($chapComAssoc, $chapNbComAssoc, $commentSent, $userComSent, 0, 0);

        
        }




         if($errorReturned == ''){


         	}else{
         		http_response_code(400); echo $errorReturned; exit;
         	}


}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailOrPseudoUser'])) {


        $emailOrPseudoUser = str_cleaner($_POST["emailOrPseudoUser"]);
        $passUser = str_cleaner($_POST["passUser"]);

        $errorReturned="";


        if($emailOrPseudoUser == '' || $passUser == ''){
        	$errorReturned .= "emailOrPseudoUser,";
        	$errorReturned .= "passUser,";
        }else{

        $userVerif = User::checkCredentials($emailOrPseudoUser, $passUser, "u");

        if($userVerif == false){
        	$errorReturned .= "emailOrPseudoUser,";
        	$errorReturned .= "passUser,";
        }
        }




         if($errorReturned == ''){
         $_SESSION['USER_CONNECT'] = true;
         $_SESSION['USER_ID'] = 1;
         exit;
         }else{
            http_response_code(400); echo $errorReturned; exit;
        }
    }


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pseudoCreateUser'])) {

        $pseudoCreateUser = str_cleaner($_POST["pseudoCreateUser"]);
        $emailCreateUser = filter_var(str_cleaner(strtolower($_POST["emailCreateUser"])), FILTER_SANITIZE_EMAIL);
        $passCreateUser = str_cleaner($_POST["passCreateUser"]);
        $passCreateReUser = str_cleaner($_POST["passCreateReUser"]);

        $errorReturned=""; $errorLineAssoc="";


        if(strlen($pseudoCreateUser) < 3){
        	$errorReturned .= "pseudoCreateUser-1,";
        }
        if(! filter_var($emailCreateUser, FILTER_VALIDATE_EMAIL)){
        	$errorReturned .= "emailCreateUser-1,";
        }else{
        	$testVerif = User::checkUser($emailCreateUser, $pseudoCreateUser);
        	if($testVerif['if_new_pseudo'] == false){
        		$errorReturned .= "pseudoCreateUser-2,";
        	}
        	if($testVerif['if_new_email'] == false){
        		$errorReturned .= "emailCreateUser-2,";
        	}
        }
        if(!preg_match("#^[a-zA-Z0-9@\|]{6,20}$#",$passCreateUser)){
        	$errorReturned .= "passCreateUser,";
        }
        if($passCreateUser !== $passCreateReUser){
        	$errorReturned .= "passCreateReUser,";
        }



         if($errorReturned == ''){
         	$dateEnrol = date('Y-m-d H:i:s');
         	$passCrypt = sha1($dateEnrol.$passCreateUser.$dateEnrol);
         	User::saveUser('', '', '', $pseudoCreateUser, $emailCreateUser, $passCrypt, $dateEnrol);
         }
         else{
            http_response_code(400); echo $errorReturned; exit;
        }
            

    }









?>
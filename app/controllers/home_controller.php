<?php
$redirectAccount = false;
$goToDashBoardCl = "connectLkButt";
if(isset($_SESSION['USER_CONNECT'])&&isset($_SESSION['USER_ID'])&&isset($_SESSION['USER_LAST_CONNECTED'])){
$redirectAccount = true;
$goToDashBoardCl = "goToDashBord";
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
$lastConnectedUser = date_rewrite($_SESSION['USER_LAST_CONNECTED'], true);
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
$chapLastNumber = $lastChapTab['chap_number'];
$chapLastDate = date_rewrite($lastChapTab['chap_date_created']);
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

        $userVerif = Comment::addComment($chapComAssoc, $chapNbComAssoc, $commentSent, $userComSent, 0, 0);

        
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

        if($userVerif['user_exists'] == false){
        	$errorReturned .= "emailOrPseudoUser,";
        	$errorReturned .= "passUser,";
        }
        }




         if($errorReturned == ''){
         $_SESSION['USER_CONNECT'] = true;
         $_SESSION['USER_ID'] = $userVerif['user_id'];
         $_SESSION['USER_LAST_CONNECTED'] = $userVerif['last_connected'];
         print_r($userVerif);
         exit;
         }else{
            http_response_code(400); echo $errorReturned; exit;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailrecoverUser'])) {
        $emailrecoverUser = str_cleaner($_POST["emailrecoverUser"]);
        if($emailrecoverUser !== ''){
        $testUserMail = User::checkUser($emailrecoverUser, $emailrecoverUser, true);
        if(!$testUserMail['if_new_pseudo'] || !$testUserMail['if_new_email']){
            if($testUserMail['email_assoc'] !== ''){
                $newPassConstruct = getRand(12);
                $mailIdentifier = ['send_from_name' => 'Jean Forteroche', 'send_from_mail' => "postmaster@alaska.pernaude.com", 'send_to_name' => $testUserMail['email_assoc'], 'send_to_mail' => $testUserMail['email_assoc']];
                $contentToSend = "Vous avez demandé la réinitialisation de votre mot de passe.<br/>Voici votre nouveau mot de passe pour vous connecter. vous pouvez le changer quand vous serez connecter.<br/><br/>Mot de passe: <b>$newPassConstruct</b>";
            User::updateUserPass($testUserMail['id_assoc'], $newPassConstruct, false);
            sendMailTo($mailIdentifier, "Réinitialisation de votre mot de passe", $contentToSend, false);
            
        }
        }
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['passOldUser'])) {
        $passOldUser = str_cleaner($_POST["passOldUser"]);
        $passModifUser = str_cleaner($_POST["passModifUser"]);
        $passModifReUser = str_cleaner($_POST["passModifReUser"]);
        if(!preg_match("#^[a-zA-Z0-9@\|]{6,20}$#",$passOldUser)){
            $errorReturned .= "passOldUser,";
        }
        if(!preg_match("#^[a-zA-Z0-9@\|]{6,20}$#",$passModifUser)){
                    $errorReturned .= "passModifUser,";
                }
                if($passModifUser !== $passModifReUser){
                    $errorReturned .= "passModifReUser,";
                }
            
        
        
        
        

        if($errorReturned == ''){
            $testOldPass = User::updateUserPass($userActualId, $passOldUser, true);
            if($testOldPass){
                $testOldPass = User::updateUserPass($userActualId, $passModifUser);
            if(!$testOldPass){
               $errorReturned .= "passModifUser,";
                http_response_code(400); echo $errorReturned; exit; 
            }
            }else{
                $errorReturned .= "passOldUser,";
                http_response_code(400); echo $errorReturned; exit;
            }
            exit;
         }
         else{
            http_response_code(400); echo $errorReturned; exit;
        }
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contactName'])) {

        $contactName = str_cleaner($_POST["contactName"]);
        $contactEmail = filter_var(str_cleaner(strtolower($_POST["contactEmail"])), FILTER_SANITIZE_EMAIL);
        $contactSubject = str_cleaner($_POST["contactSubject"]);
        $contactMessage = str_cleaner($_POST["contactMessage"]);

        if($contactName !== '' && filter_var($contactEmail, FILTER_VALIDATE_EMAIL) && $contactSubject !=='' && $contactMessage !==''){
            $messageCompile = "Nom: ".$contactName."<br/>Email: ".$contactEmail."<br/>Objet: ".$contactSubject."<br/><br/>Message<br/>".$contactMessage;
            sendMailTo(['send_to_name' => 'pernaude.amoussou@gmail.com', 'send_to_mail' => 'pernaude.amoussou@gmail.com','send_from_name' => 'Jean Forteroche', 'send_from_mail' => 'postmaster@alaska.pernaude.com'], "Billet simple pour l'Alaska", $messageCompile);
        }else{
            http_response_code(400); exit;
        }


}

if(isset($_FILES['pic'])){
$pic=$_FILES['pic']['name'];
$ext_ok=array('jpg','jpeg','png','gif');
$ext_up=strtolower(substr(strrchr($pic,'.'),1));
$tmp=$_FILES['pic']['tmp_name'];
$taille=$_FILES['pic']['size'];
$erreur=$_FILES['pic']['error'];
$errorajout = 1;$picReturn = "";
if(!$pic==""&&$erreur==0&&$taille<314572900)
{

shapeAndSaveImg($tmp);
$dpPic=$_SESSION['n'];
unset($_SESSION['n']);
$picChangeState = $theUser -> updateUserPic($dpPic);
$errorajout = ($picChangeState) ? 0 : 1;
$picReturn = $dpPic;
}else{
$errorajout=1;
}
$returnResult = ["error" => $errorajout, "pic" => $picReturn];
echo json_encode($returnResult, JSON_PRETTY_PRINT);
    exit;
}









?>
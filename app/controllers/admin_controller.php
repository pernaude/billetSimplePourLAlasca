<?php
$redirectAccount = false;
$goToDashBoardCl = "connectLkButt";
if(isset($_SESSION['ADMIN_CONNECT'])&&isset($_SESSION['ADMIN_ID'])&&isset($_SESSION['ADMIN_LAST_CONNECTED'])){
$redirectAccount = true;
$goToDashBoardCl = "goToDashBord";
$userActualId = (int) $_SESSION['ADMIN_ID'];
$theUser = new User((int) $_SESSION['ADMIN_ID']);
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


if($theUser -> getIfError() == 0){
$pseudoUser = $userTab['pseudo'];
$firstNameUser = $userTab['first_name'];
$lastNameUser = $userTab['last_name'];
$picUser = $userTab['pic'];
$roleUser = $userTab['role'];
$lastConnectedUser = date_rewrite($_SESSION['ADMIN_LAST_CONNECTED'], true);
$createdDateUser = date_rewrite($userTab['date_created']);
$emailUser = $userTab['email'];
$nbCommentsAdded = $userTab['number_comments_added'];
$nbVisitedChapters = $userTab['number_chapters_visited'];
$visitedChapters = $userTab['chapters_visited'];
$commentsAdded = $userTab['comments_added'];
if($picUser != '' && file_exists("src/images/users/squared/".$picUser)){ $picUser = "src/images/users/squared/".$picUser; }else{ $picUser = "src/images/layout/dp.png"; }
}


$allChapTab = Chapter::getAllChapters();
$nbChapCount = count($allChapTab);
$allReportedComment = Comment::getAllComments(false, false, true, 0);
foreach ($allReportedComment as $key => $value){
    $allReportedComment[$key]['comment_reported_author'] = User::getSimpleName($allReportedComment[$key]['comment_reported_author']);
}
$nbReportedComment = count($allReportedComment);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editChapNumber'])) {

        $editChapNumber = (int) str_cleaner($_POST["editChapNumber"]);
        $editTitleChap = str_cleaner($_POST["editTitleChap"]);
        $editContent = str_cleaner($_POST["editContent"]);
        $hiddenActOnChapOnForm = str_cleaner($_POST["hiddenActOnChapOnForm"]);
        $hiddenUpdateChap = (int) str_cleaner($_POST["hiddenUpdateChap"]);

        $errorReturned="";


        if($editChapNumber<1){
        	$errorReturned .= "editChapNumber-";
        }
        if($editTitleChap == ''){
        	$errorReturned .= "editTitleChap-";
        }
        if($editContent == ''){
        	$errorReturned .= "editContent-";
        }
        if($hiddenActOnChapOnForm !== 'u' && $hiddenActOnChapOnForm !== 'a'){
            $errorReturned .= "editChapNumber-";
        }
        if(($hiddenActOnChapOnForm == 'u') && $hiddenUpdateChap < 1){
            $errorReturned .= "editChapNumber-";
        }



         

         if($errorReturned == ''){
         	Chapter::checkChapterAdding($editTitleChap, $editChapNumber, $editContent, $userActualId, $hiddenActOnChapOnForm, $hiddenUpdateChap);
         }else{
            http_response_code(400); echo $errorReturned; exit;
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


    
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editUserFirstName'])) {

        $editUserFirstName = str_cleaner($_POST["editUserFirstName"]);
        $editUserLastName = str_cleaner($_POST["editUserLastName"]);
        $editUserRole = str_cleaner($_POST["editUserRole"]);
        $editUserEmail = filter_var(str_cleaner(strtolower($_POST["editUserEmail"])), FILTER_SANITIZE_EMAIL);
        $editUserPassword = str_cleaner($_POST["editUserPassword"]);
        $editUserPassAgain = str_cleaner($_POST["editUserPassAgain"]);

        $errorReturned="";


        if($editUserFirstName == ''){
        	$errorReturned .= "editUserFirstName-";
        }
        if($editUserLastName == ''){
        	$errorReturned .= "editUserLastName-";
        }
        if($editUserRole == 0){
        	$errorReturned .= "editUserRole-";
        }
        if(! filter_var($editUserEmail, FILTER_VALIDATE_EMAIL)){
        	$errorReturned .= "editUserEmail-";
        }
        if(!preg_match("#^[a-zA-Z0-9@\|]{6,20}$#",$editUserPassword)){
        	$errorReturned .= "editUserPassword-";
        }
        if($editUserPassword !== $editUserPassAgain){
        	$errorReturned .= "editUserPassAgain-";
        }



         

         if($errorReturned == ''){
         	$dateEnrol = date('Y-m-d H:i:s');
            $passCrypt = sha1($dateEnrol.$editUserPassword.$dateEnrol);
         	User::saveUser($editUserRole, $editUserFirstName, $editUserLastName, '', $editUserEmail, $passCrypt, $dateEnrol);
         }
         else{
            http_response_code(400); echo $errorReturned; exit;
        }
            

    }


if(isset($_GET['q'])){
$q= (int) str_cleaner($_GET['q']);
$getThisChap = new Chapter($q);
$responseConstitute = array();
return json_encode($responseConstitute, JSON_FORCE_OBJET);
    }

}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailOrPseudoUser'])) {


        $emailOrPseudoUser = str_cleaner($_POST["emailOrPseudoUser"]);
        $passUser = str_cleaner($_POST["passUser"]);
        $userType = str_cleaner($_POST["userType"]);

        $errorReturned="";


        if($emailOrPseudoUser == '' || $passUser == ''){
            $errorReturned .= "emailOrPseudoUser,";
            $errorReturned .= "passUser,";
        }else{

        $userVerif = User::checkCredentials($emailOrPseudoUser, $passUser, "ad");

        if($userVerif['user_exists'] == false){
            $errorReturned .= "emailOrPseudoUser,";
            $errorReturned .= "passUser,";
        }
        }




         if($errorReturned == ''){
         $_SESSION['ADMIN_CONNECT'] = true;
         $_SESSION['ADMIN_ID'] = $userVerif['user_id'];
         $_SESSION['ADMIN_LAST_CONNECTED'] = $userVerif['last_connected'];
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

?>
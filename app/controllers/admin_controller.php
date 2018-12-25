<?php

$allChapTab = Chapter::getAllChapters();



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editChapNumber'])) {

        $editChapNumber = (int) str_cleaner($_POST["editChapNumber"]);
        $editTitleChap = str_cleaner($_POST["editTitleChap"]);
        $editContent = str_cleaner($_POST["editContent"]);

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



         

         if($errorReturned == '')
         	Chapter::checkChapterAdding($editTitleChap, $editChapNumber, $editContent, 9);
         else
            http_response_code(400); echo $errorReturned; exit;
            

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
        if($editUserRole == ''){
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
         	$passCrypt = crypt_pass($dateEnrol);
         	Chapter::checkUserAdding($editUserRole, $editUserFirstName, $editUserLastName, '', $editUserEmail, $passCrypt, $dateEnrol);
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

?>
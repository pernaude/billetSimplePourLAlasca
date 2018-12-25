<!DOCTYPE html>
<html>
<head>

    <?php include_once 'app/views/parts/admin_head.php'?>

    <title><?= ucfirst($page) ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="src/css/default.css?v=hhjjjjh"/>
    <link rel="stylesheet" type="text/css" href="src/css/layout.css?v=<?= time(); ?>"/>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=2snpaz1ge5ucj0xj488fs2egpga9sk6r0mecsosebvk78hx4"></script>



</head>

<body>


    <!-- CONTENU DE LA PAGE DEMANDEE -->

    <header id="header">
    	<div id="topMenuWrapper"><div id="sortFortForClose"></div>
    		<div id="menuSingleBloc">
    			<ul id="menuAllSlideDown">
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="closeButtShow" class="closeButtBox"> &times;</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuSelect-1" class="menusetLk"><i class="fas fa-home"></i> &nbsp; Accueil</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuSelect-2" class="menusetLk"><i class="fas fa-plus"></i> &nbsp; Ajouter un chapitre</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuSelect-3" class="menusetLk"><i class="fas fa-marker"></i> &nbsp; Voir tous les chapitres</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuSelect-4" class="menusetLk"><i class="far fa-flag"></i> &nbsp; Modérer un commentaire</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuSelect-5" class="menusetLk"><i class="far fa-user-circle"></i> &nbsp; Mon compte</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuSelect-6" class="menusetLk"><i class="far fa-address-card"></i> &nbsp; Ajouter un administrateur</a></li>
    			</ul>


    		</div>
    		


    	</div>

    </header>

    <div id="globalContainer">
    	<div id="menuActuelContener"><a href="javascrip:void(0);" id="actualMenuShow"><span id="screenShow"><i class="fas fa-home"></i> &nbsp; Accueil</span>  &nbsp; <i class="fas fa-angle-right"></i></a></div>

    	<div id="actionBoxWrapper">

    		<div id="menuSelect-1-container" class="boxPartUnik"><div class="theContainerInside">
    			<ul id="menuBigShow">
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuBigSelect-2" class="menusetBigLk"><i class="fas fa-plus"></i> &nbsp; Ajouter un chapitre</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuBigSelect-3" class="menusetBigLk"><i class="fas fa-marker"></i> &nbsp; Voir tous les chapitres</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuBigSelect-4" class="menusetBigLk"><i class="far fa-flag"></i> &nbsp; Modérer un commentaire</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuBigSelect-5" class="menusetBigLk"><i class="far fa-user-circle"></i> &nbsp; Mon compte</a></li>
    				<li class="menuLineWrap"><a href="javascript:void(0);" id="menuBigSelect-6" class="menusetBigLk"><i class="far fa-address-card"></i> &nbsp; Ajouter un administrateur</a></li>
    			</ul>
    		</div></div>
    		<div id="menuSelect-2-container" class="boxPartUnik"><div class="theContainerInside">
    			<form method="post" action='' id="form-add-chapter">
    				<div id="noError1" class="noErrorCl"> Le chapitre a été ajouté avec succès</div>
    				<div class="halfWidth leftWrapper">
    				<label>
    					<input type="number" name="editChapNumber" min="1" max="50" id="editChapNumber" class="putDisplayNeet" length="2" placeholder="Numéro du chapitre"/>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editChapNumber-error">Veuillez mettre le numéro du chapitre</div></div>
    			</div><div class="halfWidth rightWrapper">
    				<label>
    					<input type="text" name="editTitleChap" id="editTitleChap" class="putDisplayNeet" placeholder="Titre du chapitre"/>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editTitleChap-error">Veuillez écrire le titre du chapitre</div></div>
    			</div>
    				<label>
    					<textarea name="editContent" id="editContent" class="putDisplayNeet textareaShape" placeholder="Contenu du chapitre"></textarea>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editContent-error">Veuillez rédiger le chapitre</div></div>
    				<div class="alignSubmitButt"><input type="submit" value="Enrégistrer le chapitre" id="submit-butt-save" class="buttStyleBlue"></div>
    			</form>



    		</div></div>
    		<div id="menuSelect-3-container" class="boxPartUnik"><div class="theContainerInside">
    			<?php foreach($allChapTab as $keytaken => $valAssocTaken): ?>
    				<div class="lineWrapperDisplay"><span class="chapNumberCover">Chapitre <?= ucfirst($valAssocTaken['chap_number']); ?></span><span class="chapActionCover"><a href="javascript:void(0);" class="actionOnChap actionButtSingle-modif" id="act-assoc-<?= $keytaken; ?>">Modifier</a> &nbsp; <a href="javascript:void(0);" class="actionOnChap actionButtSingle-del" id="act-assoc-<?= $keytaken; ?>">Supprimer</a></span><div class="chapTitleCover"><?= ucfirst($valAssocTaken['chap_title']); ?></div><div class="clear"></div></div>

    			<?php endforeach ?>
    		</div></div>
    		<div id="menuSelect-4-container" class="boxPartUnik"><div class="theContainerInside"></div></div>
    		<div id="menuSelect-5-container" class="boxPartUnik"><div class="theContainerInside"></div></div>
    		<div id="menuSelect-6-container" class="boxPartUnik"><div class="theContainerInside">
    			<form method="post" action='' id="form-add-user">
    				<div id="noError2" class="noErrorCl">L'utilisateur a été ajouté avec succès</div>
    				<div class="halfWidth leftWrapper">
    				<label>
    					<input type="text" name="editUserFirstName" autocomplete="off" id="editUserFirstName" class="putDisplayNeet"  placeholder="Prénom"/>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editUserFirstName-error">Veuillez mettre prénom</div></div>
    			</div><div class="halfWidth rightWrapper">
    				<label>
    					<input type="text" name="editUserLastName" id="editUserLastName" class="putDisplayNeet" placeholder="Nom"/>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editUserLastName-error">Veuillez mettre votre nom</div></div>
    			</div>
    				<div class="halfWidth leftWrapper">
    				<label>
    					<select name="editUserRole" id="editUserRole" class="putDisplayNeet">
    						<option value="">Rôle de l'utilisateur</option>
    						<option value="Administrateur">Administrateur</option>
    						<option value="Editeur">Editeur</option>
    					</select>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editUserRole-error">Veuillez choisir le rôle de l'utilisateur</div></div>
    			</div><div class="halfWidth rightWrapper">
    				<label>
    					<input type="text" name="editUserEmail" id="editUserEmail" class="putDisplayNeet" placeholder="Email"/>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editUserEmail-error">L'email est invalide</div></div>
    			</div>
    				<div class="halfWidth leftWrapper">
    				<label>
    					<input type="password" name="editUserPassword" autocomplete="off" id="editUserPassword" class="putDisplayNeet"  placeholder="Mot de passe"/>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editUserPassword-error">Veuillez choisir votre mot de passe</div></div>
    			</div><div class="halfWidth rightWrapper">
    				<label>
    					<input type="password" name="editUserPassAgain" id="editUserPassAgain" class="putDisplayNeet" placeholder="Retappez le mot de passe"/>
    				</label>
    				<div class="errorCover"><div class="errorGet" id="editUserPassAgain-error">Veuillez retappez le mot de passe</div></div>
    			</div>
    				<div class="alignSubmitButt"><input type="submit" value="Enrégistrer l'utilisateur" id="submit-butt-save-user" class="buttStyleBlue"></div>
    			</form>
    		</div></div>

    	</div>
    	<div id="messageDisplayCover">
    		<div id="messageDisplayConfirm">
    			<div id="messageDisplaySelf">
    				<span id="msg-chap" class="actionMessage">Voulez-vous vraiment supprimer ce chapitre?</span>
    				<span id="msg-user" class="actionMessage">Voulez-vous vraiment supprimer cet utilisateur?</span>
    			</div>
    			<div id="messageDisplayActionButt">
    				<a href="javascript: void(0);" class="actionConfirmButt theNegativeAns" id="action-confirm-n">Annuler</a> &nbsp; 
    				<a href="javascript: void(0);" class="actionConfirmButt thePositiveAns" id="action-confirm-y">Confirmer</a>
    			</div>
    		</div>
    		<div id="messageDisplayLoad"></div>
    	</div>



    </div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="src/js/admin_main.js?v=<?= time(); ?>"></script>

</body>
</html>

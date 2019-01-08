<!DOCTYPE html>
<html>
<head>

    <?php include_once 'app/views/parts/head.php'?>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=2snpaz1ge5ucj0xj488fs2egpga9sk6r0mecsosebvk78hx4"></script>

    <title><?= ucfirst($page) ?></title>
</head>

<body>


<?php if($redirectAccount): ?>
    <header id="admin-header">
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
    	<div id="menuActuelContener" style="z-index:2500"><a href="javascrip:void(0);" id="actualMenuShow"><span id="screenShow"><i class="fas fa-home"></i> &nbsp; Accueil</span>  &nbsp; <i class="fas fa-angle-right"></i></a></div>

    	<div id="actionBoxWrapper">
            <div class="page">
                <div id="messageDisplayActionCallbackResponse">
                    <div id="callBackMessageDisplay-noerror" class="callBackMessageDisplay"></div>
                    <div id="callBackMessageDisplay-error" class="callBackMessageDisplay"></div>
                </div>
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
    				<div class="halfWidth leftWrapper"><input type="hidden" name="hiddenActOnChapOnForm" id="hiddenActOnChapOnForm" value="a" maxlength="1"/><input type="hidden" name="hiddenUpdateChap" id="hiddenUpdateChap" value="a" maxlength="1"/>
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
                <div class="topDisplayActivity"><span id="nbChapExists"><?= $nbChapCount; ?></span> chapitres ajoutés</div>
    			<?php foreach($allChapTab as $keytaken => $valAssocTaken): ?>
    			<div class="lineWrapperDisplay" id="lineWrapperDisplay-<?= $valAssocTaken['chap_id']; ?>">
                    <span class="chapNumberCover">Chapitre <?= ucfirst($valAssocTaken['chap_number']); ?></span><span class="chapActionCover"><a href="javascript:void(0);" class="actionOnChap actionButtSingle-modif" id="act-assoc-<?= $valAssocTaken['chap_id']; ?>">Modifier</a> &nbsp; <a href="javascript:void(0);" class="actionOnChap actionButtSingle-del" id="act-assoc-<?= $valAssocTaken['chap_id']; ?>">Supprimer</a></span><div class="chapTitleCover"><?= ucfirst($valAssocTaken['chap_title']); ?></div><div class="clear"></div>
                </div>

    			<?php endforeach ?>
    		</div></div>
    		<div id="menuSelect-4-container" class="boxPartUnik">
                <div class="topDisplayActivity"><span id="nbReportedComment"><?= $nbReportedComment; ?></span> commentaires signalés</div>
                <div class="theContainerInside">
                    <?php foreach ($allReportedComment as $key => $value): ?>
                        <div class="lineSHowReported" id="lineSHowReported-<?= $allReportedComment[$key]['comment_id']; ?>">
                            <div class="chapterNumberCoverSet">
                                <a href="javascript:void(0);" id="commentLineReport-<?= $key; ?>" class="lineDisplayReportLk"><span class="arrowExpandBox"><i class="fas fa-angle-down"></i></span>Commentaire de <span class="commentOwnerDisplay"><?= $allReportedComment[$key]['user_pseudo']; ?></span> sur le Chapitre <span class="chapReportedDisplay"><?= $allReportedComment[$key]['comment_chap_number']; ?></span> signalé par <span class="reporterSpDisplay"><?= $allReportedComment[$key]['comment_reported_author']; ?></span></a>
                                <div class="bottomReportOpenerBox">
                                    <div class="reportContentBox">
                                        <?= $allReportedComment[$key]['comment_report_content']; ?>
                                    </div>
                                    <div class="actionLineReportBottom">
                                        <a href="javascript:void(0);" class="actionReportButt deleteActionOnComment" id="deleteThisCommentButt-<?= $allReportedComment[$key]['comment_id']; ?>">Supprimer</a> <a href="javascript:void(0);" class="actionReportButt cancelActionOnComment" id="cancelThisCommentReportButt-<?= $allReportedComment[$key]['comment_id']; ?>">Annuler le signal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
    		<div id="menuSelect-5-container" class="boxPartUnik">
                <div class="theContainerInside">
                    <section id="admin-dashboard">
            <div class="admin-insideContent">
                <div class="page">
                    <h1 class="titleHeader">Bienvenue dans votre compte</h1>
                    <div id="topProfilHead">
                        <h2 id="pseudoContener"><?= $firstNameUser.' '.$lastNameUser; ?></h2>
                        <div class="lineBottomPseudo">Inscrit le <span id="inscriptdateContener"><?= $createdDateUser; ?></span></div>
                        <a href="javascript:void(0);" id="profilePicCover"><img src="<?= $picUser; ?>" alt="Photo de profil"/></a>
                        <div id="actionAssocProfilHead">
                            <div class="theActionLineBottomAlign">Dernière connexion: <span id="inscriptdateContener"><?= $lastConnectedUser; ?></span></div> &nbsp; &nbsp; 
                            <a href="settings/scripts/logout.php" id="logOutButt" class="lkActionTo">Déconnexion</a>
                        </div>
                    </div>
                    <div class="halfDisplay">
                        <form>
                            <label>
                                <input type="email" class="putMiniShape" name="emailModifUser" id="emailModifUser" placeholder="Email" value="<?= $emailUser; ?>" disabled=true/>
                            </label>
                        </form>
                        <form method="post" id="passUpdateForm" class="userUpdateForm">
                            <h4 class="headerForChange">Changer de mot de passe</h4>
                            <div class="waitingForceLoader"></div>
                            <div id="passUpdateBox">
                                <div id="noErrorTopUpdate" class="noErrorTriggered">Mot de passe modifié avec succès</div>
                                <label>
                                    <input type="password" class="putMiniShape" name="passOldUser" id="passOldUser" placeholder="Ancien mot de passe"/>
                                </label>
                                <div class="spaceMakerCover"><div class="errorDisplayMini" id="passOldUser-error">Mot de passe incorrect</div></div>
                                <label>
                                    <input type="password" class="putMiniShape" name="passModifUser" id="passModifUser" placeholder="Nouveau mot de passe"/>
                            </label>
                            <div class="spaceMakerCover"><div class="errorDisplayMini" id="passModifUser-error">Le mot de passe doit comporter au minimum 6 caractères alphanumériques</div></div>
                            <label>
                                    <input type="password" class="putMiniShape" name="passModifReUser" id="passModifReUser" placeholder="Retapper le nouveau mot de passe"/>
                            </label>
                            <div class="spaceMakerCover"><div class="errorDisplayMini" id="passModifReUser-error">Les mots de passes ne sont pas identiques</div></div>
                            <div class="alignButtBox"><input type="submit" class="buttShapeSet" value="Changer le mot de passe" id="updateUserButt"/></div>
                            </div>
                        </form>
                    </div>
                </div>
        
            </div>
            <div id="picDisplayBox">
                <div class="quitTriggerBg"></div>
                <div id="picContainerDisplay"><div class="annonceDoneSuccess"></div>
                    <div id="picOnlyContener"><img src="<?= $picUser; ?>" alt="Photo de profil" id="dpDisplaySrc"></div>
                    <div id="picMenuAdd"><a href="javascript:void(0);" id="updatePicButt"><i class="fas fa-pen"></i> Changer</a><a href="javascript:void(0);" id="deletePicButt"><i class="fas fa-trash-alt"></i> Supprimer</a></div>
                    <div class="waitingForceLoader"></div>
                    <form method="post" id="picChangerForm" action="" enctype="multipart/form-data">
                        <input type="file" name="pic" id="pic" accept="image/*"/><input type="submit"/>
                    </form>
                </div>
            </div>
        </section>
                </div>
            </div>
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
    						<option value="0">Rôle de l'utilisateur</option>
    						<option value="1">Administrateur</option>
    						<option value="2">Editeur</option>
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
<?php else: ?>
    <div id="connectPanelShow" class="userBlocDisplay">
                <h4 class="topUserAnnoce">Connexion<span class="closeTriggerPseudoButt">&times;</span></h4>
                <form method="post" action="<?= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" class="adminFormClTriggered" id="adminConnectUserForm">
                    <div class="waitingForceLoader"></div>
                    <div id="errorTopConnect" class="errorTriggered">Email ou mot de passe incorrect</div>
                    <label>
                        <input type="text" class="putMiniShape" name="emailOrPseudoUser" id="emailOrPseudoUser" placeholder="Email"/>
                    </label><div class="spaceMakerCover"></div>
                    <label>
                        <input type="password" class="putMiniShape" name="passUser" id="passUser" placeholder="Mot de passe"/>
                    </label><div class="spaceMakerCover"></div>
                    <div class="alignButtBox"><input type="submit" class="buttShapeSet" value="Me connecter" id="connectUserButt"/></div>
                    <div class="subActionInFormBox">
                        <input type="hidden" name="userType" value="ad">
                        <div class="subActionInFormLine">
                            <a href="javascript:void(0);" class="recoverLkButt" id="retrievePass">Mot de passe oublié?</a>
                        </div>
                    </div>
                </form>
               </div>
               <div id="recoverPanelShow" class="userBlocDisplay">
                <h4 class="topUserAnnoce">Récupération de votre mot de passe<span class="closeTriggerPseudoButt">&times;</span></h4>
                <form method="post" action="<?= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" class="adminFormClTriggered" id="adminRecoverUserForm">
                    <div class="waitingForceLoader"></div>
                    <div id="noErrorTopRecover" class="noErrorTriggered">Un email de confirmation vous a été envoyé par email</div>
                    <label>
                        <input type="text" class="putMiniShape" name="emailrecoverUser" id="emailrecoverUser" placeholder="Votre email"/>
                    </label>
                    <div class="spaceMakerCover"></div>
                    <div class="alignButtBox"><input type="submit" class="buttShapeSet" value="Créer le compte" id="recoverUserButt"/></div>
                    <div class="subActionInFormBox">
                        <div class="subActionInFormLine">
                            <a href="javascript:void(0);" class="connectLkButt">Me connecter</a>
                        </div>
                    </div>
                </form>
               </div>
<?php endif; ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script><?php if($redirectAccount){ ?>_getUserAct = true;<?php }else{ ?>_getUserAct = false;<?php } ?></script>
   <script src="src/js/main.js?v=<?= time(); ?>"></script>
   <script src="src/js/admin_main.js?v=<?= time(); ?>"></script>

</body>
</html>

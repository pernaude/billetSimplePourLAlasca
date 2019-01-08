<!doctype html>
<html lang="fr">
<head>
    <?php include_once 'app/views/parts/head.php'?>

    <title><?= HOME_TITLE; ?></title>
</head>

<body>



    <div id="container">
        <?php include_once 'app/views/parts/header.php'?>
        <section class="sectionCl" id="homeDisplay">
        	<div id="titleBookAnnonce">
        		<h1 id="titleBookLineHeader">Billet simple pour l'Alaska</h1>
        		<h2 id="titleBookLineMiniHeader">Le nouveau roman de Jean Forteroche</h2>
        	</div>
    	</section>
    	<section class="sectionCl" id="reaminingDisplay"><div class="page">
    		<div id="globalContainer">
    			<h1 class="sectionHeadeLine">Dernier chapitre</h1>
    			<div id="lastChapiter">
                    <?php if($chapLastTitle !== NULL): ?>
    				<ul class="chaperShortDisplay">
    					<li class="chapterTitleBox">
                            <h4 class="chapNumberAssoc">Chapitre <?= $chapLastNumber; ?></h4>
    						<h2 class="chapTitleLine"><?= $chapLastTitle; ?></h2>
    						<p class="chapDateLine">Publié le <span class="dateSelfDisplay"><?= $chapLastDate; ?></span></p>
    						<a class="showAllChapterButtBig chapTrackerLk" id="chap-select-last-l-<?= $chapLastId; ?>" href="javascript:void(0);">Lire ce chapitre</a>
    					</li>
    					<li class="chapterContentBox"><?= $chapLastContent; ?> ... <a class="showAllChapterButtShort chapTrackerLk" id="chap-select-last-r-<?= $chapLastId; ?>" href="javascript:void(0);">Lire la suite</a></li>
    				</ul>
                <?php endif; ?>
    			</div>
    		</div></div>
    	</section>
    	<section class="sectionCl" id="contact"><div class="page">
    		<h1 class="sectionHeadeLine">Contact</h1>
    				<div class="contactTopDisplay">Veuillez m'envoyer toutes vos requêtes et appréciations et je vous répondrai dans les plus brefs délais.</div>
    				<div class="contactErrorDisplay">Tous les champs sont requis</div>
                    <div class="contactNoErrorDisplay">Votre message a été envoyé avec succès</div>
    				<form id="contactForm" action="<?= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" method="post">
                        <div class="loaderInside"></div>
    					<label class="shortFirstCover theLeftPartAlign">
    						<input class="putShapeAll" type="text" name="contactName" id="contactName" placeholder="Votre nom" required/>
    					</label><label class="shortFirstCover theRightPartAlign">
    						<input class="putShapeAll" type="email" name="contactEmail" id="contactEmail" placeholder="Votre email" required/>
    					</label>
    					<label class="LongFirstCover">
    						<input class="putShapeAll" type="text" name="contactSubject" id="contactSubject" placeholder="Objet de votre message" required/>
    					</label>
    					<label class="LongFirstCover">
    						<textarea class="putShapeAll areaShape" name="contactMessage" id="contactMessage" placeholder="Ecrivez message ici" required></textarea>
    					</label>
    					<div class="butCoverAlign"><input type="submit" class="butShapeGlobal" value="Envoyer votre message"></div>
    				</form>
    			</div>
        </section>
    	<section id="chaptersPlug">
    		<div id="readBoard">
    			<div id="fadeTrapBox"></div>
    			<div id="readerContainer">
    				<div class="page bgShapeDraw" id="contentBoard">
    					<div id="readBoardChapList">
    						<div class="readerTopAnnonce" id="readerTopAnnonce-list">
                                Tous les chapitres
                                <div class="controlLineCover">
                                <a href="javascript:void(0);" class="gotoLastView miniDispoz" id="back-list-lk"><i class="fas fa-arrow-left"></i></a>
                                </div>
    						</div>
    						<div class="readBoardOnlyContainer">
    							<?php foreach($allChapTab as $keytaken => $valAssocTaken): ?>
    								<ul class="chaperShortDisplay spaceMakerBox">
    					                <li class="chapterTitleBox">
    					                	<h4 class="chapNumberAssoc">Chapitre <?= $valAssocTaken['chap_number']; ?></h4>
    						                <a href="javascript:void(0);" id="chap-select-ll-<?= $valAssocTaken['chap_id']; ?>" class="chapTitleLine chapTrackerLk"><?= $valAssocTaken['chap_title']; ?></a>
    						                <p class="chapDateLine">Publié le <span class="dateSelfDisplay"><?= date_rewrite($valAssocTaken['chap_date_created'], true); ?></span></p>
    						                <a class="showAllChapterButtBig chapTrackerLk" id="chap-select-l-<?= $valAssocTaken['chap_id']; ?>" href="javascript:void(0);">Lire ce chapitre</a>
    					                </li>
    					                <li class="chapterContentBox"><?= substr($valAssocTaken['chap_content'],0,800); ?> ... <a class="showAllChapterButtShort chapTrackerLk" id="chap-select-r-<?= $valAssocTaken['chap_id']; ?>" href="javascript:void(0);">Lire la suite</a></li>
    				                </ul>
    			                <?php endforeach ?>
    						</div>
    					</div>
    					<div id="readBoardChapUnikReader">
    						<div class="readerTopAnnonce" id="readerTopAnnonce-unik">
    							<div class="centerChapAnnonceTop" id="ceterShowLaterTop">
    								<div id="chapNumberUnik" class="chapNumberUnikLine">Chapitre <span id="chapNumberInside"></span></div>
    								<div id="chapTitleUnik" class="chapTitleUnikLine"></div>
    								<div id="chapDateUnik" class="chapDateUnikLine">Publié le <span id="chapDateInside"></span></div>
    							</div>
                                <div class="controlLineCover">
                                <a href="javascript:void(0);" class="gotoLastView highDispo" id="back-chap-lk"><i class="fas fa-arrow-left"></i></a>
                                <div id="controlRightBox">
                                <a href="javascript:void(0);" id="previous-chap-lk"><i class="fas fa-angle-left"></i></a><a href="javascript:void(0);" id="next-chap-lk"><i class="fas fa-angle-right"></i></a>
                                </div>
                                </div>
    						</div>
    						<div class="theContentDisplayUnikChap">
    							<div id="chapUnikContentLine" class="contentTextDisplay"></div>
    							<div id="commentBoxShow">
    								<h3 class="topMiniComment"><span id="nbCommentsDisplay">0 Commentaire</span></h3>
                                    <div id="commentStream"></div>
    					            <?php if(!$redirectAccount): ?>
    					                <div id="connectRiquiredLine">
    					                	Vous devez être connecté pour ajouter un commentaire.<br/>
    					                	<a href="javascript:void(0);" class="connectLkButt">Me connecter</a> &nbsp; | &nbsp; 
    					                	<a href="javascript:void(0);" class="createLkButt">Créer un compte</a>
    					                </div>
                                        <?php else: ?>
                                        <form method="post" id="commentAddingForm" class="formClShaped">
                                        <div class="waitingForceLoader"></div>
                                        <div id="noErrorTopComment" class="commentMessageAfter noErrorTriggered">Votre commentaire a été enrégistré avec succès.</div>
                                        <div id="errorTopConnect" class="commentMessageAfter errorTriggered">Le commentaire ne peut être ajouté actuellement</div>
                                        <input type="hidden" name="userComSent" id="userComSent" value="<?= $userActualId?>" />
                                        <input type="hidden" name="chapComAssoc" id="chapComAssoc" />
                                        <input type="hidden" name="chapNbComAssoc" id="chapNbComAssoc" />
                                            <label class="LongFirstCover">
                                                <textarea class="putShapeAll areaShape" name="commentSent" id="commentSent" placeholder="Ajoutez votre commentaire ici"></textarea>
                                            </label>
    					                    <div class="butCoverAlign"><input type="submit" class="butShapeGlobal" value="Ajouter votre commentaire"></div>
    								</form>
                                    <?php endif ?>
    							</div>
    						</div>
    					</div>
    					<div id="theWaitingAnnonceBlock">
    						<div class="readerTopAnnonce" id="readerTopAnnonce-wait">
    							<div id="waitingAnnonceBox">
    								<div class="theMiniAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div><br/><div class="theWideAbbonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div><br/><div class="theHalfAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div>
    							</div>
    						</div>
    						<div class="theWaitingLoaderGlobal">
    							<div id="waitingAnnonceBigBox"><br/><br/>
    								<div class="theMiniAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div><br/><br/><div class="theFullAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div><br/><br/><div class="theFullAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div><br/><br/><div class="theFullAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div><br/><br/><div class="theFullAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
    	<?php if(!$redirectAccount): ?>
    	<section>
    		<div id="messageDisplayCover">
    		   <div id="messageDisplayLoad"></div>
    		   <div id="theTriggerLeave"></div>
    		   <div id="userBoxRun">
    		   	<div id="connectUserBox" class="userAccountCoverBox">
    		   	<h4 class="topUserAnnoce">Connexion<span class="closeTriggerPseudoButt">&times;</span></h4>
    		   	<form method="post" action="<?= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" class="formClTriggered" id="connectUserForm">
    		   		<div id="noErrorTopCreate" class="noErrorTriggered">Compte créé avec succès.<br/>Vous pouvez maintenant vous connecter</div>
    		   		<div id="errorTopConnect" class="errorTriggered">Email, Pseudo ou mot de passe incorrect</div>
    		   		<label>
    		   			<input type="text" class="putMiniShape" name="emailOrPseudoUser" id="emailOrPseudoUser" placeholder="Pseudo ou email"/>
    		   		</label><div class="spaceMakerCover"></div>
    		   		<label>
    		   			<input type="password" class="putMiniShape" name="passUser" id="passUser" placeholder="Mot de passe"/>
    		   		</label><div class="spaceMakerCover"></div>
    		   		<div class="alignButtBox"><input type="submit" class="buttShapeSet" value="Me connecter" id="connectUserButt"/></div>
    		   		<div class="subActionInFormBox">
    		   			<div class="subActionInFormLine">
    		   				<a href="javascript:void(0);" class="recoverLkButt" id="retrievePass">Mot de passe oublié?</a>
    		   			</div> <span class="simpleSepararor">&nbsp; &nbsp; | &nbsp; &nbsp;</span> 
    		   			<div class="subActionInFormLine">
    		   				<a href="javascript:void(0);" class="createLkButt">Créer un compte</a>
    		   			</div>
    		   		</div>
    		   	</form>
    		   </div>
    		   <div id="createUserBox" class="userAccountCoverBox">
    		   	<h4 class="topUserAnnoce">Créer un compte<span class="closeTriggerPseudoButt">&times;</span></h4>
    		   	<form method="post" action="<?= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" class="formClTriggered" id="createUserForm">
    		   		<div id="errorTopCreate" class="errorTriggered">Veuillez corriger les erreurs</div>
    		   		<label>
    		   			<input type="text" class="putMiniShape" name="pseudoCreateUser" id="pseudoCreateUser" placeholder="Pseudo"/>
    		   		</label>
                    <div class="spaceMakerCover">
                        <div class="errorDisplayMini" id="pseudoCreateUser-1-error">Pseudo invalide</div>
                        <div class="errorDisplayMini" id="pseudoCreateUser-2-error">Ce pseudo n'est pas disponible</div>
                    </div>
    		   		<label>
    		   			<input type="email" class="putMiniShape" name="emailCreateUser" id="emailCreateUser" placeholder="Email"/>
    		   		</label>
                    <div class="spaceMakerCover">
                        <div class="errorDisplayMini" id="emailCreateUser-1-error">Email invalide</div>
                        <div class="errorDisplayMini" id="emailCreateUser-2-error">Cet email est déjà utilisé</div>
                    </div>
    		   		<label>
    		   			<input type="password" class="putMiniShape" name="passCreateUser" id="passCreateUser" placeholder="Mot de passe"/>
    		   		</label>
                    <div class="spaceMakerCover">
                        <div class="errorDisplayMini" id="passCreateUser-error">Le mot de passe doit comporter au minimum 6 caractères alphanumériques</div>
                    </div>
    		   		<label>
    		   			<input type="password" class="putMiniShape" name="passCreateReUser" id="passCreateReUser" placeholder="Retapper le mot de passe"/>
    		   		</label>
                    <div class="spaceMakerCover">
                        <div class="errorDisplayMini" id="passCreateReUser-error">Les mots de passes ne sont pas identiques</div></div>
    		   		<div class="alignButtBox"><input type="submit" class="buttShapeSet" value="Créer le compte" id="createUserButt"/></div>
    		   		<div class="subActionInFormBox">
    		   			<div class="subActionInFormLine">
    		   				Déjà un compte? 
    		   				<a href="javascript:void(0);" class="connectLkButt">Me connecter</a>
    		   			</div>
    		   		</div>
    		   	</form>
    		   </div>
    		   <div id="recoverUserBox" class="userAccountCoverBox">
    		   	<h4 class="topUserAnnoce">Récupération de votre mot de passe<span class="closeTriggerPseudoButt">&times;</span></h4>
    		   	<form method="post" action="<?= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" class="formClTriggered" id="recoverUserForm">
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
    		   </div>
    	    </div>
    	</section>
    	<?php else: ?>
    	<section id="dashboard">
    		<div class="insideContent">
    	        <div class="page">
    		        <h1 class="titleHeader">Bienvenue dans votre compte</h1>
    		        <div id="topProfilHead">
    		        	<h2 id="pseudoContener"><?= $pseudoUser; ?></h2>
    		        	<div class="lineBottomPseudo">Inscrit le <span id="inscriptdateContener"><?= $createdDateUser; ?></span></div>
    		        	<a href="javascript:void(0);" id="profilePicCover"><img src="<?= $picUser; ?>" alt="Photo de profil"/></a>
                        <div id="actionAssocProfilHead">
                            <div class="theActionLineBottomAlign">Dernière connexion: <span id="inscriptdateContener"><?= $lastConnectedUser; ?></span></div> &nbsp; &nbsp; 
                            <a href="settings/scripts/logout.php" id="logOutButt" class="lkActionTo">Déconnexion</a>
                        </div>
    		        </div>
    		        <div class="halfDisplay" id="serviceInteractions">
    		            <div id="visitedChapters">
    		            	<h3 class="headerLiner"><?= $visitedChapterMade; ?></h3>
    		            	<div class="theBottomContenerForUserAct">
    		            		<?php foreach ($visitedChapters as $keyTk => $valueTk): ?>
    		            			<a href="javascript:void(0);" class="lineCompte chapTrackerLk" id="chap-select-u-<?= $valueTk['chap_id']; ?>"><i class="fas fa-book-open"></i> &nbsp; Chapitre <?= $valueTk['chap_number']; ?></a>
    		            		<?php endforeach ?>
    		            	</div>
    		            </div>
    		            <div id="commentAdded">
    		            	<h3 class="headerLiner"><?= $addedCommentMade; ?></h3>
    		            	<div class="theBottomContenerForUserAct">
    		            		<?php foreach ($commentsAdded as $keyTk => $valueTk): ?>
    		            			<a href="javascript:void(0);" class="lineCompte chapTrackerLk" id="chap-select-c-<?= $valueTk['comment_chapter']; ?>"><i class="far fa-comment-dots"></i> &nbsp; Commentaire ajouté le <?= date_rewrite($valueTk['comment_add_date'], true); ?> au chapitre <?= $valueTk['comment_chap_number']; ?></a>
    		            		<?php endforeach ?>
    		            	</div>
    		            </div>
    		        </div>
    		        <div class="halfDisplay" id="accountSettings">
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
                <div id="picContainerDisplay"><div class="annonceDoneSuccess"></div><div class="annonceDoneFail"></div>
                    <div id="picOnlyContener"><img src="<?= $picUser; ?>" alt="Photo de profil" id="dpDisplaySrc"></div>
                    <div id="picMenuAdd"><a href="javascript:void(0);" id="updatePicButt"><i class="fas fa-pen"></i> Changer</a><a href="javascript:void(0);" id="deletePicButt"><i class="fas fa-trash-alt"></i> Supprimer</a></div>
                    <div class="waitingForceLoader"></div>
                    <form method="post" id="picChangerForm" action="<?= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
                        <input type="file" name="pic" id="pic" accept="image/*"/><input type="submit"/>
                    </form>
                </div>
            </div>
        </section>
        <?php endif; ?>




    </div>
<script><?php if($redirectAccount){ ?>_getUserAct = true;<?php }else{ ?>_getUserAct = false;<?php } ?></script>
<?php include_once 'app/views/parts/footer.php'?>

</body>
</html>

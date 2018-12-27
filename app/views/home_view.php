<!doctype html>
<html>
<head>

    <?php include_once 'app/views/parts/head.php'?>

    <title><?= ucfirst($page) ?></title>
</head>

<body>



    <div id="container">
        <?php include_once 'app/views/parts/header.php'?>
        <section class="sectionCl" id="homeDisplay">
        	<div id="titleBookAnnonce">
        		<h1 id="titleBookLineHeader">Un billet pour l'Alaska</h1>
        		<h2 id="titleBookLineMiniHeader">Le nouveau roman de Jean Forteroche</h2>
        	</div>
    	</section>
    	<section class="sectionCl" id="reaminingDisplay"><div class="page">
    		<div id="globalContainer">
    			<h1 class="sectionHeadeLine">Dernier chapitre</h1>
    			<div id="lastChapiter">
    				<ul class="chaperShortDisplay">
    					<li class="chapterTitleBox">
    						<h2 class="chapTitleLine"><?= $chapLastTitle; ?></h2>
    						<p class="chapDateLine">Publié le <span class="dateSelfDisplay"><?= $chapLastDate; ?></span></p>
    						<a class="showAllChapterButtBig chapTrackerLk" id="chap-select-last-l-<?= $chapLastId; ?>" href="javascript:void(0);">Lire ce chapitre</a>
    					</li>
    					<li class="chapterContentBox"><?= $chapContent; ?> ... <a class="showAllChapterButtShort chapTrackerLk" id="chap-select-last-r-<?= $chapLastId; ?>" href="javascript:void(0);">Lire la suite</a></li>
    				</ul>
    			</div>
    		</div></div>
    	</section>
    	<section class="sectionCl" id="contact"><div class="page">
    		<h1 class="sectionHeadeLine">Contact</h1>
    				<div class="contactTopDisplay"></div>
    				<div class="contactErrorDisplay"></div>
    				<form id="contactForm" action="">
    					<label class="shortFirstCover theLeftPartAlign">
    						<input class="putShapeAll" type="text" name="contactName" id="contactName" placeholder="Votre nom" />
    					</label><label class="shortFirstCover theRightPartAlign">
    						<input class="putShapeAll" type="text" name="contactEmail" id="contactEmail" placeholder="Votre email" />
    					</label>
    					<label class="LongFirstCover">
    						<input class="putShapeAll" type="text" name="contactSubject" id="contactSubject" placeholder="Objet de votre message" />
    					</label>
    					<label class="LongFirstCover">
    						<textarea class="putShapeAll areaShape" id="contactMessage" placeholder="Ecrivez message ici"></textarea>
    					</label>
    					<div class="butCoverAlign"><input type="submit" class="butShapeGlobal" value="Envoyer votre message"></div>
    				</form>
    			</div>
        </section>
    	<section id="chaptersPlug">
    		<div id="readBoard">
    			<div id="readerContainer">
    				<div class="page bgShapeDraw" id="contentBoard">
    					<div id="readBoardChapList">
    						<h2 class="readerTopAnnonce" id="readerTopAnnonce-list">Tous les chapitres</h2>
    						<div class="readBoardOnlyContainer">
    							<?php foreach($allChapTab as $keytaken => $valAssocTaken): ?>
    								<ul class="chaperShortDisplay spaceMakerBox">
    					                <li class="chapterTitleBox">
    						                <h2 class="chapTitleLine"><?= $valAssocTaken['chap_title']; ?></h2>
    						                <p class="chapDateLine">Publié le <span class="dateSelfDisplay"><?= date_rewrite($valAssocTaken['chap_date_created'], 'short'); ?></span></p>
    						                <a class="showAllChapterButtBig chapTrackerLk" id="chap-select-l-<?= $valAssocTaken['chap_id']; ?>" href="javascript:void(0);">Lire ce chapitre</a>
    					                </li>
    					                <li class="chapterContentBox"><?= substr($valAssocTaken['chap_content'],0,800); ?> ... <a class="showAllChapterButtShort chapTrackerLk" id="chap-select-r-<?= $valAssocTaken['chap_id']; ?>" href="javascript:void(0);">Lire la suite</a></li>
    				                </ul>
    			                <?php endforeach ?>
    						</div>
    					</div>
    					<div id="readBoardChapUnikReader">
    						<h2 class="readerTopAnnonce" id="readerTopAnnonce-unik">
    							<a href="javascript:void(0);" class="gotoLastView" id="back-chap-lk"><i class="fas fa-arrow-left"></i></a>
    							<div id="controlRightBox">
    							<a href="javascript:void(0);" id="previous-chap-lk"><i class="fas fa-angle-left"></i></a><a href="javascript:void(0);" id="next-chap-lk"><i class="fas fa-angle-right"></i></a>
    						    </div>
    							<div class="centerChapAnnonceTop" id="ceterShowLaterTop">
    								<div id="chapNumberUnik" class="chapNumberUnikLine">Chapitre <span id="chapNumberInside"></span></div>
    								<div id="chapTitleUnik" class="chapTitleUnikLine"></div>
    								<div id="chapDateUnik" class="chapDateUnikLine">Publié le <span id="chapDateInside"></span></div>
    							</div>
    						</h2>
    						<div class="theContentDisplayUnikChap">
    							<div id="chapUnikContentLine" class="contentTextDisplay"></div>
    							<div id="commentBoxShow">
    								<h3 class="topMiniComment">0 Commentaire</h3>
    								<form>
    									
    					                <label class="LongFirstCover">
    						                <textarea class="putShapeAll areaShape" id="contactMessage" placeholder="Ajoutez votre commentaire ici"></textarea>
    					                </label>
    					                <div class="butCoverAlign"><input type="submit" class="butShapeGlobal" value="Ajouter votre commentaire"></div>
    								</form>
    							</div>
    						</div>
    					</div>
    					<div id="theWaitingAnnonceBlock">
    						<h2 class="readerTopAnnonce" id="readerTopAnnonce-wait">
    							<div id="waitingAnnonceBox">
    								<div class="theMiniAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div><br/><div class="theWideAbbonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div><br/><div class="theHalfAnnonceWait thelineContener"><div class="theGlowingLine">&nbsp;</div></div>
    							</div>
    						</h2>
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
    	<section>
    		<div id="messageDisplayCover">
    		   <div id="messageDisplayLoad"></div>
    	    </div>
    	</section>




    </div>

<?php include_once 'app/views/parts/footer.php'?>

</body>
</html>

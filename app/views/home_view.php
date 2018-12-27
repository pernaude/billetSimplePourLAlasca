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
    						<h2 class="chapTitleLine"><?= $chapTitle; ?></h2>
    						<p class="chapDateLine">Publié le <span class="dateSelfDisplay"><?= $chapDate; ?></span></p>
    						<a class="showAllChapterButtBig" href="javascript:void(0);">Lire ce chapitre</a>
    					</li>
    					<li class="chapterContentBox"><?= $chapContent; ?> ... <a class="showAllChapterButtShort" href="javascript:void(0);">Lire la suite</a></li>
    				</ul>
    			</div>
    		</div></div>
    	</section>
    	<section class="sectionCl" id="contactBlock"><div class="page">
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
    		<div id="readBoard"></div>
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

<?php

/**
*  Class Chapter
*  Gestion des chapitres ( Ajouter, Lire, Modifier, Supprimer )
*  Retourne aussi les commentaires et sous-commentaires associés à un chapitre
*
*/

class Chapter {
	
	
	private $commentId;
	private $errorCatch = 0;

	
	public function __construct($id){

		if((int) $id >= 1){
			$this->commentId = $id;

			
			

		}
		

		
	}



		static function addComment($chapId, $chapNb, $content, $author, $ifSub, $subAuthor ){
		
		global $db;

		try{
			$insertTrack = $db->execute('INSERT INTO comments_set (comment_chapter, comment_chap_number, comment_content, comment_author, comment_if_sub, comment_sub_author, comment_if_visible, comment_if_deleted, comment_if_waiting, comment_if_reported, comment_add_date ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$chapId, $chapNb, $content, $author, $ifSub, $subAuthor, 1, 0, 0, 0, date('Y-m-d H:i:s')]);
		}catch(PDOException $error){
			$this -> errorCatch = 1;



		}
	}



}


	?>
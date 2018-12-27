<?php

/**
*  Class Chapter
*  Gestion des chapitres ( Ajouter, Lire, Modifier, Supprimer )
*  Retourne aussi les commentaires et sous-commentaires associés à un chapitre
*
*/

class Chapter {
	
	
	private $chapId;
	private $chapNumberPlace;
	private $chapTitle;
	private $chapSummary;
	private $chapContent;
	private $chapState;
	private $chapPublishDate;
	private $chapCreatedDate;
	private $nbComments;
	private $nbChapters;
	private $errorCatch = 0;

	
	public function __construct($id){

		if((int) $id >= 1){
			$this->chapId = $id;

			try{

			global $db;

			$retrievedTrack = $db -> fetch('SELECT chap.* FROM chapter_set chap WHERE chap.chap_id = ?', [$id], false);


			$this -> chapTitle = $retrievedTrack['chap_title'];
			$this -> chapNumberPlace = $retrievedTrack['chap_number'];
			$this -> chapSummary = $retrievedTrack['chap_summary'];
			$this -> chapContent = $retrievedTrack['chap_content'];
			$this -> chapAuthor = $retrievedTrack['chap_author'];
			$this -> chapState = $retrievedTrack['chap_if_publish'];
			$this -> chapPublishDate = $retrievedTrack['chap_date_publish'];
			$this -> chapCreatedDate = $retrievedTrack['chap_date_created'];
			
			$nbCommentsOnIt = $db -> fetch('SELECT com.* FROM comments_set com  WHERE com.comment_chapter = ?', [$id], true);

			$this -> nbComments= $db -> getCountRequest();


			}catch(PDOException $error){

			$this -> errorCatch = 1;
		}
			

		}
		

		
	}
	
	static function checkChapterAdding($title, $chapNumber, $content, $activeUser ){
		
		global $db;

		try{
			$insertTrack = $db->execute('INSERT INTO chapter_set (chap_title, chap_number, chap_content, chap_author, chap_if_publish, chap_date_publish, chap_date_created) VALUES(?, ?, ?, ?, ?, ?, ?)', [$title, $chapNumber, $content, $activeUser, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
		}catch(PDOException $error){
			$this -> errorCatch = 1;



		}
			
			
		
	}






	
	static function checkCommentAdding($chapter, $content, $author, $ifSub, $subAuthor ){
		
		global $db;

		try{
			$insertTrack = $db->execute('INSERT INTO comments_set (comment_chapter, comment_content, comment_author, comment_if_sub, comment_sub_author, comment_if_visible, comment_if_deleted, comment_if_waiting, comment_if_reported, comment_add_date ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$chapter, $content, $author, $ifSub, $subAuthor, 1, 0, 0, 0, date('Y-m-d H:i:s')]);
		}catch(PDOException $error){
			$this -> errorCatch = 1;



		}
	}



	static function checkUserAdding($role, $firstName, $lastName, $pseudo, $email, $pass, $dateEnr ){
		
		global $db;

		try{
			$insertTrack = $db->execute('INSERT INTO users_set (user_role, user_firstname, user_lastname, user_pseudo, user_email, user_pass, user_date_save) VALUES(?, ?, ?, ?, ?, ?, ?)', [$role, $firstName, $lastName, $pseudo, $email, $pass, $dateEnr]);
		}catch(PDOException $error){
			$this -> errorCatch = 1;

		}
	}
		
			
			
		
	






	
	static function saveChapter(){
		
		
		
	}
	
	static function getChapter(){
		
		
		
	}
	

	
	public function getAllChapters($nbRows = 0){
		
			try{

			global $db;
			$requestStr = '';

			if((int) $nbRows > 0){ $requestStr = " LIMIT $nbRows"; }

			$retrievedTrack = $db -> fetch('SELECT chap.* FROM chapter_set chap '.$requestStr, [], true);


			return $retrievedTrack;


			}catch(PDOException $error){
				return ($error -> getMessage());
			
		}	
	}



	static function getLastChapter(){
		
			try{

			global $db;

			$retrievedTrack = $db -> fetch('SELECT chap.* FROM chapter_set chap ORDER BY chap_id DESC LIMIT 1', [], false);


			return $retrievedTrack;


			}catch(PDOException $error){
				return ($error -> getMessage());
			
		}	
	}

	public function getChapTitle(){

		return ($this -> chapTitle);
	}
	public function getchapNumberPlace(){
		return ($this -> chapNumberPlace);
	}
	public function getChapSummary(){

		return ($this -> chapSummary);
	}
	public function getChapContent(){

		return ($this -> chapContent);
	}
	public function getChapAuthor(){

		return ($this -> chapAuthor);
	}
	public function getChapPublishDate(){

		return ($this -> chapPublishDate);
	}
	public function getChapcreatedDate(){

		return ($this -> chapCreatedDate);
	}
	public function getNbComments(){

		return ($this -> nbComments);
	}
	public function getNbChapters(){

		return ($this -> nbChapters);
	}
	public function getErrorCatch(){

		return ($this -> errorCatch);
	}
		
	
	
	
	
}






























?>
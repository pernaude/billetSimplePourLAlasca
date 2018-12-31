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


	public function checkIfReadChapter($userId, $chapId){
        	global $db;


        	try{
        	$userReadChapOrNot = $db -> execute('SELECT chap_id FROM chapter_set  WHERE chap_id = ? AND chap_visited LIKE ?', [$chapId, '%-'.$userId.'-%']);

			if($db -> getCountRequest() == 0){
			    $db -> execute('UPDATE chapter_set SET chap_visited = concat(chap_visited, ?)  WHERE chap_id = ?', ['-'.$userId.'-', $chapId]);
		    }


			}catch(PDOException $error){

			$this -> errorCatch = $error ->getMessage();
			return false;
		}
        }


		
		

	public function getSiblingChap($chapActuSend, $direction){
		try{

			global $db;

			$chapActuSend = (int) $chapActuSend;
			if($direction == "n"){
				$directGo = ">";
				$orderCount = "ASC";
			}else{
				$directGo = "<";
				$orderCount = "DESC";
			}

			$retrievedTrack = $db -> fetch('SELECT chap.* FROM chapter_set chap WHERE chap_number '.$directGo.' ? ORDER BY chap_number '.$orderCount.' LIMIT 1', [$chapActuSend], false);


			return $retrievedTrack;


			}catch(PDOException $error){
				return ($error -> getMessage());
			
		}	
	}


	public function getAllChapters($nbRows = 0){
		
			try{

			global $db;
			$requestStr = '';

			if((int) $nbRows > 0){ $requestStr = " LIMIT $nbRows"; }

			$retrievedTrack = $db -> fetch('SELECT chap.* FROM chapter_set chap ORDER BY chap_number DESC'.$requestStr, [], true);


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
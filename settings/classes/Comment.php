<?php

/**
*  Class Chapter
*  Gestion des chapitres ( Ajouter, Lire, Modifier, Supprimer )
*  Retourne aussi les commentaires et sous-commentaires associés à un chapitre
*
*/

class Comment {
	
	
	private $commentId;
	private $errorCatch = 0;

	
	public function __construct($id){

		if((int) $id >= 1){
			$this->commentId = $id;

			
			

		}
		

		
	}

     /**
     * Retrieve all chapters
     * @param int $chapId chapter Id
     * @param boolean $getAllStates if want to retrieve reported and/or not reported comment
     * @param boolean $getReported retrieve only reported or not reported
     * @param boolean $short retrieve just the main columns
     */

	static function getAllComments($byChapter = true, $getAllStates = false, $getReported = false, $chapId, $short = false){
		global $db;
		$insertTrack = [];
		try{
			if($byChapter){
				$suiteRequest = "WHERE com.comment_chapter = ?";
				$valuesAssoc = [$chapId];
				$intersectLink = " AND ";
			}else{
				$suiteRequest = " WHERE ";
				$valuesAssoc = [];
				$intersectLink = "";
			}
			
			
			if($getAllStates){
				$completeCondiTion = '';
				$intersectLink = '';
			}else{
			if($getReported){
				$completeCondiTion = $intersectLink." com.comment_if_reported = ?";
				$valuesAssoc[] = 1;
			}else{
				$completeCondiTion = $intersectLink." com.comment_if_reported = ?";
				$valuesAssoc[] = 0;
			}
		    }
			if(!$short){
				$shortLk = 'com.comment_id, com.comment_chapter, com.comment_chap_number, com.comment_content, com.comment_author, com.comment_report_content, com.comment_reported_author, com.comment_add_date, user.user_pseudo, user.user_dp';
			}else{
				$shortLk = 'com.*';
			}

			
			$insertTrack = $db->fetch('SELECT '.$shortLk.' FROM comments_set com INNER JOIN users_set user ON com.comment_author = user.user_id '.$suiteRequest.$completeCondiTion, $valuesAssoc, true);
		}catch(PDOException $error){
			$this -> errorCatch = 1;
		}
		return $insertTrack;
	}



		static function addComment($chapId, $chapNb, $content, $author, $ifSub, $subAuthor ){
		
		global $db;

		try{
			$insertTrack = $db->execute('INSERT INTO comments_set (comment_chapter, comment_chap_number, comment_content, comment_author, comment_if_sub, comment_sub_author, comment_if_visible, comment_if_deleted, comment_if_waiting, comment_if_reported, comment_add_date ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$chapId, $chapNb, $content, $author, $ifSub, $subAuthor, 1, 0, 0, 0, date('Y-m-d H:i:s')]);
		}catch(PDOException $error){
			$this -> errorCatch = 1;



		}
	}

	static function reportComment($commentId, $authorId, $reportContent){
		global $db;
		try{
			$insertTrack = $db->execute('UPDATE comments_set SET comment_if_reported = ?, comment_reported_author = ?, comment_report_content = ? WHERE comment_id = ?', [1, $authorId, $reportContent, $commentId]);
		}catch(PDOException $error){
			$this -> errorCatch = 1;
		}
	}

	static function cancelReportComment($commentId){
		global $db;
		try{
			$insertTrack = $db->execute('UPDATE comments_set SET comment_if_reported = ?, comment_reported_author = ?, comment_report_content = ? WHERE comment_id = ?', [0, 0, '', $commentId]);
		}catch(PDOException $error){
			$this -> errorCatch = 1;
		}
	}

	public function deleteComment($commentId){
		global $db;
		try{
			$insertTrack = $db->execute('DELETE FROM comments_set WHERE comment_id = ?', [$commentId]);
			return true;
		}catch(PDOException $error){
			$this -> errorCatch = 1;
			return false;
		}
	}

	static function actionOnReportedComment($comId, $actOnComment){
		global $db;
		$returnValue = false;

		
               
		try{
			if($actOnComment == 'c'){
				
			    $insertTrack = $db->execute('UPDATE comments_set SET comment_if_reported = ?, comment_reported_author = ?, comment_report_content = ?  WHERE comment_id = ?', [0, 0, NULL, $comId], false);
			    $returnValue = true;
		    }if($actOnComment == 'd'){
		    	$insertTrack = $db->execute('DELETE FROM comments_set WHERE comment_id = ?', [$comId]);
                	$returnValue = true;
		    }
		}catch(PDOException $error){
		}

		return $returnValue;

	}



}


	?>
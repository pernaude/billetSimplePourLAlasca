<?php



class User{
        private $idUser;
        private $pseudoUser;
        private $firstNameUser;
        private $lastNameUser;
        private $emailUser;
        private $roleUser;
        private $dateCreatedUser;
        private $lastConnected;
        private $picUser;
        private $nbVisitedChapters;
        private $visitedChapter;
        private $nbCommentsAdded;
        private $commentsAdded;
        private $ifError = 1;
        private $errorCatch = '';


        public function __construct($id){


        	if((int) $id >= 1){
        		$id = (int) $id;

			try{

			global $db;

			$retrievedTrack = $db -> fetch('SELECT * FROM users_set WHERE user_id = ?', [$id], false);


			$this -> idUser = $retrievedTrack['user_id'];
			$this -> pseudoUser = $retrievedTrack['user_pseudo'];
			$this -> emailUser = $retrievedTrack['user_email'];
			$this -> roleUser = $retrievedTrack['user_role'];
			$this -> lastConnected = $retrievedTrack['user_last_connected'];
			$this -> dateCreatedUser = $retrievedTrack['user_date_save'];
			$this -> firstNameUser = $retrievedTrack['user_firstname'];
			$this -> lastNameUser = $retrievedTrack['user_lastname'];
			$this -> picUser = $retrievedTrack['user_pic'];
			$this -> fetchUserVisitedChapter($id);
			$this -> fetchUserComments($id);
			
			
			$this -> ifError = 0;


			}catch(PDOException $error){

			$this -> errorCatch = $error ->getMessage();
		}


        }
        }



        private function fetchUserComments($id){
        	global $db;

        	try{
        	$visitedChapterFetch = $db -> fetch('SELECT comment_id,comment_chapter,comment_chap_number,comment_content,comment_add_date FROM comments_set  WHERE comment_author = ? ORDER BY comment_add_date DESC', [$id], true);

			$this -> nbCommentsAdded = $db -> getCountRequest();
			$this -> commentsAdded = $visitedChapterFetch;
			}catch(PDOException $error){

			$this -> errorCatch = $error ->getMessage();
		}
        }

        private function fetchUserVisitedChapter($id){
        	global $db;

        	try{
        	$nbCommentsFetch = $db -> fetch('SELECT chap_id,chap_number FROM chapter_set  WHERE chap_visited LIKE ?', ['%-'.$id.'-%'], true);

			$this -> nbVisitedChapters = $db -> getCountRequest();
			$this -> visitedChapter = $nbCommentsFetch;


			}catch(PDOException $error){

			$this -> errorCatch = $error ->getMessage();
		}
        }
        

        public function userGlobal(){
        	$returnJsonObj = ["if_error" => $this -> ifError, "error" => $this -> errorCatch, "id" => $this -> idUser, "pseudo" => $this -> pseudoUser, "first_name" => $this -> firstNameUser, "last_name" => $this -> lastNameUser, "email" => $this -> emailUser, "pic" => $this -> picUser, "role" => $this -> roleUser, "date_last_connected" => $this -> lastConnected, "date_created" => $this -> dateCreatedUser, "chapters_visited" => $this -> visitedChapter, "comments_added" => $this -> commentsAdded, "number_chapters_visited" => $this -> nbVisitedChapters, "number_comments_added" => $this -> nbCommentsAdded];
        	return ($returnJsonObj);

        }



        static function checkUser($emailGot, $pseudoGot){
        	global $db;
        	$newEmail = false; $newPseudo = false; $errorCatch = []; $returnTab = [];

        	try{
			$insertTrack = $db->execute('SELECT user_id FROM users_set WHERE user_email = ?', [$emailGot]);
			if($db -> getCountRequest() == 0){
				$newEmail = true;
			}
		    }catch(PDOException $error){
			$errorCatch[] = $error->getMessage();

		    }
		    try{
			$insertTrack = $db->execute('SELECT user_id FROM users_set WHERE user_pseudo = ?', [$pseudoGot]);
			if($db -> getCountRequest() == 0){
				$newPseudo = true;
			}
		    }catch(PDOException $error){
			$errorCatch[] = $error->getMessage();
		    }
		    $returnTab['error'] = $errorCatch;
		    $returnTab['if_new_email'] = $newEmail;
		    $returnTab['if_new_pseudo'] = $newPseudo;
            return ($returnTab);
		}



		static function checkCredentials($emailOrPseudoGot, $passGot, $userType){
			global $db;
			$userExists = false; $newPseudo = false; $errorCatch = ''; $returnTab = [];
			try{
			$insertTrack = $db->execute('SELECT user_pass, user_date_save FROM users_set WHERE (user_email = ? OR user_pseudo = ?)', [$emailOrPseudoGot, $emailOrPseudoGot]);
			if($db -> getCountRequest() == 1){
				$insertTrackFetch = $db->fetch('SELECT user_pass, user_date_save FROM users_set WHERE (user_email = ? OR user_pseudo = ?)', [$emailOrPseudoGot, $emailOrPseudoGot], false);
				$passRetrieve = $insertTrackFetch['user_pass'];
				$dateRetrieve = $insertTrackFetch['user_date_save'];
				if($passRetrieve === sha1($dateRetrieve.$passGot.$dateRetrieve)){
					$userExists = true;
				}
				
			}
		    }catch(PDOException $error){
			$errorCatch = $error->getMessage();

		    }
		    return ($userExists);
		}





        
        static function saveUser($role, $firstName, $lastName, $pseudo, $email, $pass, $dateEnr ){
		
		global $db;

		try{
			$insertTrack = $db->execute('INSERT INTO users_set (user_role, user_firstname, user_lastname, user_pseudo, user_email, user_pass, user_last_connected, user_date_save) VALUES(?, ?, ?, ?, ?, ?, ?, ?)', [$role, $firstName, $lastName, $pseudo, $email, $pass, $dateEnr, $dateEnr]);
		}catch(PDOException $error){
			$this -> errorCatch = 1;

		}
	    }



	    public function getIdUser(){
	    	return ($this -> idUser);
	    }
	    public function getPseudoUser(){
	    	return ($this -> pseudoUser);
	    }
	    public function getFirstNameUser(){
	    	return ($this -> firstNameUser);
	    }
	    public function getLastNameUser(){
	    	return ($this -> lastNameUser);
	    }
	    public function getEmailUser(){
	    	return ($this -> emailUser);
	    }
	    public function getLastConnected(){
	    	return ($this -> lastConnected);
	    }
	    public function getDateCreatedUser(){
	    	return ($this -> dateCreatedUser);
	    }
	    public function getPicUser(){
	    	return ($this -> picUser);
	    }
	    public function getRoleUser(){
	    	return ($this -> roleUser);
	    }
	    public function getNbCommentsAdded(){
	    	return ($this -> nbCommentsAdded);
	    }
	    public function getNbVisitedChapters(){
	    	return ($this -> nbVisitedChapters);
	    }
	    public function getVisitedChapter(){
	    	return ($this -> visitedChapter);
	    }
	    public function getCommentsAdded(){
	    	return ($this -> commentsAdded);
	    }
	    public function getErrorCatch(){
	    	return ($this -> errorCatch);
	    }
	    public function getIfError(){
	    	return ($this -> ifError);
	    }

	







}
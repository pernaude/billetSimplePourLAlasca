<?php
/**
 * Class Dbase
 * cette classe permet de créer des requêtes SQL faciles avec PDO
 */
class Dbase{
    private $db;
    private $countRequest;
    /**
     * Connection à la base de données
     * @param $dbhost
     * @param $dbname
     * @param $dbuser
     * @param $dbpswd
     */
    public function __construct($dbhost, $dbname, $dbuser, $dbpswd){
        $this->db = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpswd);
    }
    /**
     * Execute une requête SQL
     * @param string $request ( Resuête SQL )
     * @param array|null $values ( Optionnelles )
     * @return PDOStatement ( Retourne un Objet PDO )
     */
    private function exec($request, $values = null){
        try{
        $req = $this->db->prepare($request);
        $req->execute($values);
        return $req;
         }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /**
     * Definit le mode de récupération des données
     * @param int $fetchMode ( Mode de récupération des données: Nombre ) 
     */
    public function setFetchMode($fetchMode){
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $fetchMode);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * Execute une requête SQL et retourne l'état
     * @param string $request ( Requête SQL )
     * @param array|null $values ( Optionnelles )
     * @return bool ( Retoune un boolean donc true ou false )
     */
    public function execute($request, $values = array(), $countRow = true){
        try{
        $results = self::exec($request, $values);
        if($countRow){
        $this -> countRequest = $results-> rowCount();
        }
        return ($results) ? true : false;
    }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /**
     * Execute une requête SQL et retourne des lignes de données
     * @param string $request ( Requête SQL )
     * @param array|null $values ( Optionnelles )
     * @param bool $all ( Définit si on veut une ligne de résultat ou plusieurs )
     * @return array|mixed Return data
     */
    public function fetch($request, $values = null, $all = true) {
        $results = self::exec($request, $values);
        if($all){ $returnValue = $results->fetchAll(); $this -> countRequest = $results-> rowCount(); }else{ $returnValue = $results->fetch();
 }
        return ($returnValue);
    }

    public function getCountRequest(){
        return ($this -> countRequest);
    }
}
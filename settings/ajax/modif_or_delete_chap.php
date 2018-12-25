<?php
include_once '../functions/functions.php';
require_once '../classes/Dbase.php';
require_once '../classes/Chapter.php';



if(isset($_GET['q'])){

$q = (int) str_cleaner($_GET['q']);

$responseConstitute = array();

echo json_encode($responseConstitute);

}else{
	echo "do";
}


?>
<? 

include("diary.php");

$postdata = file_get_contents("php://input");
$aDados = json_decode($postdata);

extract($_GET);


$codusuario = '1';


$Diary = new Diary();

if ($funcao == 'insertAcontecimento') {	
	$Diary->$funcao($codusuario, $acontecimento, $color);
} else if($funcao == 'getAcontecimentosByUser'){
	$Diary->$funcao($codusuario);
} else if($funcao == 'insertLike'){
	$Diary->$funcao($codusuario, $codacontecimento);
} else if($funcao == 'removeLike'){
	$Diary->$funcao($codusuario, $codacontecimento);
}


?>
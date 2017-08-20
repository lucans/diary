<?

class Diary{

	private $link;

	public function __construct(){	
		// $this->link = mysqli_connect("localhost","root","","db_diary");

	 	if ($_SERVER['DOCUMENT_ROOT'] == 'C:/xampp/htdocs') {
		    $this->link = mysqli_connect("localhost","root","","db_diary");
		} else {
		    $this->link = mysqli_connect('mysql.hostinger.com.br','u709177649_diary','Nb4eqRQelSa4','u709177649_diary');
		}

	}

	public function insertAcontecimento($codusuario, $acontecimento, $color){

		$sQuery = "INSERT INTO acontecimentos SET acontecimento = '" . utf8_decode($acontecimento) . "', data = NOW(), codusuario = '" . $codusuario . "', color = '" . $color . "' ";

		mysqli_query($this->link, $sQuery); 
		unset($sWhere);		

	}

	public function insertLike($codusuario, $codacontecimento){

		$sQuery = "UPDATE acontecimentos SET likes = likes + 1 WHERE codacontecimento = '" . $codacontecimento . "' ";

		mysqli_query($this->link, $sQuery); 
		unset($sWhere);		

	}

	public function removeLike($codusuario, $codacontecimento){

		$sQuery = "UPDATE acontecimentos SET likes = likes - 1 WHERE codacontecimento = '" . $codacontecimento . "' ";

		mysqli_query($this->link, $sQuery); 
		unset($sWhere);		

	}


	public function getAcontecimentosByUser($codusuario){

		$sQuery = "SELECT * FROM acontecimentos WHERE codusuario = '" . $codusuario . "' ORDER BY data DESC";		

		$oStmt = mysqli_query($this->link, $sQuery); 

		$aResult = array();				

		while($oResult = mysqli_fetch_assoc($oStmt)){

			$auxData = explode(' ', $oResult['data']);
			$aData = $auxData[0];
			$aHora = $auxData[1];

			$aData = implode('/', array_reverse(explode('-', $aData)));			

			$oResult['data'] = $aData;
			$oResult['hora'] = $aHora;


			// CORES
			$randomNum = rand(1, 12);

			$Colors = array();
			$Colors[0] = "primary";
			$Colors[1] = "primary";
			$Colors[2] = "secondary";
			$Colors[3] = "success";
			$Colors[4] = "danger";
			$Colors[5] = "warning";
			$Colors[6] = "info";
			$Colors[7] = "dark";

			$Colors[8] = "purple";
			$Colors[9] = "indigo";
			$Colors[10] = "purple";
			$Colors[11] = "teal";
			$Colors[12] = "cyan";	

   
			$oResult['color'] = $Colors[$randomNum];

			$oResult['acontecimento'] = utf8_encode($oResult['acontecimento']);


			array_push($aResult, $oResult);
		}
		
		$aResult = $aResult;
		
		unset($sWhere);	

		echo json_encode($aResult);
	}

	public function getAcontecimentos(){

		$sQuery = "SELECT * FROM acontecimentos";		

		$oStmt = mysqli_query($this->link, $sQuery); 

		$aResult = array();				

		while($oResult = mysqli_fetch_assoc($oStmt)){
			array_push($aResult, ArrayEncode($oResult));
		}
		
		$aResult = $aResult;
		
		unset($sWhere);
		
		echo json_encode($aResult);

	}

	// public function getCol($tamanho_texto){

	// 	if ($tamanho_texto <= 6) {
	// 		return '2';
	// 	} else if($tamanho_texto > 6 && $tamanho_texto <= 15){
	// 		return '3';
	// 	} else if($tamanho_texto > 15 && $tamanho_texto <= 30){
	// 		return '6';
	// 	} else if($tamanho_texto > 30){
	// 		return '12';
	// 	}

	// }

}

?>
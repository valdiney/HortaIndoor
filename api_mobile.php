<?php 
header('Access-Control-Allow-Origin: *');
require_once('config.php');

if (isset($_GET['laisi_key']) AND $_GET['laisi_key'] == "laisiabfjk") {
    
    # ==================================================
    # RETORNA DADOS POR HORA
    # ==================================================
	if (isset($_GET['data_sensor_por_hora'])) {

		# Busca os dados de sensores por hora
		function dadosSensorPorHora($db, $opcao) {

		  $query = $db->prepare("SELECT id, valor AS VALOR, DATE_FORMAT(data_cadastro, '%H:%i') AS HORA
		        FROM horta_sensor WHERE tipo_sensor = ?
		        GROUP BY id,  HORA, VALOR ORDER BY id DESC LIMIT 10"
		  );

		  $query->execute(array($opcao));
		  $linha = $query->fetchAll(PDO::FETCH_OBJ);
		  
		  echo json_encode($linha);
		}

		return dadosSensorPorHora($db, $_GET['opcao']);

	}
    
    # ==================================================
    # RETORNA DADOS POR PERIODO DE DATA
    # ==================================================

	if (isset($_GET['data_sensor_por_data'])) {

		# Busca os dados de sensores por intervalo de datas
		function dadosSensorPorData($db, $de, $ate, $tipo_sensor) {

		  $query = $db->prepare("SELECT id, valor AS VALOR, DATE_FORMAT(data_cadastro, '%H:%i') AS HORA, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS DATA
		        FROM horta_sensor WHERE DATE(data_cadastro) BETWEEN ? AND ? AND tipo_sensor = ?
		        GROUP BY id, HORA, VALOR, DATA ORDER BY id DESC"
		  );

		  $query->execute(array($de, $ate, $tipo_sensor));
		  $linha = $query->fetchAll(PDO::FETCH_OBJ);

		  echo json_encode($linha);
		}

		$de = $_GET['de'];
		$ate = $_GET['ate'];
		$tipo_sensor = $_GET['tipo_sensor'];

		return dadosSensorPorData($db, $de, $ate, $tipo_sensor);

	}

} else {
	echo "Erro, voce nao pode acessar essa URL";
}
<?php 
require_once('config.php');

if (isset($_GET['laisi_key']) AND $_GET['laisi_key'] == "laisiabfjk") {

	$tipo_sensor = $_GET['tipo_sensor'];   
	$sensor_local = $_GET['sensor_local'];
	$valor = $_GET['valor'];
	$data_cadastro = date('Y-m-d H:i:s');

	function cadastrar($db, $tipo_sensor, $sensor_local, $valor, $data_cadastro)
	{
	  $gravar = $db->prepare("INSERT INTO horta_sensor(tipo_sensor, sensor_local, valor, data_cadastro) VALUES(?,?,?,?)");
	  return $gravar->execute(array($tipo_sensor, $sensor_local, $valor, $data_cadastro));
	}

	$cadastrar = cadastrar($db, $tipo_sensor, $sensor_local, $valor, $data_cadastro);

	if ($cadastrar) {
		echo "Cadastrado com Sucesso";
	} else {
		echo "Erro ao Cadastrar";
	}

} else {
	echo "Erro, voce nao pode acessar essa URL";
}
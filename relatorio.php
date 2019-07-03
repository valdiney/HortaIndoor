<?php 
# Busca os dados de sensores por hora
function dadosSensorPorHora($db, $opcao) {
  $query = $db->prepare(
    "SELECT id, valor AS VALOR, DATE_FORMAT(data_cadastro, '%H:%i') AS HORA
    FROM horta_sensor WHERE tipo_sensor = ?
    GROUP BY id,  HORA, VALOR ORDER BY id DESC LIMIT 10"
  );

  $query->execute(array($opcao));
  $linha = $query->fetchAll(PDO::FETCH_OBJ);
  return $linha;
}

# Busca os dados de sensores por intervalo de datas
function dadosSensorPorData($db, $de, $ate, $tipo_sensor) {
  $query = $db->prepare(
    "SELECT id, valor AS VALOR, DATE_FORMAT(data_cadastro, '%H:%i') AS HORA, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS DATA
    FROM horta_sensor WHERE DATE(data_cadastro) BETWEEN ? AND ? AND tipo_sensor = ?
    GROUP BY id, HORA, VALOR, DATA ORDER BY id DESC"
  );

  $query->execute(array($de, $ate, $tipo_sensor));
  $linha = $query->fetchAll(PDO::FETCH_OBJ);
  return $linha;
}

function legendasUmidade($umidade) {
  if ($umidade < 500) {
    return "<span style='color:#0066cc'>Umido</span>";
  }

  if ($umidade >= 500 AND $umidade <= 700) {
    return "<span style='color:#009933'>Moderado</span>";
  }

  if ($umidade > 700) {
    return "<span style='color:#996633'>Seco</span>";
  }
}

function legendaUmidadeAmbiente($umidade) {
  if ($umidade >= 60 AND $umidade <= 90) {
    return "<span style='color:#009933'>Adequada</span>";
  } else {
    return "<span style='color:#666666'>Ruim</span>";
  }
}

function porcentagemUmidadeAmbiente($db) {
  $query = $db->prepare(
    "SELECT CASE 
    WHEN valor >= 60 AND valor <= 90 THEN 'Adequada' ELSE 'Ruim' END AS Situacao,
    COUNT(*) AS Quantidade
    FROM horta_sensor WHERE tipo_sensor = 'umidade_ambiente'
    GROUP BY Situacao"
  );

  $query->execute();
  $linha = $query->fetchAll(PDO::FETCH_OBJ);

  $adequada = false;
  $ruim = false;

  foreach ($linha as $dataSensor) {
    if ($dataSensor->Situacao == "Adequada") {
      $adequada = $dataSensor->Quantidade;
    } else if ($dataSensor->Situacao == "Ruim") {
      $ruim = $dataSensor->Quantidade;
    }
  }

  return [
    "adequada" => ($adequada + $ruim) * $adequada / 100,
    "ruim" => ($adequada + $ruim) * $ruim / 100
  ];

}

function porcentagemUmidadeSolo($db) {
  $query = $db->prepare(
    "SELECT CASE
    WHEN valor < 500 THEN 'Umido'
    WHEN valor >= 500 AND valor <= 700 THEN 'Moderado'
    WHEN valor > 700 THEN 'Seco'
    END AS Situacao,
    COUNT(*) AS Quantidade
    FROM horta_sensor WHERE tipo_sensor = 'umidade_solo'
    GROUP BY Situacao"
  );

  $query->execute();
  $linha = $query->fetchAll(PDO::FETCH_OBJ);

  $umido = false;
  $moderado = false;
  $seco = false;

  foreach ($linha as $dataSensor) {
    if ($dataSensor->Situacao == "Umido") {
      $umido = $dataSensor->Quantidade;
    } else if ($dataSensor->Situacao == "Moderado") {
      $moderado = $dataSensor->Quantidade;
    } else if ($dataSensor->Situacao == "Seco") {
      $seco = $dataSensor->Quantidade;
    }
  }

  return [
    "umido" => ($umido + $moderado + $seco) * $umido / 100,
    "moderado" => ($umido + $moderado + $seco) * $moderado / 100,
    "seco" => ($umido + $moderado + $seco) * $seco / 100
  ];

}
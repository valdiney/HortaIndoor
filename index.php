<?php 
require_once('config.php');
require_once('relatorio.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Horta Indoor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" 
  href="css/bootstrap.css">

  <link rel="stylesheet" type="text/css" href="css/horta-style.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
  
  <link rel="icon" type="image/png" href="img/icon.png" />
  <meta property="og:image" content="https://i.ibb.co/j33T168/img-app.jpg" />
  <meta property="og:url" content="https://shielded-harbor-79485.herokuapp.com/">
  <meta property="og:title" content="Horta Indoor (Internet of Things‎)">
  <meta property="og:image:width" content="800"> 
  <meta property="og:image:height" content="600"> 
  <meta property="og:description" content="A Horta Indoor é uma tecnologia elaborada para possibilitar o cultivo de plantas sem depender da luz solar e facilitar o cultivo fornecendo informaçoes sobre o plantio. Consiste em um ambiente fechado, iluminado através de LED's de alto desempenho e monitorado por sensores, o que permite o acompanhamento via IOT (Internet of Things).">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="#5eaaaa">
</head>
<body>

  <div class="jumbotron" style="margin-bottom:0">
    <div class="col-lg-12">
        <center>
          <h1 class="titulo-jumbotron">Bem vindo a Horta Indoor</h1> 
            <p style="color:#eae7e7;opacity:0.80">Data visualization</p>
        </center> 
    </div>
  </div>

  <div class="container" style="margin-top:0;">

    <div class="row">

      <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h3>Descrição do projeto</h3>

              <p style="font-size:18px;color:#666666">
                A Horta Indoor é uma tecnologia elaborada para possibilitar o cultivo de plantas sem depender da luz solar e facilitar o cultivo fornecendo informaçoes sobre o plantio. Consiste em um ambiente fechado, iluminado através de LED's de alto desempenho e monitorado por sensores, o que permite o acompanhamento via IOT (Internet of Things).
              </p>

              <b>Contatos:</b> <br>
              <b>Email:</b> hortaindoor@outlook.com <br>
           </div>
        </div>
      </div>
      
    </div><!--end row-->


    <div class="row">

      <div class="col-lg-4">
        <div class="card">
           <div class="card-body">
              <img src="img/01.jpg" alt="" class="img-thumbnail">
              <h3>Temperatura ambiente</h3>
              <center><span>Últimos dados coletados</span></center>
              <br>

              <table class="table table-striped">
                <tr>
                    <td>Hora</td>
                    <td>Temperatura</td>
                </tr>

                <?php foreach (dadosSensorPorHora($db, 'temperatura_ambiente') as $data):?>
                    <tr>
                        <td><?php echo $data->HORA;?></td>
                        <td><?php echo $data->VALOR;?>ºC</td>
                    </tr>
                <?php endforeach;?>
              </table>
           </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
           <div class="card-body">
              <img src="img/02.jpg" alt="" class="img-thumbnail">
              <h3>Umidade ambiente</h3>
              <center><span>Últimos dados coletados</span></center>
              <br>
              
              <table class="table table-striped">
                <tr>
                    <td>Hora</td>
                    <td>Umidade</td>
                    <td>Situação</td>
                </tr>
                <?php foreach (dadosSensorPorHora($db, 'umidade_ambiente') as $data):?>
                    <tr>
                        <td><?php echo $data->HORA;?></td>
                        <td><?php echo $data->VALOR;?>%</td>
                        <td><?php echo legendaUmidadeAmbiente($data->VALOR);?></td>
                    </tr>
                 <?php endforeach;?>
              </table>
           </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
           <div class="card-body">
              <img src="img/03.jpg" alt="" class="img-thumbnail">
              <h3>Umidade do solo</h3>
              <center><span>Últimos dados coletados</span></center>
              <br>
              
              <table class="table table-striped">
                <tr>
                    <td>Hora</td>
                    <td>Situação</td>
                </tr>
                <?php foreach (dadosSensorPorHora($db, 'umidade_solo') as $data):?>
                    <tr>
                        <td><?php echo $data->HORA;?></td>
                        <td><?php echo legendasUmidade($data->VALOR)?></td>
                    </tr>
                 <?php endforeach;?>
              </table>
           </div>
        </div>
      </div>

    </div><!--end row-->

    <div class="row">

      <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
              <h3>Umidade Ambiente</h3>
              <center><span>Indicativas deste mês</span></center>
              <br>
              
              <div id="indicativo_umidade_ambiente"></div>
           </div>
        </div>
      </div>
      
      <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
              <h3>Umidade do solo</h3>
              <center><span>Indicativas deste mês</span></center>
              <br>
              
              <div id="indicativo_umidade_solo"></div>
           </div>
        </div>
      </div>
      
    </div><!--end row-->

    <div class="row">

      <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h3>Temperatura Ambiente</h3>
              <center><span>Ultimos dados coletados</span></center>
              <br>
              
              <div id="chart_temperatura_ambiente"></div>
           </div>
        </div>
      </div>

      <div class="col-lg-12" style="margin-top:20px"></div>

      <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h3>Umidade Ambiente</h3>
              <center><span>Ultimos dados coletados</span></center>
              <br>
              
              <div id="chart_umidade_ambiente"></div>
           </div>
        </div>
      </div>
      
    </div><!--end row-->

  </div>
<br>
<br>
<br>

<div class="col-lg-12" style="margin-top:20px;"></div>

<div class="col-lg-12" id="rodape">
  <div style="padding:10px">
    <center style="font-size:13px">
      <span>Copyright &copy; Horta Indoor 2017 - <?php echo date('Y');?></span>
    </center>
  </div>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(temperatura_ambiente);
google.charts.setOnLoadCallback(umidade_ambiente);
google.charts.setOnLoadCallback(porcentagem_umidade_ambiente);
google.charts.setOnLoadCallback(porcentagem_umidade_solo);

function temperatura_ambiente() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Hora');
      data.addColumn('number', 'ºC');

      data.addRows([
        <?php foreach (dadosSensorPorHora($db, "temperatura_ambiente") as $data):?>
           <?php echo "['{$data->HORA}', {$data->VALOR}]";?>,
        <?php endforeach;?>
      ]);

      var options = {
        fontSize:'11',
        pointSize: 5,
        curveType: "function",

        hAxis: {
          title: 'HORA'
        },
        vAxis: {
          title: 'TEMPERATURA'
        },
        series: {
          0: {
            color: "#689eaa",
            lineWidth: 2
          },
          1: {
            color: '',
            lineWidth: 2
          }
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_temperatura_ambiente'));
      chart.draw(data, options);
    }
    
    ////////////////////////////////////////////////////////////////////////

    function umidade_ambiente() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Hora');
      data.addColumn('number', 'Temp');

      data.addRows([
        <?php foreach (dadosSensorPorHora($db, "umidade_ambiente") as $data):?>
           <?php echo "['{$data->HORA}', {$data->VALOR}]";?>,
        <?php endforeach;?>
      ]);

      var options = {
        fontSize:'11',
        pointSize: 5,
        curveType: "function",

        hAxis: {
          title: 'HORA'
        },
        vAxis: {
          title: 'UMIDADE'
        },
        series: {
          0: {
            color: "#689eaa",
            lineWidth: 2
          },
          1: {
            color: '',
            lineWidth: 2
          }
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_umidade_ambiente'));
      chart.draw(data, options);
    }

////////////////////////////////////////////////////////////////////////

function porcentagem_umidade_ambiente() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Adequada', <?php echo round(porcentagemUmidadeAmbiente($db)["adequada"]);?>],
      ['Ruim', <?php echo round(porcentagemUmidadeAmbiente($db)["ruim"]);?>]
    ]);

    var options = {
      pieHole: 0.2,
      colors: ['#009966', '#666666'],
    };

    var chart = new google.visualization.PieChart(document.getElementById('indicativo_umidade_ambiente'));
    chart.draw(data, options);
}

////////////////////////////////////////////////////////////////////////

function porcentagem_umidade_solo() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Umido', <?php echo round(porcentagemUmidadeSolo($db)["umido"]);?>],
      ['Moderado', <?php echo round(porcentagemUmidadeSolo($db)["moderado"]);?>],
      ['Seco', <?php echo round(porcentagemUmidadeSolo($db)["seco"]);?>]
    ]);

    var options = {
      pieHole: 0.2,
      colors: ['#0099cc', '#009966', '#996633']
    };

    var chart = new google.visualization.PieChart(document.getElementById('indicativo_umidade_solo'));
    chart.draw(data, options);
}
</script>

</body>
</html>
<?php require_once('header.php');?>

<?php 
if ($_GET) {

    $tipo_sensor = $_GET['tipo_sensor'];
    $de = $_GET['de'];
    $ate = $_GET['ate'];

    $query_relatorio = dadosSensorPorData($db, my_date_format($de), my_date_format($ate), $tipo_sensor);

}
?>

<link rel="stylesheet" type="text/css" href="css/jquery_ui_css.css">

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer jumbotron1">
            <h1>Busca por Intervalo de datas</h1>
            <hr>
            <form method="get" action="consulta_relatorio.php?buscar">
                <div class="form-group">
                    <label>Selecione um Sensor</label>

                    <select name="tipo_sensor" class="form-control">

                       <?php if ($_GET):?>
                            <option value="<?php echo $_GET['tipo_sensor'];?>">
                                <?php echo $_GET['tipo_sensor'];?>
                            </option>
                       <?php endif;?>

                       <option value="temperatura_ambiente">Temperatura Ambiente</option>
                       <option value="umidade_ambiente">Umidade Ambiente</option>
                       <option value="umidade_solo">Umidade do Solo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>De</label>
                    <input type="text" name="de" class="form-control" id="de" placeholder="dia/mês/ano"
                    value="<?php echo (isset($_GET['de'])) ? $_GET['de'] : '';?>">
                </div>

                <div class="form-group">
                    <label>Ate</label>
                    <input type="text" name="ate" class="form-control" id="ate" placeholder="dia/mês/ano"
                    value="<?php echo (isset($_GET['ate'])) ? $_GET['ate'] : '';?>">
                </div>

                <button type="submit" class="btn btn-primary btn-large">Buscar</button>
            </form>

        </header>

        <?php if ($_GET):?>

            <?php if (count($query_relatorio) > 0):?>

                <!-- Title -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Sensores da Horta:</h3>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Page Features -->
                <?php if ($_GET['tipo_sensor'] == "umidade_ambiente"):?>
                    <?php require_once('tabelas_consultas/umidade_ambiente.php');?>
                <?php elseif ($_GET['tipo_sensor'] == "umidade_solo"):?>
                    <?php require_once('tabelas_consultas/umidade_solo.php');?>
                <?php elseif ($_GET['tipo_sensor'] == "temperatura_ambiente"):?>
                    <?php require_once('tabelas_consultas/temperatura_embiente.php');?>
                <?php endif;?>
                <!-- /.row -->

            <?php else:?>
                <h3>Registro não encontrado!</h3>
            <?php endif;?>
        <?php endif;?>
        
<?php require_once('footer.php');?>
<script src="js/jquery_ui.js"></script>

<script>
var jq = $.noConflict();
jq(document).ready(function(){
    jq.datepicker.regional['pt-BR'] = {
        closeText: 'Fechar',
        prevText: '&#x3c;Anterior',
        nextText: 'Pr&oacute;ximo&#x3e;',
        currentText: 'Hoje',
        monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
        'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
        'Jul','Ago','Set','Out','Nov','Dez'],
        dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
        dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
        jq.datepicker.setDefaults(jq.datepicker.regional['pt-BR']);

        jq("#de").datepicker({ 
                dateFormat: 'dd/mm/yy',
                changeMonth: true, // Mostra input com o mês
                changeYear: true // Mostra o input com o ano
        }).val();

        jq("#ate").datepicker({ 
                dateFormat: 'dd/mm/yy',
                changeMonth: true, // Mostra input com o mês
                changeYear: true // Mostra o input com o ano
        }).val();
});
</script>
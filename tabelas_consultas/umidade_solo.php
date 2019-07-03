<div class="row text-center">

    <div class="col-md-6 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="img/04.jpg" alt="">
            <div class="caption">

                <h3>Umidade <br><small>do Solo</small></h3>

                <table class="table">
                    <tr>
                        <td>Hora</td>
                        <td>Situação</td>
                        <td>Data</td>
                    </tr>

                    <?php foreach ($query_relatorio as $data):?>
                        <tr>
                            <td><?php echo $data->HORA;?></td>
                            <td><?php echo legendasUmidade($data->VALOR);?></td>
                            <td style="opacity:0.70;"><?php echo $data->DATA;?></td>
                        </tr>
                    <?php endforeach;?>
                </table>

            </div>
        </div>
    </div>
</div>
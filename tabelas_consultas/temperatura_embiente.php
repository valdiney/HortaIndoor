<div class="row text-center">

    <div class="col-md-6 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="img/01.jpg" alt="">
            <div class="caption">

                <h3>Temperatura <br><small>Ambiente</small></h3>
                <table class="table">
                    <tr>
                        <td>Hora</td>
                        <td>Temperatura</td>

                        <td>Data</td>
                    </tr>

                    <?php foreach ($query_relatorio as $data):?>
                        <tr>
                            <td><?php echo $data->HORA;?></td>
                            <td><?php echo $data->VALOR;?>ºC</td>
                            <td style="opacity:0.70;"><?php echo $data->DATA;?></td>
                        </tr>
                    <?php endforeach;?>
                </table>

            </div>
        </div>
    </div>
</div>
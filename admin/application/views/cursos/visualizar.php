<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Curso</a></li>
            <div class="buttons">
                <a title="Icon Title" class="btn btn-mini btn-info" href="<?php echo base_url().'index.php/cursos/editar/'.$result->idCursos?>"><i class="icon-pencil icon-white"></i> Editar</a>
            </div>
        </ul>
    </div>
    <div class="widget-content tab-content">
        <!--Tab 1 - Dados do Curso -->
        <div id="tab1" class="tab-pane active" style="min-height: 300px">


            <div class="widget-content">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Título</strong></td>
                            <td><?php echo $result->titulo ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Descrição</strong></td>
                            <td><?php echo $result->descricao ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Capa</strong></td>
                            <td><img src="<?php echo $result->capa ?>" width="400px"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Galeria</strong></td>
                            <td>
                                <?php foreach ($galeria as $g) {
                                    echo '<img src="'.$g->url.'" width="300px" style="margin-right: 20px">';
                                }?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Data de Cadastro</strong></td>
                            <td><?php echo date('d/m/Y',  strtotime($result->dataCadastro)) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>



          
        </div>


        
    </div>
</div>
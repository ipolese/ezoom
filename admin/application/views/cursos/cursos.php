<a href="<?php echo base_url();?>index.php/cursos/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Curso</a> 

<?php
if(!$results){?>

        <div class="widget-box">
        <div class="widget-title">
            <h5>&nbsp&nbsp Cursos</h5>
        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Capa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Curso Cadastrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php }else{
    

?>
<div class="widget-box">
     <div class="widget-title">
        <h5>&nbsp&nbsp Cursos</h5>
     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Capa</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {

            echo '<tr>';
            echo '<td>'.$r->idCursos.'</td>';
            echo '<td>'.$r->titulo.'</td>';
            echo '<td style="max-width: 100ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">'.$r->descricao.'</td>';
            echo '<td><img src="'.$r->capa.'" width="200px"></td>';
            echo '<td>
                <a href="'.base_url().'index.php/cursos/visualizar/'.$r->idCursos.'" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>
                <a href="'.base_url().'index.php/cursos/editar/'.$r->idCursos.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Curso"><i class="icon-pencil icon-white"></i></a>
                <a href="#modal-excluir" role="button" data-toggle="modal" curso="'.$r->idCursos.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Curso"><i class="icon-remove icon-white"></i></a>
            </td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
<?php echo $this->pagination->create_links();}?>

<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/cursos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Curso</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idCurso" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este curso?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>


<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var curso = $(this).attr('curso');
        $('#idCurso').val(curso);

    });

});

</script>

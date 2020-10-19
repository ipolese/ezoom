<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <h5>&nbsp&nbsp Cadastrar Curso</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formCurso" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="control-group">
                        <label for="titulo" class="control-label">Título<span class="required">*</span></label>
                        <div class="controls">
                            <input id="titulo" class="span8" type="text" name="titulo" value="<?php echo set_value('titulo'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                        <div class="controls">
                            <textarea class="span8" name="descricao" id="descricao" cols="30" rows="5"><?php echo set_value('descricao'); ?></textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="titulo" class="control-label">Capa<span class="required">*</span></label>
                        <div class="controls">
                            <input type="file" name="userfile" value="" />(PNG / JPG)
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" id="submitar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/cursos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url()?>js/jquery.validate.js"></script>

<script type="text/javascript">
      $(document).ready(function(){
           $('#formCurso').validate({
            rules :{
                  titulo:{ required: true},
                  descricao:{ required: true},
                  capa: { required: true}
            },
            messages:{
                titulo :{ required: 'Campo Requerido.'},
                descricao:{ required: 'Campo Requerido.'},
                capa:{ required: 'Campo Requerido.'}
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });
      });
</script>





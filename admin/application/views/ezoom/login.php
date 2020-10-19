
<!DOCTYPE html>
<html lang="pt-br">
    
<head>
    <title>ezoom</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/matrix-login.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src="<?php echo base_url()?>assets/js/jquery-1.10.2.min.js"></script>
    <style type="text/css">
        .btnCriarConta {
            width: 395px;
            height: 50px;
            font-family: "Open Sans", sans-serif;
            background: #d2704e;
            color: #fff !important;
            display: block;
            margin-top: 20px;
            padding-top: 12px;
            text-align: center;
            border: 0px solid #ef825c;
            border-bottom-width: 7px;
        }
        .btnCriarConta:hover {
            text-decoration: none;
            box-shadow: 0px 1px 3px #2196F3;
        }
        .help-inline, .fa {
            display: none !important;
        }
    </style>
    </head>
    <body>
        <div class="wrapper">
            <form  class="form-vertical login" id="formLogin" method="post" action="<?php echo base_url()?>index.php/ezoom/verificarLogin">
            
            <div class="control-group normal_text" style="margin-top: 30px; margin-bottom: 30px">
                <h3>
                    <center>
                        <img src="<?php echo base_url()?>assets/img/logo-ezoom.png" alt="Logo" />
                    </center>
                </h3>
            </div>

                <?php if($this->session->flashdata('error') != null){?>
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <?php echo $this->session->flashdata('error');?>
                   </div>
                <?php }?>

                <p class="title">Login</p>
                <input id="email" name="email" type="text" placeholder="Email" autofocus/>
                <i class="fa fa-user"></i>
                <input name="senha" type="password" placeholder="Senha" />
                <i class="fa fa-key"></i>
                <button>
                    <span class="state" style="font-size: 14px">Login</span>
                </button>

                <hr style="margin-top: 25px">

                <footer style="font-size: 12px; color:#5c0091">
                    <b>Login:</b> ezoom@ezoom.com.br <br />
                    <b>Senha:</b> 123456
                </footer>

            </form>
        </div>
        
        <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/validate.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                
                $('#email').focus();
                $("#formLogin").validate({
                     rules :{
                          email: { required: true, email: true},
                          senha: { required: true}
                    },
                    messages:{
                          email: { required: 'Campo Requerido.', email: 'Insira Email válido'},
                          senha: {required: 'Campo Requerido.'}
                    },
                   submitHandler: function( form ){       
                        var dados = $( form ).serialize();
                        var login;
                        
                        login = $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>index.php/ezoom/verificarLogin?ajax=true",
                            data: dados,
                            dataType: 'json',
                            success: function(data)
                            {
                                if(data.result == true){
                                    window.location.href = "<?php echo base_url();?>index.php/ezoom";
                                }else{
                                    $('#call-modal').trigger('click');
                                }
                            }
                        });
                        return false;
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



        <a href="#notification" id="call-modal" role="button" class="btn" data-toggle="modal" style="display: none ">notification</a>

        <div id="notification" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel">ezoom</h4>
          </div>
          <div class="modal-body">
            <h5 style="text-align: center">Os dados de acesso estão incorretos, por favor tente novamente!</h5>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fechar</button>

          </div>
        </div>


    </body>

</html>










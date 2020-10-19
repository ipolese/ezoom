<!DOCTYPE html>
<html lang="en">
<head>
<title>ezoom</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" /> 

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>

</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="">ezoom</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    
</div>

<!-- sair conta -->
<button class="logout-painel tip-bottom"><a href="<?php echo base_url();?>index.php/ezoom/sair" class="btnShearcExit">SAIR</a></button>

<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i> Menu</a>
  <ul>
    <li class="<?php if (isset($menuPainel)) {echo 'active';};?>"><a href="<?php echo base_url()?>index.php/ezoom"><span>&nbsp&nbsp Dashboard</span></a></li>
    <li class="<?php if (isset($menuCursos)) {echo 'active';};?>"><a href="<?php echo base_url()?>index.php/cursos"><span>&nbsp&nbsp Cursos</span></a></li>
  </ul>
</div>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url()?>" title="Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <?php if ($this->uri->segment(1) != null) {
    ?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1)?>" class="tip-bottom" title="<?php echo ucfirst($this->uri->segment(1));?>"><?php echo ucfirst($this->uri->segment(1));?></a> <?php if ($this->uri->segment(2) != null) {
    ?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>"><?php echo ucfirst($this->uri->segment(2));
    } ?></a> <?php
    }?></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <?php if ($this->session->flashdata('error') != null) {?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php }?>

                <?php if ($this->session->flashdata('success') != null) {?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $this->session->flashdata('success');?>
                    </div>
                <?php }?>
                    
                <?php if (isset($view)) {
                    echo $this->load->view($view, null, true);
                }?>
            </div>
        </div>
    </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y")?> &copy; ezoom.</div>
</div>
<!--end-Footer-part-->


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script> 



</body>
</html>



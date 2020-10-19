<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/excanvas.min.js"></script><![endif]-->

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/dist/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/dist/jquery.jqplot.min.css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/js/dist/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dist/plugins/jqplot.donutRenderer.min.js"></script>


<div class="container-fluid quick-wrap">
  <div class="quick-actions_homepage">
    <ul class="quick-actions">
      <li class="bg_lb"> <a href="<?php echo base_url()?>index.php/cursos">&nbsp&nbsp Cursos </a> <div class="quick-number"> <strong><?php echo $this->db->where('situacao', '1')->count_all_results('cursos');?></strong> </div> </li>
    </ul>
  </div>
</div>  
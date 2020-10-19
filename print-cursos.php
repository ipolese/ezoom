<?php
  while($res = $pdo_query->fetch()){
    $idCursos = $res['idCursos'];
    $titulo = $res['titulo'];
    $descricao = $res['descricao'];
    $capa = $res['capa'];

    echo'
      <div class="div-curso">
        <div class="col-lg-4 img">
          <img src="'.$capa.'" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8 pt-4 pt-lg-0 content">
          <h3>'.$titulo.'</h3>
          <p class="font-italic">'.$descricao.'</p>
          <div>
            <a class="curso-btn" href="curso.php?id='.$idCursos.'">Ver Mais</a>
          </div>
        </div>
      </div>
    ';
  }
?>

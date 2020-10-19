<?php
	$base_dados  = 'ezoom';
	$usuario_bd  = 'root';
	$senha_bd    = '';
	 
	$host_db     = 'localhost';
	$charset_db  = 'UTF8';
	$conexao_pdo = null;

	// Concatenação das variáveis para detalhes da classe PDO
	$detalhes_pdo  = 'mysql:host=' . $host_db . ';';
	$detalhes_pdo .= 'dbname='. $base_dados . ';';
	$detalhes_pdo .= 'charset=' . $charset_db . ';';

	// Tenta conectar
	try {
	    // Cria a conexão PDO com a base de dados
	    $conexao_pdo = new PDO($detalhes_pdo, $usuario_bd, $senha_bd);
	} catch (PDOException $e) {
	    // Se der algo errado, mostra o erro PDO
	    print "Erro: " . $e->getMessage() . "<br/>";
	   
	    // Mata o script
	    die();
	}
?>
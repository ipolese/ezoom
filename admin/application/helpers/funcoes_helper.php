<?php

	if (!defined('BASEPATH')) {
		exit('No direct script access allowed');
	}

    function curl_boleto_token($token, $dados){
        
        $ch = curl_init();    
          
        curl_setopt($ch, CURLOPT_URL, 'https://cobrancaporboleto.com.br/api/v1/' );      

        if ($dados){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dados) );
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_USERPWD, $token);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        
        $output = curl_exec($ch);

        curl_close($ch);
        
        $resposta = json_decode($output, 1);

        return $resposta;
    }

	function p_array($variavel) 
	{

		echo '<pre>';
		print_r($variavel);
		echo '</pre>';
	}

	function msg($mensagem = '$$$', $tip = 1, $retorno = 0){
        $r = array();

        if ($mensagem == '$$$'){
            $r['tip'] = $this->tip_mensagem;
            $r['msg'] = $this->mensagem;
        }else{
            $r['tip'] = $tip;
            $r['msg'] = $mensagem;
        }

        if ($retorno == 1){
            return json_encode($r);
        }else{
            echo json_encode($r);
        }
    }

    function valida_cep($cep){

        $cep = preg_replace("/[^0-9]/", "", $cep);

        if ( is_numeric( $cep ) and  strlen($cep) == 8 ){
            return true;
        }else{
            return false;
        }
    }

    function isMail($email){

        if (filter_var( trim($email), FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }

    }

    function ValidaData($dat){
          $data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como referÃƒÂªncia

          if (count($data) != 3){
            return false;
          }

          if ( !$data[0] || !$data[1] || !$data[2]  ){
            return false;
          }


          $d = $data[0];
          $m = $data[1];
          $y = $data[2];

          $res = @checkdate($m,$d,$y);
          if ($res == 1){
             return true;
          } else {
             return false;
          }
      }

    function valida_celular($celular)
    {

        $celular = preg_replace("/[^a-zA-Z0-9]/", "", $celular);
        $celular = str_replace(' ', '', $celular);

        if(strlen($celular) == 10){ // REGRA PARA 8 DÍGITOS
            $celular = mascara_string('(##) ####-####', $celular);
                            $exp_regular = '/^\([1-9]{2}\) [1-9][0-9]{3}\-[0-9]{4}/';
                $ret = preg_match($exp_regular, $celular);
        }else if(strlen($celular) == 11){ // REGRA PARA 9 DÍGITOS
            $celular = mascara_string('(##) #####-####', $celular);
                            $exp_regular = '/^\([1-9]{2}\) [9-9][1-9][0-9]{3}\-[0-9]{4}$/';
                $ret = preg_match($exp_regular, $celular);
        }else{ // SE NÃO FOR 10 OU 11 TA ERRADO
            return false;
        }

        if($ret === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
	function pegaddd($celular)
    {
    	$celular = soNumero($celular);
		
		$celular = substr($celular,0,2);
		
		return $celular;
        
    }
	
	function pegatelefone($celular)
    {
    	$celular = soNumero($celular);
		
		$celular = substr($celular, 2);
		
		return $celular;
        
    }

    function mascara_string($mascara,$string)
    {
       $string = str_replace(" ","",$string);
       for($i=0;$i<strlen($string);$i++)
       {
          $mascara[strpos($mascara,"#")] = $string[$i];
       }
       return $mascara;
    }
	
	function limpaCPF($cpf){
		return preg_replace('/[^0-9]/', '', (string) $cpf);
	}
	
	function pegaEstado($estado){
		$estado = explode('(', $estado);
		$estado = substr(@$estado[1],0, 2);
		
		return $estado;
	}    

    function valida_cpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);

        if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999') {
            return false;
         }

        // Valida tamanho
        if (strlen($cpf) != 11)
            return false;
        // Calcula e confere primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Calcula e confere segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
    }
	
	function valida_cnpj($cnpj)
	{
		$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
		// Valida tamanho
		if (strlen($cnpj) != 14)
			return false;
		// Valida primeiro dígito verificador
		for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
		{
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;
		if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
			return false;
		// Valida segundo dígito verificador
		for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
		{
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;
		return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
	}
	
	function formataDataHora($datahora){
		if( !is_null($datahora) ) {
			  return (new DateTime($datahora))->format('d/m/Y H:i:s');
		}else{
		  return '';
		}
	}

	function dateTimeToDateBR ($datahora){
	  if ($datahora != null and $datahora != '0000-00-00 00:00:00' and !empty($datahora)){
		  return date('d/m/Y', strtotime($datahora));
	  }else{
		  return '';
	  }
	}

	function dateTimeToHoraBR ($datahora){
	  if ($datahora != null and $datahora != '0000-00-00 00:00:00' and !empty($datahora)){
		  return date('H:i', strtotime($datahora));
	  }else{
		  return '';
	  }
	}  

	function moeda($numero, $rs = 0){
	  if ($rs == 0){
		  return @number_format($numero, 2, ',', '.');
	  }else{
		  return 'R$ '.number_format($numero, 2, ',', '.');
	  }
	}

	function numero($numero){
		return number_format($numero, 0, ',', '.');
	}

	function soNumero($str) {
		return preg_replace("/[^0-9]/", "", $str);
	}

    function dateToUS($dataBR) {
      // 23/05/2015 --> 2015-05-23
      $d = explode('/',$dataBR);
      $dataOK = $d[2].'-'.$d[1].'-'.$d[0];
      return $dataOK;
    }

    function dateTimeToUS($dataBR_his) {
      $d = explode(' ',$dataBR_his);
      $dataOK = dateToUS($d[0]).' '.$d[1];
      return $dataOK;
    }
	
	function enviaEmail($email){
        $url = 'https://api.sparkpost.com/api/v1/transmissions';
        $token = '43c01d452d356c0211525dd050810f7a4fe2efe3';

        $dados = [
            'content' => [
                'from' => [
                    'name' => $email['de'],
                    'email' => 'contato@email.pmoc.me',
                ],
                'subject' => $email['assunto'],
                'html' => $email['html'],
                'text' => '',
                'reply_to' => $email['de_email'],
            ],
            'options' => [
                'open_tracking' => false,
                'click_tracking' => false,
            ], 
            'recipients' => [
                [
                    'address' => [
                        'name' => $email['nome_destinatario'],
                        'email' => $email['email_destinatario'],
                    ],
                ],
            ],
        ];

        $ch = curl_init();      
        curl_setopt($ch, CURLOPT_URL, $url);        

        if ($dados){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados) );
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        $headr = array();
        $headr[] = 'Content-length: '. strlen(json_encode($dados));
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: '.$token;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);

        $resposta = curl_exec($ch);

        $resposta = json_decode($resposta);

        //p_array($resposta);
        //p_array($dados);
        //exit;

        if ( @$resposta->results->total_accepted_recipients == 1 ){
          return true;
        }else{
          return false;
        }
    }
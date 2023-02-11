<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of HelpersValidate
 *
 * @author Adriano
 */
//Clase exclusiva para validaÃ§ões em PHP, pode-se usar antes de submeter os dados caso o usuário burle o javascript.

namespace app\helpers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Standard;
Use yii\helpers\Html;

class HelpersValidate {
    private $_errors=array();	// attribute name => array of errors
    public  $msg_vazio      = "Campo obrigatório";
    public  $msg_email      = "Preencha o campo com um email válido";
    public  $msg_cep        = "CEP com formato inválido"; 
    public  $msg_data       = "Data em formato inválido";
    public  $msg_telefone   = "Telefone inválido"; 
    public  $msg_celular    = "Celular inválido";
    public  $msg_cpf        = "CPF inválido"; 
    public  $msg_cnpj       = "CNPJ inválido"; 
    public  $msg_ip         = "IP inválido"; 
    public  $msg_so_numeros = "Preencha o campo com numeros"; 
    public  $msg_so_letras  = "Preencha o campo somente com letras";
    public  $msg_so_le_num  = "Preencha o campo somente com letras ou numeros";
    public  $msg_url        = "URL especificada é inválida"; 
    public  $msg_tags_script= "Tags SCRIPT não permitidas"; 
    public  $msg_tags_html  = "Tags HTML não permitidas"; 
    public  $msg_tags_style = "Tags STYLE não permitidas"; 
    public  $msg_tam_max    = "O campo deve ter no máximo %d caracteres"; 
    public  $msg_tam_min    = "O campo deve ter no mínimo %d caracteres";
    public  $msg_extensao   = "Extensão não autorizada \n\n\r Use as extensões %s";
    public  $msg_max   		= "O valor máximo deve ser ";
    public  $msg_min   		= "O valor mínimo deve ser ";
    /**
    * Adds a new error to the specified attribute.
    * @param string $attribute attribute name
    * @param string $error new error message
    */
    public function addError($attribute, $error){
        $this->_errors[$attribute][] = $error;
    }
    /**
    * Adds a list of errors.
    * @param array $errors a list of errors. The array keys must be attribute names.
    * The array values should be error messages. If an attribute has multiple errors,
    * these errors must be given in terms of an array.
    * You may use the result of {@link getErrors} as the value for this parameter.
    */
     public function addErrors($errors){
            foreach($errors as $attribute=>$error){
                if(is_array($error)){
                    foreach($error as $e)
                        $this->addError($attribute, $e);
                }
                else
                   $this->addError($attribute, $error);
     }
    }
    
    public function getErrors($attribute=null){
        if($attribute===null)
            return $this->_errors;
        else
            return isset($this->_errors[$attribute]) ? $this->_errors[$attribute] : array();
    }
    
    public function getError($attribute){
        return isset($this->_errors[$attribute]) ? reset($this->_errors[$attribute]) : null;
    }
    
    public function geraErrosFrontHtml($title = 'Atenção foram encontrados erros no seu cadastro') {
        $html .= "<h1 class='error-title ta-c'>{$title}</h3>";
        $html .= "<div class='error-cotent'>
                    <table cellpadding='0' cellspacing='0'>";

        foreach ($this->_errors as $key => $value) {
            $html .= "<tr>";
            $html .= "<td class='error-name ta-r va-t'>{$key}:</td><td>";
            foreach (array_unique($value) as $val) {
                $html .= "<span class='error-item d-ib'>{$val}</span>";
            }
            $html .= "</td></tr>";
        }
        $html .= "</table></div><a class='error-close ta-c' data-error-close aria-label='Fechar' title='Fechar'></a>";
        return $html;
    }
	
    public function geraErrosFront($title = 'ATENÇÃO! Foram encontrados os seguintes erros:')
	{
        $html = '<b>' . $title . '</b><br><br>';;

        foreach ($this->_errors as $key => $value) 
		{
            $html .= '<b>' . $key . '</b>' . ': ';
			$count_value = count(array_unique($value));			
			$i = 0;
			
			foreach (array_unique($value) as $val) 
			{
				$i += 1;
				if($val != '')
				{
					$html .= $val;
					
					if($count_value > 1 && $count_value != $i)
					{
						$html .= " | ";
					}
				}
            }
			
            $html .= "<br />";
        }
		
        return $html;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    //                              VALIDAÃ‡Ã•ES                                                           //
    
    
	# INPUT TEXT DEFAUL
    function validarInputTextDefault($valor ,$attribute= 'campo', $required = false, $min = '', $max = '')
	{
		# REQUIRED
        if($required)
		{
            $this->validarCampoVazio($valor, $attribute);
        }
		
		# TAGS
        $this->validarTagsScript($valor , $attribute);
        $this->validarTagsStyle($valor , $attribute);
        $this->validarTagsHTML($valor , $attribute);
		
		# MAX
        if (strlen($valor) > $max && $max)
		{
            $this->addError($attribute, sprintf($this->msg_tam_max, $max));	
        }
		
		# MIN
        if (strlen($valor) < $min && $min)
		{
            $this->addError($attribute, sprintf($this->msg_tam_min, $min));	
        }
    }
	
    public function validarEmail($valor, $attribute = 'email', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $conta = "/^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$/";
        $pattern = $conta.$domino.$extensao;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_email));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_email));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_email));
        if (!preg_match($pattern, $valor))
           $this->addError($attribute, ($msg)?($msg):($this->msg_email));
    }
    
    // Validar CEP (xxxxx-xxx)
    function validarCep($valor, $attribute = 'cep', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_cep));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_cep));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_cep));
        if (!preg_match("/^[0-9]{5}-[0-9]{3}$/", $valor)){ 
            $this->addError($attribute, ($msg)?($msg):($this->msg_cep));
        }
    }
	
    // Validar Datas (DD/MM/AAAA)
    function validarData($valor, $attribute = 'data', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_data));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_data));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_data));
        if (!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $valor)){ 
            $this->addError($attribute, ($msg)?($msg):($this->msg_data));
        }
    }
	
    // Validar Telefone (999 9999 9999)
    function validarTelefone($valor, $attribute = 'telefone', $required =false, $msg = ''){
        $valor = str_replace(array('(',')','-',' '), array('','','',''), $valor);
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute);
        $this->validarTagsStyle($valor , $attribute);
        $this->validarTagsHTML($valor , $attribute);
		
        if (!preg_match("/^[0-9]{8,14}$/", $valor)){ 
            $this->addError($attribute, ($msg)?($msg):($this->msg_telefone));
        }
    }
    
    // Validar Celular (999 9999 9999)
    function validarCelular($valor, $attribute = 'celular', $required =false, $msg = ''){
        $valor = str_replace(array('(',')','-',' '), array('','','',''), $valor);
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_celular));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_celular));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_celular));        
        if (!preg_match("/^[0-9]{8,14}$/", $valor) && $valor){ 
            $this->addError($attribute, ($msg)?($msg):($this->msg_celular));
        }
    }
	
    // Validar CPF (111111111111)
    function validarCpf($valor, $attribute = 'cpf', $required = false, $msg = ''){
        $cpfNormal = $cpf = $valor;
        $cpf = str_replace('.', '', $cpf);
        $cpf = str_replace('-', '', $cpf);
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        if(!is_numeric($cpf)){
            $status = false;
        } else {
            # Pega o digito verificador
            $dv_informado = substr($cpf, 9,2);
            for($i=0; $i<=8; $i++){
                    $digito[$i] = substr($cpf, $i,1);
            }
            # Calcula o valor do 10Â° digito de verificação
            $posicao = 10;
            $soma = 0;
            for($i=0; $i<=8; $i++){
            $soma = $soma + $digito[$i] * $posicao;
            $posicao = $posicao - 1;
            }
            $digito[9] = $soma % 11;
                    if($digito[9] < 2){
                    $digito[9] = 0;
                    } else {
                    $digito[9] = 11 - $digito[9];
                    } 
            # Calcula o valor do 11Â° digito de verificação
            $posicao = 11;
            $soma = 0;
            for ($i=0; $i<=9; $i++){
            $soma = $soma + $digito[$i] * $posicao;
            $posicao = $posicao - 1;
            }
            $digito[10] = $soma % 11;
                    if ($digito[10] < 2){
                    $digito[10] = 0;
                    } else {
                    $digito[10] = 11 - $digito[10];
                    }
            # Verifica de o dv Ã© igual ao informado
            $dv = $digito[9] * 10 + $digito[10];
            if ($dv != $dv_informado){
                    $status = false;
            } else
                    $status = true;
        }
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_cpf));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_cpf));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_cpf));
        if (!$status || !preg_match("/^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$/", $cpfNormal)){
                $this->addError($attribute, ($msg)?($msg):($this->msg_cpf));;
        }
    }
    
    function validarCNPJ($valor, $attribute = 'cnpj', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        //Etapa 1: Cria um array com apenas os digitos numÃ©ricos, isso permite receber o cnpj em diferentes formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00" etc...
        $j=0;
        for($i=0; $i<(strlen($valor)); $i++)
        {
            if(is_numeric($valor[$i]))
            {
                $num[$j]=$valor[$i];
                $j++;
            }
        }
        //Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numÃ©ricos.
        if(count($num)!=14)
        {
            $isCnpjValid=false;
             // echo count($num);
        }
            //Etapa 3: O nÃºmero 00000000000 embora nÃ£o seja um cnpj real resultaria um cnpj válido após o calculo dos dígitos verificares e por isso precisa ser filtradas nesta etapa.
        if ($num[0]==0 && $num[1]==0 && $num[2]==0 && $num[3]==0 && $num[4]==0 && $num[5]==0 && $num[6]==0 && $num[7]==0 && $num[8]==0 && $num[9]==0 && $num[10]==0 && $num[11]==0)
        {
            $isCnpjValid=false;
        }else//Etapa 4: Calcula e compara o primeiro dígito verificador.
        {
            $j=5;
            for($i=0; $i<4; $i++)
            {
                $multiplica[$i]=$num[$i]*$j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $j=9;
            for($i=4; $i<12; $i++)
            {
                $multiplica[$i]=$num[$i]*$j;
                $j--;
            }
            $soma = array_sum($multiplica);	
            $resto = $soma%11;			
            if($resto<2)
            {
                $dg=0;
            }
            else
            {
                $dg=11-$resto;
            }
            if($dg!=$num[12])
            {
                $isCnpjValid=false;
            } 
        }
            //Etapa 5: Calcula e compara o segundo dígito verificador.
        if(!isset($isCnpjValid))
        {
            $j=6;
            for($i=0; $i<5; $i++)
            {
                $multiplica[$i]=$num[$i]*$j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $j=9;
            for($i=5; $i<13; $i++)
            {
                $multiplica[$i]=$num[$i]*$j;
                $j--;
            }
            $soma = array_sum($multiplica);	
            $resto = $soma%11;			
            if($resto<2)
            {
                $dg=0;
            }
            else
            {
                $dg=11-$resto;
            }
            if($dg!=$num[13])
            {
                $isCnpjValid=false;
            }
            else
            {
                $isCnpjValid=true;
            }
        }
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_cnpj));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_cnpj));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_cnpj));
        if (!$isCnpjValid || !preg_match("/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/", $valor)){
              $this->addError($attribute, ($msg)?($msg):($this->msg_cnpj));;
        }
    }
	
    // Validar IP (200.200.200.200)
    function validarIp($valor, $attribute = 'ip', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_ip));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_ip));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_ip));       
        if (!preg_match("/^([0-9]){1,3}.([0-9]){1,3}.([0-9]){1,3}.([0-9]){1,3}$/", $valor)){
            $this->addError($attribute, ($msg)?($msg):($this->msg_ip));
        }
    }
	
    // Validar Numero
    function validarNumero($valor, $attribute = 'numero', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        if(!is_numeric($valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_numeros),$attribute));
        }
    }
    
    function validarNumeroSpace($valor, $attribute = 'nome',$required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        if (!preg_match("/^[0-9\ \']+$/", $valor) ){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_numeros),$attribute));
        }
    }
    
    function validarSoString($valor, $attribute = 'nome', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        if (!preg_match("/^[a-zA-Z']+$/", $valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_letras),$attribute));
        }
    }
    function validarSoStringSpace($valor, $attribute = 'nome', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        if (!preg_match("/^[a-zA-Z\ \']+$/", $valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_letras),$attribute));
        }
    }
    function validarSoStringSpaceAcent($valor, $attribute = 'nome', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        if (!preg_match("/^[a-zA-ZáÃ Ã¢Ã£ÃÃ€Ã‚ÃƒÃ©ÃªÃ‰ÃŠíÃóÃ´Ã“Ã”ÃºÃšÃ§Ã‡\ \']+(\[a-zA-ZáÃ Ã¢Ã£ÃÃ€Ã‚ÃƒÃ©ÃªÃ‰ÃŠíÃóÃ´Ã“Ã”ÃºÃšÃ§Ã‡\ \']+)*$/", $valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_letras),$attribute));
        }
    }
    function validarSoStringSpaceAcentUrderHif($valor, $attribute = 'nome', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_letras));        
        if (!preg_match("/^[_a-zA-Z-áÃ Ã¢Ã£ÃÃ€Ã‚ÃƒÃ©ÃªÃ‰ÃŠíÃóÃ´Ã“Ã”ÃºÃšÃ§Ã‡\ \']+(\[_a-zA-Z-áÃ Ã¢Ã£ÃÃ€Ã‚ÃƒÃ©ÃªÃ‰ÃŠíÃóÃ´Ã“Ã”ÃºÃšÃ§Ã‡\ \']+)*$/", $valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_letras),$attribute));
        }
    }
    
    function validarSoStringORNumeros($valor, $attribute = 'nome',$required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        if (!preg_match("/^[0-9a-zA-Z]+$/", $valor) ){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_le_num),$attribute));
        }
    }
    function validarSoStringORNumerosORSpace($valor, $attribute = 'nome', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        if (!preg_match("/^[0-9a-zA-Z\ \']+$/", $valor)  && isset($valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_le_num),$attribute));
        }
    }
    function validarSoStringORNumerosORSpaceAcent($valor, $attribute = 'nome', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        if (!preg_match("/^[a-zA-Z0-9áÃ Ã¢Ã£ÃÃ€Ã‚ÃƒÃ©ÃªÃ‰ÃŠíÃóÃ´Ã“Ã”ÃºÃšÃ§Ã‡\ \']+(\[a-zA-Z0-9áÃ Ã¢Ã£ÃÃ€Ã‚ÃƒÃ©ÃªÃ‰ÃŠíÃóÃ´Ã“Ã”ÃºÃšÃ§Ã‡\ \']+)*$/", $valor)  && isset($valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_le_num),$attribute));
        }
    }
    function validarSoStringORNumerosORSpaceAcentUderHif($valor, $attribute = 'nome', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_le_num));
        if (!preg_match("/^[_a-zA-Z0-9-áÃ Ã¢Ã£ÃÃ€Ã‚ÃƒÃ©ÃªÃ‰ÃŠíÃóÃ´Ã“Ã”ÃºÃšÃ§Ã‡\ \']+(\[_a-zA-Z0-9-áÃ Ã¢Ã£ÃÃ€Ã‚ÃƒÃ©ÃªÃ‰ÃŠíÃóÃ´Ã“Ã”ÃºÃšÃ§Ã‡\ \']+)*$/", $valor)  && isset($valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_so_le_num),$attribute));
        }
    }
    
    function validarExtensao($valor, $attribute = 'arquivo', $required = false, $extensoes= 'jpg|JPG|png|PNG|bmp|BMP|JPEG|jpeg', $msg = ''){
         
         if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_extensao));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_extensao));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_extensao));
        if (!preg_match("/(?:{$extensoes})$/", $valor)){
            $extensoes = implode(', ',array_unique(explode('|',strtolower($extensoes))));
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_extensao),$extensoes));
        }
    }
	
    // Validar URL
    function validarUrl($valor, $attribute = 'url', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_url));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_url));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_url));
        if (!preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $valor)){
             $this->addError($attribute, ($msg)?($msg):($this->msg_url),$attribute);
        }
    }   
    // Verificação simples (Campo vazio, maximo/minimo de caracteres)
    function validarCampoVazio($valor, $attribute, $msg = ''){
        if ($valor == "" || empty($valor)){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_vazio), $attribute));	
        } 
    }
    function validarTamanhoMax($valor, $attribute = 'campo', $required = false, $max = 20){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_tam_max));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_tam_max));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_tam_max));
        if (strlen($valor) > $max){
            $this->addError($attribute, sprintf($this->msg_tam_max, $max));	
        }
    }
    function validarTamanhoMin($valor ,$attribute= 'campo', $required = false, $min = 4){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_tam_min));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_tam_min));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_tam_min));
        if (strlen($valor) < $min){
            $this->addError($attribute, sprintf($this->msg_tam_min, $min));	
        }
    }
    
    function validarTagsScript($valor ,$attribute= 'campo', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        if (preg_match('/^<script[^>]*?>[\s\S]*?<\/script>/', $valor)){
             $this->addError($attribute, ($msg)?($msg):($this->msg_tags_script),$attribute);
        }
    }
    function validarTagsStyle($valor ,$attribute= 'campo', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        if (preg_match('/^<style[^>]*?>[\s\S]*?<\/style>/', $valor)){
             $this->addError($attribute, ($msg)?($msg):($this->msg_tags_style),$attribute);
        }
    }
    function validarTagsHTML($valor ,$attribute= 'campo', $required = false, $msg = ''){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        if (preg_match('/^([\<])([^\>]{1,})*([\>])/', $valor)){
             $this->addError($attribute, ($msg)?($msg):($this->msg_tags_html),$attribute);
        }
    }
    
    // Validar Numero Max Min
    function validarMaxMin($valor, $attribute = 'numero', $required = false, $msg = '', $max, $min){
        if($required):
            $this->validarCampoVazio($valor, $attribute);
        endif;
        $this->validarTagsScript($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        $this->validarTagsStyle($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        $this->validarTagsHTML($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        $this->validarNumero($valor , $attribute, $required,($msg)?($msg):($this->msg_so_numeros));
        if($valor > $max){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_max . $max),$attribute));
        }
        if($valor < $min){
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_min . $min),$attribute));
        }
    }
 
    function validarCupom($cupom_post, $cupom_base, $attribute = 'Cupom', $msg = 'Cupom inválido')
	{
        # CAMPO VAZIO
		if ($cupom_post == "" || empty($cupom_post))
		{
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_vazio), $attribute));	
        } 
		
		# CUPOM
		$cupom_array = array_map('trim', explode(',', mb_strtolower($cupom_base, 'UTF-8')));
		
		if(!in_array(trim(mb_strtolower($cupom_post, 'UTF-8')), $cupom_array))
		{
            $this->addError($attribute, sprintf(($msg)?($msg):($this->msg_vazio), $attribute));	
		}
    }
}
?>

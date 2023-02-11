<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Moip extends Model
{
    private $token = '';
    private $token_dev = 'TVdVWjZVTlBLWjFWU01LODVQTEFDTUJYWTFKWTNUSlY6T1BEVExWNVVIUU9YWlRWSEdUNDZDSzE1N09LUkhSRzJMWDlCUFhLUA==';
    private $token_prod = 'SlNKVk4wR1c4TlI4QkhDRlc0VEFPR1JQOVJJSURDTkM6QkRRU1VWN0ZUQlBZSDNHQTNLVVRXUFNFRk9UV0JPVVBPRFlEMlkwOQ==';

    function __construct() 
    {
        if(YII_ENV_DEV || YII_ENV_TEST)
        {
            $this->token = $this->token_dev;
            
        } else {
            $this->token = $this->token_prod;
        }
    }

    public function getToken()
    {
        return $this->token;
    }

    public function submitPayment($payment_method, $assinante, $cartao = '', $moip_customer_code, $new_client)
    {
        # ENDPOINT
        if(YII_ENV_DEV || YII_ENV_TEST)
        {
           $endpoint = "https://sandbox.moip.com.br/assinaturas/v1/subscriptions?new_customer=" . ($new_client ? 'true' : 'false');
           
        } else {
            $endpoint = "https://api.moip.com.br/assinaturas/v1/subscriptions?new_customer=" . ($new_client ? 'true' : 'false');
        }

        # TRATANDO OS DADOS
        $ddd = substr(preg_replace('/[^0-9]/', '', $assinante->phone), 0, 2);
        $telefone = substr(preg_replace('/[^0-9]/', '', $assinante->phone), 2);
        $cep = preg_replace('/[^0-9]/', '', $assinante->postal_code);
        $cpf = preg_replace('/[^0-9]/', '', $assinante->client_id);

        # REQUEST
        $curl = curl_init();

        if($payment_method == 'CREDIT_CARD')
        {
            $json_assinatura = 
            "{\r\n  \"code\": \"" . $assinante->moip_subscription_code . "\",\r\n  \"amount\": \"\",\r\n  \"payment_method\": \"" . $assinante->payment_method . "\",\r\n  \"plan\": {\r\n      \"code\": \"" . $assinante->plan . "\"\r\n  },\r\n\"pro_rata\": true,\r\n\"best_invoice_date\": {\r\n    \"day_of_month\": \"" .$assinante->dia_vencimento . "\"\r\n}, \r\n  \"customer\": {\r\n      \"code\": \"" . $moip_customer_code . "\",\r\n      \"email\": \"" .$assinante->email . "\",\r\n      \"fullname\": \"" .$assinante->name . " " .$assinante->lastname . "\",\r\n      \"cpf\": \"" . $cpf . "\",\r\n      \"phone_number\": \"" . $telefone . "\",\r\n      \"phone_area_code\": \"" . $ddd . "\",\r\n      \"birthdate_day\": \"" . date("d", strtotime(str_replace('/', '-', $assinante->client_birthdate))) . "\",\r\n      \"birthdate_month\": \"" . date("m", strtotime(str_replace('/', '-', $assinante->client_birthdate))) . "\",\r\n      \"birthdate_year\": \"" . date("Y", strtotime(str_replace('/', '-', $assinante->client_birthdate))) . "\",\r\n      \"address\": {\r\n          \"street\": \"" .$assinante->street . "\",\r\n          \"number\": \"" .$assinante->number . "\",\r\n          \"complement\": \"" .$assinante->complement . "\",\r\n          \"district\": \"" .$assinante->neighborhood . "\",\r\n          \"city\": \"" . $assinante->cidade . "\",\r\n          \"state\": \"" . $assinante->estado . "\",\r\n          \"country\": \"BRA\",\r\n          \"zipcode\": \"" . $cep . "\"\r\n      },  \r\n      \"billing_info\": {\r\n          \"credit_card\": {\r\n              \"holder_name\": \"" . $cartao['holder_name'] . "\",\r\n              \"number\": \"" . str_replace(' ', '', $cartao['cartao_numero']) . "\",\r\n              \"expiration_month\": \"" . $cartao['expiration_month'] . "\",\r\n              \"expiration_year\": \"" . $cartao['expiration_year'] . "\"\r\n          }\r\n      }\r\n  }\r\n}";
        
        } else {
            $json_assinatura = 
            "{\r\n  \"code\": \"" . $assinante->moip_subscription_code . "\",\r\n  \"amount\": \"\",\r\n  \"payment_method\": \"" .$assinante->payment_method . "\",\r\n  \"plan\": {\r\n      \"code\": \"" . $assinante->plan . "\"\r\n  },\r\n\"pro_rata\": true,\r\n\"best_invoice_date\": {\r\n    \"day_of_month\": \"" .$assinante->dia_vencimento . "\"\r\n}, \r\n  \"customer\": {\r\n      \"code\": \"" .$moip_customer_code . "\",\r\n      \"email\": \"" .$assinante->email . "\",\r\n      \"fullname\": \"" .$assinante->name . " " .$assinante->lastname . "\",\r\n      \"cpf\": \"" . $cpf . "\",\r\n      \"phone_number\": \"" . $telefone . "\",\r\n      \"phone_area_code\": \"" . $ddd . "\",\r\n      \"birthdate_day\": \"" . date("d", strtotime(str_replace('/', '-', $assinante->client_birthdate))) . "\",\r\n      \"birthdate_month\": \"" . date("m", strtotime(str_replace('/', '-', $assinante->client_birthdate))) . "\",\r\n      \"birthdate_year\": \"" . date("Y", strtotime(str_replace('/', '-', $assinante->client_birthdate))) . "\",\r\n      \"address\": {\r\n          \"street\": \"" .$assinante->street . "\",\r\n          \"number\": \"" .$assinante->number . "\",\r\n          \"complement\": \"" .$assinante->complement . "\",\r\n          \"district\": \"" .$assinante->neighborhood . "\",\r\n          \"city\": \"" . $assinante->cidade . "\",\r\n          \"state\": \"" . $assinante->estado . "\",\r\n          \"country\": \"BRA\",\r\n          \"zipcode\": \"" . $cep . "\"\r\n      }\r\n  }\r\n}";
        }

        curl_setopt_array($curl, array(
        CURLOPT_URL => $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>$json_assinatura,
        CURLOPT_HTTPHEADER => array(
            "Accept-Charset: utf-8",
            "Authorization: Basic " . $this->getToken(),
            "Content-Type: application/json"
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    public function listFaturas($assinatura_id)
    {
        # ENDPOINT
        if(YII_ENV_DEV || YII_ENV_TEST)
        {
           $endpoint = "https://sandbox.moip.com.br/assinaturas/v1/subscriptions/" . $assinatura_id . "/invoices";
           
        } else {
            $endpoint = "https://api.moip.com.br/assinaturas/v1/subscriptions/" . $assinatura_id . "/invoices";
        }

        # REQUEST
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $endpoint,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Accept-Charset: utf-8",
            "Authorization: Basic " . $this->getToken(),
            "Content-Type: application/json"
        ),
        ));            
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    public function getAssinatura($assinatura_id)
    {
        # ENDPOINT
        if(YII_ENV_DEV || YII_ENV_TEST)
        {
           $endpoint =  "https://sandbox.moip.com.br/assinaturas/v1/subscriptions/" . $assinatura_id;
           
        } else {
            $endpoint =  "https://api.moip.com.br/assinaturas/v1/subscriptions/" . $assinatura_id;
        }

        # REQUEST
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept-Charset: utf-8",
                "Authorization: Basic " . $this->getToken(),
                "Content-Type: application/json"
            ),
            ));
        $response = curl_exec($curl);            
        curl_close($curl);
        return json_decode($response, true);
    }

    public function createAppUser($assinante, $senha)
    {
        # TRATANDO OS DADOS
        $ddd = substr(preg_replace('/[^0-9]/', '', $assinante->phone), 0, 2);
        $telefone = substr(preg_replace('/[^0-9]/', '', $assinante->phone), 2);
        $cep = preg_replace('/[^0-9]/', '', $assinante->postal_code);
        $cpf = preg_replace('/[^0-9]/', '', $assinante->client_id);
        $cnpj = preg_replace('/[^0-9]/', '', $assinante->company_id);
        $sexo = $assinante->client_sex == 'Masculino' ? 'M' : 'F';

        # ENDPOINT
        if(YII_ENV_DEV || YII_ENV_TEST)
        {
           $endpoint = "http://13.59.68.235:81/api/login/ServicoLoja";
           
        } else {
            $endpoint = "https://sistema.rdoapp.com.br/api/login/ServicoLoja";
        }

        $postfields = 
        '   {
                tipoLicenca: "' . $assinante->licenca . '",
                cpf: "' . $cpf . '",
                nomeColaborador: "' . $assinante->name . ' ' . $assinante->lastname . '",
                emailColaborador: "' . $assinante->email . '",
                telefoneColaborador: "' . $ddd . $telefone . '",
                senha: "' . $senha . '",
                sexo: "' . $sexo . '",
                nascimento: "' . $assinante->client_birthdate . '",
                logradouro: "' . $assinante->street . '",
                municipio: "' . $assinante->cidade . '",
                cep: "' . $cep . '",
                bairro: "' . $assinante->neighborhood . '",
                complemento: "' . $assinante->complement . '",
                numero: "' . $assinante->number . '",
                ramo: "' . $assinante->branch . '",
                setor: "' . $assinante->sector . '",
                razaoSocial: "' . $assinante->company_name . '",
                nomeFantasia: "' . $assinante->fantasy_name . '",
                cnpjEmpresa: "' . $cnpj . '",
                token: "' . $assinante->moip_subscription_code . '",
            }
        ';

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $endpoint,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $postfields,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));        
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}

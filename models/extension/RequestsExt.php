<?php

namespace app\models\extension;

use Yii;
use \app\models\Requests;

class RequestsExt extends \app\models\Requests
{
    public static function findById($id, $cliente_id)
    {
        $assinatura = Requests::find()
            ->alias('a')
			->select([
                            # REQUEST
                                'a.*'
                            ,   'DATE_FORMAT(a.checkout_date, "%d/%m/%Y") AS checkout_date'
                            ,   'CASE WHEN `a`.`payment_method` = \'CREDIT_CARD\'  
                                    THEN \'Cartão de Crédito\' 
                                WHEN  `a`.`payment_method` = \'BOLETO\' 
                                    THEN \'Boleto\'  
                                ELSE \'\' 
                                END AS payment_method'
                            ,   'CASE WHEN `a`.`status` = 1 THEN \'Ativo\' ELSE \'Inativo\' END AS status_label'

                            # CLIENT
                            ,   'c.client_birthdate',   'c.client_id', 'c.moip_customer_code'
                            ,   'CASE WHEN `c`.`client_sex` = \'M\' THEN \'Masculino\' ELSE \'Feminino\' END AS client_sex'

                            # USER
                            ,   'u.name', 'u.lastname', 'u.phone', 'u.postal_code', 'u.street', 'u.number', 'u.complement', 'u.neighborhood', 'u.email'

                            #OTHERS
                            ,   'cd.name AS cidade'
                            ,   'es.abbr AS estado'
                            ,   'p.name AS plano'
                            ,   'l.name  AS licenca'
                            ,   'cp.company_name', 'cp.fantasy_name', 'cp.company_id', 'cp.branch', 'cp.sector'
                        ])
                ->innerJoin('clients c', 'c.code = a.client')
                ->innerJoin('users u', 'u.code = c.user')
                ->innerJoin('companies cp', 'cp.code = a.company')
                ->innerJoin('plans p', 'p.code = a.plan')
                ->innerJoin('licenses l', 'l.code = p.plan_type')
                ->innerJoin('cities cd', 'cd.code = u.city')
                ->innerJoin('states es', 'es.code = u.state')
            ->where(['a.code' => $id, 'a.client' => $cliente_id, 'a.status' => 1])
            ->one();

        if (count($assinatura) == 1)
		{
            return $assinatura;
        
		} else { 
			throw new \yii\web\BadRequestHttpException('Não foi possível gerar os dados.', 500);
		}
    }

    public static function duplicidadeEmpresa($empresa_id)
    {
        return $assinatura = Requests::find()
            ->alias('r')
			->select([
                                'r.*'
                        ])
            ->innerJoin('companies c', 'c.code = r.company')
            ->where(['c.company_id' => trim($empresa_id)])
            ->one();
    }

    public static function findAllById($cliente_id)
    {
        $assinaturas = Requests::find()
            ->alias('a')
			->select([
                                'a.code', 'a.code_alias', 'a.moip_subscription_code', 'a.checkout_value'
                            ,   'cp.fantasy_name'
                            ,   'p.name AS plano'
                            ,   'c.client_birthdate'
                            ,   'l.name  AS licenca'
                            ,   'DATE_FORMAT(a.checkout_date, "%d/%m/%Y") AS checkout_date'
                            ,   'CASE WHEN `a`.`status` = 1 THEN \'Ativo\' ELSE \'Inativo\' END AS status_label'
                        ])
            ->where(['a.user' => $cliente_id])
            ->andWhere(['<>', 'a.status', '2'])
            ->innerJoin('clients c', 'c.code = a.client')
            ->innerJoin('plans p', 'p.code = a.plan')
            ->innerJoin('licenses l', 'l.code = p.plan_type')
            ->innerJoin('companies cp', 'cp.code = a.company')
            ->orderBy(new \yii\db\Expression('SUBSTRING_INDEX(code_alias, "/", -1) DESC, SUBSTRING_INDEX(code_alias, "/", 1) DESC'))
            ->all();

        return $assinaturas;
    }

    public static function translateStatusAssinatura($status)
    {
        switch($status)
        {  
            case 'ACTIVE':
                $status = 'ATIVO';
                break;
            case 'SUSPENDED':
                $status = 'SUSPENSO';
                break;
            case 'EXPIRED':
                $status = 'EXPIRADO';
                break;
            case 'OVERDUE':
                $status = 'AGUARDANDO';
                break;
            case 'CANCELED':
                $status = 'CANCELADO';
                break;
            case 'TRIAL':
                $status = 'TRIAL';
                break;

            default:
                $status = '';
        }

        return $status;
    }
}

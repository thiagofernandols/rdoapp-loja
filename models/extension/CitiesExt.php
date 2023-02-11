<?php

namespace app\models\extension;

use Yii;
use \app\models\Cities;

class CitiesExt extends \app\models\Cities
{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function LoadCidades() {
        $query = new CDbCriteria();
        $query->select = "id, cidade, codigoibge";
        $query->condition = "status = 'ATIVO'";
        $query->order = "cidade";
        return $this->findAll($query);
    }

    public function LoadCidadesPorEstado($estado_id) 
    {
        if ($estado_id)
        {
            $cidades = Cities::find()
            ->alias('c')
            ->select(" c.* ")
            ->where(" c.state = '" . $estado_id . "'")
            ->all();
            
            return $cidades;

        } else {
            return false;
        }
    }

    public function LoadCidade($tipo = 'id', $condition, $sigla = '') 
	{
		$where = array();
		
        switch ($tipo) {
            case 'id':
                $where['c.code'] = $condition;
                break;
            case 'nome':
                $where['c.name'] = $condition;
                break;
            case 'estado':
                $where['c.name'] = $condition;
                $where['e.abbr'] = $sigla;
                break;
        }
		
        $cidade = Cities::find()
            ->alias('c')
            ->select("c.*, e.name, e.abbr")
            ->innerJoin('states e',  'e.code = c.state')
            ->where($where)
            ->one();

		return $cidade;
    }
}

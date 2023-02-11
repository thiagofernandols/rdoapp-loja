<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\helpers\CustomHelper;

class Menu extends Widget
{
	public $items = [];
	public $dados;

    public function run()
    {
		if (strpos($_SERVER['REQUEST_URI'],'/login') === false && strpos($_SERVER['REQUEST_URI'],'/carrinho') === false && strpos($_SERVER['REQUEST_URI'],'/sistema') === false && strpos($_SERVER['REQUEST_URI'],'/cadastro') === false && strpos($_SERVER['REQUEST_URI'],'/recover') === false && strpos($_SERVER['REQUEST_URI'],'/redefinir-senha') === false && strpos($_SERVER['REQUEST_URI'],'/contato') === false)
		{
			return $this->render('menu', [
				'items' => $this->items,
				'dados' => $this->dados
			]);
		}
    } 
}
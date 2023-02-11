<?//=header('Content-Type: text/html; charset=ISO-8859-1');?>
<option value="">Cidade</option>
<? foreach ($cidades as $cidade):?>
    <option value="<?=$cidade['code']?>"><?=$cidade['name']?></option>
<? endforeach;?>
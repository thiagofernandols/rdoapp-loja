<?
    use yii\helpers\Html;
?>
    <main id="main" class="interna conta">
        <article id="st-in-tit">
            <i class="mdi mdi-account"></i>
            <div class="tit">Minha CONTA</div>
        </article>
        <article id="st-in-conta">
            <section class="w1280">
                <div class="abas">
                    <a href="<?=Yii::$app->params['pathUrlWeb']?>assinaturas" class="opcao effectp5"><i class="mdi mdi-view-list effectp5"></i> Assinaturas</a>
                    <a class="atual effectp5"><i class="mdi mdi-account effectp5"></i> Conta</a>
                </div>
                <form class="form f-conta <?=isset($recover_return) ? 'hide' : ''?>" id="conta-form" action="<?=Yii::$app->params['pathUrlWeb']?>minha-conta" method="post">
					<?	if(Yii::$app->session->hasFlash('sucesso'))
						{
					?>
					<br /><br />
					<font style="display: block;text-align: center;" color="red"><b><?=Yii::$app->session->getFlash('sucesso');?></b></font>
					<? 	} ?>
					<?	if(isset($validate_errors))
						{
					?>
					<br /><br />
					<font style="display: block;text-align: center;" color=""><?=$validate_errors?></font>
					<? 	} ?>
					<?	if(isset($class_errors))
						{
					?>
					<br /><br />
					<font style="display: block;text-align: center;" color="red"><b>ATENÇÃO! Aconteceram os seguintes erros:</b></font><br />
					<?
							foreach($class_errors as $class_error)
							{
								foreach($class_error as $class_error_each)
								{
					?>
					<font style="display: block;text-align: center;" color=""><?=$class_error_each?></font><br />
					<?			} ?>
					<?		} ?>
					<?	} ?>
					<?	if(isset($class_errors_clients))
						{
					?>
					<br /><br />
					<font style="display: block;text-align: center;" color="red"><b>ATENÇÃO! Aconteceram os seguintes erros:</b></font><br />
					<?
							foreach($class_errors_clients as $class_error)
							{
								foreach($class_error as $class_error_each)
								{
					?>
					<font style="display: block;text-align: center;" color=""><?=$class_error_each?></font><br />
					<?			} ?>
					<?		} ?>
					<?	} ?>
                    <?	if(isset($return_senha) && !empty($return_senha))
						{
					?>
					<br /><br />
					<font style="display: block;text-align: center;" color="red"><b>ATENÇÃO! Aconteceram os seguintes erros:</b></font><br />
                    <?      foreach($return_senha as $return_senha_row)
                            {
                    ?>
					<font style="display: block;text-align: center;" color=""><?=$return_senha_row?></font>
					<? 	    } ?>
					<? 	} ?>                    <div class="tit">
                        <span>Meus dados</span>
                        <hr class="linha" />
                    </div>
					<input type="hidden" id="_csrf" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <label class="col2">
						<input type="text" id="name" name="Users[name]" class="box effectp5" placeholder="*Nome" value="<?=isset($dados_user['name']) ? $dados_user['name'] : $user->name?>" data-validation-engine="validate[required]" maxlength="255" />
					</label>
                    <label class="col2">
						<input type="text" id="lastname" name="Users[lastname]" class="box effectp5" placeholder="*Sobrenome" value="<?=isset($dados_user['lastname']) ? $dados_user['lastname'] : $user->lastname?>" data-validation-engine="validate[required]" maxlength="255" />
					</label>
                    <label class="col3">
						<input type="text" id="client_id" name="Clients[client_id]" class="box effectp5" placeholder="*CPF" value="<?=isset($dados_client['client_id']) ? $dados_client['client_id'] : $client->client_id?>" data-validation-engine="validate[required,custom[cpf]]" maxlength="255" data-mask="999.999.999-99" />
					</label>
                    <label class="col3">
						<input type="email" id="email" name="Users[email]" class="box effectp5" placeholder="*E-mail" value="<?=isset($dados_user['email']) ? $dados_user['email'] : $user->email?>" data-validation-engine="validate[required,custom[email]]" maxlength="255" disabled />
					</label>
                    <label class="col3">
						<input type="tel" id="phone" name="Users[phone]" class="box effectp5" placeholder="*Telefone" value="<?=isset($dados_user['phone']) ? $dados_user['phone'] : $user->phone?>" data-validation-engine="validate[required]" data-mask-telephone />
					</label>
                    <label class="col3">
                        <select name="Clients[client_sex]" class="box effectp5" data-validation-engine="validate[required]" >
                            <option value="" class="">*Sexo</option>
                            <option value="f" class="Feminino" <?=(isset($dados_client['client_sex']) ? $dados_client['client_sex'] : $client['client_sex']) == 'f' ? 'selected' : ''?> >Feminino</option>
                            <option value="m" class="Masculino" <?=(isset($dados_client['client_sex']) ? $dados_client['client_sex'] : $client['client_sex']) == 'm' ? 'selected' : ''?> >Masculino</option>
                        </select>
                    </label>
                    <label class="col3">
						<input type="date" name="Clients[client_birthdate]" class="box effectp5" placeholder="*Data de Nascimento" value="<?=isset($dados_client['client_birthdate']) ? $dados_client['client_birthdate'] : $client['client_birthdate']?>" data-validation-engine="validate[required]" maxlength="255" />
					</label>
					<?	/* ?>
                    <div class="tit">
                        <span>Empresa</span>
                        <hr class="linha" />
                    </div>
                    <label class="col2">
						<input type="text" id="fantasy_name" name="Companies[fantasy_name]" class="box effectp5" placeholder="Nome Fantasia" value="<?=$dados_company['fantasy_name'] ? $dados_company['fantasy_name'] : $company->fantasy_name?>" data-validation-engine="validate[required]" maxlength="255" />
					</label>
                    <label class="col2">
						<input type="text" id="company_name" name="Companies[company_name]" class="box effectp5" placeholder="Razão Social" value="<?=$dados_company['company_name'] ? $dados_company['company_name'] : $company->company_name?>" data-validation-engine="validate[required]" maxlength="255" />
					</label>
                    <label class="col2">
						<input type="text" id="company_id" name="Companies[company_id]" class="box effectp5" placeholder="CNPJ" value="<?=$dados_company['company_id'] ? $dados_company['company_id'] : $company->company_id?>" data-mask="99.999.999/9999-99" data-validation-engine="validate[required, custom[cnpj]] maxlength="255" />
					</label>
                    <label class="col3">
                        <?=Html::activeDropDownList($company, 'branch', $branches, ['id' => 'branch', 'value' =>  ($dados_company['branch'] ? $dados_company['branch'] : ($company->branch ? $company->branch : '')), 'class' => 'box effectp5', 'prompt' => 'Ramo', 'data-validation-engine' => 'validate[required]']) ?>
					</label>
                    <label class="col3">
                        <?=Html::activeDropDownList($company, 'sector', $sectors, ['id' => 'sector', 'value' =>  ($dados_company['sector'] ? $dados_company['sector'] : ($company->sector ? $company->sector : '')), 'class' => 'box effectp5', 'prompt' => 'Setor', 'data-validation-engine' => 'validate[required]']) ?>
					</label>
					<?	*/ ?>
                    <div class="tit">
                        <span>Endereço</span>
                        <hr class="linha" />
                    </div>
                    <label class="col3">
						<input type="text" id="postal_code" name="Users[postal_code]" class="box effectp5" placeholder="*CEP" value="<?=isset($dados_user['postal_code']) ? $dados_user['postal_code'] : $user->postal_code?>" data-validation-engine="validate[required]" maxlength="255" data-mask="99999-999" data-cep-cadastro />
					</label>
                    <label class="col3x2">
						<input type="text" id="street" name="Users[street]" class="box effectp5" placeholder="*Endereço" value="<?=isset($dados_user['street']) ? $dados_user['street'] : $user->street?>" data-validation-engine="validate[required]" maxlength="255" />
					</label>
                    <label class="col3">
						<input type="text" id="number" name="Users[number]" class="box effectp5" placeholder="*Número" value="<?=isset($dados_user['number']) ? $dados_user['number'] : $user->number?>" data-validation-engine="validate[required]" maxlength="255" />
					</label>
                    <label class="col3x2">
						<input type="text" id="complement" name="Users[complement]" class="box effectp5" placeholder="Complemento" value="<?=isset($dados_user['complement']) ? $dados_user['complement'] : $user->complement?>" data-validation-engine="validate[]" maxlength="255" />
					</label>
                    <label class="col3">
						<input type="text" id="neighborhood" name="Users[neighborhood]" class="box effectp5" placeholder="*Bairro" value="<?=isset($dados_user['neighborhood']) ? $dados_user['neighborhood'] : $user->neighborhood?>" data-validation-engine="validate[required]" maxlength="255" />
					</label>
                    <label class="col3">
                        <?=Html::activeDropDownList($user, 'state', $estados, ['id' => 'state', 'class' => 'box effectp5', 'prompt' => 'Estado', 'data-validation-engine' => 'validate[required]', 'data-estado' => '']) ?>
					</label>
                    <label class="col3">
                        <?=Html::activeDropDownList($user, 'city', $cidades, ['id' => 'city', 'class' => 'box effectp5', 'prompt' => 'Cidade', 'data-validation-engine' => 'validate[required]', 'data-cidade' => '']) ?>
					</label>
                    <div class="linhasubmite">
                        <input type="submit" value="SALVAR" class="bt-salvar effectp5" />
                        <hr class="linha" />
                    </div>
                </form>
                <form class="form f-conta <?=isset($recover_return) ? 'hide' : ''?>" id="recover-form" action="<?=Yii::$app->params['pathUrlWeb']?>minha-conta" method="post">
                    <div class="linhamudarsenha">
                        <a class="bt-mudarsenha effectp5"><i class="mdi mdi-key effectp5"></i> Mudar senha</a>
                    </div>
                    <div class="linhaformsenha hide">
    					<input type="hidden" id="_csrf" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
						<label class="col3">
							<input type="password" id="senha_atual" name="TrocarSenha[senha_atual]" class="box effectp5" placeholder="*Senha Atual" value="" data-validation-engine="validate[required]" maxlength="255" />
						</label>
                        <label class="col3">
                            <input type="password" id="CadastroSenha" name="TrocarSenha[senha_nova]" placeholder="*Nova Senha" class="box effectp5" value="" data-validation-engine="validate[required, minSize[4],maxSize[10]]" />
                        </label>
                        <label class="col3">
                            <input type="password" id="senha_confirm" name="TrocarSenha[senha_confirm]" placeholder="*Confirmar Nova Senha" class="box effectp5" value="" data-validation-engine="validate[required, equals[CadastroSenha],minSize[4],maxSize[10]]" />
                        </label>
                    <div class="linhasubmite">
                        <input type="submit" value="ENVIAR SENHA" class="bt-salvar effectp5" />
                        <hr class="linha" />
                    </div>
                    </div>
                </form>
            </section>
        </article>
    </main>

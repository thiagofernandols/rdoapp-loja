(function($){
	$.fn.validationEngineLanguage = function(){};
	$.validationEngineLanguage = {
		newLang: function(){
			$.validationEngineLanguage.allRules = {
				"required": {
					"regex": "none",
					"alertText": "* Este campo é obrigatório",
					"alertTextCheckboxMultiple": "* Favor selecionar uma opção",
					"alertTextCheckboxe": "* Este checkbox é obrigatório",
					"alertTextDateRange": "* Ambas as datas do intervalo são obrigatórias"
				},
				"requiredInFunction": { 
					"func": function(field, rules, i, options){
						return (field.val() == "test") ? true : false;
					},
					"alertText": "* O campo deve ser igual"
				},
				"dateRange": {
					"regex": "none",
					"alertText": "* Intervalo de datas inválido"
				},
				"dateTimeRange": {
					"regex": "none",
					"alertText": "* Intervalo de data e hora inválido"
				},
				"minSize": {
					"regex": "none",
					"alertText": "* Permitido o mínimo de ",
					"alertText2": " caractere(s)"
				},
				"maxSize": {
					"regex": "none",
					"alertText": "* Permitido o máximo de ",
					"alertText2": " caractere(s)"
				},
				"groupRequired": {
					"regex": "none",
					"alertText": "* Você deve preencher um dos seguintes campos"
				},
				"min": {
					"regex": "none",
					"alertText": "* Valor mínimo é "
				},
				"max": {
					"regex": "none",
					"alertText": "* Valor máximo é "
				},
				"past": {
					"regex": "none",
					"alertText": "* Data anterior a "
				},
				"future": {
					"regex": "none",
					"alertText": "* Data posterior a "
				},  
				"maxCheckbox": {
					"regex": "none",
					"alertText": "* Máximo de ",
					"alertText2": " opções permitidas"
				},
				"minCheckbox": {
					"regex": "none",
					"alertText": "* Favor selecionar ",
					"alertText2": " opção(ões)"
				},
				"equals": {
					"regex": "none",
					"alertText": "* Os campos não correspondem"
				},
				"creditCard": {
					"regex": "none",
					"alertText": "* Número de cartão de crédito inválido"
				},
				"phone": {
					"regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,
					"alertText": "* Número de telefone inválido"
				},
				"email": {
					"regex": /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
					"alertText": "* Endereço de email inválido"
				},
				"integer": {
					"regex": /^[\-\+]?\d+$/,
					"alertText": "* Número inteiro inválido"
				},
				"number": {
					"regex": /^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/,
					"alertText": "* Número decimal inválido"
				},
				"date": {
					"regex": /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/,
					"alertText": "* Data inválida, deve ser no formato DIA/MÊS/ANO"
				},
				"ipv4": {
					"regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
					"alertText": "* Endereço IP inválido"
				},
				"url": {
					"regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
					"alertText": "* URL inválida"
				},
				"onlyNumberSp": {
					"regex": /^[0-9\ ]+$/,
					"alertText": "* Apenas números"
				},
				"onlyLetterSp": {
					"regex": /^[a-zA-Z\ \']+$/,
					"alertText": "* Apenas letras"
				},
				"onlyLetterAccentSp":{
					"regex": /^[a-z\u00C0-\u017F\ ]+$/i,
					"alertText": "* Apenas letras e espaços."
				},
				"onlyLetterNumber": {
					"regex": /^[0-9a-zA-Z]+$/,
					"alertText": "* Não são permitidos caracteres especiais"
				},
				"real": {
					// Brazilian (Real - R$) money format
					"regex": /^([1-9]{1}[\d]{0,2}(\.[\d]{3})*(\,[\d]{0,2})?|[1-9]{1}[\d]{0,}(\,[\d]{0,2})?|0(\,[\d]{0,2})?|(\,[\d]{1,2})?)$/,
					"alertText": "* Número decimal inválido"
				},
				"cnpj": {
					"func": function(field, rules, i, options){
						cnpj = field.val().replace(/[^\d]+/g,'');
						if(cnpj == '') return false;
						if (cnpj.length != 14
						|| cnpj == "00000000000000"
						|| cnpj == "11111111111111"
						|| cnpj == "22222222222222"
						|| cnpj == "33333333333333"
						|| cnpj == "44444444444444"
						|| cnpj == "55555555555555"
						|| cnpj == "66666666666666"
						|| cnpj == "77777777777777"
						|| cnpj == "88888888888888"
						|| cnpj == "99999999999999")
							return false;
							 
						// Valida DVs
						tamanho = cnpj.length - 2
						numeros = cnpj.substring(0,tamanho);
						digitos = cnpj.substring(tamanho);
						soma = 0;
						pos = tamanho - 7;
						for (i = tamanho; i >= 1; i--) {
							soma += numeros.charAt(tamanho - i) * pos--;
							if (pos < 2)
								pos = 9;
						}
						resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
						if (resultado != digitos.charAt(0))
							return false;
							 
						tamanho = tamanho + 1;
						numeros = cnpj.substring(0,tamanho);
						soma = 0;
						pos = tamanho - 7;
						for (i = tamanho; i >= 1; i--) {
							soma += numeros.charAt(tamanho - i) * pos--;
							if (pos < 2)
								pos = 9;
						}
						resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
						if (resultado != digitos.charAt(1))
							return false;
						return true;
					},
					"alertText": "CNPJ inválido",
					"alertTextOK": "CNPJ válido"
				},
				"cpf": {
					// CPF is the Brazilian ID
					"func": function(field, rules, i, options){
						var cpf = field.val().replace(/[^\d]+/g,'');    
						if(cpf == '') return false; 
						// Elimina CPFs invalidos conhecidos    
						if (cpf.length != 11
						|| cpf == "00000000000"
						|| cpf == "11111111111"
						|| cpf == "22222222222"
						|| cpf == "33333333333"
						|| cpf == "44444444444"
						|| cpf == "55555555555"
						|| cpf == "66666666666"
						|| cpf == "77777777777"
						|| cpf == "88888888888"
						|| cpf == "99999999999")
							return false;
						// Valida 1o digito 
						add = 0;    
						for (i=0; i < 9; i ++)       
							add += parseInt(cpf.charAt(i)) * (10 - i);  
							rev = 11 - (add % 11);  
							if (rev == 10 || rev == 11)     
								rev = 0;    
							if (rev != parseInt(cpf.charAt(9)))     
								return false;
						// Valida 2o digito 
						add = 0;    
						for (i = 0; i < 10; i ++)
							add += parseInt(cpf.charAt(i)) * (11 - i);  
						rev = 11 - (add % 11);  
						if (rev == 10 || rev == 11) 
							rev = 0;    
						if (rev != parseInt(cpf.charAt(10)))
							return false;
						return true;
					},
					"alertText": "CPF inválido",
					"alertTextOK": "CPF válido"
				}
			};
			
		}
	};

	$.validationEngineLanguage.newLang();
	
})(jQuery);

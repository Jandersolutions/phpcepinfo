<?php

/**
* Classe para busca de informações sobre localização
* @author Jonathan A. Schweder <jonathanschweder@gmail.com>
*/
class Localizacao
{
	/**
	 * Retorna objeto JSON de localização por CEP
	 * @param  string $cep
	 * @return json(cep, logradouro, bairro, cidade, uf)
	 */
	public static function getArrayByCep($cep=''){
		if ($cep) {
			$jsonObject = NULL;
			$bindArray  = array();

			//http://api.postmon.com.br
			//GIT: https://github.com/PostmonAPI/postmon
			if (\Network::ping('107.21.111.101')) {
				$jsonObject = file_get_contents("http://api.postmon.com.br/v1/cep/$cep");
				
				if (!empty($jsonObject)) {		
					//bindArray['cep'] = 'atributo do objeto JSON que possui o valor para CEP'				
					$bindArray['cep'] 			= 'cep';
					$bindArray['logradouro'] 	= 'logradouro';
					$bindArray['bairro'] 		= 'bairro';
					$bindArray['cidade'] 		= 'cidade';
					$bindArray['uf'] 			= 'estado_info';

					//Tratamento de casos especificos ('uf' = JSON{nome,area_km2, codigo_ibge})
					$bindArray = \Localizacao::bindDataJsonToArray($jsonObject,$bindArray);

					if ((is_array($bindArray['uf']))&&(isset($bindArray['uf']['nome']))) {
						$bindArray['uf'] = $bindArray['uf']['nome'];
					}					
				}				
			}elseif (\Network::ping('107.21.95.174')) {
				$jsonObject = file_get_contents("http://api.postmon.com.br/v1/cep/$cep");
				
				if (!empty($jsonObject)) {		
					//bindArray['cep'] = 'atributo do objeto JSON que possui o valor para CEP'				
					$bindArray['cep'] 			= 'cep';
					$bindArray['logradouro'] 	= 'logradouro';
					$bindArray['bairro'] 		= 'bairro';
					$bindArray['cidade'] 		= 'cidade';
					$bindArray['uf'] 			= 'estado_info';

					//Tratamento de casos especificos ('uf' = JSON{nome,area_km2, codigo_ibge})
					$bindArray = \Localizacao::bindDataJsonToArray($jsonObject,$bindArray);

					if ((is_array($bindArray['uf']))&&(isset($bindArray['uf']['nome']))) {
						$bindArray['uf'] = $bindArray['uf']['nome'];
					}					
				}
			}

			return $bindArray;
		}
	}

	/**
	 * Carrega valores do objeto JSON para o Array
	 * @param  json $jsonObject 
	 * @param  array  $bindArray  
	 * @return array             
	 */
	public static function bindDataJsonToArray($jsonObject=NULL, $bindArray=array()){

		$jsonAttributes = json_decode($jsonObject, TRUE);
		foreach ($bindArray as $key => $value) {
			if (isset($jsonAttributes[$value])){
				$bindArray[$key] = $jsonAttributes[$value];
			}else{				
				$bindArray[$key] = NULL;
			}
		}
		return $bindArray;
	}
}
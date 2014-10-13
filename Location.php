<?php

/**
* Classe para busca de informações sobre localização
* @author Jonathan A. Schweder <jonathanschweder@gmail.com>
*/
class Location
{
	/**
	 * Retorna objeto JSON de localização por CEP
	 * @param  string $cep
	 * @return json(cep, logradouro, bairro, cidade, uf)
	 */
	public static function getArrayByCep($cep=''){
		if ($cep) {		
			//http://cep.correiocontrol.com.br/
			return json_decode(file_get_contents("http://cep.correiocontrol.com.br/".$cep.".json"));
		}
		return NULL;
	}
} 
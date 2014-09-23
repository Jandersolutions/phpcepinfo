<?php

/**
* Classe para trabalhar com funções de Redes
* @author Jonathan A. Schweder <jonathanschweder@gmail.com>
*/		
class Network
{

  /**
   * Idem função PING do DOS
   * @param  string $host host de destino
   * @param  int $port    porta de destino
   * @param  int $timeout time de conexão
   * @return int (ms) de tempo
   */
	public static function ping($host='', $port=80, $timeout=100) { 
  		try {
        $timeBefore = microtime(TRUE); 
        $socket = fSockOpen($host, $port, $errno, $errstr, $timeout);   
        $timeAfter = microtime(TRUE);
        return round((($timeAfter - $timeBefore) * 1000), 0);        
        
      } catch (Exception $e) {
        return FALSE;
      }
	}
}
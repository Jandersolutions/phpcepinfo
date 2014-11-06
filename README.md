phpcepinfo
==========

Biblioteca que concentra varios serviços de localização para PHP

Uso:

	echo \Location::getArrayByCep('89050000');
	# array['cep'        => '89050000',
	#       'logradouro' => 'Avenida Brasil',
	# 	'bairro'     => 'Ponta Aguda',
	# 	'cidade'     => 'Blumenau'
	# 	'uf'         => 'SC']

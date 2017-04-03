<?php
/* Arquivo dará suporte para resumir a descrição e converter data do banco  */
function traduz_data_visualizacao($data) 
{
	$data_hora = explode(" ", $data);
	$data = explode("-", $data_hora[0]);
	
	$data_exibir = "{$data[2]}/{$data[1]}/{$data[0]} " . $data_hora[1];
	
	return $data_exibir;
}

function traduz_data_home($data) 
{
	$data_hora = explode(" ", $data);
	$data = explode("-", $data_hora[0]);
	
	$data_exibir = "{$data[2]}/{$data[1]}/{$data[0]} ";
	
	return $data_exibir;
}

function descricao_resumida($texto) 
{
	if(strlen($texto) > 0) 
	{
		$descricao = '';
		for ($i=0; $i < 50; $i++) { 
			$descricao = $descricao . $texto[$i];
		}

		return trim($descricao) . '..';
	}	
}
?>
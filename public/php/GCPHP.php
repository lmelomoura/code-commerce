<?php
/***********************************
Copyright---------------------------
@author Luiz Fernando de Melo Moura
@e-mail lfmoura@gmail.com
@GCPHP v.0.1a
Copyright---------------------------
***********************************/
require_once('config/config.cfg.php');
//Carregando as bibliotecas necessárias
$handler = opendir('./libraries');
while ($file = readdir($handler)) {
	if ($file != '.' && $file != '..' && $file != '.lib.php')
    	require_once('./libraries/'.$file);
}
closedir($handler);

class GCPHP{
	
	private $Conexao;
	private $Tabelas;
	private $BaseDados;
	private $TabelasLigadas;
	
	public function __construct(){
		$this->TabelasLigadas = array();
		$this->Tabelas = array();
		try{
			$this->Conexao = new GCPHPConexao;
		}catch (GCPHPConexaoErros $e){
			echo $e;
		}
	}
	
	public function set_BaseDados($BaseDados){
		try{
			$this->Conexao->set_BaseDados($BaseDados);
			$this->BaseDados = $BaseDados;
		}catch (GCPHPConexaoErros $e){
			echo $e;
		}		
	}
	
	public function get_BaseDados(){
		return $this->BaseDados;
	}
	
	public function set_Tabelas(){
		$Resultado = array();
		try{
			if (func_num_args() < 1) throw new GCPHPTabelasErros('Especifique ao menos uma tabela a ser usada.', md5('GCPHPTabelasErros-set_Tabelas'));
			else{
				foreach(func_get_args() as $key=>$val){
					$TabelasTemporarias[$key] = $val;
				}
				$Query = 'SHOW TABLES FROM '.$this->get_BaseDados();
				$ResultadoQuery = mysql_query($Query, $this->Conexao->get_Conexao());
				while ($Linhas= mysql_fetch_array($ResultadoQuery, MYSQL_NUM)) {
				    array_push($Resultado, $Linhas[0]); 
				}
				
				foreach($TabelasTemporarias as $key=>$val){
					if (fast_in_array($val,$Resultado)){
						$this->Tabelas[$key] = $val;
					}else throw new GCPHPTabelasErros('Tabela \''.$val.'\' não existe na base de dados.', md5('GCPHPTabelasErros-set_Tabelas')); 
				}
				

				if (count($this->get_Tabelas()) > 0){
					foreach ($this->get_Tabelas() as $key=>$val){
						$this->set_TabelasLigadas($val);
					}				
				}
			}
		}catch(GCPHPTabelasErros $e){
			echo $e;
		}
	}
	
	public function get_Tabelas(){
		return $this->Tabelas;
	}
	
	private function set_TabelasLigadas($Tabela){																						 
		$Query = 'select REFERENCED_TABLE_NAME from INFORMATION_SCHEMA.KEY_COLUMN_USAGE where TABLE_NAME = \''.$Tabela.'\' and CONSTRAINT_SCHEMA = \''.$this->get_baseDados().'\' and CONSTRAINT_NAME <> \'PRIMARY\' and CONSTRAINT_NAME <> \'INDEX\' and CONSTRAINT_NAME <> \'UNIQUE\' and CONSTRAINT_NAME <> \'FULLTEXT\'';
		$ResultadoQuery = mysql_query($Query, $this->Conexao->get_Conexao());
		while ($Linhas =  mysql_fetch_array($ResultadoQuery, MYSQL_NUM)){			
			if (!in_array($Linhas[0],$this->get_Tabelas())){
				array_push($this->TabelasLigadas, $Linhas[0]); 
			}
		}
	}
	
	public function get_TabelasLigadas(){
		return $this->TabelasLigadas;
	}
	
	public function gerarClasses(){
		$TodasTabelas = array_merge($this->TabelasLigadas, $this->Tabelas);
		
		foreach ($TodasTabelas as $key=>$val){
			$Atributos = $this->obterAtributos($val);
			$Metodos = $this->obterMetodos($val);
			$Construtor = $this->obterConstrutor($val);
			$Classe = "
				class $val{
					$Atributos
					$Construtor
					$Metodos
				}
			";
			eval($Classe);
		}
		
		foreach ($this->Tabelas as $key=>$val){
			$Classe = "
				class $val".'Dao'."{
				}
			";
			echo $Classe;
		}
	}
	
	private function obterColunas($Tabela, $Completo = true){
		$Index = 0;
		$Query = "
			SELECT
				COLUMN_NAME,
				COLUMN_DEFAULT,
				IS_NULLABLE,
				DATA_TYPE,
				CHARACTER_MAXIMUM_LENGTH,
				EXTRA,(
					   SELECT
					   		REFERENCED_TABLE_NAME
					   FROM
					   		INFORMATION_SCHEMA.KEY_COLUMN_USAGE
					   WHERE
					   		INFORMATION_SCHEMA.KEY_COLUMN_USAGE.TABLE_NAME = INFORMATION_SCHEMA.COLUMNS.TABLE_NAME
					   AND
					   		INFORMATION_SCHEMA.KEY_COLUMN_USAGE.CONSTRAINT_SCHEMA = INFORMATION_SCHEMA.COLUMNS.TABLE_SCHEMA
					   AND
					   		CONSTRAINT_NAME NOT IN ('PRIMARY', 'INDEX', 'UNIQUE', 'FULLTEXT')
					   AND
					   		INFORMATION_SCHEMA.KEY_COLUMN_USAGE.COLUMN_NAME = INFORMATION_SCHEMA.COLUMNS.COLUMN_NAME
				) AS REFERENCED_TABLE_NAME
			FROM
				INFORMATION_SCHEMA.COLUMNS
			WHERE
				TABLE_SCHEMA = '".$this->get_baseDados()."'
			AND
				TABLE_NAME = '".$Tabela."'";		
		$Resultado = mysql_query($Query, $this->Conexao->get_Conexao());
		while ($Linhas = mysql_fetch_array($Resultado, MYSQL_ASSOC)){
			$Colunas[$Index]["COLUMN_NAME"] = $Linhas["COLUMN_NAME"];
			$Colunas[$Index]["COLUMN_DEFAULT"] = $Linhast["COLUMN_DEFAULT"];
			$Colunas[$Index]["IS_NULLABLE"] = $Linhas["IS_NULLABLE"];
			$Colunas[$Index]["DATA_TYPE"] = $Linhas["DATA_TYPE"];
			$Colunas[$Index]["CHARACTER_MAXIMUM_LENGTH"] = $Linhas["CHARACTER_MAXIMUM_LENGTH"];
			$Colunas[$Index]["EXTRA"] = $Linhas["EXTRA"];
			$Colunas[$Index]["REFERENCED_TABLE_NAME"] = $Linhas["REFERENCED_TABLE_NAME"];
			$Index++;
		}
		return  $Colunas;
	}
	
	private function obterAtributos($Tabela){
		$Estrangeiros = array();
		$Colunas = $this->obterColunas($Tabela);
		for($Index = 0; $Index <= count($Colunas) - 1; $Index++)
			if (empty($Colunas[$Index]["REFERENCED_TABLE_NAME"]))
				$Atributos .= "private \$".$Colunas[$Index]["COLUMN_NAME"].";";
			else if(@!in_array($Colunas[$Index]["COLUMN_NAME"], $Estrangeiros))
				array_push($Estrangeiros,$Colunas[$Index]["REFERENCED_TABLE_NAME"]);
			if (count($Estrangeiros) > 0)
				for($Index = 0; $Index <= count($Estrangeiros) - 1; $Index++)
					$Atributos .= "private \$".$Estrangeiros[$Index].";";
		return $Atributos;
	}
		
	private function obterMetodos($Tabela){
		$Estrangeiros = array();
		$Colunas = $this->obterColunas($Tabela);
		for($Index = 0; $Index <= count($Colunas) - 1; $Index++)
			if (empty($Colunas[$Index]["REFERENCED_TABLE_NAME"]))
				$Metodos .= "
					public function get_".$Colunas[$Index]["COLUMN_NAME"]."(){
						return \$this->".$Colunas[$Index]["COLUMN_NAME"].";
					}
					public function set_".$Colunas[$Index]["COLUMN_NAME"]."(\$".$Colunas[$Index]["COLUMN_NAME"]."){
						\$this->".$Colunas[$Index]["COLUMN_NAME"]." = \$".$Colunas[$Index]["COLUMN_NAME"].";
					}
				";
			else if(!in_array($Colunas[$Index]["COLUMN_NAME"], $Estrangeiros))
				array_push($Estrangeiros,$Colunas[$Index]["REFERENCED_TABLE_NAME"]);
			if (count($Estrangeiros) > 0)
				for($Index = 0; $Index <= count($Estrangeiros) - 1; $Index++)
					$Metodos .= "
						public function get_".$Estrangeiros[$Index]."(){
							return \$this->".$Estrangeiros[$Index].";
						}
						public function set_".$Estrangeiros[$Index]."(\$".$Estrangeiros[$Index]."){
							\$this->".$Estrangeiros[$Index]." = \$".$Estrangeiros[$Index].";
						}
					";
		return $Metodos;
	}
	
	private function obterConstrutor($Tabela){
		$Estrangeiros = array();
		$Colunas = $this->obterColunas($Tabela);
		if (in_array($Tabela,$this->Tabelas)){
			for($Index = 0; $Index <= count($Colunas) - 1; $Index++)
				if (!empty($Colunas[$Index]["REFERENCED_TABLE_NAME"]))
					if(!in_array($Colunas[$Index]["COLUMN_NAME"], $Estrangeiros))
						array_push($Estrangeiros,$Colunas[$Index]["REFERENCED_TABLE_NAME"]);		
			if (count($Estrangeiros) > 0){
				$Construtor = "public function __construct(){";
				for($Index = 0; $Index <= count($Estrangeiros) - 1; $Index++)
					$Construtor .= "\$this->$Estrangeiros[$Index] = new $Estrangeiros[$Index];";
				$Construtor .= "}";
			}
		}
		return $Construtor;				
	}
}

?>
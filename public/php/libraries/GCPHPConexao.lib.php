<?php
/***********************************
Copyright---------------------------
@author Luiz Fernando de Melo Moura
@e-mail lfmoura@gmail.com
@GCPHP v.0.1a
Copyright---------------------------
***********************************/
class GCPHPConexao{
	
	private $servidor;
    private $usuario;
    private $senha;
    private $baseDados;
    private $conexao;
	
	public function __construct(){
		$this->set_servidor(SERVIDOR);
		$this->set_usuario(USUARIO);
		$this->set_senha(SENHA);
		$this->conexao = (@mysql_connect($this->get_servidor(), $this->get_usuario(), $this->get_senha()));
		if (!$this->get_conexao()){
			throw new GCPHPConexaoErros(mysql_error(), mysql_errno());
		}		
	}
	
	public function	get_servidor(){
		return $this->servidor;
	}
	
	public function	get_usuario(){
		return $this->usuario;
	}
	
	public function	get_senha(){
		return $this->senha;
	}
	
	public function	get_baseDados(){
		return $this->baseDados;
	}
	
	public function	get_conexao(){
		return $this->conexao;
	}
	
	public function	set_servidor($servidor){
		$this->servidor = $servidor;
	}
	
	public function	set_usuario($usuario){
		$this->usuario = $usuario;
	}
	
	public function	set_senha($senha){
		$this->senha = $senha;
	}
	
	public function	set_baseDados($baseDados){
		$this->baseDados = @mysql_select_db($baseDados, $this->get_conexao());
		if (!$this->get_baseDados()) throw new GCPHPConexaoErros(mysql_error(), mysql_errno());		
	}	
}
?>
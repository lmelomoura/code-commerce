<?php
/***********************************
Copyright---------------------------
@author Luiz Fernando de Melo Moura
@e-mail lfmoura@gmail.com
@GCPHP v.0.1a
Copyright---------------------------
***********************************/
require_once('./interfaces/GCPHPErros.int.php');
abstract class GCPHPErros extends Exception implements GCPHPErrosInterface
{
    protected $message = 'Unknown exception';     // Mensagem de erro
    private   $string;                            // Desconhecido
    protected $code    = 0;                       // Codigo de erro
    protected $file;                              // Arquivo com erro
    protected $line;                              // Linha do erro
    private   $trace;                             // Desconhecido

    public function __construct($message = null, $code = 0)
    {
        if (!$message) {
            throw new $this('Unknown '. get_class($this));
        }
        parent::__construct($message, $code);
    }
    
    public function __toString()
    {
		$errorMsg = "<center>".
		"<div style=\"width:100%; height:auto; background-color:#FFC1C1; border:1px solid #9B0000; text-align:left; font-family:Tahoma, Geneva, sans-serif; font-size:10px;\">".
		"<b style=\"color:#9B0000\">Tipo do erro</b>: <b>".get_class($this)."</b><br>".
		"<b style=\"color:#9B0000\">Código do erro</b>: ".$this->code."<br>".
		"<b style=\"color:#9B0000\">Mensagem de erro</b>:<b> ".$this->message."</b><br>".
		"<b style=\"color:#9B0000\">Arquivo gerador</b>: ".$this->file."<br>".
		"<b style=\"color:#9B0000\">Linha da exceção</b>: ".$this->line."<br>".
		"</div>".
		"</center> <br />";
		return $errorMsg;
	}
}

class GCPHPConexaoErros extends GCPHPErros {};
class GCPHPTabelasErros extends GCPHPErros {};
?>
<?php
/***********************************
Copyright---------------------------
@author Luiz Fernando de Melo Moura
@e-mail lfmoura@gmail.com
@GCPHP v.0.1a
Copyright---------------------------
***********************************/
interface GCPHPErrosInterface
{
    /* Metodos protegidos herdados da classe Exception */
    public function getMessage();                 // Mensagem de erro 
    public function getCode();                    // Codigo de erro definido pelo usuario
    public function getFile();                    // Arquivo fonte
    public function getLine();                    // Linha fonte
    public function getTrace();                   // Um array com o backtrace()
    public function getTraceAsString();           // String formatada com o erro
    
    /* Metodos sobrecarregados herdados da class Exception */
    public function __toString();                 // Mensagem formatada para exibiчуo
    public function __construct($message = null, $code = 0);
}
?>
<?php
/***********************************
Copyright---------------------------
@author Luiz Fernando de Melo Moura
@e-mail lfmoura@gmail.com
@GCPHP v.0.1a
Copyright---------------------------
***********************************/
require_once('GCPHP.php');
$GC = new GCPHP;
$GC->set_BaseDados('gcphp');
$GC->set_Tabelas('enderecos');
$GC->gerarClasses();

$teste = new enderecos;
$teste->get_cidades()->set_nome('Uberaba');
echo $teste->get_cidades()->get_nome();
?>
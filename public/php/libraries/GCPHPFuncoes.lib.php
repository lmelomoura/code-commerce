<?php
/***********************************
Copyright---------------------------
@author Luiz Fernando de Melo Moura
@e-mail lfmoura@gmail.com
@GCPHP v.0.1a
Copyright---------------------------
***********************************/
function fast_in_array($elem, $array) 
{ 
   $top = sizeof($array) -1; 
   $bot = 0; 

   while($top >= $bot) 
   { 
      $p = floor(($top + $bot) / 2); 
      if ($array[$p] < $elem) $bot = $p + 1; 
      elseif ($array[$p] > $elem) $top = $p - 1; 
      else return TRUE; 
   } 
     
   return FALSE; 
} 
?>
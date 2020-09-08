<?php
define ("EXP",6000000); 
setlocale (LC_CTYPE, 'es_ES');
ini_set ("display_errors","0");
ini_set ("memory_limit","-1");

include_once 'lib/xajax_0.2.4/xajax.inc.php';
include_once 'lib/funciones.php';
include_once 'lib/phpmailer/libemail.php';
include_once 'lib/mysqlclass.php';

$xajax = new xajax('lib/ajx_fnci.php');

?>
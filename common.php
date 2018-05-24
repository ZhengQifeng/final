<?php
define('DOC_ROOT', __DIR__);
define('DOC_DIR', substr(dirname($_SERVER['SCRIPT_NAME']), 0));
define('BASE_URL', DOC_DIR == DIRECTORY_SEPARATOR? '': DOC_DIR);

require_once('config/config.php');
require_once('DbOper.php');
require_once('comFun.php');
?>
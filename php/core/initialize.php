<?php
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'assignment_hcmg');
    //assignment_php/php/...
    defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'php'.DS.'includes');
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'php'.DS.'core');

    //load the config file first
    require_once(INC_PATH.DS."config.php");

    //core classes
    require_once(CORE_PATH.DS."authentication.php");
    require_once(CORE_PATH.DS."user.php");
    require_once(CORE_PATH.DS."product.php");
    require_once(CORE_PATH.DS."userLib.php");
?>
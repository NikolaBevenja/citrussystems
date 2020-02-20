<?php
session_start();

$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';

define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', str_replace(DS.'app','',__DIR__));
define('SITE_HOST', $protocol.$_SERVER['HTTP_HOST']);
if($page = $_GET['path']){
    $pageArray = explode('/', $page);
    unset($page);
    $pathInfo = [];
    for($i=0; $i <= count($pageArray); $i++){
        if($pageArray[$i] != '')
            $pathInfo[] = $pageArray[$i];
    }
    if(empty($pathInfo[0])){
        $pathInfo[0] = '/';
    }
    /* required php version 7.0 */
    define('PATH', $pathInfo);
}else{
    define('PATH', array());
}

spl_autoload_register(function ($class) {
    $app = BASE_DIR.DS.'app';
    $urls = [
        $app,
        $app.DS.'Pages',
        $app.DS.'Resources',
        $app.DS.'Remotes',
        $app.DS.'Layouts'
    ];
    foreach($urls as $url){
        if(file_exists($url.DS.$class.'.php')){
            require $url.DS.$class.'.php';
            break;
        }
    }
});

function load_page(){
    $dir = BASE_DIR.DS.'app'.DS.'Pages';
    if(!PATH[0]){
        require ($dir.DS.'index'.DS.'Index.php');
        $run_class = 'Index';
    }else{
        if(file_exists($dir.DS.PATH[0])){
            require $dir.DS.PATH[0].DS.ucfirst(PATH[0]).'.php';
            $run_class = ucfirst(PATH[0]);
        }elseif(file_exists($dir.DS.PATH[0].'.layout.php')){
            require ($dir.DS.PATH[0].'.layout.php');
        }else{
            require ($dir.DS.'404'.'.layout.php');
        }
    }

    if(isset($run_class)) {
        new $run_class();
    }
}

function getHeader(){
    $dir = BASE_DIR.DS.'app'.DS.'Static';
    require $dir.DS.'header.layout.phtml';
}

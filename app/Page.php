<?php


class Page
{
    protected function getLayout($path){
        require $path.DS.'layout.phtml';
    }

    protected function getErrorPage(){
        require BASE_DIR . DS . 'app' . DS . 'Pages' . DS . '404' . '.layout.php';
    }
}
<?php


class Admin extends Page
{
    public function __construct(){
        $admin = new AdminResource();
        if($admin->isAdminUser()){
            getHeader();
            $this->getLayout(__DIR__);
        }else{
            getHeader();
            require 'subpages'.DS.'login.phtml';
        }
    }

    public function getComments($status){
        $commentResource = new CommentResource();
        return $commentResource->getCommentsByStatus($status);
    }
}
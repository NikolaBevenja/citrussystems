<?php


class AdminRemote extends AdminResource
{
    public function loginAction($data){
        if($data['username'] && $data['password']){
            return $this->loginAdminUser($data['username'], $data['password']);
        }
    }

}
<?php


class AdminResource extends AbstractResource
{
    public $table = 'admin';
    public $columns = array('adm_id', 'adm_username', 'adm_password');
    private $salt = 'pijaca';

    public function __construct()
    {
        parent::__construct();
    }

    public function loginAdminUser($username, $password){
        if($username && $password){
            $pdo = $this->getPdo();
            $cripted_password = md5($this->salt.$password.$this->salt);
            try{
                $admin = $pdo->prepare('SELECT * FROM '.$this->database.'.'.$this->table.' WHERE adm_username = :adm_username AND adm_password = :adm_password;');
                $admin->execute(array(':adm_username' => $username, ':adm_password' => $cripted_password));
                $admin_data = $admin->fetch();
                if($admin_data){
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $cripted_password;
                    return 1;
                }else
                    return 0;
            }catch (Exception $e){
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function isAdminUser(){
        if($_SESSION['username'] && $_SESSION['password']){
            $pdo = $this->getPdo();
            try{
                $admin = $pdo->prepare('SELECT * FROM '.$this->database.'.'.$this->table.' WHERE adm_username = :adm_username AND adm_password = :adm_password;');
                $admin->execute(array(':adm_username' => $_SESSION['username'], ':adm_password' => $_SESSION['password']));
                return 1;
            }catch (Exception $e){
                return 0;
            }
        }else{
            return 0;
        }
    }
}
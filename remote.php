<?php require 'app/config.php';

if ($_POST['remote']) {
    $remote = ucfirst($_POST['remote']) . 'Remote';
    $remote = new $remote();
    if ($_POST['action']) {
        $_POST['action'];
        $action = $_POST['action'] . 'Action';
        if ($_POST['data']) {
            $data = json_decode($_POST['data'], true);
            echo $remote->$action($data);
        } else {
            echo $remote->$action();
        }
    }
} else {
    require BASE_DIR . DS . 'app' . DS . 'Pages' . DS . '404' . '.layout.php';
}
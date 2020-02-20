<?php


class CommentResource extends AbstractResource
{
    public $table = 'comment';
    public $columns = array('cmt_status', 'cmt_id', 'cmt_email', 'cmt_name', 'cmt_text', 'pdt_id');

    public function __construct()
    {
        parent::__construct();
    }

    public function getEnabledCommentsByProductId($pdt_id){
        $pdo = $this->getPdo();
        try{
            $comments = $pdo->query('SELECT * FROM '.$this->database.'.'.$this->table.' WHERE pdt_id = '.$pdt_id.' AND cmt_status = 1;')->fetchAll();
            return $comments;
        }catch (Exception $e){
            return false;
        }
    }

    public function getCommentsByStatus($status){
        $pdo = $this->getPdo();
        try{
            if($status)
                $comments = $pdo->query('SELECT * FROM '.$this->database.'.'.$this->table.' JOIN '.$this->database.'.product ON '.$this->table.'.pdt_id = product.pdt_id WHERE cmt_status = '.$status.';')->fetchAll();
            else
                $comments = $pdo->query('SELECT * FROM '.$this->database.'.'.$this->table.' JOIN '.$this->database.'.product ON '.$this->table.'.pdt_id = product.pdt_id WHERE cmt_status is null;')->fetchAll();
            return $comments;
        }catch (Exception $e){
            return false;
        }
    }

    public function getCommentById($cmt_id){
        $pdo = $this->getPdo();
        try{
            $comment = $pdo->query('SELECT * FROM '.$this->database.'.'.$this->table.' WHERE cmt_id = '.$cmt_id.';')->fetch();
            return $comment;
        }catch (Exception $e){
            return false;
        }
    }

    public function getFullCommentById($cmt_id){
        $pdo = $this->getPdo();
        try{
            $comments = $pdo->query('SELECT * FROM '.$this->database.'.'.$this->table.' JOIN '.$this->database.'.product ON '.$this->table.'.pdt_id = product.pdt_id WHERE cmt_id = '.$cmt_id.';')->fetch();
            return $comments;
        }catch (Exception $e){
            return false;
        }
    }

    public function addComment($data){
        $pdo = $this->getPdo();
        $table = $this->table;
        $insert_string = '';
        $values_string = '';
        $values_array = array();
        $rows = $this->columns;
        foreach ($rows as $row){
            if(isset($data[$row])){
                $insert_string .= $row;
                $values_string .= ':'.$row;
                $values_array[':'.$row] = $data[$row];
                if(end($rows) != $row) {
                    $insert_string .= ', ';
                    $values_string .= ', ';
                }
            }
        }
        try{
            $comment = $pdo->prepare('INSERT INTO '.$this->database.'.'.$table.' ('.$insert_string.') VALUES ('.$values_string.');');
            $comment->execute($values_array);
            return 1;
        }catch (Exception $e){
            return 0;
        }
    }

    public function setCommentStatus($data, $status){
        $pdo = $this->getPdo();
        try{
            $admin = $pdo->prepare('UPDATE '.$this->database.'.'.$this->table.' SET cmt_status = '.$status.' WHERE cmt_id = :cmt_id ;');
            $admin->execute(array(':cmt_id' => $data['cmt_id']));
            return $data['cmt_id'];
        }catch (Exception $e){
            return 0;
        }
    }
}
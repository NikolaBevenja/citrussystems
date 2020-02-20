<?php


class ProductResource extends AbstractResource
{
    public $table = 'product';
    public $columns = array('pdt_id', 'pdt_name', 'pdt_description');

    public function __construct()
    {
        parent::__construct();
    }

    public function getProducts(){
        $pdo = $this->getPdo();
        try{
            $products = $pdo->query('SELECT * FROM '.$this->database.'.'.$this->table.';')->fetchAll();
            return $products;
        }catch (Exception $e){
            return false;
        }
    }

    public function getProductById($pdt_id){
        $pdo = $this->getPdo();
        try{
            $product = $pdo->query('SELECT * FROM '.$this->database.'.'.$this->table.' WHERE pdt_id = '.$pdt_id.';')->fetch();
            return $product;
        }catch (Exception $e){
            return false;
        }
    }

    public function deleteProduct($data){
        if(is_numeric($data['pdt_id'])){
            try{
                $pdo = $this->getPdo();
                $table = $this->table;
                $product = $pdo->prepare('DELETE FROM '.$this->database.'.'.$table.' WHERE pdt_id = :pdt_id ;');
                $product->execute(array(':pdt_id' => $data['pdt_id']));
                return $data['pdt_id'];
            }catch (Exception $e){
                return 0;
            }
        }else{
            return 0;
        }
    }
}
<?php


class Product extends Page
{
    private $product;
    private $comments;

    public function __construct(){
        if (!PATH[1]) {
            return require_once $this->getErrorPage();
        } elseif (!is_numeric(PATH[1])) {
            return require_once $this->getErrorPage();
        }
        $this->prepareProductData(PATH[1]);
        $this->prepareCommentsData(PATH[1]);
        getHeader();
        $this->getLayout(__DIR__);
    }


    public function prepareProductData($pdt_id){
        $productResource = new ProductResource();
        $this->product = $productResource->getProductById($pdt_id);
    }

    public function prepareCommentsData($pdt_id){
        $commentResource = new CommentResource();
        $this->comments = $commentResource->getEnabledCommentsByProductId($pdt_id);
    }

    public function getProduct(){
        return $this->product;
    }

    public function getComments(){
        return $this->comments;
    }
}
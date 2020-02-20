<?php


class Index extends Page
{
    public function __construct(){
        getHeader();
        $this->getLayout(__DIR__);
    }

    public function getProducts(){
        $product = new ProductResource();
        return $product->getProducts();
    }
}
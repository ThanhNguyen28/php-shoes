<?php

class ProductSizeController extends Controller
{

    private $productSizeModel;

    public function __construct()
    {
        $this->loadModel('ProductSizeModel');
        $this->productSizeModel = new ProductSizeModel;
    }

    public function index()
    {
        $product = $this->productSizeModel->getAll();
        echo json_encode($product);
    }

    public function create()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $this->productSizeModel->addByID($input);
        if ($id > 0) {
            echo json_encode($id);
        }
    }

    public function getProductID($id)
    {
        $size = $this->productSizeModel->getByIdProduct($id);
        echo json_encode($size);
    }

    public function delete($id)
    {
        $this->productSizeModel->del($id);
    }
}
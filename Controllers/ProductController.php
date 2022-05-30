<?php

class ProductController extends Controller
{

    private $productModel;

    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;
    }

    public function index()
    {
        $product = $this->productModel->getAll();
        echo json_encode($product);
    }

    public function create()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $this->productModel->add($input);
        print_r($id);
        if ($id > 0) {
            echo json_encode($id);
        }
    }

    public function saveimg()
    {
        if (isset($_FILES['image'])) {
            $image = $_FILES['image']['name'];
            $target = "upload/" . $image;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo json_encode(array('message', 'Save Success'));
            }
        } else {
            echo json_encode(array('message', 'Update Save'));
        }
    }

    public function update($id)
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if ($this->productModel->edit($input, $id) == true) {
            echo json_encode(array('message', 'Update Success'));
        } else {
            echo json_encode(array('message', 'Update Failure'));
        }
    }

    public function delete($id)
    {
        $this->productModel->deletes($id);
    }

    public function productNew()
    {
        $product = $this->productModel->getProductNew();
        echo json_encode($product);
    }

    public function productDetail($id)
    {
        $product = $this->productModel->getProductDetail($id);
        echo json_encode($product);
    }

    public function productCategory($id)
    {
        $product = $this->productModel->getProductCategory($id);
        echo json_encode($product);
    }

    public function allProductCategory($id)
    {
        $product = $this->productModel->getAllProductCategory($id);
        echo json_encode($product);
    }

    public function getPrices($id)
    {
        $product = $this->productModel->getPrice($id);
        echo json_encode($product);
    }

    public function search()
    {
        if ($_POST['keywords']) {
            $keywords = $_POST['keywords'];
            $product = $this->productModel->search($keywords);
            echo json_encode($product);
        }
    }
}
<?php

class SizeController extends Controller
{

    private $sizeModel;

    public function __construct()
    {
        $this->loadModel('SizeModel');
        $this->sizeModel = new SizeModel;
    }

    public function index()
    {
        $size = $this->sizeModel->getAll();
        echo json_encode($size);
    }

    public function getAll()
    {
        $size = $this->sizeModel->getAllSize();
        echo json_encode($size);
    }

    public function create()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $this->sizeModel->add($input);
        if ($id > 0) {
            echo json_encode($id);
        }
    }

    public function delete($id)
    {
        $this->sizeModel->deletes($id);
    }

    public function search()
    {
        if ($_POST['keywords']) {
            $keywords = $_POST['keywords'];
            $size = $this->sizeModel->search($keywords);
            echo json_encode($size);
        }
    }
}
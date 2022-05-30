<?php

class TrademarkController extends Controller
{

    private $trademarkModel;

    public function __construct()
    {
        $this->loadModel('TrademarkModel');
        $this->trademarkModel = new TrademarkModel;
    }

    public function index()
    {
        $trademark = $this->trademarkModel->getAll();
        echo json_encode($trademark);
    }

    public function create()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $this->trademarkModel->add($input);
        if ($id > 0) {
            echo json_encode($id);
        }
    }

    public function update($id)
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if ($this->trademarkModel->edit($input, $id) == true) {
            echo json_encode(array('message', 'Update Success'));
        } else {
            echo json_encode(array('message', 'Update Failure'));
        }
    }

    public function delete($id)
    {
        $this->trademarkModel->deletes($id);
    }

    public function search()
    {
        if ($_POST['keywords']) {
            $keywords = $_POST['keywords'];
            $trademark = $this->trademarkModel->search($keywords);
            echo json_encode($trademark);
        }
    }
}
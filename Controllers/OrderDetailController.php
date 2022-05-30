<?php

class OrderDetailController extends Controller
{

    private $orderdetailModel;

    public function __construct()
    {
        $this->loadModel('OrderDetailModel');
        $this->orderdetailModel = new OrderDetailModel;
    }

    public function index()
    {
        $order = $this->orderdetailModel->getAll();
        echo json_encode($order);
    }

    public function getOrderDetail($id)
    {
        $order = $this->orderdetailModel->getOrderId($id);
        echo json_encode($order);
    }

    public function create()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $this->orderdetailModel->addByID($input);
        if ($id > 0) {
            echo json_encode(array('id', $id));
        }
    }
}
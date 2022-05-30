<?php

class OrderController extends Controller
{

    private $orderModel;

    public function __construct()
    {
        $this->loadModel('OrderModel');
        $this->orderModel = new OrderModel;
    }

    public function index()
    {
        $order = $this->orderModel->getAll();
        echo json_encode($order);
    }

    public function create()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $this->orderModel->addByID($input);
        if ($id > 0) {
            echo json_encode($id);
        }
    }

    public function update($id)
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if ($this->orderModel->edit($input, $id) == true) {
            echo json_encode(array('message', 'Update Success'));
        } else {
            echo json_encode(array('message', 'Update Failure'));
        }
    }

    public function getID($id)
    {
        $order = $this->orderModel->getId($id);
        echo json_encode($order);
    }

    public function getStatus($id)
    {
        $order = $this->orderModel->getByStatus($id);
        echo json_encode($order);
    }

    public function getByDates($id)
    {
        $order = $this->orderModel->getByDate($id);
        echo json_encode($order);
    }

    public function getByStatistics()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $values = [];
        foreach ($input as $key => $value) {
            array_push($values, $value);
        }
        $total = $this->orderModel->getStatistics($values[0], $values[1]);
        foreach ($total as $key => $value) {
            $total = $value;
        }
        $order = $this->orderModel->getAllStatistics($values[0], $values[1]);
        array_push($order, $total);
        echo json_encode($order);
    }
}
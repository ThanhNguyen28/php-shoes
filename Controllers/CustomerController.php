<?php

class CustomerController extends Controller
{

    private $customerModel;

    public function __construct()
    {
        $this->loadModel('CustomerModel');
        $this->customerModel = new CustomerModel;
    }

    public function index()
    {
        $customer = $this->customerModel->getAll();
        echo json_encode($customer);
    }

    public function create()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $this->customerModel->addByID($input);
        if ($id > 0) {
            echo json_encode($id);
        }
    }

    public function getById($id)
    {
        $customer = $this->customerModel->getByIdCustomer($id);
        echo json_encode($customer);
    }
}
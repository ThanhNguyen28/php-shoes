<?php

class UserController extends Controller
{

    private $userModel;

    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;
    }

    public function index()
    {
        $user = $this->userModel->getAll();
        echo json_encode($user);
    }

    public function create()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $this->userModel->add($input);
        if ($id > 0) {
            echo json_encode($id);
        }
    }

    public function update($id)
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if ($this->userModel->edit($input, $id) == true) {
            echo json_encode(array('message', 'Update Success'));
        } else {
            echo json_encode(array('message', 'Update Failure' . $input));
        }
    }

    public function delete($id)
    {
        $this->userModel->del($id);
    }

    public function getId($id)
    {
        $user = $this->userModel->userId($id);
        echo json_encode($user);
    }

    public function login()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $user = $this->userModel->signin($input);
        echo json_encode($user);
    }

    public function search()
    {
        if ($_POST['keywords']) {
            $keywords = $_POST['keywords'];
            $user = $this->userModel->search($keywords);
            echo json_encode($user);
        }
    }
}
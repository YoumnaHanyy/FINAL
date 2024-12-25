<?php
class UserController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function addUser($data) {
    if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
        return json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
    }

    $result = $this->model->insertUser($data);

    if ($result) {
        return json_encode(['status' => 'success', 'message' => 'User added successfully.']);
    } else {
        return json_encode(['status' => 'error', 'message' => 'Failed to add user.']);
    }
}
    public function checkUsername($username) {
        return json_encode(['exists' => $this->model->doesUsernameExist($username)]);
    }

    public function checkEmail($email) {
        return json_encode(['exists' => $this->model->doesEmailExist($email)]);
    }
    
    
    

    public function getAllUsers() {
        return json_encode($this->model->getAllUsers());
    }

    public function updateUser($data) {
        return json_encode($this->model->updateUser($data));
    }

    public function deleteUser($username) {
        return json_encode($this->model->deleteUser($username));
    }
}
?>

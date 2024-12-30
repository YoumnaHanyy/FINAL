<?php
class UserController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function addUser($data) {
        // Validate required fields
        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            return json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        }

        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
        }

        // Check if username already exists
        if ($this->model->doesUsernameExist($data['username'])) {
            return json_encode(['status' => 'error', 'message' => 'Username already exists.']);
        }

        // Check if email already exists
        if ($this->model->doesEmailExist($data['email'])) {
            return json_encode(['status' => 'error', 'message' => 'Email already exists.']);
        }

        // Insert user into the database
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

    // public function updateUser($data) {
    //     return json_encode($this->model->updateUser($data));
    // }

    public function deleteUser($username) {
        return json_encode($this->model->deleteUser($username));
    }




    public function updateUser($data) {
        // Update user details
        $userUpdateResponse = $this->model->updateUser($data);
    
        if ($userUpdateResponse['status'] === 'success') {
            // Update assigned_to in tasks table
            $taskUpdateResponse = $this->model->updateAssignedTo($data['old_username'], $data['new_username']);
            if ($taskUpdateResponse['status'] === 'success') {
                return json_encode([
                    'status' => 'success',
                    'message' => 'User and assigned tasks updated successfully.'
                ]);
            } else {
                return json_encode([
                    'status' => 'error',
                    'message' => $taskUpdateResponse['message']
                ]);
            }
        }
    
        return json_encode([
            'status' => 'error',
            'message' => $userUpdateResponse['message']
        ]);
    }
    




}
?>
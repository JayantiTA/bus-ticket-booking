<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
  protected UserModel $userModel;

  public function index()
  {
    return view('welcome_message');
  }

  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  public function loginUser()
  {
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    $user = $this->userModel->getUserByEmail($email);
    if ($user) {
      if (password_verify($password, $user['password'])) {
        // $this->session->set('user', $user);
        unset($user['password']);
        return $this->response->setJSON($user);
      } else {
        return $this->response->setJSON(['message' => 'Password is incorrect']);
      }
    } else {
      return $this->response->setJSON(['message' => 'User not found']);
    }
  }

  public function registerUser()
  {
    $data = $this->request->getJSON();
    $user = $this->userModel->getUserByEmail($data->email);
    if ($user) {
      return $this->response->setJSON(['message' => 'User already exists']);
    } else {
      $data->password = password_hash($data->password, PASSWORD_DEFAULT);
      $this->userModel->createUser($data);
      return $this->response->setJSON($data);
    }
  }

  public function logoutUser()
  {
    $this->session->destroy();
    return $this->response->setJSON(['message' => 'User logged out']);
  }

  public function getUsers()
  {
    $users = $this->userModel->getUsers();
    for ($i = 0; $i < count($users); $i++) {
      unset($users[$i]['password']);
    }
    return $this->response->setJSON($users);
  }

  public function getUser($id)
  {
    $user = $this->userModel->getUser($id);
    if ($user) {
      unset($user['password']);
      return $this->response->setJSON($user);
    } else {
      return $this->response->setJSON(['message' => 'User not found']);
    }
  }

  public function updateUser($id)
  {
    $data = $this->request->getJSON();
    $user = $this->userModel->getUser($id);
    if ($user) {
      $this->userModel->updateUser($id, $data);
      unset($user->password);
      return $this->response->setJSON($user);
    } else {
      return $this->response->setJSON(['message' => 'User not found']);
    }
  }

  public function deleteUser($id)
  {
    $user = $this->userModel->getUser($id);
    if ($user) {
      $this->userModel->deleteUser($id);
      return $this->response->setJSON(['message' => 'User deleted']);
    } else {
      return $this->response->setJSON(['message' => 'User not found']);
    }
  }
}

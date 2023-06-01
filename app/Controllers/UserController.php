<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
  protected UserModel $userModel;

  public function registerPage()
  {
    return view('register');
  }

  public function loginPage()
  {
    return view('login');
  }

  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  public function loginUser()
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $this->userModel->getUserByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
      $this->session->set([
        'user_id' => $user['id'],
        'email' => $user['email'],
        'name' => $user['name'],
        'role_id' => $user['role_id'],
      ]);
      unset($user['password']);
      return view('login', [
        'success' => true,
        'message' => 'Login success',
      ]);
    }
    return view('login', [
      'success' => false,
      'message' => 'Login failed',
    ]);
  }

  public function registerUser()
  {
    if ($_POST['password'] !== $_POST['confirm_password']) {
      return view('register', [
        'success' => false,
        'message' => 'Password confirmation does not match'
      ]);
    }
    $user = $this->userModel->getUserByEmail($_POST['email']);
    if ($user) {
      $data = [
        'success' => false,
        'message' => 'Email already exists'
      ];
    } else {
      $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $this->userModel->createUser($_POST);
      $data = [
        'success' => true,
        'message' => 'Register success'
      ];
    }
    return view('register', $data);
  }

  public function logoutUser()
  {
    $this->session->destroy();
    $data = [
      'success' => true,
      'message' => 'User logged out'
    ];
    return view('register', $data);
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

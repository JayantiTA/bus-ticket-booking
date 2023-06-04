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
      if ($user['role_id'] == 'admin') {
        return redirect()->to('admin/user')->with('success', true)->with('message', 'Login Success');
      }
      return redirect()->to('discover')->with('success', true)->with('message', 'Login Success');
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
    return view('login', $data);
  }

  public function logoutUser()
  {
    $this->session->destroy();
    return redirect()->to('/discover')->with('success', true)->with('message', 'Logout Success');
  }

  public function getUsers()
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $users = $this->userModel->getUsers();
    for ($i = 0; $i < count($users); $i++) {
      unset($users[$i]['password']);
    }
    $data['users'] = $users;
    $data['success'] = $this->session->getFlashdata('success');
    $data['message'] = $this->session->getFlashdata('message');
    $this->session->remove('success');
    $this->session->remove('message');
    return view('admin/user', $data);
  }

  public function createUser()
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $this->userModel->createUser($_POST);
    return redirect()->to('/admin/user')->with('success', true)->with('message', 'Create User Success');
  }

  public function updateUser($id)
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $user = $this->userModel->getUser($id);
    if ($user) {
      $this->userModel->updateUser($id, $_POST);
      return redirect()->to('/admin/user')->with('success', true)->with('message', 'Update User Success');
    }
    return redirect()->to('/admin/user')->with('success', false)->with('message', 'Update User Failed');
  }

  public function deleteUser($id)
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $user = $this->userModel->getUser($id);
    if ($user) {
      $this->userModel->deleteUser($id);
      return redirect()->to('/admin/user')->with('success', true)->with('message', 'Delete User Success');
    }
    return redirect()->to('/admin/user')->with('success', false)->with('message', 'Delete User Failed');
  }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $allowedFields = ['email', 'name', 'password', 'role_id', 'created_at', 'updated_at'];
  protected $useTimestamps = true;

  public function getUsers()
  {
    return $this->findAll();
  }

  public function getUser($id)
  {
    return $this->where(['id' => $id])->first();
  }

  public function getUserByEmail($email)
  {
    return $this->where(['email' => $email])->first();
  }

  public function createUser($data)
  {
    return $this->insert($data);
  }

  public function updateUser($id, $data)
  {
    return $this->update($id, $data);
  }

  public function deleteUser($id)
  {
    return $this->delete($id);
  }
}

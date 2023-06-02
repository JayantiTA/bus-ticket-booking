<?php

namespace App\Models;

use CodeIgniter\Model;

class BusModel extends Model
{
  protected $table = 'buses';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'name', 'source', 'destination', 'departure_time', 'arrival_time', 'day',
    'seats', 'fare', 'created_at', 'updated_at'
  ];
  protected $useTimestamps = true;

  public function getBuses()
  {
    return $this->findAll();
  }

  public function getBus($id)
  {
    return $this->where(['id' => $id])->first();
  }

  public function getBusesByFilters($source, $destination)
  {
    $results = $this->where(['source' => $source, 'destination' => $destination])->findAll();
    return $results;
  }

  public function createBus($data)
  {
    return $this->insert($data);
  }

  public function updateBus($id, $data)
  {
    return $this->update($id, $data);
  }

  public function deleteBus($id)
  {
    return $this->delete($id);
  }
}

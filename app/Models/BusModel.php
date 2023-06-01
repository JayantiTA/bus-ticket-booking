<?php

namespace App\Models;

use CodeIgniter\Model;

class BusModel extends Model
{
  protected $table = 'buses';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'name', 'source', 'destination', 'departure_time', 'arrival_time',
    'seats', 'available_seats', 'fare', 'created_at', 'updated_at'
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

  public function getBusesByFilters($departure_date, $source, $destination)
  {
    $results = $this->where(['source' => $source, 'destination' => $destination])->findAll();
    $filtered_results = [];
    foreach ($results as $result) {
      if (date('Y-m-d', strtotime($result['departure_time'])) == $departure_date) {
        array_push($filtered_results, $result);
      }
    }
    return $filtered_results;
  }

  public function getBusesByDepartureTime($departure_time)
  {
    return $this->where(['departure_time' => $departure_time])->findAll();
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

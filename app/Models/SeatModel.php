<?php

namespace App\Models;

use CodeIgniter\Model;

class SeatModel extends Model
{
  protected $table = 'seats';
  protected $primaryKey = 'id';
  protected $allowedFields = ['bus_id', 'seat_position', 'status', 'created_at', 'updated_at'];
  protected $useTimestamps = true;

  public function getSeats()
  {
    return $this->findAll();
  }

  public function getSeatsByBusId($bus_id)
  {
    return $this->where(['bus_id' => $bus_id])->findAll();
  }

  public function getSeatsByBusIdAndAvailable($bus_id)
  {
    return $this->where(['bus_id' => $bus_id, 'status' => 'available'])->findAll();
  }

  public function getSeatsByBusIdAndSeatPosition($bus_id, $seat_position)
  {
    return $this->where(['bus_id' => $bus_id, 'seat_position' => $seat_position])->first();
  }

  public function getSeat($id)
  {
    return $this->where(['id' => $id])->first();
  }

  public function createSeat($data)
  {
    return $this->insert($data);
  }

  public function updateSeat($id, $data)
  {
    return $this->update($id, $data);
  }

  public function deleteSeat($id)
  {
    return $this->delete($id);
  }
}

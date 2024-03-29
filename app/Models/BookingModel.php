<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
  protected $table = 'bookings';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'bus_id', 'user_id', 'seat_id', 'departure_date', 'status', 'image_path'
  ];
  protected $useTimestamps = true;

  public function getBookings()
  {
    return $this->findAll();
  }

  public function getBookingsByUserId($user_id)
  {
    return $this->where(['user_id' => $user_id])->findAll();
  }

  public function getBookingsByBusIdAndDate($bus_id, $departure_date)
  {
    return $this->where(['bus_id' => $bus_id, 'departure_date' => $departure_date, 'status' => 'approved'])->findAll();
  }

  public function getBooking($id)
  {
    return $this->where(['id' => $id])->first();
  }

  public function createBooking($data)
  {
    return $this->insert($data);
  }

  public function updateBooking($id, $data)
  {
    return $this->update($id, $data);
  }

  public function deleteBooking($id)
  {
    return $this->delete($id);
  }
}

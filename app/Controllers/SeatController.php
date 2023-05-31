<?php

namespace App\Controllers;

use App\Models\SeatModel;

class SeatController extends BaseController
{
  protected SeatModel $seatModel;

  public function index()
  {
    return view('welcome_message');
  }

  public function __construct()
  {
    $this->seatModel = new SeatModel();
  }

  public function getSeats()
  {
    $users = $this->seatModel->getSeats();
    return $this->response->setJSON($users);
  }


  public function getSeat($id)
  {
    $seat = $this->seatModel->getSeat($id);
    if ($seat) {
      return $this->response->setJSON($seat);
    } else {
      return $this->response->setJSON(['message' => 'Seat not found']);
    }
  }

  public function updateSeat($id)
  {
    $data = $this->request->getJSON();
    $seat = $this->seatModel->getSeat($id);
    if ($seat) {
      $this->seatModel->updateSeat($id, $data);
      $updatedSeat = $this->seatModel->getSeat($id);
      return $this->response->setJSON($updatedSeat);
    } else {
      return $this->response->setJSON(['message' => 'Seat not found']);
    }
  }

  public function deleteSeat($id)
  {
    $data = $this->request->getJSON();
    $seat = $this->seatModel->getSeat($id);
    if ($seat) {
      $this->seatModel->deleteSeat($id);
      return $this->response->setJSON(['message' => 'Seat deleted']);
    } else {
      return $this->response->setJSON(['message' => 'Seat not found']);
    }
  }
}

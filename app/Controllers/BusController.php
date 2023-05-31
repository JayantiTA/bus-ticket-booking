<?php

namespace App\Controllers;

use App\Models\BusModel;
use App\Models\SeatModel;

class BusController extends BaseController
{
  protected BusModel $busModel;
  protected SeatModel $seatModel;

  public function index()
  {
    return view('welcome_message');
  }

  public function __construct()
  {
    $this->busModel = new BusModel();
    $this->seatModel = new SeatModel();
  }

  public function getBuses()
  {
    $buses = $this->busModel->getBuses();
    return $this->response->setJSON($buses);
  }

  public function getBus($id)
  {
    $bus = $this->busModel->getBus($id);
    $seats = $this->seatModel->getSeatsByBusId($id);
    if ($bus) {
      $bus->seats_position = $seats;
      return $this->response->setJSON($bus);
    } else {
      return $this->response->setJSON(['message' => 'Bus not found']);
    }
  }

  public function getAvailableBusesByDepartureTime()
  {
    $data = $this->request->getJSON();
    $buses = $this->busModel->getBusesByDepartureTime($data->departure_time);
    for ($i = 0; $i < count($buses); $i++) {
      $seats = $this->seatModel->getSeatsByBusIdAndAvailable($buses[$i]->id);
      if ($seats) {
        $buses[$i]->available_seats = count($seats);
      } else {
        $buses[$i]->available_seats = 0;
      }
    }
    if ($buses) {
      return $this->response->setJSON($buses);
    } else {
      return $this->response->setJSON(['message' => 'No buses found']);
    }
  }

  public function updateBus()
  {
    $data = $this->request->getJSON();
    $bus = $this->busModel->getBus($data->id);
    if ($bus) {
      $this->busModel->updateBus($data->id, $data);
      return $this->response->setJSON($data);
    } else {
      return $this->response->setJSON(['message' => 'Bus not found']);
    }
  }

  public function deleteBus()
  {
    $data = $this->request->getJSON();
    $bus = $this->busModel->getBus($data->id);
    if ($bus) {
      $this->busModel->deleteBus($data->id);
      return $this->response->setJSON(['message' => 'Bus deleted successfully']);
    } else {
      return $this->response->setJSON(['message' => 'Bus not found']);
    }
  }
}

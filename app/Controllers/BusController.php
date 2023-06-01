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
    return view('discover');
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

  public function searchPage()
  {
    return view('discover');
  }

  public function searchBuses()
  {
    $departure_time = $_POST['departure_time'];
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];
    $buses = $this->busModel->getBusesByFilters($departure_time, $departure_city, $destination_city);

    for ($i = 0; $i < count($buses); $i++) {
      $seats = $this->seatModel->getSeatsByBusIdAndAvailable($buses[$i]['id']);
      if ($seats) {
        $buses[$i]['available_seats'] = count($seats);
      } else {
        $buses[$i]['available_seats'] = 0;
      }
    }
    $data = [
      'success' => true,
      'date' => $departure_time,
      'buses' => $buses
    ];
    return view('available_buses', $data);
  }

  public function updateBus($id)
  {
    $data = $this->request->getJSON();
    $bus = $this->busModel->getBus($id);
    if ($bus) {
      $this->busModel->updateBus($id, $data);
      $updatedBus = $this->busModel->getBus($id);
      return $this->response->setJSON($updatedBus);
    } else {
      return $this->response->setJSON(['message' => 'Bus not found']);
    }
  }

  public function deleteBus($id)
  {
    $data = $this->request->getJSON();
    $bus = $this->busModel->getBus($id);
    if ($bus) {
      $this->busModel->deleteBus($id);
      return $this->response->setJSON(['message' => 'Bus deleted successfully']);
    } else {
      return $this->response->setJSON(['message' => 'Bus not found']);
    }
  }
}

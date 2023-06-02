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
    $data['buses'] = $this->busModel->getBuses();
    if ($this->session->get('role_id') == 'admin') {
      $data['success'] = $this->session->getFlashdata('success');
      $data['message'] = $this->session->getFlashdata('message');
      $this->session->remove('success');
      $this->session->remove('message');
    }
    return view('admin/bus', $data);
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

  public function createBus()
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $this->busModel->createBus($_POST);
    return redirect()->to('/admin/bus')->with('success', true)->with('message', 'Create Bus Success');
  }

  public function updateBus($id)
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $bus = $this->busModel->getBus($id);
    if ($bus) {
      $this->busModel->updateBus($id, $_POST);
      return redirect()->to('/admin/bus')->with('success', true)->with('message', 'Update Bus Success');
    }
    return redirect()->to('/admin/bus')->with('success', true)->with('message', 'Update Bus Failed');
  }

  public function deleteBus($id)
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $bus = $this->busModel->getBus($id);
    if ($bus) {
      $this->busModel->deleteBus($id);
      return redirect()->to('/admin/bus')->with('success', true)->with('message', 'Delete Bus Success');
    }
    return redirect()->to('/admin/bus')->with('success', true)->with('message', 'Delete Bus Failed');
  }
}

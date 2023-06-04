<?php

namespace App\Controllers;

use App\Models\BusModel;
use App\Models\BookingModel;
use App\Models\SeatModel;

class BusController extends BaseController
{
  protected BusModel $busModel;
  protected BookingModel $bookingModel;
  protected SeatModel $seatModel;

  public function index()
  {
    return view('discover');
  }

  public function __construct()
  {
    $this->busModel = new BusModel();
    $this->bookingModel = new BookingModel();
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
    }
    return $this->response->setJSON(['message' => 'Bus not found']);
  }

  public function searchPage()
  {
    return view('discover');
  }

  public function searchBuses()
  {
    $departure_date =  $this->request->getVar('departure_date');
    $departure_city =  $this->request->getVar('departure_city');
    $destination_city =  $this->request->getVar('destination_city');
    $buses = $this->busModel->getBusesByFilters($departure_city, $destination_city);
    $filtered_buses = [];
    $date = \DateTime::createFromFormat('Y-m-d', $departure_date);

    for ($i = 0; $i < count($buses); $i++) {
      $bookings = $this->bookingModel->getBookingsByBusIdAndDate($buses[$i]['id'], $departure_date);
      $buses[$i]['available_seats'] = $buses[$i]['seats'] - count($bookings);
      if ($buses[$i]['available_seats']) {
        array_push($filtered_buses, $buses[$i]);
      }
      $buses[$i]['fare'] = 'Rp. ' . number_format($buses[$i]['fare'], 0, ',', '.');
      $buses[$i]['departure_time'] = \DateTime::createFromFormat('H:i:s', $buses[$i]['departure_time'])->format('H:i');
      $buses[$i]['arrival_time'] = \DateTime::createFromFormat('H:i:s', $buses[$i]['arrival_time'])->format('H:i');
      $buses[$i]['arrival_date'] = $date->modify('+' . $buses[$i]['day'] . ' day')->format('d F Y');
    }

    $data = [
      'success' => true,
      'date' => $departure_date,
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

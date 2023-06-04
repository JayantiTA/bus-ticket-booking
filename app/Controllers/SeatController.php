<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\SeatModel;

class SeatController extends BaseController
{
  protected BookingModel $bookingModel;
  protected SeatModel $seatModel;

  public function index()
  {
    return view('welcome_message');
  }

  public function __construct()
  {
    $this->bookingModel = new BookingModel();
    $this->seatModel = new SeatModel();
  }

  public function getSeatsPage()
  {
    if (!$this->session->get('user_id')) {
      return view('login');
    }
    $bus_id = $this->request->getVar('bus_id');
    $date = $this->request->getVar('date');
    $seats = $this->seatModel->getSeatsByBusId($bus_id);
    $bookings = $this->bookingModel->getBookingsByBusIdAndDate($bus_id, $date);
    $available_seats = [];
    $booked_seat_ids = [];

    foreach ($bookings as $booking) {
      array_push($booked_seat_ids, $booking['seat_id']);
    }

    for ($i = 0; $i < count($seats); $i++) {
      if (!in_array($seats[$i]['id'], $booked_seat_ids)) {
        array_push($available_seats, $seats[$i]);
      }
    }

    $data = [
      'success' => true,
      'bus_id' => $bus_id,
      'date' => $date,
      'seats' => $available_seats
    ];
    return view('book_seat', $data);
  }

  public function getSeats()
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $seats = $this->seatModel->getSeats();

    $data['seats'] = $seats;
    $data['success'] = $this->session->getFlashdata('success');
    $data['message'] = $this->session->getFlashdata('message');
    $this->session->remove('success');
    $this->session->remove('message');
    return view('admin/seat', $data);
  }

  public function createSeat()
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $this->seatModel->createSeat($_POST);
    return redirect()->to('/admin/seat')->with('success', true)->with('message', 'Create Seat Success');
  }

  public function updateSeat($id)
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $seat = $this->seatModel->getSeat($id);
    if ($seat) {
      $this->seatModel->updateSeat($id, $_POST);
      return redirect()->to('/admin/seat')->with('success', true)->with('message', 'Update Seat Success');
    }
    return redirect()->to('/admin/seat')->with('success', false)->with('message', 'Update Seat Failed');
  }

  public function deleteSeat($id)
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $seat = $this->seatModel->getSeat($id);
    if ($seat) {
      $this->seatModel->deleteSeat($id);
      return redirect()->to('/admin/seat')->with('success', true)->with('message', 'Delete Seat Success');
    }
    return redirect()->to('/admin/seat')->with('success', false)->with('message', 'Delete Seat Failed');
  }
}

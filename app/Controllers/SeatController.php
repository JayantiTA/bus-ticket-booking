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

  public function getSeatsPage($id)
  {
    if (!$this->session->get('user_id')) {
      return view('login');
    }
    $date = $_POST['date'];
    $seats = $this->seatModel->getSeatsByBusId($id);
    $bookings = $this->bookingModel->getBookingsByBusIdAndDate($id, $date);
    $available_seats = [];
    $booked_seat_ids = [];

    foreach ($bookings as $booking) {
      array_push($booked_seat_ids, $booking['id']);
    }

    for ($i = 0; $i < count($seats); $i++) {
      if (!in_array($seats[$i]['id'], $booked_seat_ids)) {
        array_push($available_seats, $seats[$i]);
      }
    }

    $data = [
      'success' => true,
      'bus_id' => $id,
      'date' => $date,
      'seats' => $available_seats
    ];
    return view('book_seat', $data);
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

<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\BusModel;
use App\Models\SeatModel;

class BookingController extends BaseController
{
  protected BookingModel $bookingModel;
  protected BusModel $busModel;
  protected SeatModel $seatModel;

  public function index()
  {
    return view('welcome_message');
  }

  public function __construct()
  {
    $this->bookingModel = new BookingModel();
    $this->seatModel = new SeatModel();
    $this->busModel = new BusModel();
  }

  public function getBookings()
  {
    $bookings = $this->bookingModel->getBookings();
    return $this->response->setJSON($bookings);
  }

  public function getBooking($id)
  {
    $bookings = $this->bookingModel->getBooking($id);
    if ($bookings) {
      return $this->response->setJSON($bookings);
    } else {
      return $this->response->setJSON(['message' => 'Booking not found']);
    }
  }

  public function getBookingsByUserId($id)
  {
    $bookings = $this->bookingModel->getBookingsByUserId($id);
    for ($i = 0; $i < count($bookings); $i++) {
      $bookings[$i]->bus = $this->busModel->getBus($bookings[$i]->bus_id);
      $bookings[$i]->seat = $this->seatModel->getSeat($bookings[$i]->seat_id);
    }
    if ($bookings) {
      return $this->response->setJSON($bookings);
    } else {
      return $this->response->setJSON(['message' => 'Booking not found']);
    }
  }

  public function updateBooking($id)
  {
    $data = $this->request->getJSON();
    $booking = $this->bookingModel->getBooking($id);
    if ($booking) {
      $this->bookingModel->updateBooking($id, $data);
      $updatedBooking = $this->bookingModel->getBooking($id);
      return $this->response->setJSON($updatedBooking);
    } else {
      return $this->response->setJSON(['message' => 'Booking not found']);
    }
  }

  public function deleteBooking($id)
  {
    $bookings = $this->bookingModel->getBooking($id);
    if ($bookings) {
      $this->bookingModel->deleteBooking($id);
      return $this->response->setJSON(['message' => 'Booking deleted successfully']);
    } else {
      return $this->response->setJSON(['message' => 'Booking not found']);
    }
  }
}

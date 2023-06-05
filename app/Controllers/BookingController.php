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

  public function getBookingsPage()
  {
    $user_id = $this->session->get('user_id');
    if ($user_id) {
      $data['success'] = $this->session->getFlashdata('success');
      $data['message'] = $this->session->getFlashdata('message');
      $this->session->remove('success');
      $this->session->remove('message');

      $bookings = $this->bookingModel->getBookingsByUserId($user_id);

      for ($i = 0; $i < count($bookings); $i++) {
        $bus = $this->busModel->getBus($bookings[$i]['bus_id']);

        // change format
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $bookings[$i]['departure_date']);
        $bookings[$i]['departure_date'] = $date->format('d F Y');
        $bus['departure_time'] = \DateTime::createFromFormat('H:i:s', $bus['departure_time'])->format('H:i');
        $bus['arrival_time'] = \DateTime::createFromFormat('H:i:s', $bus['arrival_time'])->format('H:i');
        $bus['arrival_date'] = $date->modify('+' . $bus['day'] . ' day')->format('d F Y');

        $bookings[$i]['bus'] = $bus;
      }

      $data = [
        'bookings' => $bookings
      ];

      return view('bookings', $data);
    }
    return view('errors/html/error_404', [
      'message' => 'Permission denied'
    ]);
  }

  public function getBookingPage()
  {
    $date = $this->request->getVar('date');
    $seat_id = $this->request->getVar('seat_id');
    $bus_id = $this->request->getVar('bus_id');

    $bus_data = $this->busModel->getBus($bus_id);
    $seat_data = $this->seatModel->getSeat($seat_id);

    return view('payment', [
      'date' => $date,
      'bus_data' => $bus_data,
      'seat_data' => $seat_data,
    ]);
  }

  public function createBooking()
  {
    $bus_id = $_POST['bus_id'];
    $user_id = $this->session->get('user_id');
    $seat_id = $_POST['seat_id'];
    $departure_date = $_POST['departure_date'];

    $attachment = $this->request->getFile('attachment');
    $attachment_name = $user_id . '_' . $attachment->getName();
    $attachment->move(WRITEPATH . 'uploads', $attachment_name);

    $data = [
      'bus_id' => $bus_id,
      'user_id' => $user_id,
      'seat_id' => $seat_id,
      'departure_date' => $departure_date,
      'image_path' => $attachment_name
    ];

    $this->bookingModel->createBooking($data);
    return redirect()->to('/bookings')->with('success', true)->with('message', 'Book Success');
  }

  public function getBookings()
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }
    $data['bookings'] = $this->bookingModel->getBookings();
    $data['success'] = $this->session->getFlashdata('success');
    $data['message'] = $this->session->getFlashdata('message');
    $this->session->remove('success');
    $this->session->remove('message');

    return view('admin/book', $data);
  }


  public function getBooking($id)
  {
    $booking = $this->bookingModel->getBooking($id);
    if ($booking) {
      return $this->response->setJSON($booking);
    }
    return $this->response->setJSON(['message' => 'Bus not found']);
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
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $booking = $this->bookingModel->getBooking($id);
    if ($booking) {
      $this->bookingModel->updateBooking($id, $_POST);
      return redirect()->to('/admin/book')->with('success', true)->with('message', 'Update Booking Success');
    }
    return redirect()->to('/admin/book')->with('success', true)->with('message', 'Update Booking Failed');
  }

  public function deleteBooking($id)
  {
    if ($this->session->get('role_id') != 'admin') {
      return view('errors/html/error_404', [
        'message' => 'Permission denied'
      ]);
    }

    $booking = $this->bookingModel->getBooking($id);
    if ($booking) {
      $this->bookingModel->deleteBooking($id);
      return redirect()->to('/admin/book')->with('success', true)->with('message', 'Delete Booking Success');
    }
    return redirect()->to('/admin/book')->with('success', true)->with('message', 'Delete Booking Failed');
  }
}

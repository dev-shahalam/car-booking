<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    public function rentalPage()
    {
        $rentals = Rental::orderBy('id', 'desc')->with('user')->get();
        return view('components.rental.rental-page', compact('rentals'));
    }


    // Update the status of the rental
    public function updateStatus(Request $request)
    {
        $id = $request->statusId;
        $status = $request->status;
        $rental = Rental::find($id);

        if ($rental) {

            if ($status == 'completed' || $status == 'cancelled') {
                if ($rental->status == 'completed') {
                    return redirect()->back()->with('error', 'Rental Already Completed');
                }
                if ($rental->status == 'cancelled' && $status == 'completed') {
                    return redirect()->back()->with('error', 'Please Ongoing First');
                }
                if ($rental->status == 'cancelled') {
                    return redirect()->back()->with('error', 'Rental Already Cancelled');
                }
                $rental->update([
                    'status' => $status
                ]);
                $car = Car::where('id', $rental->car_id)->first();
                $car->update([
                    'status' => 'available'
                ]);
                return redirect()->back()->with('success', 'Rental Status Updated');
            } else {
                if ($status == 'ongoing') {

                    if ($rental->status == 'completed') {
                        return redirect()->back()->with('error', 'Rental Already Completed');
                    }
                    $rental->update([
                        'status' => $status
                    ]);
                    $car = Car::where('id', $rental->car_id)->first();
                    $car->update([
                        'status' => 'rented'
                    ]);

                    return redirect()->back()->with('success', 'Rental Status Updated');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Rental Not Found');
        }
    }




    // Car Booking Page
    public function carBooking(Request $request)
    {
        $cars = Car::where('status', 'available')->get();
        $user = User::find($request->header('id'));
        return view('user.booking', compact('cars', 'user'));
    }
    public function getPrice($car_name)
    {
        $car = Car::where('car_name', $car_name)->first();

        if ($car) {
            return response()->json(['car' => $car]);
        } else {
            return response()->json(['error' => 'Car not found']);
        }
    }


    // Booking Rental Details
    public function store(Request $request)
    {
        $user_id = $request->header('id');
        $user = User::find($user_id);

        $car_id = Car::where('car_name', $request->car_name)->value('id');


        if (!$user_id) {
            return redirect()->back()->withErrors('error', 'User ID is missing');
        }

        // if (!$car_id || !$request->car_id) {
        //     return redirect()->back()->with('error', 'Car ID is missing');
        // }

        $request->validate([
            'car_name' => 'required',
            'rental_start_date' => 'required',
            'rental_end_date' => 'required',
            'pick_location' => 'required', // Validation for pick location
            'drop_location' => 'required', // Validation for drop location
        ]);

        $car_name = $request->car_name;
        $id = Car::where('car_name', $car_name)->value('id');


        $rental_start_date = $request->rental_start_date;
        $rental_end_date = $request->rental_end_date;
        $unit_price = Car::where('id', $car_id)->value('daily_rent');
        $pickDateTime = Carbon::parse($rental_start_date);
        $dropDateTime = Carbon::parse($rental_end_date);
        $car_status = Car::where('id', $car_id)->value('status');

        if ($car_status == 'rented') {
            return redirect()->back()->with('error', 'Car already rented');
        }
        // Ensure the rental end date is after the start date
        if ($dropDateTime->lt($pickDateTime)) {
            return redirect()->back()->with('error', 'End date must be after start date');
        }
        $pick_location = $request->pick_location;
        $drop_location = $request->drop_location;
        $total_days = $pickDateTime->diffInDays($dropDateTime);
        if ($total_days == 0) {
            $total_days = 1; // Ensure minimum 1 day charge
        }
        $total_price = $total_days * $unit_price;
        $rental = Rental::create([
            'user_id' => $user_id,
            'car_id' => $car_id,
            'rental_start_date' => $pickDateTime,
            'rental_end_date' => $dropDateTime,
            'total_price' => $total_price,
            'pick_location' => $pick_location,
            'drop_location' => $drop_location,
        ]);
        $rental_id = $rental->id;
        $user_id = Car::where('id', $car_id)->value('user_id');
        $admin = User::where('id', $user_id)->first();
        $car = Car::where('id', $car_id)->first();
        $rental = Rental::where('id', $rental_id)->first();

        Mail::to($user->email)->send(new BookingConfirmation($car, $rental, $user));
        Mail::to($admin->email)->send(new BookingConfirmation($car, $rental, $admin));
        Car::where('id', $car_id)->update(['status' => 'rented']);
        return redirect()->route('home')->with('success', 'Car booked successfully');
    }





    // Rental History
    public function rentalHistory(Request $request)
    {
        $user_id = $request->header('id');
        $customer_id = $request->id;
        $user = User::find($user_id);
        if ($user) {
            $rentals = Rental::where('user_id', $customer_id)->with('car')->get();
            return view('components.rental.rental-history', compact('rentals'));
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }










}

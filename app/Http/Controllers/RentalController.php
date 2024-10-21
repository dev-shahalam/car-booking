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
        $rentals = Rental::with('user')->get();
        return view('components.rental.rental-page', compact('rentals'));
    }

    public function updateStatus(Request $request)
    {
        $user_id = $request->header('id');
        $user = User::find($user_id);

        if(!$user){
            return redirect()->back()->withErrors('error', 'User not found');
        }

        $rental_id = $request->id;
        $rental = Rental::find($rental_id);
        $status = $request->input('status');
        return  $status;
        if($rental){
            $rental->update(['status' => $status]);
            return redirect()->back()->with('success', 'Status updated successfully');
        }else{
            return redirect()->back()->withErrors('error', 'Rental not found');
        }
    }


    public function carBooking(Request $request)
    {
        $cars = Car::where('status', 'available')->get();
        $user = User::find($request->header('id'));
        return view('user.booking', compact('cars', 'user'));
    }

    // app/Http/Controllers/ProductController.php


    public function getPrice($id)
    {
        $car = Car::find($id);

        if ($car) {
            return response()->json(['car' => $car]);
        } else {
            return response()->json(['error' => 'Car not found']);
        }
    }

    // public function store(Request $request){
    //    $user_id=$request->header('id');

    //    $request->validate([
    //     'car_id' => 'required',
    //     'rental_start_date' => 'required',
    //     'rental_end_date' => 'required',
    //     'pick_location' => 'required',
    //     'drop_location' => 'required',
    //    ]);

    //    $car_id=$request->car_id;
    //    $rental_start_date=$request->rental_start_date;
    //    $rental_end_date=$request->rental_end_date;
    //    $unit_price=Car::where('id',$car_id)->value('daily_rent');
    //    $pickDateTime=Carbon::parse($rental_start_date);
    //    $dropDateTime=Carbon::parse($rental_end_date);

    //    $pick_location=$request->pick_location;
    //    $drop_location=$request->drop_location;

    // //    $total_days=$pickDateTime->diffInDays($dropDateTime);
    //    $total_hours=$pickDateTime->diffInHours($dropDateTime);


    //    $total_price=$total_hours*$unit_price/24;

    //    Rental::create([
    //     'user_id' => $user_id,
    //     'car_id' => $car_id,
    //     'rental_start_date' => $pickDateTime,
    //     'rental_end_date' => $dropDateTime,
    //     'total_price' => $total_price,
    //     'pick_location' => $pick_location,
    //     'drop_location' => $drop_location,
    //    ]);

    //    Car::where('id',$car_id)->update(['status'=>'rented']);

    //    return redirect()->route('rental')->with('success', 'Car booked successfully');


    // }


    public function store(Request $request)
    {
        $user_id = $request->header('id');
        $user = User::find($user_id);

        if (!$user_id) {
            return redirect()->back()->withErrors('error', 'User ID is missing');
        }

        $request->validate([
            'car_id' => 'required',
            'rental_start_date' => 'required',
            'rental_end_date' => 'required',
            'pick_location' => 'required', // Validation for pick location
            'drop_location' => 'required', // Validation for drop location
        ]);

        $car_id = $request->car_id;
        $rental_start_date = $request->rental_start_date;
        $rental_end_date = $request->rental_end_date;

        $unit_price = Car::where('id', $car_id)->value('daily_rent');
        $pickDateTime = Carbon::parse($rental_start_date);
        $dropDateTime = Carbon::parse($rental_end_date);

        // Ensure the rental end date is after the start date
        if ($dropDateTime->lt($pickDateTime)) {
            return redirect()->back()->withErrors('error', 'End date must be after start date');
        }

        $pick_location = $request->pick_location;
        $drop_location = $request->drop_location;

        $total_days = $pickDateTime->diffInDays($dropDateTime);
        if ($total_days == 0) {
            $total_days = 1; // Ensure minimum 1 day charge
        }

        $total_price = $total_days * $unit_price;

         $rental=Rental::create([
            'user_id' => $user_id,
            'car_id' => $car_id,
            'rental_start_date' => $pickDateTime,
            'rental_end_date' => $dropDateTime,
            'total_price' => $total_price,
            'pick_location' => $pick_location,
            'drop_location' => $drop_location,
        ]);

        $rental_id=$rental->id;

        $user_id=Car::where('id',$car_id)->value('user_id');
        $admin=User::where('id',$user_id)->first();





        // 21750

        $car=Car::where('id',$car_id)->first();
        $rental=Rental::where('id',$rental_id)->first();

        Mail::to($user->email)->send(new BookingConfirmation($car,$rental,$user));
        Mail::to($admin->email)->send(new BookingConfirmation($car,$rental,$admin));

        Car::where('id', $car_id)->update(['status' => 'rented']);

        return redirect()->route('rental')->with('success', 'Car booked successfully');
    }


    public function rentalHistory(Request $request){

        $user_id=$request->header('id');
        $customer_id=$request->id;


        $user=User::find($user_id);

        if($user){
            $rentals=Rental::where('user_id',$customer_id)->with('car')->get();
            return view('components.rental.rental-history',compact('rentals'));
        }else{
            return redirect()->back()->withErrors('error','User not found');
        }





    }










}

<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Web controller
    public function carList(Request $request)
    {
        $user_id = $request->header('id');
        $admin = User::where('id', $user_id)->where('role', 'admin')->first();
        if ($admin) {
            $cars = Car::orderByDesc('id')->where('user_id', $user_id)->get();
            return view('pages.dashboard.car-page', compact('cars', 'admin'));
        } else {
            return redirect()->route('login');
        }
    }


    public function carCreatePage()
    {
        return view('components.car.car-create');
    }

    public function carUpdatePage(Request $request)
    {
        $car = Car::find($request->id);
        return view('components.car.car-update', compact('car'));
    }





    // API controller
    public function carCreate(Request $request)
    {

        $img = $request->file('image');
        $user_id = $request->header('id');

        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = $user_id . $t . $file_name;
        $img_path = "uploads/{$img_name}";

        $img->move(public_path('uploads'), $img_name);

        Car::create([
            'car_name' => $request->input('car_name'),
            'model' => $request->input('model'),
            'make_year' => $request->input('make_year'),
            'status' => $request->input('status'),
            'daily_rent' => $request->input('daily_rent'),
            'description' => $request->input('description'),
            'image' => $img_path,
            'user_id' => $user_id
        ]);

        return redirect()->route('car-page')->with('success', 'Car Added Succesfully');
    }



    public function carUpdate(Request $request)
    {
        $user_id = $request->header('id');

        $car = Car::find($request->id);

        $img = $request->file('image');

        $status = $request->input('status');

        if($car->status == 'rented'){
            return redirect()->route('car-page')->with('error', 'Car is rented');
        }

        if ($img) {
            if (file_exists(public_path($car->image))) {
                unlink(public_path($car->image));
            }
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = $user_id . $t . $file_name;
            $img_path = "uploads/{$img_name}";
            $img->move(public_path('uploads'), $img_name);
            $car->image = $img_path;
            // delete old image
            $car->update([
                'car_name' => $request->input('car_name'),
                'model' => $request->input('model'),
                'make_year' => $request->input('make_year'),
                'status' => $status,
                'daily_rent' => $request->input('daily_rent'),
                'description' => $request->input('description'),
                'user_id' => $user_id,
                'image' => $img_path
            ]);
            return redirect()->route('car-page');
        } else {
            $car->update([
                'car_name' => $request->input('car_name'),
                'model' => $request->input('model'),
                'make_year' => $request->input('make_year'),
                'status' => $request->input('status'),
                'daily_rent' => $request->input('daily_rent'),
                'description' => $request->input('description'),
                'user_id' => $user_id
            ]);
            return redirect()->route('car-page');
        }
    }


    public function carDelete(Request $request)
    {
        $user_id = $request->header('id');
        if ($user_id) {
            $car = Car::find($request->id);
            if (file_exists(public_path($car->image))) {
                unlink(public_path($car->image));
            }
            $car->delete();
            return redirect()->route('car-page');
        } else {
            return redirect()->route('login');
        }
    }

    public function filter(Request $request)
    {
        $status = $request->get('status');
        $cars = Car::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->get();

        return response()->json(['cars' => $cars]);
    }

    public function singleCarPage(Request $request){
        $car = Car::find($request->id);
        return view('user.singleCarPage', compact('car'));

        // $car_id = $request->id;
        // $car = Car::find($car_id);
        // if($car){
        //     $request->headers->set('id', $car_id);
        //     return view('user.singleCarPage', compact('car'));
        // }else{
        //     return redirect()->route('home');
        // }

    }





}

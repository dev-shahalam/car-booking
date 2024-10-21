<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">DWA</a>
        </div>
        <p style="font-size:1.1em">Hi,{{$user->name}}</p>
        <p>Thank you for choosing our car rental service.Here is our booking details.
        </p>

        <div style="margin-bottom: 20px;">
            <h4>Car Name: {{$car->car_name}}</h4>
            <h4>Car Model: {{$car->model}}</h4>
            <h4>Car description: {{$car->description}}</h4>
            <h4>Daily Rental Price: {{$car->daily_rent}}</h4>


            <h4>Pick Up Location: {{$rental->pick_location}}</h4>
            <h4>Drop Off Location: {{$rental->drop_location}}</h4>
            <h4>Rental Start Date: {{$rental->rental_start_date}}</h4>
            <h4>Rental End Date: {{$rental->rental_end_date}}</h4>

        </div>


        <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
           Total Rental Price: BDT {{$rental->total_price}}
        </h2>
        <p style="font-size:0.9em;">Regards,<br />Drive With Anas</p>
        <hr style="border:none;border-top:1px solid #eee" />
        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
            <p>Drive With Anas</p>
            <p>Mirpur, Dhaka</p>
            <p>Bangladesh</p>
        </div>
    </div>
</div>

<?php
    require('AmadeusClient.php');
    $amadeus_api = new AmadeusDahabtours\SelfServiceApiClient('GcFYR1Jv2b3Qi4Lg6qUzkqaZK9LhDg7y','xQbJqs342R0uOzBS');

    // Flight Inspiration Search
    $flight_inspiration = $amadeus_api->flightInspiration([
        'origin'        => 'MUC'
    ]);

    # Flight Cheapest Date Search
    $flight_dates = $amadeus_api->flightDates([
        'origin'        => 'MAD',
        'destination'   => 'MUC'
    ]);
    
?>

{{-- Flight Inspiration --}}
 <div class="card">
    <div class="card-header">Flight Inspiration (<span onclick="$('#flight-inspiration').toggleClass('d-none');"><span>VIEW</span> API RESPONSE</span>)</div>
    <div class="card-body text-center">
        <form action="">
            <select class="custom-select custom-select-sm">
                <option selected>Departure</option>
                <option value="1">MUC</option>
                <option value="2">MAD</option>
                <option value="3">CDG</option>
            </select>
        </form>
    </div>
    <div class="card-body">
        <div>
            {{ json_decode($flight_inspiration['response_text'])->data[0]->origin.' -> '.json_decode($flight_inspiration['response_text'])->data[0]->destination }}
        </div>
        <div>
            Departure Date: {{ json_decode($flight_inspiration['response_text'])->data[0]->departureDate }}
        </div>
        <div>
            Return Date: {{ json_decode($flight_inspiration['response_text'])->data[0]->returnDate }}
        </div>
        <div>
            Price: {{ json_decode($flight_inspiration['response_text'])->data[0]->price->total }}
        </div>
        <div id="flight-inspiration" class="p-1 d-none" style="border: 1px lightgrey solid;">
            @php
            print_r('<pre>');
            print_r($flight_inspiration);
            print_r('</pre>');
            @endphp
        </div>
    </div>
</div>
{{-- light Cheapest Date --}}
<div class="card mt-4">
    <div class="card-header">Flight Cheapest Date (<span onclick="$('#flight-cheapest-date').toggleClass('d-none');"><span>VIEW</span> API RESPONSE</span>)</div>
    <div class="card-body text-center">
        <form action="">
            <select class="custom-select custom-select-sm">
                <option selected>Departure</option>
                <option value="1">MUC</option>
                <option value="2">MAD</option>
                <option value="3">CDG</option>
            </select>
            <select class="custom-select custom-select-sm mt-2">
                <option selected>Destination</option>
                <option value="1">MUC</option>
                <option value="2">MAD</option>
                <option value="3">CDG</option>
            </select>
        </form>
    </div>
    <div class="card-body">
        <div>
            {{ json_decode($flight_dates['response_text'])->data[0]->origin.' -> '.json_decode($flight_inspiration['response_text'])->data[0]->destination }}
        </div>
        <div>
            Departure Date: {{ json_decode($flight_dates['response_text'])->data[0]->departureDate }}
        </div>
        <div>
            Return Date: {{ json_decode($flight_dates['response_text'])->data[0]->returnDate }}
        </div>
        <div>
            Price: {{ json_decode($flight_dates['response_text'])->data[0]->price->total }}
        </div>
        <div id="flight-cheapest-date" class="p-1 d-none" style="border: 1px lightgrey solid;">
            @php
            print_r('<pre>');
            print_r($flight_dates);
            print_r('</pre>');
            @endphp
        </div>
    </div>
</div>
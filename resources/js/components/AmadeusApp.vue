<template>
<div>
    <div class="card mb-4">
        <div class="card-body text-center">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-plane-departure"></i></span>
                </div>
                <input v-model="origin_1" @keyup.enter="amadeusApiCall(origin_1,dest_1,departure_1)" type="text" class="form-control" placeholder="Origin Airport" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-plane-arrival"></i></span>
                </div>
                <input v-model="dest_1" @keyup.enter="amadeusApiCall(origin_1,dest_1,departure_1)" type="text" class="form-control" placeholder="Destination Airport" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-minus"></i></span>
                </div>
                <input v-model="departure_1" @keyup.enter="amadeusApiCall(origin_1,dest_1,departure_1)" type="date" class="form-control" placeholder="Origin Airport" aria-label="Username" aria-describedby="basic-addon1">
            </div>

        </div>
    </div>
    <div class="card">
        <div class="card-header">Flight Inspiration (<span onclick="$('#flight-inspiration').toggleClass('d-none');"><span>VIEW</span> API RESPONSE</span>)</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Departure</th>
                            <th>Return</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(fInspiration, index) in fInspirations" :key="index">
                            <td>{{ fInspiration.origin }}</td>
                            <td>{{ fInspiration.destination }}</td>
                            <td>{{ fInspiration.departureDate }}</td>
                            <td>{{ fInspiration.returnDate }}</td>
                            <td>{{ fInspiration.price.total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="flight-inspiration" class="p-1 d-none" style="border: 1px lightgrey solid;">
                @php
                print_r('<pre>');
                print_r({{ fInspirations }});
                print_r('</pre>');
                @endphp
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                origin_1: null,
                dest_1: null,
                departure_1: null,
                fInspirations: [],
            }
        },
        methods: {
            amadeusApiCall() {
                let origin = this.origin_1 ?? 'PAR'; 
                let dest = this.dest_1 ?? 'FRA'; 
                let departure = this.departure_1 ?? '2021-04-15';

                axios.get('/amadeus-api/'+origin+'/'+dest+'/'+departure)
                .then((response) => {
                    this.fInspirations = response.data[0].data;
                    console.log(response.data[1]);
                });
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

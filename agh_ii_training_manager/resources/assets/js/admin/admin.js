import * as $ from "jquery";
import Customers from './customers'
import Orders from "./orders";
import Trainings from "./trainings";
import TrainingReservations from "./training_reservations";
import Products from "./products";
import Races from "./races";
import RaceHeats from "./race_heats";
import RaceResults from "./race_results";
import RaceRegistrations from "./race_registrations";

const content = $('#admin-content');

$('#btn-users').bind('click', function () {
    Customers.show(content);
});

$('#btn-products').bind('click', function () {
   Products.show(content)
});

$('#btn-orders').bind('click', function () {
    Orders.show(content)
});

$('#btn-trainings').bind('click', function () {
   Trainings.show(content)
});

$('#btn-training-reservations').bind('click', function () {
    TrainingReservations.show(content)
});

$('#btn-races').bind('click', function () {
   Races.show(content)
});

$('#btn-race_heats').bind('click', function () {
    RaceHeats.show(content)
});

$('#btn-race_results').bind('click', function () {
   RaceResults.show(content)
});

$('#btn-race_registrations').bind('click', function () {
   RaceRegistrations.show(content)
});



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

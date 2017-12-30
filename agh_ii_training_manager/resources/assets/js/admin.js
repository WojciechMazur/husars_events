import * as $ from "jquery";
import Customers from './admin/customers'
import Orders from "./admin/orders";

const content = $('#admin-content');

$('#btn-users').bind('click', function () {
    Customers.show(content);
});

$('#btn-orders').bind('click', function () {
    Orders.show(content)
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

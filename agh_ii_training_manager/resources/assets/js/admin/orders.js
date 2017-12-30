import {floor, isInteger} from "lodash";

import * as $ from "jquery";
import * as util from './../utils'
import {findTextInTable} from "../utils";

export default class Orders{
    static show(content) {
        content.html("");
        $.getJSON(window.location.origin + '/orders', function (data) {
            let tr;
            let table=$("<table class='admin-table' id='tbl-orders'/>");
            table.append(
                `<tr>
    <th>Id</th>
    <th>Ordered by</th>
    <th>Status</th>
    <th>Price</th>
    <th>Created</th>
    <th>Updated</th>
    <th> </th>
    <th> </th>
</tr>`);
            for (let i=0; i<data.length;i++){
                let ordered_by = $(`<td>Unknown</td>`);
                $.getJSON(`${window.location.origin}/users/${data[i].customer_id}`, function (user) {
                    ordered_by.html(`${user.first_name} ${user.surname}`);
                });
                let status = $(`<td>Unknown</td>`);
                $.getJSON(`${window.location.origin}/orders/codes/${data[i].status_code}`, function (code) {
                    status.html(`${code.description}`);
                });
                let btn_edit=$("<button class='btn-edit'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button>");
                btn_edit.on('click', function () {
                    Orders.edit($(this).parent().parent().find('td:first').text());
                });
                let btn_delete=$("<button class='btn-delete'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>");
                btn_delete.on('click', function () {
                    Orders.delete($(this).parent().parent().find('td:first').text());
                });

                tr = $('<tr/>');
                tr.append("<td>" + data[i].id + "</td>");

                tr.append(ordered_by);
                tr.append(status);
                tr.append("<td id='order_price'>" + data[i].total_price + "PLN </td>");
                tr.append("<td>" + data[i].created_at + "</td>");
                tr.append("<td>" + data[i].updated_at + "</td>");
                tr.append($("<td></td>").append(btn_edit));
                tr.append($("<td></td>").append(btn_delete));

                table.append(tr);
            }
            content.append(table);
        });
    }

    static edit(id){
        $.getJSON(`${window.location.origin}/orders/${id}`, function (data) {
            Orders.createEditForm(data);
        });

    }

    static delete(id){
        $.ajax({
            url: `${window.location.origin}/orders/${id}`,
            method: 'DELETE',
            success: (response) => {
                let row = findTextInTable(id, "#tbl-orders");
                row.html("");
            },
            fail: (status) => {
                alert("Unknown error accoured");
                console.log(status);
            },

        })

    }

    static createEditForm(order) {
        const modal=$('#modal');
        const modalContent=$('#modal-content');
        modalContent.html("");
        modalContent.append(`
            <input type="button" id="btn-cancel" class="fa fa-times" value=&#xf00d>`);
        modal.find('#btn-cancel').on('click', function () {
            modal.toggle('fast');
        });

        let options = '';
        $.getJSON(`${window.location.origin}/orders/${order.id}/items`, function (items) {
            let orderItems = $(`<table class="admin-table modal-content" id="tbl-orderitems"/>`);
            orderItems.append(`<tr> <th>Id</th>  <th>Name</th> <th>Price</th> <th>Quantity</th> <th>Value</th> <th> </th> </tr>`);
            for(let i=0; i<items.length;i++){
                let quantity=$(`<td><input type="number" min="0" step="1" value="${items[i].order_items_quantity}"></td>`);
                quantity.find('input').on('change', function () {
                    const newQuantity = $(this).val();
                    $.ajax({
                        url: `${window.location.origin}/orderItems/${items[i]['id']}`,
                        method: 'PUT',
                        data: {
                            'order_items_quantity': newQuantity,
                        },
                        success: (response) => {
                            if(response==='1'){
                                $(this).parent().parent().html("");
                            }else {
                                $(this).parent().next().text(floor(response['item']['order_items_quantity']*response['item_price']*100)/100 + " PLN");
                                const rows = $("#tbl-orders tr");
                                for(let i=0; i<rows.length;i++){
                                    if (rows[i].childNodes[0].innerHTML==response['order']['id'])
                                        rows[i].childNodes[3].innerHTML=floor(response['order']['total_price']*100)/100 + " PLN";
                                }
                            }
                        }
                    });
                });
                let tr=$(`
                <tr>    
                    <td>${items[i].id}</td>
                    <td>${items[i].product.name}</td>
                    <td>${items[i].product.price} PLN</td>
                </tr>`);
                tr.append(quantity);
                tr.append(`
                    <td>${floor(items[i].order_items_quantity*items[i].product.price*100)/100} PLN</td>
                    <td></td>
                    <td></td>`);
            orderItems.append(tr);
            }
            modalContent.append(orderItems);
        });

        $.getJSON(`${window.location.origin}/orders/status/codes/`, function (statusCodes) {
            for(let i=0; i<statusCodes.length;i++) {
                let selected =(statusCodes[i].id===order.status_code) ? "selected" : "";
                options+=(`<option value="${statusCodes[i].id}" ${selected}>${statusCodes[i].description}</option>`);
            }
        }).done(function () {
            let form=$(`
                <form method="POST" action="/orders/${order.id}" class="modal-content">
                    <input type="hidden" name="_method" value="PUT">
                    <label for="order_details">Order details</label><textarea name="order_details"></textarea>
                    <label for="status">Status</label> <select name=status>${options}</select>
                    <hr>
                    <label for="first_name">First name</label>  <input type="text" name="first_name" value="${order.first_name}">
                    <label for="second_name">Second name</label><input type="text" name="second_name" value="${order.second_name}"><br>
                    <label for="surname">Surname</label>        <input type="text" name="surname" value="${order.surname}"><br>
                    <label for="email">Email</label>            <input type="email" name="email" value="${order.email}"><br>
                    <label for="phone">Phone</label>            <input type="tel"  name="phone" value="${order.phone}"><br>
                    <label for="country">Country</label>        <input type="text" name="country" value="${order.country}">
                    <label for="state">State</label>            <input type="text" name="state" value="${order.state}"><br>
                    <label for="city">City</label>              <input type="text" name="city" value="${order.city}">
                    <label for="address">Address</label>        <input type="text" name="address" value="${order.address}"><br>
                    <label for="zip-code">Zip-code</label>      <input type="text" name="zip_code" value="${order['zip_code']}"><br>
                                                                <input type="submit" id="btn-submit" class="fa fa-floppy-o" value=&#xf0c7>

                    <input type="hidden" name="_token" value="${$('meta[name=csrf-token]').attr('content')}">
                </form>`);
            modalContent.append(form);
            modal.toggle('fast');
            });
    }
}


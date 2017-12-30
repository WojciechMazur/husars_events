import * as $ from "jquery";
import * as util from './../utils'
import {findTextInTable} from "../utils";

export default class Customers{
    static show(content) {
        content.html("");
        $.getJSON(window.location.origin + '//users', function (data) {
            const now= new Date();
            let tr;

            let table=$("<table class='admin-table' id='tbl-customers'/>");
            table.append(
                `<tr>
    <th>Id</th>
    <th>First Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Created</th>
    <th>Updated</th>
    <th> </th>
    <th> </th>
</tr>`);
            for (let i=0; i<data.length;i++){
                let btn_edit=$("<button class='btn-edit'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button>");
                btn_edit.on('click', function () {
                    Customers.edit($(this).parent().parent().find('td:first').text());
                });
                let btn_delete=$("<button class='btn-delete'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>");
                btn_delete.on('click', function () {
                    Customers.delete($(this).parent().parent().find('td:first').text());
                });

                tr = $('<tr/>');
                tr.append("<td>" + data[i].id + "</td>");
                tr.append("<td>" + data[i].first_name + "</td>");
                tr.append("<td>" + data[i].surname + "</td>");
                tr.append("<td>" + data[i].email + "</td>");
                tr.append("<td>" + Math.floor((now.getTime()-util.stringToDate(data[i].created_at,'YYYY-MM-DD HH:MM:SS'))/86400000) + " days ago </td>");
                tr.append("<td>" + Math.floor((now.getTime()-util.stringToDate(data[i].updated_at,'YYYY-MM-DD HH:MM:SS'))/86400000) + " days ago </td>");
                tr.append($("<td></td>").append(btn_edit));
                tr.append($("<td></td>").append(btn_delete));

                table.append(tr);
            }
            content.append(table);
        });
    }

    static edit(id){
        $.getJSON(`${window.location.origin}/users/${id}`, function (data) {
            Customers.createEditForm(data);
        });

    }

    static delete(id){
        $.ajax({
            url: `${window.location.origin}/users/${id}`,
            method: 'DELETE',
            success: (response) => {
                let row = findTextInTable(id, "#tbl-customers");
                row.html("");

            },
            fail: (status) => {
                alert("Unknown error accoured");
                console.log(status);
            },

        })

    }

    static createEditForm(user) {
        let zip_code=user['zip-code'];
        const modal=$('#modal');
        const modalContent=$('#modal-content');
        let form=$(`
                <form method="POST" action="/users/${user.id}" class="modal-content">
                <input type="hidden" name="_method" value="PUT">
                <label for="first_name">First name</label>  <input type="text" name="first_name" value="${user.first_name}">
                <label for="second_name">Second name</label><input type="text" name="second_name" value="${user.second_name}"><br>
                <label for="surname">Surname</label>        <input type="text" name="surname" value="${user.surname}"><br>
                <label for="email">Email</label>            <input type="email" name="email" value="${user.email}"><br>
                <label for="phone">Phone</label>            <input type="tel"  name="phone" value="${user.phone}"><br>
                <label for="country">Country</label>        <input type="text" name="country" value="${user.country}">
                <label for="state">State</label>            <input type="text" name="state" value="${user.state}"><br>
                <label for="city">City</label>              <input type="text" name="city" value="${user.city}">
                <label for="address">Address</label>        <input type="text" name="address" value="${user.address}"><br>
                <label for="zip-code">Zip-code</label>      <input type="text" name="zip_code" value="${zip_code}"><br>
                <label for="password">Password</label>      <input type="text" name="password"><br>
                <input type="hidden" name="_token" value="${$('meta[name=csrf-token]').attr('content')}">
                <input type="submit" id="btn-submit" class="fa fa-floppy-o" value=&#xf0c7>
                <input type="button" id="btn-cancel" class="fa fa-times" value=&#xf00d>
                </form>`);
        form.find('#btn-cancel').on('click', function () {
           modal.toggle('fast');
        });

        modalContent.html("").append(form);
        modal.toggle('fast');
    }

}


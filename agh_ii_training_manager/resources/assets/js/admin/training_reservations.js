import {floor, isInteger} from "lodash";

import * as $ from "jquery";
import * as util from './../utils'
import {findTextInTable} from "../utils";

export default class TrainingReservations{
    static show(content) {
        content.html("");
        createTrainingInput(content);
        createCustomerInput(content);
        let innerContent = $('<div id="inner-content"></div>');
        let btnFind=$('<button id="btn-find">Find</button>');
        btnFind.bind('click', function () {
            innerContent.html('');
            $.getJSON(window.location.origin + '/trainings/reservations/index', {
                customer_id: $('#input-customer-id').val(),
                training_id: $('#input-training-id').val()
            }, function (data) {
               console.log(data);
                let tr;
                let table=$("<table class='admin-table' id='tbl-training-reservations'/>");
                table.append(
                    `<tr>
    <th>Id</th>
    <th>Date</th>
    <th>Location</th>
    <th>Limit</th>
    <th>First name</th>
    <th>Surname</th>
    <th>Email</th>
    <th> </th>
    <th> </th>
</tr>`);
                for (let i=0; i<data.length;i++){
                    let btn_edit=$("<button class='btn-edit'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button>");
                    btn_edit.on('click', function () {
                        TrainingReservations.edit($(this).parent().parent().find('td:first').text());
                    });
                    let btn_delete=$("<button class='btn-delete'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>");
                    btn_delete.on('click', function () {
                        TrainingReservations.delete($(this).parent().parent().find('td:first').text());
                    });
                    tr = $('<tr/>');
                    tr.append(`<td>${data[i].id}</td>`);
                    tr.append(`<td>${data[i].date.substring(0, 16)}</td>`);
                    tr.append(`<td>${data[i].location}</td>`);
                    tr.append(`<td>${data[i].signed_in} / ${data[i].capacity_limit}</td>`);
                    tr.append(`<td>${data[i].first_name}`);
                    tr.append(`<td>${data[i].surname}</td>`);
                    tr.append(`<td>${data[i].email}</td>`);
                    tr.append(btn_edit);
                    tr.append(btn_delete);
                    table.append(tr)
                }
                innerContent.append(table);
            });
        });
        content.append(btnFind);
        content.append(innerContent);
    }

    static edit(id){
    }

    static delete(id){
        $.ajax({
            url: `${window.location.origin}/trainings/reservation/${id}`,
            method: 'DELETE',
            success: (response) => {
                let row = findTextInTable(id, "#tbl-training-reservations");
                row.html("");
            },
            fail: (status) => {
                alert("Unknown error accoured");
                console.log(status);
            },

        })

    }

    static createEditForm(product) {

    }

}

function createTrainingInput(content){
    $.getJSON(window.location.origin + '/trainings', {api: true}, function (data) {
        let options = '<option value="*">Select training</option>';
        for(let i=0; i<data.length;i++) {
            let trainer=`${data[i].trainer_details.name} ${data[i].trainer_details.surname}`;
            let location=`${data[i].location}`;
            let date=`${data[i].date.substring(0,16)}`;
            options+=(`<option value="${data[i].id}">${date} ${location} ${trainer}</option>`);
        }
        let inputTrainingId = $(`<select id="input-training-id" style="width:100%">${options}</select>`);
        content.prepend(inputTrainingId);

    });
}

function createCustomerInput(content){
    $.getJSON(window.location.origin + '/users', {api: true}, function (data) {
        let options = '<option value="*">Select customer</option>';
        for(let i=0; i<data.length;i++) {
            let user=`${data[i].first_name} ${data[i].surname} ${data[i].email}`;
            options+=(`<option value="${data[i].id}">${user}</option>`);
        }
        let inputCustomerId = $(`<select id="input-customer-id" style="width:100%">${options}</select>`);
        content.prepend(inputCustomerId);
    });
}

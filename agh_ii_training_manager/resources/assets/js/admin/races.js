import {floor, isInteger} from "lodash";

import * as $ from "jquery";
import * as util from './../utils'
import {findTextInTable} from "../utils";

export default class Races{
    static show(content) {
        content.html("");
        $.getJSON(`${window.location.origin}/races`, {api: true}, function (data) {
            console.log(data);
            let tr;
            let table=$("<table class='admin-table' id='tbl-races'/>");
            table.append(
                `<tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Location</th>
                 <th>Distance</th>
                 <th>Date</th>
                 <th> </th>
                 <th> </th>
             </tr>`);
            //Bug. Gets object insted or array of objects
            for (let i=0; i<data.length;i++){
                console.log(i);
                let btn_edit=$("<button class='btn-edit'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button>");
                btn_edit.on('click', function () {
                    Races.edit($(this).parent().parent().find('td:first').text());
                });
                let btn_delete=$("<button class='btn-delete'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>");
                btn_delete.on('click', function () {
                    Races.delete($(this).parent().parent().find('td:first').text());
                });
                tr = $('<tr/>');
                tr.append(`<td>${data[i].id}</td>`);
                tr.append(`<td>${data[i].name}</td>`);
                tr.append(`<td>${data[i].location}</td>`);
                tr.append(`<td>${data[i].distance}`);
                tr.append(`<td>${data[i].date.substring(0, 16)}</td>`);
                tr.append(btn_edit);
                tr.append(btn_delete);
                table.append(tr)
            }
            content.append(table);
        });
    }

    static edit(id){
    }

    static delete(id){
        $.ajax({
            url: `${window.location.origin}/races/${id}`,
            method: 'DELETE',
            success: (response) => {
                let row = findTextInTable(id, "#tbl-races");
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


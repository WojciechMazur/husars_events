import * as $ from "jquery";
import {showMessage} from "../utils";


$('.tbl-races tr').bind('click', function () {
    const id = $(this).children()[0].innerHTML;
    let options='';
    $.getJSON(`${window.location.origin}/races/${id}`, function (data) {
        for(let i=0; i<data['heats'].length;i++) {
            const h=data['heats'][i];
            options+=(`<option value="${h.id}">${h.heat_start.substring(0,5)} ${h.type.toUpperCase()} ${h.signed_in} / ${h.capacity}</option>`);
        }
    }).done(function (data) {
        const modal= $('#modal');
        const content= $('#modal-content');
        content.html("");
        const div = $('<div id=race_details></div>');
        div.append(`<span id="name"><b>${data['name']}</b></span>`);
        div.append(`<span id="date">Date: <b>${data['date']}</b></span>`);
        div.append(`<span id="location">Location: <b>${data['location']}</b></span>`);
        div.append(`<span id="distance">Distance: <b>${data['distance']}</b></span>`);
        div.append(`<span id="description">${data['description']}</span>`);
        div.append(`<select id="heats">${options}</select>`);
        const btn_join = $('<button id="btn-signin">Join</button>');
        const btn_cancel = $('<button id="btn-cancel" class="fa fa-times" value="&#xf00d"></button>');
        btn_cancel.on('click', function () {
            modal.toggle('fast');
        });
        btn_join.on('click', function () {
            $.ajax({
                url: `${window.location.origin}/races/register`,
                method: 'POST',
                dataType : 'json',
                data: {
                    customer_id: user.id,
                    race_id: id,
                    heat_id: $('#heats').find('option:selected').val()
                },
                success: (response) => {
                  if(response.success)
                      showMessage("Registration successful", 'green');
                  else
                      showMessage(response.message);
                    }
            });
            modal.toggle();
        });
        content.append(btn_cancel);
        div.append(btn_join);
        content.append(div);
        modal.toggle();
    })
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

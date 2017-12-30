import * as $ from "jquery";
import {showMessage} from "./utils";


$('.tbl-trainings tr').bind('click', function () {
    const id = $(this).children()[0].innerHTML;
    $.getJSON(`${window.location.origin}/trainings/${id}`, function (data) {
        const modal= $('#modal');
        const content= $('#modal-content');
        content.html("");
        const limit_fillup = data['signed_in']/data['capacity_limit'];
        const limit_style = (limit_fillup>0.75) ? '#ff0000' : (limit_fillup>0.5) ? '#ffbf00' : '#00ff00';
        const div = $('<div id=training_details></div>');
        div.append(`<span id="date">Date: <b>${data['date'].substring(0,16 )}</b></span>`);
        div.append(`<span id="trainer">Trainer: <b>${data['trainer_details']['name']} ${data['trainer_details']['surname']}</b></span>`);
        div.append(`<span id="trainer_spec">Trainer specialization: <b>${data['trainer_details']['specialization']}</b></span>`);
        div.append(`<span id="duration">Duration:<b> ${data['duration_minutes']} minutes</b></span>`);
        div.append(`<span id="location">Location:<b>${data['location']}</b></span>`);
        div.append(`<span id="description">${data['description']}</span>`);
        div.append(`<span id="limits">Participants limits: <b style="color: ${limit_style}">${data['signed_in']}/${data['capacity_limit']}</b></span>`);
        const btn_join = $('<button id="btn-signin">Join</button>');
        const btn_cancel = $('<button id="btn-cancel" class="fa fa-times" value="&#xf00d"></button>');
        btn_cancel.on('click', function () {
            modal.toggle('fast');
        });
        btn_join.on('click', function () {
            $.ajax({
                url: `${window.location.origin}/trainings/reservation`,
                method: 'POST',
                dataType : 'json',
                data: {
                    customer_id: user.id,
                    training_id: id
                },
                success: (response) => {
                    switch (response){
                        case 208: showMessage('Already joined to this training'); break;
                        default: showMessage("Reservation successful", 'green');
                    }
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

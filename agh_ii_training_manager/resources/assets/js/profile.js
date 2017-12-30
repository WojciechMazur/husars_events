import * as $ from "jquery";
import {showMessage} from "./utils";

$('.btn-remove-training-reservation').bind('click', function () {
   console.log($(this).val());

   $.ajax({
       url: `${window.location.origin}/trainings/reservation/${$(this).val()}`,
       method: 'DELETE',
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       success: (response) => {
           console.log(response);
           showMessage("Reservation deleted");
           let rootElement=$($(this).parent().parent());
           rootElement.find('.collapsable').toggle('slow');
           const btn_expend =rootElement.parent().find('.btn-expend');
           btn_expend.html('<i class="fa fa-plus" aria-hidden="true"></i>');

           rootElement.parent().remove();
       },
       fail: (response) => {
          showMessage("Some problem accoured. Please, try again.")
       }
   });
});

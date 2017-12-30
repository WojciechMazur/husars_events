
import * as $ from "jquery";

$(function(){
    $('li:has(.collapsable)')
        .find('.btn-expend').html('<i class="fa fa-plus" aria-hidden="true"></i>');

    $('.btn-expend')
        .click(function(event){
            let parent=$(this).parent();
            let button = $(parent).find('.btn-expend');
            if(parent.has(event.target)){
                button.html(!$(parent).find('.collapsable').first().is(':hidden')
                    ? '<i class="fa fa-plus" aria-hidden="true"></i>'
                    : '<i class="fa fa-minus" aria-hidden="true"></i>');
                $(parent).find('.collapsable').toggle('slow');
            }
            return false;
        }).parent().find('.collapsable').hide();

});

export function toogleCollapsable(obj) {
    console.log(obj);
    console.log($(obj));
}
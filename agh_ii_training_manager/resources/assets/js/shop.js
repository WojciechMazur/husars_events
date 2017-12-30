
import * as $ from "jquery";
import {showMessage} from "./utils";


function applyQuantityChange(){
    let inputNode = null;
    let subobjects = this.parentNode.childNodes;
    for(let i=0; i<subobjects.length;i++) {
        if(subobjects.item(i).name==='quantity-input') {
            inputNode = subobjects.item(i);
            break;
        }
    }
    let objectId=inputNode.id.split('-').pop();
    $.ajax({
        url: window.location.origin + '/shop/shopping-cart/edit',
        method: 'PUT',
        data: {
            id: objectId,
            key: 'quantity',
            value: inputNode.value
        },
        success: (response) => {
            let responseObj = $.parseJSON(response);
            //alert("Quantity of product changed");
            $('#shopping-cart-items')
                .html('Shopping Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i> ' + responseObj['totalQuantity']);
            let priceElement=$('#totalPrice');
            let start=(priceElement.html().indexOf('<strong>'))+'<strong>'.length;
            let end=(priceElement.html().indexOf('</strong>'));
            let replacePrice = priceElement.html().substring(0, start) +
                responseObj['totalPrice'].toFixed(2) + ' PLN';
                priceElement.html().substring(end);
            priceElement.html(replacePrice);
            let edited=(responseObj['items'][objectId]);
            if(edited!==undefined)
                $('#'+inputNode.id).closest('td').next().next().html(edited['value']);
            else
                $(this).parent().parent().remove();
            showMessage("Shopping cart was updated", 'green');
            },
        fail: () => {
            alert("Unknown error accoured");
        },

    })

}

window.onload=function () {
    if(window.location.href.split('/').pop()!=='submit') {
        let quantity_inputs = document.getElementsByClassName('btn-quantity-submit');
        for (let i = 0; i < quantity_inputs.length; i++) {
            quantity_inputs[i].addEventListener('click', applyQuantityChange);
        }
    }
    $('#btn-submit-order').bind('click', function () {
       window.location.replace(window.location.origin + '/shop/shopping-cart/submit');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
};
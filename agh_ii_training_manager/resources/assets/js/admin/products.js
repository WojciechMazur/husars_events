import {floor, isInteger} from "lodash";

import * as $ from "jquery";
import * as util from './../utils'
import {findTextInTable} from "../utils";

export default class Products{
    static show(content) {
        content.html("Not implemented");
    }

    static edit(id){
    }

    static delete(id){
        $.ajax({
            url: `${window.location.origin}/products/${id}`,
            method: 'DELETE',
            success: (response) => {
                let row = findTextInTable(id, "#tbl-products");
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


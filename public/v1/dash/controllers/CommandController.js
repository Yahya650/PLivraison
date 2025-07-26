"use strict";

// Class definition
var CommandController = (function () {
    var form;
    var validator;

    var initForm = function (e) {

        $(".select2").select2({
            dropdownParent: $('#Delivery_Guercif_modal'),
        });


    };


    return {
        init: function () {
            form = document.querySelector("#command-form");
            initForm();
            // handleForm();
        },
        getForm: function () {
            return form;
        },
    };
})();


// $(document).ready(function () {
//     blogController.init();
// });
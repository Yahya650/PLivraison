const global_selector = "#ManagmentCIFpro_modal";
const global_selector_seccend = "#ManagmentCIFpro_modal2";
const global_search = "#global-modal-search";
const alertType = 'swal';

console.log("app.js its work");

function dd(message) {
    console.log(message);
}
function message(message, type = 'info') {
    selectedType = 'text-' + type;
    selectedAnimation = 'animate__shakeX';
    toastAnimationExample = document.querySelector('.toast-ex');
    toastAnimationExample.classList.add(selectedAnimation);
    toastAnimationExample.querySelector('.ti').classList.add(selectedType);
    time = document.querySelector('.ti-time');
    time.innerHTML = '1 second ago';
    custom_message = $(".toast-body").text(message);
    toastAnimation = new bootstrap.Toast(toastAnimationExample);
    toastAnimation.show();
}




// Format options (for dropdown items)
function formatCountryOption(option) {
    if (!option.id) {
        return option.text; // Show default text for placeholder
    }

    // Get the data attributes
    var flagUrl = $(option.element).data('flag');
    var countryName = $(option.element).data('name');
    var iso3 = $(option.element).data('iso3');
    var phoneCode = $(option.element).data('phone-code');

    return `
                <span>
                    <img src="${flagUrl}" alt="${countryName}" style="width: 20px; height: 15px; margin-right: 10px;">
                    ${countryName} - ${iso3} <span class="text-muted">(${phoneCode})</span>
                </span>
            `;
}

// Format selection (for the selected item in the input box)
function formatCountrySelection(option) {
    if (!option.id) {
        return option.text; // Show default text for placeholder
    }

    // Get the data attributes
    var flagUrl = $(option.element).data('flag');
    var countryName = $(option.element).data('name');
    var phoneCode = $(option.element).data('phone-code');
    return `
                <span>
                    <img src="${flagUrl}" alt="${countryName}" style="width: 20px; height: 15px; margin-right: 10px;">
                    ${countryName}
                </span>
            `;
}

function removeUrlParameter(param) {
    const url = new URL(window.location.href); // Get the current URL
    url.searchParams.delete(param); // Remove the specified parameter
    window.history.replaceState(null, '', url); // Update the browser's URL without reloading the page
}


// This function for take all params in current url and put them in request url and return new url = current url + current filter params
function setSearchParamsAtCurrentUrl(action) {
    const url = new URL(action); // Get the current URL
    const currentUrl = new URL(window.location.href); // Get the current URL
    currentUrl?.searchParams?.forEach((value, key) => {
        url.searchParams.append(key, value); // Append each parameter
    });
    return url
}
function playSuccessSound() {
    var audio = new Audio("/v1/web/assets/sounds/success/3.mp3");
    audio.play();
}
function playErrorSound() {
    var audio = new Audio("/v1/web/assets/sounds/error/1.mp3");
    audio.play();
}
function playInfoSound() {
    var audio = new Audio("/v1/web/assets/sounds/info/1.mp3");
    audio.play();
}
function playWarningSound() {
    var audio = new Audio("/v1/web/assets/sounds/warning/1.mp3");
    audio.play();
}

/* FUNCTIONS HELPERS STARTS HERE */
function alert_success(message, type = 'success') {
    playSuccessSound()
    Swal.fire({
        html: message,
        icon: type,
    });
}

function alert_error(message, type = 'error') {
    playErrorSound()
    swal.fire({
        html: message,
        icon: type,
    })

}

function alert_info(message, type = 'info') {
    playInfoSound()
    swal.fire({
        html: message,
        icon: type,
    })

}

function alert_warning(message, type = 'warning') {
    playWarningSound()
    swal.fire({
        html: message,
        icon: type,
    })


}

const container = document.getElementById("global-toast");
const targetElement = document.querySelector('[data-kt-docs-toast="stack"]');
if (targetElement) {
    targetElement.parentNode.removeChild(targetElement);
}

function toast_success(message, type = 'success') {
    playSuccessSound()
    toastr.success(message, type)

}

function toast_info(message, type = 'info') {
    // selectedType = 'text-' + type;
    // selectedAnimation = 'animate__shakeX';
    // toastAnimationExample = document.querySelector('.toast-ex');
    // toastAnimationExample.classList.add(selectedAnimation);
    // toastAnimationExample.querySelector('.ti').classList.add(selectedType);
    // time = document.querySelector('.ti-time');
    // time.innerHTML = '1 second ago';
    // custom_message = $(".toast-body").text(message);
    // toastAnimation = new bootstrap.Toast(toastAnimationExample);
    // toastAnimation.show();
    playInfoSound()
    toastr.info(message, type)

}

function toast_error(message, type = 'error') {
    // selectedType = 'text-' + type;
    // selectedAnimation = 'animate__shakeX';
    // toastAnimationExample = document.querySelector('.toast-ex');
    // toastAnimationExample.classList.add(selectedAnimation);
    // toastAnimationExample.querySelector('.ti').classList.add(selectedType);
    // time = document.querySelector('.ti-time');
    // time.innerHTML = '1 second ago';
    // custom_message = $(".toast-body").text(message);
    // toastAnimation = new bootstrap.Toast(toastAnimationExample);
    // toastAnimation.show();
    playErrorSound()
    toastr.error(message, type)

}

function toast_warning(message, type = 'warning') {
    playWarningSound()
    toastr.warning(message, type)

}

function disconnected() {
    warning(
        "Il semble que vous soyez déconnecté de l'application, veuillez rafraîchir la page."
    );
}


function showLoader(message = null) {

    $.blockUI({
        message: `
                <div class="">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only ps-4">${message ? message : "Loading..."}</span>
                    </div>
                    <p>${message ? message : "Loading..."}</p>
                </div>
                `,
        css: {
            backgroundColor: 'transparent',
            zIndex: 99999999999999,
            border: 'none'
        },
        overlayCSS: {
            zIndex: 9999999999999,
            backgroundColor: '#000',
            opacity: 0.6
        }
    });
    // alert("googl")
    // if ($('body').hasClass('software-landing-page')) {
    //     $("#preloader").show();
    // } else {
    //     $("#kt_body").addClass("page-loading");
    // }

}

function hideLoader() {

    $.unblockUI();

    // if ($('body').hasClass('software-landing-page')) {
    //     $("#preloader").hide();
    // } else {
    //     $("#kt_body").removeClass("page-loading");
    // }
}

function showLoaderInDataContainer(dataContainer_id) {
    $(dataContainer_id).html(`
        <div style="
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
        ">
            <div class="loader">
                <img id="drawerUserImage" width="150px" src="/v1/web/assets/images/plivraison.png" />
            </div>
        </div>
    `);
}


function hideLoaderInDataContainer(dataContainer_id) {
    if ($('body').hasClass('software-landing-page')) {
        $("#preloader").hide();
    } else {
        $("#kt_body").removeClass("page-loading");
    }
}

function check_controller(controller) {

    try {
        if (!controller) {

            alert_error(
                "The controller is not found! You need to specify the controller name in attribute data-controller in the element. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
            );
            return false;
        }

        let validator = window[controller].getValidator();

        if (validator === undefined) {
            alert_error(
                "The controller " +
                controller +
                " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
            );
            return false;
        }
        return true;
    } catch (error) {
        alert_error(
            "The controller " +
            controller +
            " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
        );
        return false;
    }
}

/* FUNCTIONS HELPERS ENDS HERE */

/* EVENTS HELPERS STARS HERE */

// Show a modal on click on a link
$("body").off("click", ".anchor-modal");
$("body").on("click", ".anchor-modal", function (e) {
    e.preventDefault();
    showLoader();
    var current = $(this);

    let modal_id = current.data("modal-type") == "seccend" ? global_selector_seccend : global_selector;
    let modal_size = "";

    if (current.data("modal-id")) {
        modal_id = current.data("modal-id");
    }
    if (current.data("modal-size")) {
        modal_size = current.data("modal-size");
    }

    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");

    let disableclick = current.data("disableclick");
    if (!current.data("href")) {
        alert_error(
            "Please specify the data-href attribute in the anchor element"
        );
        hideLoader();
        return;
    }
    let orders = [];
    if (current.data('orders') != undefined) {
        orders = current.data('orders');
    };
    headers = {}
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }

    // Get the base URL
    let url = new URL(current.data("href"));

    // Loop through localStorage and add each item as a query parameter
    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        const value = localStorage.getItem(key);
        url.searchParams.append(key, value);
    }

    $.ajax({
        type: "GET",
        url,
        headers: headers,
        data: {
            orders: orders,
        },
        success: function (data) {

            if (data.html === undefined) {
                // playErrorSound();
                toast_error(
                    "The data returned is not valid, please return a valid html in the data object"
                );
                hideLoader();
                return;
            }

            if (disableclick) {
                $(modal_id).modal({
                    backdrop: "static",
                    keyboard: false
                });
            }

            // console.log(data.html);


            $(modal_id)
                .find(".modal-header")
                .find("h1")
                .empty()
                .html(current.data("modal-title"));
            $(modal_id)
                .find('.modal-body').empty().html(data.html);
            $(modal_id).find("form").find("h2.modal-call_center_id").text(current.data("modal-call_center_id"));
            // $(modal_id).find(".modal-content").find(".modal-body").empty();

            // $(modal_id)
            //     .find("#content")
            //     .html(data.html);

            if (modal_size) {
                $(modal_id)
                    .find(".modal-dialog")
                    .removeClass(["modal-xl", "modal-fullscreen"])
                    .addClass(modal_size);
            }

            if (has_controller) {

                if (!window[controllerClass]) {
                    alert_error(
                        "The controller " +
                        controllerClass +
                        " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the button."
                    );
                    hideLoader();
                    return false;
                } else {
                    window[controllerClass].init();
                    $(modal_id).modal("show");
                }
            } else {
                $(modal_id).modal("show");
            }

            // $('.file').fileuploader({
            //     limit: 1,
            //     files: data.file_infos ? [data.file_infos] : null // Pass the file details to prepopulate
            // });

            // if ($('#tags')[0]) tagify = new Tagify($('#tags')[0]); // tags input

            hideLoader();

        },

        error: function (xhr) {
            hideLoader();
            let response = xhr.responseJSON;
            // playErrorSound();
            if (response.is_want_alert_type) {
                alert_error(response.message)
            } else {
                toast_error(response.message);
            }
        },
    });
});

var files = [];
$("body").off("change", ".file-input");
$("body").on("change", ".file-input", function (e) {
    if (!this.files) {
        return false;
    }
    files.push(this.files[0]);

    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (event) {
            reader.readAsDataURL(this.files[0]);
        };
    }
});

// Ajax add a new user after a form-store
$("body").off("submit", ".form-store");
$("body").on("submit", ".form-store", function (e) {
    // alert("edd");
    e.preventDefault();

    let current = $(this);
    let action = current.attr("action");
    let method = current.attr("method");
    let container_id = current.data("container");
    let show_alert = current.data("show-alert");
    let modal_id = current.data("model-id") ? current.data("model-id") : global_selector;
    // let has_controller = !current.data("no-controller");
    let names_list = current.data("names-list"); // Parse the names list
    let has_wait_button = current.data("wait-button");
    let wait_button_content = $(current.data("wait-button")).html();
    let has_DataCondition = current.data("hasdatacondition");


    // Form Data object
    // console.log(fd.get('_method'));
    // // console.log(url.pathname.includes("formations"));
    // return;

    var fd = new FormData(this);
    // This function for take all params in current url and put them in request url
    let url = setSearchParamsAtCurrentUrl(action)

    if (has_wait_button) {
        var button = document.querySelector(has_wait_button);
        button.innerHTML = `
            <span class="indicator-label">s'il vous plaît, patientez...</span>
            <span class="indicator-progress">
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>`;
        button.disabled = true;
    }

    function sendAjax() {



        showLoader(); // Show a global loader if implemented
        const headers = {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        };

        let XUSERID = $('meta[name="user-proxy-id"]').attr("content");
        if (XUSERID) {
            headers["X-USER-PROXY-ID"] = XUSERID;
        }

        $.ajax({
            url,
            method,
            data: fd,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: headers,
            success: function (response) {
                hideLoader(); // Hide loader after success
                // playSuccessSound(); // Optional success sound
                if (show_alert) {
                    alert_success(response.message);
                } else {
                    toast_success(response.message);
                }

                if (response.redirect) {
                    setTimeout(() => window.location = response.redirect, 1000);
                }

                if (container_id) {
                    $(container_id).html(response.html);

                    if (has_DataCondition) {
                        $("#container_of_list_container").css("display", "block");
                        $("#no_data_message").hide();
                    }
                }

                names_list?.forEach(name => {
                    let input = current.find(`[name="${name}"]`);
                    input.removeClass("is-invalid");
                    // input.addClass("is-valid");
                    input.next(".invalid-feedback").remove();
                });

                $(modal_id).modal("hide");

                files = [];
                if (current.data("init-controller") && window[current.data("init-controller")]) {
                    window[current.data("init-controller")].init();
                }

                if (has_wait_button) {
                    button.innerHTML = wait_button_content;
                    button.disabled = false;
                }

                current.trigger("reset");
            },
            error: function (response) {
                hideLoader(); // Hide loader after error
                // playErrorSound(); // Optional error sound
                // console.log(response.html);
                // return ;

                if (container_id) {
                    $(container_id).html(response.responseJSON?.html);

                    if (has_DataCondition) {
                        $("#container_of_list_container").css("display", "block");
                        $("#no_data_message").hide();
                    }
                }

                if (has_wait_button) {
                    button.innerHTML = wait_button_content;
                    button.disabled = false;
                }
                // if (response.status === 422) {
                // Handle validation errors
                const errors = response.responseJSON?.errors;
                names_list?.forEach(name => {
                    let input = current.find(`[name="${name}"]`);
                    if (errors && errors[name]) {
                        if (input.hasClass("is-invalid")) {
                            input.removeClass("is-invalid");
                            input.next(".invalid-feedback").remove();
                        }
                        input.addClass("is-invalid");
                        input.after(`<div class="invalid-feedback">${errors[name]}</div>`);
                    } else {
                        if (input.hasClass("is-invalid")) {
                            input.removeClass("is-invalid");
                            input.addClass("is-valid");
                            input.next(".invalid-feedback").remove();
                        }
                    }
                });
                // } else {
                if (response.responseJSON?.is_want_alert_type) {
                    alert_error(response.responseJSON?.message)
                } else {
                    toast_error(response.responseJSON?.message);
                }                // }

            },
        });
    }

    // Optional controller-based validation
    if (false) {
        let controllerClass = current.data("controller");
        if (check_controller(controllerClass)) {
            let validator = window[controllerClass].getValidator();
            validator.validate().then(status => {
                if (status === "Valid") {
                    sendAjax();
                } else {
                    // playErrorSound();
                    toast_error("Veuillez remplir tous les champs obligatoires.");
                    if (has_wait_button) {
                        button.innerHTML = wait_button_content;
                        button.disabled = false;
                    }
                }
            });
        } else {
            sendAjax();
        }
    } else {
        sendAjax();
    }
});

// Ajax add a new user after a form-filter
$("body").off("change", ".form-filter");
$("body").on("change", ".form-filter", function (e) {
    e.preventDefault();
    // alert('zz')

    let current = $(this);
    // console.log(current);

    let action = current.attr("action");
    let method = current.attr("method");
    let container_id = current.data("container");
    // let modal_id = global_selector;
    // let has_controller = !current.data("no-controller");
    let names_list = current.data("names-list"); // Parse the names list
    let names_list_array = current.data("names-list-array"); // Parse the names list
    // let has_wait_button = current.data("wait-button");
    // let wait_button_content = $(current.data("wait-button")).html();
    // let has_DataCondition = current.data("hasdatacondition");

    // Form Data object
    var fd = new FormData(this);

    const url = new URL(action); // Get the current URL

    // if (has_wait_button) {
    //     var button = document.querySelector(has_wait_button);
    //     button.innerHTML = `
    //         <span class="indicator-label">s'il vous plaît, patientez...</span>
    //         <span class="indicator-progress">
    //             <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    //         </span>`;
    //     button.disabled = true;
    // }

    function sendAjax() {
        showLoaderInDataContainer(container_id); // Show a loader in data container place

        const headers = {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        };

        let XUSERID = $('meta[name="user-proxy-id"]').attr("content");
        if (XUSERID) {
            headers["X-USER-PROXY-ID"] = XUSERID;
        }

        names_list?.map((name) => {
            // alert(name + " " + fd.get(name))
            if (fd.get(name) != "" && fd.get(name) != null && fd.get(name) != undefined && fd.get(name) != 0) url.searchParams.set(name, fd.get(name)); // Add or update the parameter
            else url.searchParams.delete(name, name)
        })

        names_list_array?.map((name) => {
            let arrayOfInputs = $(`input[name="${name}[]"]:checked`)
            let arrayOfVals = arrayOfInputs.map(function () {
                return $(this).val();
            }).get();

            if (arrayOfVals.length > 0) url.searchParams.set(name, arrayOfVals); // Add or update the parameter;
            else url.searchParams.delete(name, name)
        })

        history.replaceState(null, '', url);

        $.ajax({
            url,
            method: method,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: headers,
            success: function (response) {
                // hideLoaderInDataContainer(); // Hide loader after success
                playSuccessSound(); // Optional success sound
                if (response.redirect) {
                    window.location = response.redirect;
                    setTimeout(function () {
                    }, 2000);
                }
                setTimeout(function () {
                    if (container_id) {
                        $(container_id).html(response.html);
                    }
                }, 100);
            },
        });
    }

    sendAjax();

});

$(".form-filter").off("click", ".reset-filter-button");
$('.form-filter').on('click', '.reset-filter-button', function (e) {
    e.preventDefault();

    let current = $(".form-filter");
    let action = current.attr("action");

    // Clear all inputs explicitly
    current.find("input, select, textarea").each(function () {
        if ($(this).is(":checkbox") || $(this).is(":radio")) {
            // alert('checkbox or radio')
            // Uncheck all checkboxes and radio buttons
            $(this).attr("checked", false);

        } else if ($(this).is("select")) {
            // alert('select')
            // Reset dropdown to the first option
            $(this).find('option').removeAttr('selected').first().attr('selected', 'selected');
        } else if ($(this).is("input[type='number']")) {
            $(this).attr("value", 0);
        } else {
            // Clear text, number, email, etc.
            $(this).attr("value", "");
        }
    });

    // Trigger form reset for any other fields (default behaviors)
    current.trigger("reset");

    // Remove all URL parameters
    // const url = window.location.origin + window.location.pathname;
    // alert(url)

    window.history.replaceState(null, "", action);

    current.change();
});


$("body").off("click", ".anchor-share");
$("body").on("click", ".anchor-share", async function (e) {
    if (navigator.share) {
        try {
            await navigator.share({
                title: document.title,
                url: $(this).data('share-url'),
            });
        } catch (error) {
            console.error('Error sharing the page:', error);
        }
    } else {
        alert('Sharing is not supported on this browser.');
    }

});

$("body").off("click", ".anchor-delete");
$("body").on("click", ".anchor-delete", function (e) {
    e.preventDefault();

    $(".modal").modal("hide");

    Swal.fire({
        title: "Are you sure ?",
        text: "You can't go back!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Continue",
    }).then((result) => {
        if (!result.isConfirmed) {
            e.preventDefault();
        } else {
            showLoader();
            var current = $(this);
            let action = current.data("href");
            let has_DataCondition = current.data("hasdatacondition");
            let container_id = current.data("container");


            // This three lines for take all params in current url and put them in request url
            // let url = setSearchParamsAtCurrentUrl(action)


            if (!action) {
                // playErrorSound();
                toast_error(
                    "Please specify the data-href attribute in the anchor element"
                );

                hideLoader();
                return;
            }
            if (!container_id) {
                // playErrorSound();
                toast_error(
                    "Please specify the data-container attribute in the anchor element"
                );

                hideLoader();
                return;
            }

            let headers = { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }
            let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
            if (XUSERID) {
                headers["X-USER-PROXY-ID"] = XUSERID;
            }

            $.ajax({
                type: "DELETE",
                url: action,
                data: {
                    _method: "DELETE"
                },
                headers: headers,
                success: function (response) {

                    hideLoader();
                    if ("html" in response == false) {
                        // playErrorSound();
                        toast_error(
                            "Les données renvoyées ne sont pas valides, veuillez renvoyer un HTML valide dans l'objet de données."
                        );
                        return;
                    }

                    if (response.html == "" || response.html == null) {
                        if (has_DataCondition) {
                            $("#container_of_list_container").css(
                                "display",
                                "none"
                            );
                            $("#no_data_message").attr(
                                "style",
                                "display: flex !important"
                            );
                        }
                    }

                    $(container_id).html(response.html);
                    if (response.count != undefined) {
                        console.log(response.count);
                        $('#paginate-count').text(response.count);
                    }
                    // KTMenu.createInstances();
                    if (response.message) {
                        // toast_success(response.message);
                        // playSuccessSound();
                        toast_success(response.message);
                    }
                    if (response.redirect) {
                        window.location = response.redirect;
                        setTimeout(function () {
                        }, 2000);
                    }
                },
                error: function (xhr) {
                    hideLoader();
                    let response = xhr.responseJSON;
                    // playErrorSound();
                    toast_error(response.message);
                },
            });
        }
    });
});

$("body").off("click", ".anchor-target");
$("body").on("click", ".anchor-target", function (e) {
    e.preventDefault();
    showLoader();

    var current = $(this);
    let container_id = current.data("container");
    let parent_container_id = current.data("parent-container");

    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");

    if (!current.data("href")) {
        // playErrorSound();
        toast_error(
            "Please specify the data-href attribute in the anchor element"
        );

        hideLoader();
        return;
    }

    function sendAjaxTarget() {
        let headers = {}
        let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
        if (XUSERID) {
            headers["X-USER-PROXY-ID"] = XUSERID;
        }
        $.ajax({
            type: "GET",
            headers: headers,
            url: current.data("href"),
            success: function (data) {
                if (data.html === undefined) {
                    // playErrorSound();
                    toast_error(
                        "Les données renvoyées ne sont pas valides, veuillez renvoyer un HTML valide dans l'objet de données."
                    );
                    hideLoader();
                    return;
                }

                if (has_controller) {
                    if (!window[controllerClass]) {
                        // playErrorSound();
                        toast_error(
                            "The controller " +
                            controllerClass +
                            " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
                        );

                        hideLoader();
                        return false;
                    } else {
                        $(container_id).html(data.html);
                        if (parent_container_id) {
                            $(parent_container_id).html(data.parentHml);
                        }
                        window[controllerClass].init();
                    }
                } else {
                    $(container_id).html(data.html);
                    if (parent_container_id) {
                        $(parent_container_id).html(data.parentHml);
                    }
                }

                if (data.message) {
                    // playSuccessSound();
                    toast_info(data.message);
                }
                hideLoader();
                // KTMenu.createInstances();
                // KTImageInput.createInstances();
                // $('.select_2').select2();

            },

            error: function (xhr) {
                hideLoader();
                let response = xhr.responseJSON;
                // playErrorSound();
                toast_error(response.message);
            },
        });
    }

    if (current.data("has-confirm-message")) {
        hideLoader();
        Swal.fire({
            title: current.data("confirm-title") || "Êtes-vous sûr(e) ?",
            text: current.data("confirm-message") || "Vous ne pouvez pas revenir en arrière !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Oui, continuez",
        }).then((result) => {
            if (!result.isConfirmed) {
                e.preventDefault();
            } else {
                showLoader();
                sendAjaxTarget();
            }
        });
    } else {
        sendAjaxTarget();
    }

});

$("body").off("change", ".anchor-cities");
$("body").on("change", ".anchor-cities", function (e) {
    e.preventDefault();
    showLoader();

    var current = $(this);
    let container_id = current.data("container");
    let parent_container_id = current.data("parent-container");

    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");

    let country = $(this).val();

    if (!current.data("href")) {
        // playErrorSound();
        toast_error(
            "Please specify the data-href attribute in the anchor element"
        );

        hideLoader();
        return;
    }

    function sendAjaxTarget() {
        let headers = {}
        let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
        if (XUSERID) {
            headers["X-USER-PROXY-ID"] = XUSERID;
        }
        $.ajax({
            type: "GET",
            headers: headers,
            url: current.data("href"),
            data: {
                country: country
            },
            success: function (data) {
                if (data.html === undefined) {
                    // playErrorSound();
                    toast_error(
                        "The data returned is not valid, please return a valid html in the data object"
                    );
                    hideLoader();
                    return;
                }

                if (has_controller) {
                    if (!window[controllerClass]) {
                        // playErrorSound();
                        toast_error(
                            "The controller " +
                            controllerClass +
                            " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
                        );

                        hideLoader();
                        return false;
                    } else {
                        $(container_id).html(data.html);
                        if (parent_container_id) {
                            $(parent_container_id).html(data.parentHml);
                        }
                        window[controllerClass].init();
                    }
                } else {
                    $(container_id).html(data.html);
                    if (parent_container_id) {
                        $(parent_container_id).html(data.parentHml);
                    }
                }
                if (data.message) {
                    // playSuccessSound();
                    toast_info(data.message);
                }
                hideLoader();
                KTMenu.createInstances();
                $('.select_2').select2();

            },

            error: function (xhr) {
                hideLoader();
                let response = xhr.responseJSON;
                // playErrorSound();
                toast_error(response.message);
            },
        });
    }

    if (current.data("has-confirm-message")) {
        hideLoader();
        Swal.fire({
            title: current.data("confirm-title") || "Êtes-vous sûr(e) ?",
            text: current.data("confirm-message") || "Vous ne pouvez pas revenir en arrière !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Oui, continuez.",
        }).then((result) => {
            if (!result.isConfirmed) {
                e.preventDefault();
            } else {
                showLoader();
                sendAjaxTarget();
            }
        });
    } else {
        sendAjaxTarget();
    }




});

$("body").off("click", ".anchor-message");
$("body").on("click", ".anchor-message", function (e) {
    $(this).data("loading-message") ? showLoader($(this).data("loading-message")) : showLoader();

    e.preventDefault();
    let action = $(this).data("href");
    let method = $(this).data("method");
    let container_id = $(this).data("container");
    // console.log(method);
    if (!action) {
        // playErrorSound();
        toast_error(
            "Please specify the data-href attribute in the anchor element"
        );
        hideLoader();
        return;
    }

    let headers = { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }
    $.ajax({
        type: method,
        url: action,
        headers: headers,
        success: function (response) {
            if (response.message === undefined || response.html === undefined) {
                // playErrorSound();
                toast_error(
                    "The data returned is not valid, please return a valid html in the data object"
                );
                hideLoader();
                return;
            } else {
                // playSuccessSound();
                hideLoader();
                if (response.redirect) {
                    window.open(response.redirect, '_blank');
                    setTimeout(function () {
                        // You can add any code to run after 2 seconds here if needed
                    }, 2000);
                }
                if (container_id) {
                    $(container_id).html(response.html);
                }
                toast_success(response.message);
            }
        },
        error: function (xhr) {
            hideLoader();
            let response = xhr.responseJSON;
            // playErrorSound();
            toast_error(response.message);
        }
    });
});


$("body").off("click", ".anchor-target-filter");
$("body").on("click", ".anchor-target-filter", function (e) {
    e.preventDefault();

    let current = $(this);


    let action = current.data("href");
    let method = current.data("method");
    let data_names = current.data("data-names"); // Parse the names list
    let container_id = current.data("container");

    showLoaderInDataContainer(container_id);

    const url = new URL(action); // Get the current URL

    if (!action) {
        // playErrorSound();
        toast_error(
            "Please specify the data-href attribute in the anchor element"
        );
        hideLoader();
        return;
    }

    let headers = { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }


    if (data_names.filter != "" && data_names.filter != null && data_names.filter != undefined && data_names.filter != 0) url.searchParams.set('time', data_names.filter); // Add or update the parameter
    else url.searchParams.delete('time', data_names.filter)

    if (data_names.type != "" && data_names.type != null && data_names.type != undefined && data_names.type != 0) url.searchParams.set('type', data_names.type); // Add or update the parameter
    else url.searchParams.delete('type', data_names.type)

    history.replaceState(null, '', url);

    $.ajax({
        type: method,
        url,
        headers: headers,
        success: function (response) {
            if (response.html === undefined) {
                // playErrorSound();
                toast_error(
                    "The data returned is not valid, please return a valid html in the data object"
                );
                return;
            } else {
                // playSuccessSound();
                if (container_id) {
                    $(container_id).html(response.html);
                }
                if (response.redirect) {
                    window.open(response.redirect, '_blank');
                    setTimeout(function () {
                        // You can add any code to run after 2 seconds here if needed
                    }, 2000);
                }

                if (response.message) toast_success(response.message);
            }
        },
        // error: function (xhr) {
        //     showLoaderInDataContainer(container_id);
        //     let response = xhr.responseJSON;
        //     playErrorSound();
        //     toast_error(response.message);
        // }
    });
});

$("body").off("change", ".select-target");
$("body").on("change", ".select-target", function (e) {
    e.preventDefault();

    let method = $(this).data("method");
    let action = $(this).data("href");
    let current = $(this);
    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");

    action = action.replace("RPL", current.val());

    const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };

    let XUSERID = $('meta[name="user-proxy-id"]').attr("content");
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }

    // ✅ get all form data
    let formData = current.closest("form").serialize();

    showLoader();

    $.ajax({
        type: method,
        url: action,
        headers: headers,
        data: formData, // ✅ send form data
        success: function (response) {
            hideLoader();

            if (current.data("container") && response.html) {
                $(current.data("container")).html(response.html);
            }

            if (current.data("container0") && response.html0) {
                $(current.data("container0")).html(response.html0);
            }

            if (current.data("container1") && response.html1) {
                $(current.data("container1")).html(response.html1);
            }

            if (current.data("container2") && response.html2) {
                $(current.data("container2")).html(response.html2);
            }

            if (current.data("container3") && response.html3) {
                $(current.data("container3")).html(response.html3);
            }

            if (response.message) {
                toast_info(response.message);
            }

            if (has_controller) {
                if (!window[controllerClass]) {
                    alert_error("The controller " + controllerClass + " does not exist.");
                    return false;
                } else {
                    window[controllerClass].init();
                }
            }

            if (response.redirect) {
                window.location = response.redirect;
            }
        },
        error: function (response) {
            hideLoader();
            toast_error(response.responseJSON?.message || "Erreur inconnue");
        },
    });
});


$("body").off("click", ".upload-anchor");
$("body").on("click", ".upload-anchor", function (e) {
    e.preventDefault();
    $("#kt_modal_upload_target").modal("show");
    var current = $(this);
    var myDropzone = new Dropzone("#kt_dropzone_global", {
        url: current.attr("href"), // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        addRemoveLinks: true,
        sending: function (file, xhr, formData) {
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            // TODO : add the user proxy id
        },
        init: function () {
            thisDropzone = this;
            this.on("error", function (file, responseText) {
                $(".dz-preview:last .dz-error-message").text(
                    responseText.errors.file[0]
                );
            });
            this.on("success", function (file, responseText) {
                $(current.data("container")).html(responseText.html);
            });
        },
    });
});

$("body").off("change", ".toggle-recover");
$("body").on("change", ".toggle-recover", function (e) {
    e.preventDefault();
    let action = $(this).data("href");
    var current = $(this);
    let only_trashed = 0;
    if (current.is(":checked")) {
        only_trashed = 1;
    }
    action = action + "&only_trashed=" + only_trashed;
    showLoader();
    let headers = { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }
    $.ajax({
        type: "POST",
        url: action,
        headers: headers,
        success: function (response) {
            hideLoader();
            if (current.data("container")) {
                $(current.data("container")).html(response.html);
            }
            //success(response.message);
            if (response.redirect) {
                window.location = response.redirect;
                setTimeout(function () {
                }, 2000);
            }
        },
        error: function (xhr) {
            hideLoader();
            let response = xhr.responseJSON;
            // playErrorSound();
            toast_error(response.message);
        },
    });
});

$("body").off("change", ".toggle-target");
$("body").on("change", ".toggle-target", function (e) {
    e.preventDefault();
    let action = $(this).data("href");
    var current = $(this);
    let data = {};

    if (current.data("value")) {
        data[current.attr("name")] = current.is(":checked") ? 1 : 0;
    }

    if (!action) {
        // playErrorSound();
        toast_error(
            "Please specify the data-href attribute in the anchor element"
        );
        hideLoader();
        return;
    }

    showLoader();
    let headers = { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }
    $.ajax({
        type: "POST",
        url: action,
        data: data,
        headers: headers,
        success: function (response) {
            hideLoader();
            if (current.data("container")) {
                $(current.data("container")).html(response.html);
            }
            if (response.message) {
                toast_success(response.message);
            }
            //success(response.message);
            if (response.redirect) {
                window.location = response.redirect;
                setTimeout(function () {
                }, 2000);
            }
        },
        error: function (xhr) {
            hideLoader();
            let response = xhr.responseJSON;
            alert_error(response.message);
            if (current.prop("checked")) {
                current.prop("checked", false);
            } else {
                current.prop("checked", true);
            }
        },
    });
});

$("body").off("click", ".anchor-modal-store");
$("body").on("click", ".anchor-modal-store", function (e) {
    e.preventDefault();
    showLoader();
    var current = $(this);
    var dataClosest = current.data("closest");
    let modal_id = global_selector;
    if (current.data("modal-id")) {
        modal_id = current.data("modal-id");
    }

    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");

    if (!current.data("href")) {
        // playErrorSound();
        toast_error(
            "Please specify the data-href attribute in the anchor element"
        );
        hideLoader();
        return;
    }
    let headers = {}
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }

    $.ajax({
        type: "GET",
        headers: headers,
        url: current.data("href"),
        success: function (data) {
            if (data.html === undefined) {
                // playErrorSound();
                toast_error(
                    "The data returned is not valid, please return a valid html in the data object"
                );
                hideLoader();
                return;
            }

            $(modal_id)
                .find(".modal-header")
                .find("h2")
                .find(".modal-icon")
                .empty()
                .html(current.data("modal-icon"));
            $(modal_id)
                .find(".modal-header")
                .find("h2")
                .find(".modal-title")
                .empty()
                .text(current.data("modal-title"));
            $(modal_id).find('.modal-body').html(data);
            $(modal_id).find("form").find("h2.modal-call_center_id").text(current.data("modal-call_center_id"));
            $(modal_id).find(".modal-content").find(".modal-body").empty();
            $(modal_id)
                .find(".modal-content")
                .find("#modal-wecodeit-content")
                .html(data.html);

            if (has_controller) {
                if (!window[controllerClass]) {
                    // playErrorSound();
                    toast_error(
                        "The controller " +
                        controllerClass +
                        " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
                    );
                    hideLoader();
                    return false;
                } else {
                    window[controllerClass].init();
                    $(modal_id).modal("show");
                }
            } else {
                $(modal_id).modal("show");
            }
            hideLoader();

            $(modal_id).on("submit", ".form-modal-store", function (e) {
                e.preventDefault();

                let current_form = $(this);
                let data = current_form.serializeArray();
                let action = current_form.attr("action");
                // let container_id = current_form.data("container");

                let has_controller = !current_form.data("no-controller");
                let controllerClass = current_form.data("controller");

                function sendAjax() {
                    let headers = { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }
                    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
                    if (XUSERID) {
                        headers["X-USER-PROXY-ID"] = XUSERID;
                    }
                    showLoader();
                    $.ajax({
                        type: current_form.attr("method"),
                        url: action,
                        data: data,
                        headers: headers,
                        success: function (response) {
                            hideLoader();
                            current
                                .closest(dataClosest)
                                .replaceWith(response.html);
                            KTMenu.createInstances();
                            $(modal_id).modal("hide").hide();
                        },
                        error: function (response) {
                            hideLoader();
                            // playErrorSound();

                            toast_error(response.responseJSON.message);
                        },
                    });
                }

                if (has_controller) {
                    if (check_controller(controllerClass)) {
                        let validator = window[controllerClass].getValidator();
                        validator.validate().then(function (status) {
                            if (status == "Valid") {
                                sendAjax();
                            } else {
                                // playErrorSound();

                                toast_error(
                                    "Veuillez remplir tous les champs obligatoires."
                                );
                            }
                        });
                    }
                    return false;
                } else {
                    sendAjax();
                    return false;
                }
            });
        },

        error: function (xhr) {
            hideLoader();
            let response = xhr.responseJSON;
            // playErrorSound();

            toast_error(response.message);
        },
    });
});

$("body").off("click", ".anchor-search");
$("body").on("click", ".anchor-search", function (e) {
    e.preventDefault();
    showLoader();
    var current = $(this);

    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");
    if (!current.data("href")) {
        // playErrorSound();

        toast_error(
            "Please specify the data-href attribute in the anchor element"
        );
        hideLoader();
        return;
    }
    let modal_content = $("#global-modal-search")
        .find("#modal-search-content")
        .html();
    if ($.trim(modal_content) != "") {
        hideLoader();
        $(".drawer-overlay").show();
        $("#global-modal-search").addClass("drawer-on");
    } else {
        let headers = {}
        let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
        if (XUSERID) {
            headers["X-USER-PROXY-ID"] = XUSERID;
        }
        $.ajax({
            type: "GET",
            url: current.data("href"),
            headers: headers,
            success: function (data) {
                if (data.html === undefined) {
                    // playErrorSound();

                    toast_error(
                        "The data returned is not valid, please return a valid html in the data object"
                    );
                    hideLoader();
                    return;
                }
                $(".drawer-overlay").show();
                $("#global-modal-search").addClass("drawer-on");
                $("#global-modal-search")
                    .find(".card-header")
                    .find(".card-title")
                    .find(".card-header-index")
                    .empty()
                    .text(current.data("modal-title"));
                $("#global-modal-search").find("#modal-search-content").empty();
                $("#global-modal-search")
                    .find("#modal-search-content")
                    .html(data.html);

                if (has_controller) {
                    if (!window[controllerClass]) {
                        // playErrorSound();

                        toast_error(
                            "The controller " +
                            controllerClass +
                            " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
                        );
                        hideLoader();
                        return false;
                    } else {
                        window[controllerClass].init();
                    }
                }
                hideLoader();
            },

            error: function (xhr) {
                hideLoader();
                let response = xhr.responseJSON;
                // playErrorSound();

                toast_error(response.message);
            },
        });
    }
});

$("body").off("click", ".anchor-chat");
$("body").on("click", ".anchor-chat", function (e) {
    e.preventDefault();
    showLoader();
    var current = $(this);

    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");
    if (!current.data("href")) {
        // playErrorSound();

        toast_error(
            "Please specify the data-href attribute in the anchor element"
        );
        hideLoader();
        return;
    }
    let modal_content = $("#global-modal-chat")
        .find("#modal-chat-content")
        .html();
    if ($.trim(modal_content) != "") {
        hideLoader();
        $(".drawer-overlay").show();
        $("#global-modal-chat").addClass("drawer-on");
    } else {
        let headers = {}
        let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
        if (XUSERID) {
            headers["X-USER-PROXY-ID"] = XUSERID;
        }
        $.ajax({
            type: "GET",
            url: current.data("href"),
            headers: headers,
            success: function (data) {
                if (data.html === undefined) {
                    // playErrorSound();

                    toast_error(
                        "The data returned is not valid, please return a valid html in the data object"
                    );
                    hideLoader();
                    return;
                }
                $(".drawer-overlay").show();
                $("#global-modal-chat").addClass("drawer-on");
                $("#global-modal-chat")
                    .find(".card-header")
                    .find(".card-title")
                    .find(".card-header-index")
                    .empty()
                    .text(current.data("modal-title"));
                $("#global-modal-chat").find("#modal-chat-content").empty();
                $("#global-modal-chat")
                    .find("#modal-chat-content")
                    .html(data.html);

                if (has_controller) {
                    if (!window[controllerClass]) {
                        // playErrorSound();

                        toast_error(
                            "The controller " +
                            controllerClass +
                            " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
                        );
                        hideLoader();
                        return false;
                    } else {
                        window[controllerClass].init();
                    }
                }
                hideLoader();
            },

            error: function (xhr) {
                hideLoader();
                let response = xhr.responseJSON;
                // playErrorSound();

                toast_error(response.message);
            },
        });
    }
});

$("body").off("click", ".input-search");
$("body").on("keyup", ".input-search", function (e) {
    e.preventDefault();
    var current = $(this);
    let value = current.val();
    let container_id = current.data("container");
    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");
    let headers = {}
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }

    function sendAjax(value) {
        $.ajax({
            method: "get",
            url: current.data("href"),
            data: {
                value: value,
            },
            headers: headers,
            success: function (data) {
                if (data.html === undefined) {
                    alert_error(
                        "The data returned is not valid, please return a valid html in the data object"
                    );
                    return;
                }
                if (has_controller) {
                    if (!window[controllerClass]) {
                        alert_error(
                            "The controller " +
                            controllerClass +
                            " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the form."
                        );
                        return false;
                    } else {
                        if (!container_id) {
                            alert_error(
                                "You didnt specify a container , you can add attribute (data-container) to the form"
                            );
                            return;
                        }
                        $(container_id).html(data.html);
                        window[controllerClass].init();
                    }
                } else {
                    if (!container_id) {
                        alert_error(
                            "You didnt specify a container , you can add attribute (data-container) to the form"
                        );
                        return;
                    }
                    $(container_id).html(data.html);
                }
            },
            error: function (response) {
                console.log(response);
            },
        });
    }
    if (!current.data("href")) {
        alert_error(
            "Please specify the data-href attribute in the anchor element"
        );
        return;
    }
    // get data if value.length > 2
    if (value.length > 2) {
        $("#spinner").removeClass('d-none');
        setTimeout(function () {
            $("#spinner").addClass('d-none');

        }, 1000);
        sendAjax(value);
    }
    // get all if value.length < 2
    else {
        value = "";
        sendAjax(value);
    }
});


// start toggle search modal
$("#close_search").on("click", function () {
    $(".drawer-overlay").hide();
});

$("body").on("click", ".drawer-overlay", function () {
    $("#global-modal-search").removeClass("drawer-on");
    $(".drawer-overlay").hide();
});

$("body").on("click", ".drawer-overlay", function () {
    $("#global-modal-chat").removeClass("drawer-on");
    $(".drawer-overlay").hide();
});

// end toggle search modal

$("#kt_user_menu_dark_mode_toggle").change(function () {
    if ($(this).is(":checked")) {
        localStorage.setItem("darkMode", "enabled");
        $("#link-css").attr("href", "/assets/css/style.dark.bundle.css");
    } else {
        localStorage.setItem("darkMode", null);
        $("#link-css").attr("href", "/assets/css/style.bundle.css");
    }
});

$("body").on("change", ".country_id", function () {
    let contry_id = $(this).val();
    if (!contry_id) {
        $("#cities_container").html('');
    }
    let url = $(this).data("url");
    let headers = {}
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }
    $.ajax({
        type: "GET",
        url: url,
        headers: headers,
        data: {
            contry_id: contry_id,
        },
        success: function (response) {
            if (!response.html) {
                $(".cities").empty();
            }
            if (response.message) {
                // playErrorSound();
                toast_error(response.message);
                $(".cities").empty();
            } else {
                $("#cities_container").html(response.html);
                $(".currency").text(response.currency);
                $(".cities").select2();
            }
        },
        error: function (response) { },
    });
});

// $("body").off("submit", ".form-search");
// $("body").on("submit", ".form-search", function (e) {
//     e.preventDefault();
//     let current = $(this);
//     // let data = current.serializeArray();
//     let action = current.attr("action");
//     let container_id = current.data("container");
//     let modal_id = global_selector;

//     let has_controller = !current.data("no-controller");
//     let has_DataCondition = current.data("hasdatacondition");

//     let controllerClass = current.data("controller");
//     var fd = current.serializeArray();

//     function sendAjax() {
//         showLoader();
//         let headers = {}
//         let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
//         if (XUSERID) {
//             headers["X-USER-PROXY-ID"] = XUSERID;
//         }
//         if (current.attr("method") == "post") {
//             headers["X-CSRF-TOKEN"] = $('meta[name="csrf-token"]').attr('content');
//         }
//         $.ajax({
//             method: current.attr("method"),
//             url: action,
//             headers: headers,
//             data: fd,
//             success: function (response) {
//                 hideLoader();

//                 if (response.message) {
//                     // playSuccessSound();
//                     toast_info(response.message);
//                 }
//                 if (response.redirect) {
//                     window.location = response.redirect;
//                     setTimeout(function () {
//                     }, 2000);
//                 }
//                 if (container_id) {
//                     if (has_DataCondition) {
//                         $("#container_of_list_container").css(
//                             "display",
//                             "block"
//                         );
//                         $("#no_data_message").attr(
//                             "style",
//                             "display: none !important"
//                         );
//                     }
//                     $(container_id).html(response.html);
//                     if (response.count != undefined) {
//                         console.log(response.count);
//                         $('#paginate-count').text(response.count);
//                     }
//                     var rows = $("#table-list > tbody").children().length;
//                     if (rows == 0) {
//                         $("#container_of_list_container").css(
//                             "display",
//                             "none"
//                         );
//                         $("#no_data_message").attr(
//                             "style",
//                             "display: flex !important"
//                         );
//                     } else {
//                         $("#container_of_list_container").css(
//                             "display",
//                             "block"
//                         );
//                         $("#no_data_message").attr(
//                             "style",
//                             "display: none !important"
//                         );
//                     }

//                     if (has_controller) {
//                         window[controllerClass].init();
//                     }

//                 }

//                 // Reinitialize all KT Menues
//                 $('.select_2').select2();
//                 KTMenu.createInstances();
//                 $(modal_id).modal("hide").hide();
//                 files = [];
//                 if (current.data("init-controller")) {
//                     if (window[current.data("init-controller")]) {
//                         window[current.data("init-controller")].init();
//                     }
//                 }
//             },
//             error: function (response) {
//                 hideLoader();
//                 // playErrorSound();
//                 toast_error(response.responseJSON.message);
//             },
//         });
//     }

//     if (has_controller) {
//         if (check_controller(controllerClass)) {
//             let validator = window[controllerClass].getValidator();
//             if (!validator) {
//                 sendAjax();
//             } else {
//                 validator.validate().then(function (status) {
//                     if (status == "Valid") {
//                         sendAjax();
//                     } else {
//                         // playErrorSound();
//                         toast_error("Veuillez remplir tous les champs obligatoires.");
//                     }
//                 });
//             }

//         } else {
//             sendAjax();
//         }
//         return false;
//     } else {
//         sendAjax();
//         return false;
//     }
// });


$("body").off("change", ".paginate_target");
$("body").on("change", ".paginate_target", function (e) {
    e.preventDefault();
    let action = $(this).data("href");
    let container_id = $(this).data("container");
    let perPage = $(this).val();
    showLoader();
    let headers = {}
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }
    $.ajax({
        type: "GET",
        url: action,
        headers: headers,
        data: {
            perPage: perPage,
        },
        success: function (response) {
            hideLoader();
            if (container_id) {
                $(container_id).html(response.html);
                KTMenu.createInstances();
                $('.select_2').select2();
            }
            if (response.message) {
                toast_info(response.message);
            }
            if (response.redirect) {
                window.location = response.redirect;
                setTimeout(function () {
                }, 2000);
            }
        },
        error: function (response) {
            hideLoader();
            // playErrorSound();
            toast_error(response.responseJSON.message);
        },
    });
});

$("body").on("change", "#chat_search", function (e) {
    e.preventDefault();
    let url = $(this).data("url");
    let search = $(this).val();

    let headers = {}
    let XUSERID = $('meta[name="user-proxy-id"]').attr("content")
    if (XUSERID) {
        headers["X-USER-PROXY-ID"] = XUSERID;
    }
    $.ajax({
        type: "GET",
        url: url,
        headers: headers,
        data: {
            search: search,
        },
        success: function (response) {
            $("#modal-chat-content").html(response.html);
        },
        error: function (response) {
            // playErrorSound();
            toast_error(response.responseJSON.message);
        }
    });
});
// let userProxyId = document.querySelector('meta[name="user-proxy-id"]')?.content;
// axios.defaults.headers.common['X-USER-PROXY-ID'] = userProxyId;


$("body").on('click', '.custom-anchor-modal', function () {
    const current = $(this);
    const $row = current.closest('[data-repeater-item]');
    const companyId = $row.find('.company-id-select').val(); // More reliable than name
    const url = current.data('href');
    const modal_title = current.data("modal-title");

    let modal_id = current.data("modal-type") == "seccend" ? global_selector_seccend : global_selector;

    let has_controller = !current.data("no-controller");
    let controllerClass = current.data("controller");

    // console.log(companyId);
    // return;

    if (!companyId) {
        toast_error("Veuillez choisir une entreprise d'abord.");
        return;
    }
    showLoader(); // Show a global loader if implemented

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            company_id: companyId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            hideLoader(); // Hide loader after success

            if (data.html) {

                $(modal_id)
                    .find(".modal-header")
                    .find("h1")
                    .empty()
                    .html(modal_title);

                $(modal_id)
                    .find('.modal-body').empty().html(data.html);

            } else {
                toast_error(data.message);
                return;
            }


            if (has_controller) {
                if (!window[controllerClass]) {
                    alert_error(
                        "The controller " +
                        controllerClass +
                        " does not exist, or you didnt specify a controller. Othwerise, if this form doesnt need a controller, you can add attribute (data-no-controller=true) to the button."
                    );
                    hideLoader();
                    return false;
                } else {
                    window[controllerClass].init();
                    $(modal_id).modal("show");
                }
            } else {
                $(modal_id).modal("show");
            }

        },
        error: function (xhr) {
            hideLoader(); // Hide loader after success

            alert(xhr.responseJSON?.message || 'Une erreur est survenue.');
        }
    });
});
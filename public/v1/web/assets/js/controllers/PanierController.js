"use strict";

var PanierController = (function () {
    var form;

    var initForm = function () {
        $(document).ready(function () {
            // ➕➖
            // $("body").off("click", ".btn-number");
            // $(document).on('click', '.btn-number', function (e) {
            //     e.preventDefault();
            //     const input = $(this).siblings('input.qty');
            //     let quantity = parseInt(input.val()) || 1;
            //     quantity = $(this).hasClass('qtyplus') ? quantity + 1 : Math.max(1, quantity - 1);
            //     input.val(quantity).trigger('change');
            // });

            // 📝 تغيير الكمية
            $("body").off("change", ".update-quantity");
            $(document).on('change', '.update-quantity', function () {
                const product_id = $(this).data('id');
                const quantity = $(this).val();

                $.post(window.PANIER_CONFIG.routeChangeQuantity, {
                    _token: window.PANIER_CONFIG.csrf,
                    product_id,
                    quantity
                }, function (response) {
                    $('.shoppingcart-content').html($(response.html).find('.shoppingcart-content').html());
                    $('.panier-items').html($(response.html1).find('.panier-items').html());
                    toastr.success(response.message);
                }).fail(function (xhr) {
                    toastr.error(xhr.responseJSON.message || 'Erreur');
                });
            });

            // 🧹 تأكيد تفريغ السلة باستخدام SweetAlert
            $("body").off("click", ".btn-clear-cart");
            $(document).on('click', '.btn-clear-cart', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action va vider tout le panier.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, vider',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(window.PANIER_CONFIG.routeClear, {
                            _token: window.PANIER_CONFIG.csrf
                        }, function (response) {
                            $('.shoppingcart-content').html($(response.html).find('.shoppingcart-content').html());
                            $('.panier-items').html($(response.html1).find('.panier-items').html());
                            toastr.success(response.message);
                        }).fail(function () {
                            toastr.error('Erreur lors du vidage du panier.');
                        });
                    }
                });
            });


            // 🗑️ حذف منتج
            $("body").off("click", ".remove-from-cart");
            $(document).on('click', '.remove-from-cart', function (e) {
                e.preventDefault();
                const product_id = $(this).data('id');

                $.post(window.PANIER_CONFIG.routeDelete, {
                    _token: window.PANIER_CONFIG.csrf,
                    product_id
                }, function (response) {
                    $('.shoppingcart-content').html($(response.html).find('.shoppingcart-content').html());
                    $('.panier-items').html($(response.html).find('.panier-items').html());
                    toastr.success(response.message);
                }).fail(function (xhr) {
                    toastr.error(xhr.responseJSON.message || 'Erreur');
                });
            });
        });
    };

    return {
        init: function () {
            form = document.querySelector("#category-form");
            initForm();
        },
        getForm: function () {
            return form;
        },
    };
})();

PanierController.init();

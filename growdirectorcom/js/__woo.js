// Min-Max quantity (moved to main js)
// (function ($) {
//     $(document).ready(function () {
//         $(document).on( 'click', 'button.plus, button.minus', function() {
//             let qty = $( this ).closest( '.quantity' ).find( '.qty' ); //parent
//             let val = parseFloat(qty.val());
//             let max = parseFloat(qty.attr( 'max' ));
//             let min = parseFloat(qty.attr( 'min' ));
//             let step = parseFloat(qty.attr( 'step' ));
//             if ( $( this ).is( '.plus' ) ) {
//                 //qty.trigger( 'change' );
//                 if ( max && ( max <= val ) ) {
//                     qty.val( max );
//                 } else {
//                     qty.val( val + step );
//                 }
//             } else {
//                 if ( min && ( min >= val ) ) {
//                     qty.val( min );
//                 } else if ( val > 1 ) {
//                     qty.val( val - step );
//                     //console.log(val);
//                 }
//             }
//             //$( this ).find( '.qty' ).trigger("change");
//             qty.trigger( 'change' );
//         });
//     });
// })(jQuery);

// Ajax quantity
(function ($) {
    $(document).ready(function () {
        //var cartButton = document.getElementsByClassName('ajax_add_to_cart');
        // Shop
        $(document).on('change', '.quantity .qty', function () {
            $(this).closest('li.product').find('a.add_to_cart_button').attr('data-quantity', $(this).val());
        });
        // Product
        $(document).on('click', 'button.plus, button.minus', function () {
            var qty = $(this).closest('.quantity').find('.qty'); //parent
            var addCartBtn = $(this).closest('.bottom-box').find('.add_to_cart_button')
            addCartBtn[0].setAttribute('data-quantity', qty.trigger('change')[0].value);
        });
        // Update data-quantity
        $(document.getElementById('')).on('input', 'input.qty', function () {
            var addCartBtn = $(this).closest('.bottom-box').find('.add_to_cart_button')
            addCartBtn[0].setAttribute('data-quantity', $(this).val());
            //console.log(addCartBtn[0].getAttribute('data-quantity'));
        });
    });
})(jQuery);
Stripe.setPublishableKey('pk_test_CjJAidK8moNaHSVqYk4K2Ncq');

let $form = $('#payment-form');
let $checkout_error = $('#checkout-error');

$form.on('submit', function(event) {
    event.preventDefault();

    $('#checkout-error').addClass('hidden');
    $form.find('button').prop('disabled', true);
    Stripe.card.createToken({
        number: $('#card').val(),
        cvc: $('#cvv').val(),
        exp_month: $('#month').val(),
        exp_year: $('#year').val(),
        name: $('#user_name').val()
    }, stripeResponseHandler);
    return false;
});

function stripeResponseHandler(status, response) {
    if(response.error) {
        $checkout_error.removeClass('hidden');
        $checkout_error.text(response.error.message);
        $form.find('button').prop('disabled', false);
    } else {
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeSource" />').val(token));
        $form.get(0).submit();
    }
}
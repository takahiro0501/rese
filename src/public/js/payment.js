window.onload = function () {

    var stripe = Stripe('pk_test_51LQTnkCj3idPrsItepJatAgTBHfKWGqHKBph7XSqKJeLKzVbCZ343vrTeFEUVrvFiX66FZJCl7V0hn3RBm2zRLLV00CQjun2Dp');
    var elements = stripe.elements();

    //カード番号
    const cardNumber = elements.create('cardNumber');
    cardNumber.mount('#card-number');
    cardNumber.on('change', function (event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    //有効期限
    const cardExpiry = elements.create('cardExpiry');
    cardExpiry.mount('#card-expiry');
    cardExpiry.on('change', function (event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    //セキュリティコード
    const cardCvc = elements.create('cardCvc');
    cardCvc.mount('#card-cvc');
    cardCvc.on('change', function (event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    const form = document.getElementById('payment__form');
    form.addEventListener('submit', function (event) {
    event.preventDefault();
    var errorElement = document.getElementById('card-errors');
    if (event.error) {
        errorElement.textContent = event.error.message;
    } else {
        errorElement.textContent = '';
    }

    stripe.createToken(cardNumber).then(function (result) {
        if (result.error) {
            errorElement.textContent = result.error.message;
        } else {
            stripeTokenHandler(result.token);
        }
    });
    });

    function stripeTokenHandler(token) {
    var form = document.getElementById('payment__form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    form.submit();
}


}
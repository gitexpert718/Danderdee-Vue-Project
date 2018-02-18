import Basket from '../../components/basket';
import './checkout.css';


function validateName(name) {
    return /^[A-Za-z\s]+$/.test(name);
}

$(() => {
    const basket = new Basket('#basket');
    const cardHolderNameInput = $('#cardholder-name');
    const cardInputElement = $('#card-input');
    const form = $('#payment-form');
    const stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');

    const elements = stripe.elements({
        fonts: [
            {
                cssSrc: 'https://fonts.googleapis.com/css?family=Roboto'
            }
        ]
    });

    const card = elements.create('card', {
        iconStyle: 'solid',
        style: {
            base: {
                iconColor: '#c4f0ff',
                color: '#676767',
                fontWeight: 'bold',
                fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                fontSize: '14px',
                fontSmoothing: 'antialiased',

                ':-webkit-autofill': {
                    color: '#fce883'
                },
                '::placeholder': {
                    color: '#909090'
                },
            },
            invalid: {
                iconColor: '#FFC116',
                color: '#c42526'
            }
        }
    });

    card.mount(cardInputElement[0]);

    card.addEventListener('change', function(event) {

        if (event.error) {
            cardInputElement
                .addClass('has-error')
                .find('.help-block')
                .html(event.error.message);
        } else {
            cardInputElement
                .removeClass('has-error')
                .find('.help-block')
                .html('');
        }
    });

    card.addEventListener('focus', function() {
        cardInputElement.addClass('focused');
    });

    card.addEventListener('blur', function() {
        cardInputElement.removeClass('focused');
    });

    cardHolderNameInput.on('change', function (e) {
        const parent = $(this).closest('.form-group');

        if (validateName(this.value)) {
            parent.removeClass('has-error')
                .find('.help-block')
                .html('');
        } else {
            parent
                .addClass('has-error')
                .children('.help-block')
                .html('Cardholder name is invalid');
        }
    });


    form.on('submit', function(event) {
        event.preventDefault();

        const name = cardHolderNameInput.val();
        const parent = $(this).parent();

        if(!validateName(name)) {
            cardHolderNameInput.trigger('change')
        }

        parent.addClass('submitting');

        stripe.createToken(card, {
            name: name
        }).then((result) => {

            if (result.error) {
                parent.removeClass('submitting');

                cardInputElement
                    .addClass('has-error')
                    .find('.help-block')
                    .html(event.error.message);
            } else {

                setTimeout(() => {
                    cardInputElement
                        .removeClass('has-error')
                        .find('.help-block')
                        .html('');
                    parent.removeClass('submitting').addClass('submitted');

                    basket.data = {};
                    basket.updateStorageData();

                    setTimeout(() => {
                        location = this.action;
                    }, 5000)
                }, 2000);

                // stripeTokenHandler(result.token);
            }
        });
    });
});

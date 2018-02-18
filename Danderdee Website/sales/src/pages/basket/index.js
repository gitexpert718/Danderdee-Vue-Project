import template from 'lodash.template';
import Basket from './../../components/basket';
import tplItem from './item.html';
import tplEmpty from './empty.html';


$(() => {
    const basket = new Basket('#basket');

    const $basketContainer = $('#basket-container');
    const $btnCheckout = $('#btn-checkout');
    const t = template(tplItem);

    const render = function () {
        if (basket.isEmpty()) {
            $basketContainer.html(tplEmpty);
            $btnCheckout.addClass('disabled');
        } else {
            $basketContainer.empty();
            const data = basket.data;
            for (let item in data) {
                $basketContainer.append(t(data[item]))
            }
        }
    }

    render();

    $basketContainer.on('click', '.btn-remove', function () {
        const id = $(this).data('locationId');

        basket.remove(id);
        render();
    })

});

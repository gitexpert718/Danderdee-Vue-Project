const KEY = '__basket_locations';

class Basket {
    constructor(el) {
        if (typeof el == 'string') {
            el = $(el);
        }

        this.el = el;

        this.data = this.getStorageData();

        this.updateView(Object.keys(this.data).length);
    }

    updateStorageData() {
        localStorage.setItem(KEY, JSON.stringify(this.data));
        this.updateView();

        return this;
    }

    getStorageData() {
        let data = JSON.parse(localStorage.getItem(KEY));

        if(!$.isPlainObject(data)) {
            localStorage.removeItem(KEY);
            data = {};
        }

        return data;
    }

    add(item) {
        this.data[item._id] = item;
        this.updateStorageData();
    }

    remove(id) {
        delete this.data[id];
        this.updateStorageData();
    }

    updateView() {
        const len = Object.keys(this.data).length;
        const html = len ? `<span class="badge">${len}</span>` : '';
        this.el.find('>span').html(html);
    }

    isEmpty() {
        return $.isEmptyObject(this.data);
    }
}

export default Basket;
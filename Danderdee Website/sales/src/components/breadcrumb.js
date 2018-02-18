class Breadcrumb {

    get items() {
        return ['Countries', 'Regions', 'Locations'];
    }

    constructor(el) {
        if (typeof el == 'string') {
            el = $(el);
        }
        this.el = el;

        this.addEventListener();
    }

    addEventListener() {
        this.el.on('click', 'li > a', this._clickEventHandler.bind(this));
    }

    update(level) {
        let html = '';
        this.items.every((item, index) => {

            const last = level == index + 1;

            html += `<li>${ last ? item : `<a href="#" data-level="${index + 1}">${item}</a>` }</li>`;

            return !last;
        });

        this.el.html(html);
    }

    _clickEventHandler(e) {

        e.preventDefault();

        if (this._clickEventCallback) {
            this._clickEventCallback(e);
        }
    }

    onClick(callback) {
        if (typeof callback == 'function')
            this._clickEventCallback = callback;
    }
}

export default Breadcrumb;
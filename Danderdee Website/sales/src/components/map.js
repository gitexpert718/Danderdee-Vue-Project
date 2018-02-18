import L from 'leaflet';
import markerImageGreen from '../../img/marker_c.png';
import markerImageYellow from '../../img/marker_c_selected.png';
//
// const greenIcon = L.icon({
//     iconUrl: markerImageGreen,
//     shadowUrl: markerImageGreen,
//
//     iconSize:     [28, 28], // size of the icon
//     shadowSize:   [28, 28], // size of the shadow
//     iconAnchor:   [28, 28], // point of the icon which will correspond to marker's location
//     shadowAnchor: [28, 28],  // the same for the shadow
//     popupAnchor:  [-20, -40] // point from which the popup should open relative to the iconAnchor
// });
//
// const yellowIcon = L.icon({
//     iconUrl: markerImageYellow,
//     shadowUrl: markerImageYellow,
//     iconSize:     [28, 28],
//     shadowSize:   [28, 28],
//     iconAnchor:   [28, 28], // point of the icon which will correspond to marker's location
//     shadowAnchor: [28, 28],  // the same for the shadow
//     popupAnchor:  [-20, -40] // point from which the popup should open relative to the iconAnchor
//
// });

const LeafIcon = L.Icon.extend({
    options: {
        // shadowUrl: 'leaf-shadow.png',
        iconSize: [28, 28],
        shadowSize: [28, 28],
        iconAnchor: [28, 28], // point of the icon which will correspond to marker's location
        shadowAnchor: [28, 28],  // the same for the shadow
        popupAnchor: [-20, -40]
    }
});

const greenIcon = new LeafIcon({iconUrl: markerImageGreen}),
    yellowIcon = new LeafIcon({iconUrl: markerImageYellow}),
    orangeIcon = new LeafIcon({iconUrl: 'leaf-orange.png'});

class Map {

    static get LEVELS() {
        return {
            level1: 1,
            level2: 2,
            level3: 3
        }
    }

    get layer() {
        return 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png';
    }

    constructor(el, options) {
        this.el = el;
        this.data = [];
        // this.currentLevel = null;

        this.init();
    }

    init() {
        this.map = L.map(this.el);
        this.layerGroup = L.layerGroup().addTo(this.map);

        L.tileLayer(this.layer, {
            maxZoom: 18
        }).addTo(this.map);


    }

    setCountries(data) {
        this.data = data;
        return this;
    }

    setMarkerIconDefault(marker) {
        marker.setIcon(greenIcon);
    }

    setMarkerIconSelected(marker) {
        marker.setIcon(yellowIcon);
    }

    _onClickCountryHandler(e) {
        if (this._onChangeCountryCallback) {
            this._onChangeCountryCallback.call(this, e)
        }
    }

    _onClickRegionHandler(e) {
        if (this._onChangeRegionCallback) {
            this._onChangeRegionCallback.call(this, e)
        }
    }

    onChangeCountry(callback) {
        if (typeof callback == 'function')
            this._onChangeCountryCallback = callback;
    }

    onChangeRegions(callback) {
        if (typeof callback == 'function')
            this._onChangeRegionCallback = callback;
    }

    updateCountries() {
        this.layerGroup.clearLayers();

        this.data.forEach((item) => {
            let marker = new L.marker(L.latLng(item.lat|| 0, item.lng|| 0), {
                locationId: item['_id'],
                locationName: item.name,
                level: 1,
                icon: new L.DivIcon({
                    className: 'icon-country',
                    html: `<div>${item.location_count}</div>`
                })
            }).on('click', this._onClickCountryHandler.bind(this));

            marker.addTo(this.layerGroup);
        })

        this.fit();

        if (this.data.length == 1) {
            this.map.setZoom(4);
        }
    }

    updateRegions(params) {
        this.layerGroup.clearLayers();
        const bounds = [];

        this.data.forEach((country) => {
            if (params.includes(country.name)) {
                country.regions.forEach((item) => {
                    let marker = new L.marker(L.latLng(item.lat, item.lng), {
                        locationId: item.id,
                        locationName: item.name,
                        level: 2,
                        icon: new L.DivIcon({
                            className: 'icon-country',
                            html: `<div>${item.location_count}</div>`
                        })
                    }).on('click', this._onClickRegionHandler.bind(this));
                    bounds.push([item.lat, item.lng]);
                    marker.addTo(this.layerGroup);
                })
            }
        })

        this.map.fitBounds(bounds);
    }

    updateLocations(locations) {
        this.layerGroup.clearLayers();

        const bounds = [];
        this.locations = {};

        locations.forEach((location) => {
            const selected = Boolean(this.basket.data[location._id]);
            let marker = new L.marker(L.latLng(location.lat, location.lng), {
                locationData: location,
                selected: selected,
                level: 3,
                icon: selected ? yellowIcon : greenIcon
            });
            marker.bindPopup(`Location: ${location.name}
                <br/><b>Devices</b>: ${location.devices}
                <br/>
                <div class="text-center">
                <button class="btn btn btn-default btn-xs btn-select-location">${selected ? 'Unselect':'Select'}</button>
                </div>`);
            bounds.push([location.lat, location.lng]);
            this.locations[location._id] = marker.addTo(this.layerGroup);
        })

        this.map.fitBounds(bounds);
    }

    fit() {
        const bounds = this.data.map((item) => {
            return [item.lat || 0, item.lng || 0];
        });

        this.map.fitBounds(bounds);
    }
}

export default Map;
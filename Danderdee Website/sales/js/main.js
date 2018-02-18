;(function ($) {

    var greenIcon = L.icon({
        iconUrl: 'img/marker_c.png',
        shadowUrl: 'img/marker_c.png',

        iconSize:     [28, 28], // size of the icon
        shadowSize:   [28, 28], // size of the shadow
        iconAnchor:   [28, 28], // point of the icon which will correspond to marker's location
        shadowAnchor: [28, 28],  // the same for the shadow
        popupAnchor:  [-20, -40] // point from which the popup should open relative to the iconAnchor
    });

    var yellowIcon = L.icon({
        iconUrl: 'img/marker_c_selected.png',
        shadowUrl: 'img/marker_c_selected.png',
        iconSize:     [28, 28],
        shadowSize:   [28, 28],
        iconAnchor:   [28, 28], // point of the icon which will correspond to marker's location
        shadowAnchor: [28, 28],  // the same for the shadow
        popupAnchor:  [-20, -40] // point from which the popup should open relative to the iconAnchor

    });

    function GeoLocationHotspots() {
        this.$countries = $('#countries-list');
        this.$regions = $('#regions-list');
        this.$locations = $('#locations-list');
        this.map = L.map('mapid');

        this.data = {};

        this.init()
    }

    GeoLocationHotspots.prototype.init = function () {
        var self = this;
        this.basket = new Basket('#basket');
        this.getData().then(function (data) {
            self.data = data;
            self.render();
        });
        this._bindEvents();
    }

    GeoLocationHotspots.prototype._bindEvents = function () {
        var self = this;
        this.$countries.on('change', this.changeCountryHandler.bind(this));
        this.$regions.on('change', this.changeRegionHandler.bind(this));
        this.$locations.on('change', this.changeLocationHandler.bind(this));
        this.map.on('popupopen', function(e) {
            debugger;
            $(e.popup._container).find('.btn-choose').on('click', function(){
                debugger;
                e.popup._source.setIcon(yellowIcon);
            })
        });

        this.map.on('popupclose', function (e) {
            $(e.popup._container).find('.btn-choose').off('click');
        })
    }

    GeoLocationHotspots.prototype.render = function () {
        this.renderMap();
    }

    GeoLocationHotspots.prototype.renderMap = function () {
        L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png', {
            maxZoom: 18
        }).addTo(this.map);

        var markers = L.markerClusterGroup({
            showCoverageOnHover: false
        });

        var dataKeys = Object.keys(this.data);

        if (dataKeys.length) {
            for (var i = 0; i < dataKeys.length; i++) {
                var location = this.data[dataKeys[i]];
                var title = location.name;
                var devices = location.devices;
                var marker = L.marker(new L.LatLng(location.lat, location.lng), {icon: greenIcon});
                marker.bindPopup("Location: " + title +
                    "<br/><b>Devices</b>: "+ devices.names +
                    "<br/>" +
                    "<button class='btn btn-xs btn-choose'>Select</button>");

                location['marker'] = marker;

                marker._locationId = location.id;

                markers.addLayer(marker);
            }
        }

        this.map.addLayer(markers);

        this.fitMap(dataKeys)
    }

    GeoLocationHotspots.prototype.initCountriesSelect = function () {
        var self = this;

        this.getCountries().done(function(data){
            self.data = {};

            data.countries.forEach(function(country){
                country.regions.forEach(function(region){
                    region.locations.forEach(function(location){
                        self.data[location.location_id] = {
                            id: location.location_id,
                            name: location.location_name,
                            lat: location.lat,
                            lng: location.lng,
                            devices: location.device_types
                        };
                    })
                })
            })

            self.renderMap();
            self.fitMap();

            self.$countries.select2({
                tags: true,
                placeholder: "Select countries",
                data: data.countries.map(function (country) {
                    return {
                        id: country.country_name,
                        text: country.country_name
                    }
                })
            })
        });
    }

    GeoLocationHotspots.prototype.initRegionsSelect = function (countries) {
        var self = this;

        this.getRegions(countries).done(function(data){
            var locations = [];
            data.regions.forEach(function(region){
                region.cities.forEach(function(city){
                    city.locations.forEach(function(location){
                        locations.push(location.location_id);
                    })
                })
            })

            self.fitMap(locations);

            self.$regions.select2({
                tags: true,
                placeholder: "Select regions",
                data: data.regions.map(function (region) {
                    return {
                        id: region.region_name,
                        text: region.region_name
                    }
                })
            })
        });
    }

    GeoLocationHotspots.prototype.initLocationsSelect = function () {
        var self = this;
        this.getLocations().done(function(data){

            var locations = [];

            data.cities.forEach(function(city){
                city.locations.forEach(function(location){
                    locations.push(location.location_id);
                })
            })

            self.fitMap(locations);

            self.$locations.select2({
                tags: true,
                placeholder: "Select locations",
                data: locations
            })
        });
    }

    GeoLocationHotspots.prototype.getData = function () {
        var self = this;

        return $.getJSON('countries1.data.json').then(function (response) {
            var data = {};
            response.countries.forEach(function(country){
                country.regions.forEach(function(region){
                    region.locations.forEach(function(location){
                        data[location.location_id] = {
                            id: location.location_id,
                            lat: location.lat,
                            lng: location.lng,
                            name: location.location_name,
                            region: region.region_name,
                            country: country.country_name,
                            devices: location.device_types
                        };
                    })
                })
            })

            return data;
        })
    };

    GeoLocationHotspots.prototype.getCountries = function () {
        return $.getJSON('countries1.data.json').done();
    }

    GeoLocationHotspots.prototype.getRegions = function () {
        return $.getJSON('regions.data.json');
    }

    GeoLocationHotspots.prototype.getLocations = function () {
        return $.getJSON('cities.data.json');
    }

    GeoLocationHotspots.prototype.changeCountryHandler = function(e) {
        var country = e.currentTarget.value;
        this.initRegionsSelect(country);
        $('a[href="#regions-tab-container"]').removeClass('disabled');
    }

    GeoLocationHotspots.prototype.changeRegionHandler = function(e) {
        var region = e.currentTarget.value;
        this.initLocationsSelect(region);
        $('a[href="#locations-tab-container"]').removeClass('disabled');
    }

    GeoLocationHotspots.prototype.changeLocationHandler = function(e) {
        var data = $(e.currentTarget).select2('data');

        data.forEach(function(locationId){
            debugger;
        });

        this.basket.setData(data).updateView();
        debugger;
    }

    GeoLocationHotspots.prototype.removeItem = function (item) {
        var index = this.selectedItems.findIndex(function(element, index, array){
            return element.x === this.x && element.y === this.y;
        }, item)

        this.selectedItems.splice(index, 1);
    }

    GeoLocationHotspots.prototype.fitMap = function (data) {
        var self = this;
        var bounds = data.map(function(id) {
            var location = self.data[id];
            return [location.lat, location.lng];
        });

        this.map.fitBounds(bounds);
    }

    /**
     *
     * @param el
     * @constructor
     */

    var COOKIESKEY = '__locations_basket';

    var Basket = function (el) {

        if (typeof el == 'string') {
            el = $(el);
        }

        this.el = el;

        this.data = [];

        this.init();
    }

    Basket.prototype.init = function() {
        var cookie = Cookies.getJSON(COOKIESKEY);

        if (cookie) {
            this.data = cookie;
        }

        this.updateView();
    }

    Basket.prototype.setData = function (data) {
        this.data = data;

        Cookies.set(COOKIESKEY, data);

        return this;
    }

    Basket.prototype.add = function (item) {
        this.data.push(item);
    }
    
    Basket.prototype.remove = function (item) {

    }

    Basket.prototype.updateView = function () {
        this.el.find('.badge').text(this.data.length)
    }
    
    $(document).ready(function(){
        window.aaa = new GeoLocationHotspots();
    })

})(jQuery)
import 'bootstrap/js/tab';
import 'select2';
import Request from './request';
import Map from './components/map';
import Basket from './components/basket';
import Breadcrumb from './components/breadcrumb';

$(() => {
    const map = new Map('mapid');
    const basket = new Basket('#basket');
    const breadcrumb = new Breadcrumb('#breadcrumb');
    const request = new Request;

    map.basket = basket;

    let countriesData = [];

    const countriesTab = $('a[href="#countries-tab-container"]');
    const regionsTab = $('a[href="#regions-tab-container"]');
    const locationsTab = $('a[href="#locations-tab-container"]');

    const countryElement = $('#countries-list').select2({
        tags: true,
        placeholder: "Select countries"
    });
    const regionElement = $('#regions-list').select2({
        tags: true,
        placeholder: "Select regions"
    });

    const locationElement = $('#locations-list').select2({
        tags: true,
        placeholder: "Select regions"
    });

    countryElement.on('change', function (e) {
        let data = [];
        let selected = $(this).val();

        if (!selected.length) {
            map.updateCountries();
            breadcrumb.update(1);
            regionsTab.addClass('disabled');
            locationsTab.addClass('disabled');
            return;
        }

        countriesData.forEach(function (country) {
            if (selected.includes(country.name)) {
                country.regions.forEach(function (region) {
                    data.push({
                        id: region.name,
                        text: region.name
                    });
                })
            }
        });

        if (data.length) {
            regionsTab.removeClass('disabled');
        } else {
            regionsTab.addClass('disabled');
        }

        map.updateRegions(selected);
        breadcrumb.update(2);
        regionElement.empty().select2({data: data});
        regionElement.val(null);
    });

    regionElement.on('change', function (e) {
        let selectedCountries = countryElement.val();
        let selectedRegions = $(this).val();

        if (!selectedRegions.length) {
            map.updateRegions(selectedCountries);
            breadcrumb.update(2);
            locationsTab.addClass('disabled');
            return;
        }

        request.getLocations({regions: selectedRegions}).then(function (response) {
            breadcrumb.update(3);
            map.updateLocations(response.locations);
            locationElement
                .empty()
                .select2({
                    data: response.locations.map((location) => {
                        return {
                            id: location['_id'],
                            text: location.name,
                            selected: !!basket.data[location['_id']]
                        }
                    })
                })

            if (response.locations.length) {
                locationsTab.removeClass('disabled');
            } else {
                locationsTab.addClass('disabled');
            }

        });
    });

    locationElement
        .on()
        .on('select2:select', function (e) {
            const marker = map.locations[e.params.data.id];
            map.setMarkerIconSelected(marker);
            marker.options.selected = true;
            basket.add(marker.options.locationData);
        })
        .on('select2:unselect', function (e) {
            const marker = map.locations[e.params.data.id];
            map.setMarkerIconDefault(marker);
            marker.options.selected = false;
            basket.remove(marker.options.locationData['_id']);
        })

    map.onChangeCountry(function (e) {
        const params = [e.target.options.locationName];
        countryElement.val(params).trigger('change');
    });

    map.onChangeRegions(function (e) {
        regionElement.val([e.target.options.locationName]).trigger('change');
    });

    $(map.map.getContainer()).on('click', '.btn-choose-location', function() {
        
    });

    map.map
        .on('popupopen', function(popupEvent){
            const options = popupEvent.popup._source.options;
            const btn = $(popupEvent.popup._container).find('.btn-select-location')

            if(options.selected) {
                btn.text('Unselect')
            } else {
                btn.text('Select')
            }

            btn.on('click', function (e) {
            const data = locationElement.val();

             if(!locationsTab.parent().hasClass('active')) {
                 locationsTab.trigger('click')
             }

            if(!options.selected) {
                data.push(options.locationData['_id']);
                locationElement.val(data)
                    .trigger('change')
                    .trigger({
                        type: 'select2:select',
                        params: {
                            data: {
                                id: options.locationData['_id']
                            }
                        }
                    });

                options.selected = true;
                btn.text('Unselect')

            } else {
                const index = data.indexOf(options.locationData['_id']);
                data.splice(index,1);
                
                locationElement.val(data)
                    .trigger('change')
                    .trigger({
                        type: 'select2:unselect',
                        params: {
                            data: {
                                id: options.locationData['_id']
                            }
                        }
                    });

                options.selected = false;
                btn.text('Select')
            }

                popupEvent.popup._close();
        })
    })
        .on('popupclose', function(e){
            $(e.popup._container).find('.btn-select-location').off('click');
        });

    request.getCountries().then(function (response) {

        countriesData = response.countries;

        map.setCountries(countriesData);
        map.updateCountries();

        let countries = [];
        countriesData.forEach(function (item) {
            countries.push({
                id: item.name,
                text: item.name
            })
        });

        countryElement.select2({data: countries})
    });

    breadcrumb.onClick(function (e) {
        const level = $(e.target).data('level');

        switch (level){
            case 1:
                // map.updateCountries(countryElement.val());
                countryElement.val(null).trigger('change');
                countriesTab.trigger('click');
                break
            case 2:
                regionElement.val(null).trigger('change');
                regionsTab.trigger('click');
                // map.updateRegions(countryElement.val());
                break
        }

        breadcrumb.update(level)
    })
});

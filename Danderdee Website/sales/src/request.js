// test data
const data = {
    'Tuscany': [{
        "id": "59db9d965b067b079b146b41",
        "name": "Belvedere Faro di Capo Circeo",
        "lat": "41.222528",
        "lng": "13.068248",
        "devices": [
            "Device 1",
            "Device 2"
        ]
    },
        {
            "id": "59db9d965b067b079b146b42",
            "name": "Fabbro Rainone Fiumicino",
            "lat": "41.762434",
            "lng": "12.248179",
            "devices": [
                "Device 3",
                "Device 4"
            ]
        }],
    'Veneto': [
        {
            "id": "59db9d965b067b079b",
            "name": "Peperino Pizza & Grill",
            "lat": "45.437225",
            "lng": "10.9917624",
            "devices": [
                "Device 5",
                "Device 6",
                "Device 7"
            ]
        },
        {
            "id": "59db9d965b067b079b146b4465b067b079b146b44",
            "name": "Piazzetta Castelvecchio",
            "lat": "45.439939",
            "lng": "10.988946",
            "devices": [
                "Device 8"
            ]
        }
    ]
}


const API_KEY = 'SH+3hl7HgYs6yeOWL29sYA==';

class Request {

    constructor() {
        this.baseUrl = 'https://netapi.danderdee.com/api'
    }
    
    getUrl(uri) {
        return this.baseUrl + uri;
    }
    
    getCountries() {
        return $.getJSON(this.getUrl('/webportal/country-data'), {
            key: API_KEY
        });
    }

    getCounties() {

    }

    getLocations(params = {}) {

        return $.getJSON(this.getUrl('/webportal/location-data'), Object.assign({
            key: API_KEY
        },params));

        // return $.Deferred().resolve({
        //     data: regions.reduce((d, r)=> {
        //         return d.concat(data[r])
        //     }, [])
        // });
    }
}

export default Request;

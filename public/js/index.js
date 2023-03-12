'use strict';

ymaps.ready(init);

const elem = document.getElementsByClassName("data-cols-name");
const elem1 = document.getElementsByClassName("data-cols-number");

let coordinates = [];

console.log(coordinates);

function init() {
    let placemarks;

    var geolocation = ymaps.geolocation,
        myMap = new ymaps.Map('map', {
            center: [55, 34],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        });

    geolocation.get({
        provider: 'yandex',
        mapStateAutoApply: true
    }).then(function (result) {
        
        myMap.geoObjects.add(result.geoObjects);
    });

    function setCoordinates(coordinates) {
        for (let r = 0; r < elem1.length; r++) {
            let result = elem1[r].innerHTML.split(' ');
            let numbers = result.map(parseFloat);
            coordinates.push({
                name: elem[r].innerHTML,
                coordinates: numbers
            });
    }
}
setCoordinates(coordinates);
   
    for (let el of elem1)
    {
        el.addEventListener('click', function(e){
            e.preventDefault();
                    let number = el.innerHTML.split(' ')
                    let float = number.map(parseFloat)
                    myMap.setCenter([...float], 10, {
                        checkZoomRange: true
                    });
                })
    }


    for (let elem of coordinates)
    {
    placemarks = new ymaps.Placemark(elem.coordinates, {
                balloonContent: elem.name
            });
            myMap.geoObjects.add(placemarks);
    }
}



//Переменная для включения/отключения индикатора загрузки
var spinner = $('.ymap-container').children('.loader');
//Переменная для определения была ли хоть раз загружена Яндекс.Карта (чтобы избежать повторной загрузки при наведении)
var check_if_load = false;
//Необходимые переменные для того, чтобы задать координаты на Яндекс.Карте
var myMapTemp, myPlacemarkTemp, myPlacemarkTemp2 ;

//Функция создания карты сайта и затем вставки ее в блок с идентификатором &#34;map-yandex&#34;
function init () {
    var myMapTemp = new ymaps.Map("map-yandex", {
        center: [59.934776, 30.316158], // координаты центра на карте
        zoom: 10, // коэффициент приближения карты
        controls: ['zoomControl', 'fullscreenControl'] // выбираем только те функции, которые необходимы при использовании
    });
    var myPlacemarkTemp = new ymaps.GeoObject({

        geometry: {
            type: "Point",
            coordinates: [59.990900, 30.374142] // координаты, где будет размещаться флажок на карте
        },
        properties: {
            hintContent: "Пик",
            balloonContentHeader: "Санкт петербург",
            balloonContentBody: "БМВ ПИК<br>С 09:00 до 21:00<br> Кушелевская дорога, 20",

        }
    });
    var myPlacemarkTemp2 = new ymaps.GeoObject({

        geometry: {

            type: "Point",
            coordinates: [59.907564, 30.339530] // координаты, где будет размещаться флажок на карте
        },
        properties: {
            hintContent: "Пик",
            balloonContentHeader: "Санкт петербург",
            balloonContentBody: "БМВ ПИК<br>С 09:00 до 21:00<br> Боровая 116",

        }
    });

    var myPlacemarkTemp3 = new ymaps.GeoObject({

        geometry: {

            type: "Point",
            coordinates: [59.867439, 30.247749] // координаты, где будет размещаться флажок на карте
        },
        properties: {
            hintContent: "Пик",
            balloonContentHeader: "Санкт петербург",
            balloonContentBody: "БМВ ПИК<br>С 09:00 до 21:00<br> дорога на Турухтанные Острова, 12",

        }
    });


    myMapTemp.geoObjects
        .add(myPlacemarkTemp)
        .add(myPlacemarkTemp2)
        .add(myPlacemarkTemp3);// помещаем флажок на карту


    // Получаем первый экземпляр коллекции слоев, потом первый слой коллекции
    var layer = myMapTemp.layers.get(0).get(0);

    // Решение по callback-у для определения полной загрузки карты
    waitForTilesLoad(layer).then(function() {
        // Скрываем индикатор загрузки после полной загрузки карты
        spinner.removeClass('is-active');
    });
}

// Функция для определения полной загрузки карты (на самом деле проверяется загрузка тайлов)
function waitForTilesLoad(layer) {
    return new ymaps.vow.Promise(function (resolve, reject) {
        var tc = getTileContainer(layer), readyAll = true;
        tc.tiles.each(function (tile, number) {
            if (!tile.isReady()) {
                readyAll = false;
            }
        });
        if (readyAll) {
            resolve();
        } else {
            tc.events.once("ready", function() {
                resolve();
            });
        }
    });
}

function getTileContainer(layer) {
    for (var k in layer) {
        if (layer.hasOwnProperty(k)) {
            if (
                layer[k] instanceof ymaps.layer.tileContainer.CanvasContainer
                || layer[k] instanceof ymaps.layer.tileContainer.DomContainer
            ) {
                return layer[k];
            }
        }
    }
    return null;
}

// Функция загрузки API Яндекс.Карт по требованию (в нашем случае при наведении)
function loadScript(url, callback){
    var script = document.createElement("script");

    if (script.readyState){  // IE
        script.onreadystatechange = function(){
            if (script.readyState == "loaded" ||
                script.readyState == "complete"){
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  // Другие браузеры
        script.onload = function(){
            callback();
        };
    }

    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
}

// Основная функция, которая проверяет когда мы навели на блок с классом &#34;ymap-container&#34;
var ymap = function() {
    $( document ).ready(function(){
            if (!check_if_load) { // проверяем первый ли раз загружается Яндекс.Карта, если да, то загружаем

                // Чтобы не было повторной загрузки карты, мы изменяем значение переменной
                check_if_load = true;

                // Показываем индикатор загрузки до тех пор, пока карта не загрузится
                spinner.addClass('is-active');

                // Загружаем API Яндекс.Карт
                loadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;loadByRequire=1", function(){
                    // Как только API Яндекс.Карт загрузились, сразу формируем карту и помещаем в блок с идентификатором &#34;map-yandex&#34;
                    ymaps.load(init);
                });
            }
        }
    );
}
$(function() {

    //Запускаем основную функцию
    ymap();

});
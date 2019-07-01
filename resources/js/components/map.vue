<template>
    <div>
        <div v-if="editMode" class="col-12  d-flex  ">
            <button type="button" class="btn   btn-light-blue m-1   col-6"
                    @click.prevent="showLocation(0)">مکان فعلی
                <i class="fa fa-map-marker" aria-hidden="true"></i></button>
            <button type="button" class="btn   btn-danger m-1 col-6"
                    @click.prevent="showLocation(1)">بازگردانی
                <i class="fa fa-undo"></i></button>
        </div>
        <div id="map" class="map">
        </div>
    </div>
</template>

<script>
    //    let map;


    //    import bannerCards from './banner-cards.vue';
    //    let map;
    const EventBus = new Vue();
    //    let map;
    //    import 'ol/ol.css';
    //    import {Map, View} from 'ol';
    //    import TileLayer from 'ol/layer/Tile';
    //    import OSM from 'ol/source/OSM';

    export default {

//        extends: bannerCards,

        props: ['s', 'editMode', 'map'],

        data() {
            return {


                latLng: [],
                latLng2: [],
//                latLng: this.s.schoolable.loc.split(','),
//                latLng: ['30.283937', '57.083363'],
                mapZoom: 15,
                pos: null,
                firstPos: null,
                myPos: null,
                marker: null,
                mapElement: null,
//                map: null,

//                photos: [],
//                thumbs: []
            }
        },
        created() {

            $('#mapModal').on('shown.bs.modal', () => {
//                console.log('modal');
                this.addMarker();
            });

        },
        mounted() {

            this.setEvents();


        },
        updated() {

        },

        methods: {

            statusClass(status) {
                if (status === 's') {
                    return 'btn-dark-gray disabled';
                } else if (status === 'a') {
                    return 'btn-success';
                } else if (status === 'r' || status === 'p') {
                    return 'btn-danger disabled';
                } else {
                    return status;
                }
            }
            ,
            statusText(status) {
                if (status === 's') {
                    return 'خارج از دسترس';
                } else if (status === 'a') {
                    return 'آماده';
                } else if (status === 'r' || status === 'p') {
                    return 'رزرو شده';
                } else {
                    return status;
                }
            },

            addMarker() {
//                console.log("add marker");


                let iconFeatures = [];

                let layer;
//                layer = this.map.getLayers().getArray()[2];

                layer = this.map.getLayers().getArray()[0].getLayers().getArray()[3]; //markers layer
                if (!this.s.schoolable.loc && !this.s.schoolable.loc_yeylagh) {
                    layer.getSource().clear();
                    return;
                }
//                this.map.getLayers().forEach(function (tLayer) {
//                    if (tLayer.get('name') !== undefined && tLayer.get('name') === 'markers') {
////                        layersToRemove.push(layer);
//                        layer = tLayer;
//                    }
//                });

                if (this.s.schoolable.loc) { // sabet have one marker
                    this.latLng = this.s.schoolable.loc.split(',').map(Number);
                    let marker1 = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([this.latLng[1], this.latLng[0]], 'EPSG:4326',
                            'EPSG:3857')),
                        name: this.s.name,
                        population: this.s.hooze.name,

                    });
                    iconFeatures.push(marker1);
                    this.map.getView().setCenter(ol.proj.fromLonLat([this.latLng[1], this.latLng[0]]), 4);

                }
                else if (this.s.schoolable.loc_yeylagh) {
                    let iconStyle = new ol.style.Style({
                        image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                            anchor: [0.5, 1],
                            anchorXUnits: 'fraction',
                            anchorYUnits: 'fraction',
                            opacity: .9,
                            src: 'img/marker-school-red.png'
                        }))
                    });
//                    console.log(this.s.schoolable);
                    this.latLng = this.s.schoolable.loc_yeylagh.split(',').map(Number);
                    let marker1 = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([this.latLng[1], this.latLng[0]], 'EPSG:4326',
                            'EPSG:3857')),
                        name: this.s.name,
                        population: this.s.hooze.name,

                    });

                    this.latLng2 = this.s.schoolable.loc_gheshlagh.split(',').map(Number);
                    let marker2 = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([this.latLng2[1], this.latLng2[0]], 'EPSG:4326',
                            'EPSG:3857')),
                        name: this.s.name,
                        population: this.s.hooze.name,


                    });
                    marker2.setStyle(iconStyle);
//add line Style(iconStyleyeylagh gheshlagh
                    let startPt = ol.proj.fromLonLat([this.latLng[1], this.latLng[0]]);
                    let endPt = ol.proj.fromLonLat([this.latLng2[1], this.latLng2[0]]);

                    let style = new ol.style.Style({
                        stroke: new ol.style.Stroke({
                            color: '#09ef00',
                            width: 8
                        })
                    });

                    let lineMarker = new ol.Feature({
                        geometry: new ol.geom.LineString([startPt, endPt]),
                        name: 'Line',
                    });
                    lineMarker.setStyle(style);

                    iconFeatures.push(lineMarker);
                    iconFeatures.push(marker1);
                    iconFeatures.push(marker2);

                }
                layer.getSource().clear();
                layer.getSource().addFeatures(iconFeatures);


//                    layer.getSource().addFeature(iconFeatures[1]);

                let extent = layer.getSource().getExtent();
                extent = [extent[0] - 100, extent[1] - 50, extent[2] + 50, extent[3] + 100]; //add padding to borders
                this.map.getView().fit(extent, this.map.getSize());
                this.map.setTarget($("#map")[0]);

            },

            initialize_map() {

                if (this.map) {
                    this.map.setTarget(null);
                    this.map = null;
                }

                this.map = new ol.Map({
                    target: "map",
                    layers: [
                        new ol.layer.Tile({
                            source: new ol.source.OSM(
//                                {
//                                url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png"
//                            }
                            ),

                        })
                    ],
//                    view: new ol.View({
//                        center: ol.proj.fromLonLat([this.latLng[0], this.latLng[1]]),
//                        zoom: this.mapZoom
//                    })
                });
//                });


            },

            add_map_point(lat, lng) {
                let vectorLayer = new ol.layer.Vector({
                    source: new ol.source.Vector({
                        features: [new ol.Feature({
                            geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
                        })]
                    }),
                    style: new ol.style.Style({
                        image: new ol.style.Icon({
                            anchor: [0.5, 0.5],
                            anchorXUnits: "fraction",
                            anchorYUnits: "fraction",
                            src: "https://upload.wikimedia.org/wikipedia/commons/e/ec/RedDot.svg"
                        })
                    })
                });
                map.addLayer(vectorLayer);
            },


            initMap() {
                try {

                    this.mapElement = document.getElementById("map");
                    this.pos = this.firstPos = new google.maps.LatLng(this.latLng[0], this.latLng[1]);

                    const options = {
                        zoom: 15,
                        center: this.pos,

                    };
                    this.map = new google.maps.Map(this.mapElement, options);


                    this.marker = new google.maps.Marker({
                        position: this.firstPos,
                        zoom: 15,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        map: this.map,
                        icon: '../img/school-marker.png',
                        title: this.name,
                    });

                    // set marker change on click


                    if (this.editMode) {
                        google.maps.event.addListener(this.map, 'click', (event) => {
                            EventBus.$emit('changeMarkerPos', event.latLng);
                        });
                        google.maps.event.addListener(this.marker, 'dragend', (event) => {
                            EventBus.$emit('changeMarkerPos', event.latLng);
                        });
                    }
                } catch (err) {
                    if (err.message === "google is not defined") {
                        this.$root.$emit('showMessage', {
                            type: 'error',
                            title: 'نقشه بارگزاری نشد!',
                            message:
                                'اتصال اینترنت را بررسی و صفحه را مجدد بارگزاری نمایید'
                        });
                    } else {
                        this.$root.$emit('showMessage', {
                            type: 'warning',
                            title: 'خطایی رخ داد!',
                            message: err.message
                        });
                    }
                }
            },
            setEvents() {
                EventBus.$on('changeMarkerPos', (pos) => {
                    this.showLocation(pos);

                });

            },
            showLocation(where) {
                //0 = my location
                //1= first location
                // else changed location
//                this.removeMarkers();
                if (where === 0) {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((position) => {

                                this.myPos = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude
                                };
                                this.map.setCenter(this.myPos);
                                this.marker.setPosition(this.myPos);
                                this.pos = this.myPos;

                            },
                            () => {
                                alert(' لطفا location را از نوار آدرس فعال کنید');
                            });
                    } else {
                        // Browser doesn't support Geolocation
                        alert('مرورگر قادر به یافتن مکان نیست!  ');
                    }
                }
                else if (where === 1) {

                    this.map.setCenter(this.firstPos);
                    this.marker.setPosition(this.firstPos);
                    this.pos = this.firstPos;
                }
                else {
                    this.pos = where;
//                    this.map.setCenter(where);
                    this.marker.setPosition(where);
//                    console.log(where.lat());
                }

//                this.map.setZoom(15);
                this.$root.$emit('updateLocation', this.pos);
            },
            createMarker(locations) {
                let bounds = new google.maps.LatLngBounds();
                let marker;
                let location;
                for (location of locations) {
                    bounds.extend(location);
                    marker = new google.maps.Marker({

                        position: location,
                        map: this.map,
//                    icon: place.icon,
                        title: this.name
                    });
                    this.map.fitBounds(bounds);

//                map.setCenter(bounds.getCenter());
                }
            },
            removeMarkers() {
                if (this.marker)
                    this.marker.setMap(null);
            },


        }
    }

</script>

<style lang="scss">


</style>
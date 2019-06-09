<template>

    <div class="row gallery">

        <div v-for="s,idx in schools" class="col-12 col-sm-6 col-md-4 col-lg-3 p-1">

            <div class="m-card  " :key="s.id" data-toggle="modal" data-target="#mapModal" @click="selectedSchool=s">
                <div class="m-card-header bg-transparent">

                    <div class="icon-container d-inline-block" data-toggle="tooltip" data-placement="top"
                         title="جنسیت">
                        <div class="" v-if="s.jensiat=='b'"><i class="fas  fa-lg fa-male   "></i></div>
                        <div class="" v-else-if="s.jeniat=='g'"><i class="fas fa-lg fa-female"></i></div>
                        <div class="" v-else>
                            <i class="fas fa-lg fa-male"></i>
                            <i class="fas fa-lg fa-female"></i>
                        </div>
                    </div>
                    <span class="left-border  px-2 badge-pill bg-primary float-left small-1" data-toggle="tooltip"
                          data-placement="top"
                          title="تعداد دانش آموز">
                        {{s.tedad_daneshamooz}}</span>

                    <span class="px-1   text-white float-left small-1"
                          :class="[s.is_roozane ?'bg-success':'bg-dark-gray']">
                        {{s.is_roozane ? "روزانه" : "شبانه"}}
                    </span>
                    <span class="right-border badge-pill text-white float-left small-1 bg-light-red"
                          data-toggle="tooltip" data-placement="top" title="نوع فضا">
                        {{getType(s, "faza")}}
                    </span>

                    <img class="back-header-img" src="img/card-header.png" alt="">
                    <img class="school-img" :src="getImage(s.docs)" alt="">


                </div>

                <!--<img v-else src="img/school-no.png" alt=""></div>-->
                <div class="card-body">

                    <p class="text-purple mb-0 text-center"> {{s.name}}</p>

                    <div class="codes d-flex justify-content-center">
                        <small class="  right-border badge-pill bg-gray text-white small d-inline-block   "
                               :class="[s.is_roozane ?'bg-success':'bg-dark-gray']">
                            کد مدرسه: {{ s.code_madrese }}
                        </small>
                        <small class="  left-border badge-pill bg-dark-green text-white small d-inline-block  "
                               :class="[s.is_roozane ?'bg-success':'bg-dark-gray']">
                            کد فضا: {{ s.code_faza }}
                        </small>
                    </div>

                    <div class="card-divider"></div>

                    <p class="card-text text-dark-blue">
                        <i class="fas  fa-arrow-circle-left"></i> تاسیس: {{s.sale_tasis}}
                    </p>
                    <p class="card-text text-dark-blue">
                        <i class="fas  fa-arrow-circle-left"></i> حوزه نمایندگی: {{s.hooze.name}}
                    </p>

                    <p class="card-text text-dark-blue p-type">
                        <i class="fas  fa-arrow-circle-left"></i> {{getType(s, "kooch")}}
                        <i v-if="s.schoolable_type==='App\\Koochro'"
                           class="fas  fa-arrow-circle-left text-dark-red"></i>{{getType(s, "sayyar")}}
                    </p>
                    <p class="card-text text-dark-blue p-type">
                        <i class="fas  fa-arrow-circle-left"></i> تعداد همکاران: {{s.tedad_hamkaran}}

                    </p>
                    <p class="card-text text-dark-blue p-type">
                        <i class="fas  fa-arrow-circle-left"></i> تعداد پایه تحصیلی: {{s.tedad_paye_tahsili}}

                    </p>

                    <div class="card-divider"></div>

                    <div class="doore">
                        <span v-for="d in s.doore.split('$')"
                              class="card-text badge-pill bg-purple text-white px-2  mx-1 d-inline-block">{{getType(d, "doore")}}</span>
                    </div>

                    <p v-if="s.vaziat!='m'" class="vaziat card-text badge-pill text-dark-blue text-center  mt-2 "
                       @click.stop="$root.$emit('dropdownResponse',{'ids':getType(s, 'zamime_ids')})">
                        <i class="fas  fa-eye "></i>{{getType(s, "zamime")}}


                    </p>
                    <!--search button-->
                    <div class="  m-1 mt-4 d-block ">
                        <label id="search" for="search" class="btn bg-gradient-blue   btn-block"
                               @click.stop="    $root.$emit('search') ">
                            <i class="fa fa-edit"></i> ویرایش
                        </label>
                    </div>

                </div>
                <div class="m-card-footer bg-transparent">
                    <img class="back-footer-img" src="img/card-footer.png" alt="">
                </div>

            </div>
        </div>

        <div class="modal fade px-2 " id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel"
             aria-hidden="true">
            <div class="modal-dialog  max-w-full show" role="document">

                <div class="modal-content" v-if="selectedSchool">
                    <div class="modal-header  ">

                        <h5 class="modal-title "> {{selectedSchool.name}}</h5>
                        <i class="glyphicon glyphicon-remove text-danger  clear-btn" data-dismiss="modal"
                           aria-label="Close"
                           @click="cancel()">

                        </i>
                    </div>
                    <div class="modal-body   ">

                        <school_map id="map_card" :map="map"
                                    :key="selectedSchool.id"
                                    :s="selectedSchool"
                                    :editMode="false">
                        </school_map>

                        <div class="modal-footer justify-content-start text-dark-blue">
                            <div v-if="selectedSchool.schoolable_type==='App\\Saabet'">
                                <p class="small text-primary"> آدرس <i class="fas fa-arrow-circle-left"></i>
                                    {{selectedSchool.schoolable.address}} -> {{selectedSchool.name}} -> {{selectedSchool.doore}}
                                </p>
                            </div>
                            <div v-else-if="selectedSchool.schoolable_type==='App\\Koochro'">
                                <p class="small text-primary"> آدرس ییلاق <i class="fas fa-arrow-circle-left"></i>
                                    {{selectedSchool.schoolable.address_yeylagh}}  </p>
                                <p class="small text-danger"> آدرس قشلاق <i class="fas fa-arrow-circle-left"></i>
                                    {{selectedSchool.schoolable.address_gheshlagh}}  </p>
                                <p class="small text-dark"> مسافت کوچ <i class="fas fa-arrow-circle-left"></i>
                                    {{selectedSchool.schoolable.masafate_kooch}} کیلومتر  </p>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div><!--end modal for map-->

    </div>


</template>

<script>
    import schoolMap from './map.vue';
    import LayerSwitcher from 'ol-layerswitcher/dist/ol-layerswitcher';
    //    import 'ol/ol.css';
    //    import Feature from 'ol/Feature.js';
    //    import Map from 'ol/Map.js';
    //    import Overlay from 'ol/Overlay.js';
    //    import View from 'ol/View.js';
    //    import Point from 'ol/geom/Point.js';
    //    import {Tile as TileLayer, Vector as VectorLayer} from 'ol/layer.js';
    //    import TileJSON from 'ol/source/TileJSON.js';
    //    import VectorSource from 'ol/source/Vector.js';
    //    import {Icon, Style} from 'ol/style.js';

    let map;
    let layer;
    let kerman = [57.0532, 30.2880];
    export default {

        props: ['schoolsLink'],
        components: {
            school_map: schoolMap,
        },
        data() {
            return {
                schools: null,
                params: null,
                selectedSchool: null,
                map: null,
                layer: null,
                bingLayer: null,
            }
        },
        mounted() {
//            this.getSchools();

            this.initialize_map();

            this.setEvents();
//            $('#mapModal').on('shown.bs.modal', () => {
////                console.log('modal');
//
//
////                this.layer.getSource().refresh({force: true});
////
//                this.map.renderSync();
//                this.map.render();
//                this.map.updateSize();
//                this.map.changed();
//            });
//            this.initialize_map();
//            this.addMarker();
//            $(window).on('hidden.bs.modal', function() {
//                $('#code').modal('hide');
//                alert('hidden');
//            });
        },
        created() {

        },
        updated() {

        },
        methods: {
            addMarker() {
                this.selectedSchool = this.schools[0];
                let iconFeatures = [];

                let layer;
//                console.log(this.map.getLayers().getArray());
                this.map.getLayers().forEach(function (tLayer) {
                    if (tLayer.get('name') !== undefined && tLayer.get('name') === 'main') {
//                        layersToRemove.push(layer);
                        layer = tLayer;
                    }
                });

                if (this.selectedSchool.schoolable.loc) { // sabet have one marker
//                    console.log(this.s.schoolable);
                    this.latLng = this.selectedSchool.schoolable.loc.split(',');
                    let marker1 = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([this.latLng[0], this.latLng[1]], 'EPSG:4326',
                            'EPSG:3857')),
                        name: this.selectedSchool.name,
                        population: this.selectedSchool.hooze.name,

                    });
                    iconFeatures.push(marker1);
                }
                else {
//                    console.log(this.s.schoolable);
                    this.latLng = this.selectedSchool.schoolable.loc_yeylagh.split(',');
                    let marker1 = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([this.latLng[1], this.latLng[0]], 'EPSG:4326',
                            'EPSG:3857')),
                        name: this.selectedSchool.name,
                        population: this.selectedSchool.hooze.name,

                    });

                    let marker2 = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([this.latLng[1], this.latLng[0]], 'EPSG:4326',
                            'EPSG:3857')),
                        name: this.selectedSchool.name,
                        population: selectedSchool.hooze.name,

                    });
                    this.latLng = this.selectedSchool.schoolable.loc_gheshlagh.split(',');

                    iconFeatures.push(marker1);
                    iconFeatures.push(marker2);
                }


//                var s = layer.getSource();
////                s.clear();
//                var f = s.getFeatures();
//                console.log(f);
//
//                layer.getSource().addFeature(iconFeatures[0]);
                let vectorSource = new ol.source.Vector({
                    features: iconFeatures //add an array of features
                });

                let iconStyle = new ol.style.Style({
                    image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        opacity: 0.75,
                        src: 'img/school-marker.png'
                    }))
                });


                layer = new ol.layer.Vector({
                    source: vectorSource,
                    style: iconStyle
                });
                this.map.addLayer(layer);
            },
            initialize_map() {
                console.log('init');
                let iconFeatures = [];

                let iconStyle = new ol.style.Style({
                    image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                        anchor: [0.5, 1],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'fraction',
                        opacity: .9,
                        src: 'img/marker-school-blue.png'
                    }))
                });
                let marker1 = new ol.Feature({
//                    geometry: new ol.geom.Point(kerman),
                    geometry: new ol.geom.Point(ol.proj.transform(kerman, 'EPSG:4326', 'EPSG:3857')),
//                    name: this.s.name,
//                    population: this.s.hooze.name,

                });
//                marker1.setStyle(iconStyle);

                iconFeatures.push(marker1);

                if (this.map) {
                    this.map.setTarget(null);
                    this.map = null;
                }
                let vectorSource = new ol.source.Vector({
                    features: [marker1]

                });
                let markersLayer = new ol.layer.Vector({
                    source: vectorSource,
                    style: iconStyle,
                    name: "markers"
                });

                this.bingLayer = new ol.layer.Tile({
                    source: new ol.source.BingMaps({
                        key: 'AodEaqQSDksfjZDM0HwxhdvJQDnj0Y6wgtaP6gi_wpDBcFMaefn8kz8bjvmFpN_s',
                        imagerySet: 'Aerial', //or 'Road', 'AerialWithLabels',
                        maxZoom: 19,
                    }),

                    name: "bingHybrid",
                    title: 'جزییات',
                });
                this.layer = new ol.layer.Tile({
                    source: new ol.source.OSM(
                        {
//                            url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png",
                            url: "http://mt.google.com/vt/lyrs=m&x={x}&y={y}&z={z}&s=IR&hl=fa",

                        }
                    ),
                    style: iconStyle,
                    name: "main",
                    title: 'ساده',
                });
                this.GoogleHybridlayer = new ol.layer.Tile({
                    source: new ol.source.OSM(
                        {
//                            url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png",
//                            url: "http://mt.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
                            url: 'http://mt0.google.com/vt/lyrs=y&hl=fa&x={x}&y={y}&z={z}&s=IR',

                        }
                    ),
                    style: iconStyle,
                    name: "googleHybrid",
                    title: 'گوگل',
                });

//                let overlayGroup = new ol.layer.Group({
//                    title: 'Overlays',
//                    layers: []
//                });

                this.map = new ol.Map({
                    target: "map",
                    layers: [new ol.layer.Group({
                        title: 'لایه ها',
                        name: 'group',
                        layers: [
                            this.GoogleHybridlayer, this.layer, this.bingLayer, markersLayer
                        ]
                    }),
//                        overlayGroup
                    ],
                    view: new ol.View({
                        center: ol.proj.fromLonLat(kerman),
                        zoom: 15
                    })
                });

//                this.map.addControl(new ol.control.PanZoomBar());
//                this.map.addControl(new ol.control.LayerSwitcher());
//                this.map.addControl(new ol.control.Permalink());
//                this.map.addControl(new ol.control.Permalink('permalink'));
//                this.map.addControl(new ol.control.KeyboardDefaults());
//                this.map.addControl(new ol.control.KeyboardDefaults());
                this.map.addControl(new ol.control.OverviewMap());

                this.map.addControl(new LayerSwitcher());


//                });
//                this.map = map;
//                this.layer = layer;
            },
            cancel() {
                $("#mapModal").removeClass('show');
            },

            getType(school, _for) {
                let text = '';
                if (_for === "kooch") {
                    if (school.schoolable_type === 'App\\Saabet')
                        text = 'نوع: ثابت';
                    else if (school.schoolable_type === 'App\\Koochro')
                        text = ' نوع: کوچ رو';
                }
                else if (_for === "sayyar") {
                    if (school.schoolable.type === 'n')
                        text = ' نیمه سیار ';
                    else if (school.schoolable.type === 's')
                        text = ' سیار ';

                }
                else if (_for === "faza") {
                    if (school.noe_fazaye_amoozeshi === 's')
                        text = ' ساختمان ';
                    else if (school.noe_fazaye_amoozeshi === 'k')
                        text = ' کانکس ';
                    else if (school.noe_fazaye_amoozeshi === 'c')
                        text = ' چادر ';
                }
                else if (_for === "zamime") {
                    if (school.vaziat.startsWith('a')) //zamime ast
                        text = ' ضمیمه است ';
                    else if (school.vaziat.startsWith('d')) //zamime darad
                        text = ' ضمیمه دارد ';

                }
                else if (_for === "zamime_ids") {
                    if (school.vaziat !== 'm')
                        return school.vaziat.split("$").slice(1);


                }
                else if (_for === "doore") {
                    if (school === '0')
                        text = ' ابتدایی ';
                    else if (school === '1')
                        text = ' متوسطه ۱ ';
                    else if (school === '2')
                        text = ' متوسطه ۲ ';

                }
                return text;

            },
            getImage(doc) {
                if (doc.length !== 0)
                    return doc[0].path;
                else
                    return "img/school-no.png";
            },
            getSchools() {
                axios.post(this.schoolsLink, this.params)
                    .then((response) => {
//                        console.log(response);
                        if (response.status === 200) {
//
                            this.schools = response.data;

                            this.paginator =
                                {
                                    current_page: response.data['current_page'],
                                    first_page_url: response.data['first_page_url'],
                                    next_page_url: response.data['next_page_url'],
                                    prev_page_url: response.data['prev_page_url'],
                                    last_page_url: response.data['last_page_url'],
                                    last_page: response.data['last_page'],
                                    from: response.data['from'],
                                    to: response.data['to'],
                                    total: response.data['total'],
                                };

                            this.$root.$emit('paginationChange', this.paginator);

                        }
                    }).catch((error) => {
//                    this.errors += '<br>'; // maybe is not empty from javascript validate
//                    if (error.response && error.response.status === 422)
//                        for (let idx in error.response.data.errors)
//                            this.errors += error.response.data.errors[idx] + '<br>';
//                    else {
//                        this.errors = error;
//                    }
//                    this.showDialog();
////                    console.log(error);
////                    console.log(error.response);
                });
            },

            setEvents() {


                this.$root.$on('schoolsChange', data => {
//                    console.log(data);
                    this.schools = data;
//                    this.initialize_map();
//                    this.addMarker();
                });
//            console.log(this.data);
//            console.log(this.banners);
                //ids that start with img-
                $("img[id^='img-']").each((i, el) => {

                    let imgTag = el;
                    let img = new Image();
                    img.src = imgTag.src;
//                    imgTag.src = '';
                    $(imgTag).addClass('loading');
                    img.onload = () => {
                        imgTag.src = img.src;
                        $(imgTag).removeClass('loading');
//                imgTag.setAttribute('src', img.src);
                        // Fade out and hide the loading image.
//                $('.loading').fadeOut(100); // Time in milliseconds.
                    };
                    img.onerror = (e) => {
//                console.log(e);
                        $(imgTag).removeClass('loading');
                        $(imgTag).prop('src', './img/noimage.png');
                    };

                });


            }
        }

    }


</script>
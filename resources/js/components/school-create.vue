<template>

    <div class="search-container">

        <div class=" row col-12">

            <!--<p class="divider  "><span>نام مدرسه</span></p>-->
            <div class="input-group col-md-6 col-sm-6 pt-1 ">
                <div class="input-group-prepend   btn-group-vertical p-1">
                    <i class="fa fa-search   text-primary  "></i>
                </div>
                <input type="text" placeholder="نام مدرسه " v-model="sName" id="name-input"
                       class="my-1 py-1 pr-1 form-control border" aria-label="SearchName">
                <div class=" input-group-append  btn-group-vertical   ">
                    <i class=" glyphicon glyphicon-remove text-danger  clear-btn p-1"
                       @click="sName=''; "
                    ></i>
                </div>
            </div>

            <!--hoozes-->
            <dropdown :data-link="this.hoozesLink" :for="'hooze'" :newable="true" :multi="false"
                      class="col-md-6 col-sm-6 "></dropdown>

            <div class="col-md-6 col-sm-6 my-1">
                <p class="divider text-center "><span>کد مدرسه</span></p>
                <div class="input-container text-center my-1">
                    <input type="number" v-model="code_madrese"
                           oninput="validity.valid" id="code-madrese-input"
                           class="   badge-pill"
                    />

                </div>
            </div>

            <div class="col-md-6 col-sm-6 my-1">
                <p class="divider text-center "><span>کد فضا</span></p>
                <div class="input-container text-center my-1">
                    <input type="number" v-model="code_faza"
                           oninput="validity.valid" id="code-faza-input"
                           class="   badge-pill"
                    />
                </div>
            </div>

            <div class="col-md-6 col-sm-6 my-1">
                <p class="divider text-center "><span>سال تاسیس</span></p>
                <div class="input-container text-center my-1">
                    <input type="number" v-model="sale_tasis" min="1300"
                           oninput="validity.valid" id="sal-input"
                           class="   badge-pill"
                    />
                </div>
            </div>

            <div class="col-md-6 col-sm-6 my-1">
                <p class="divider text-center "><span>تعداد دانش آموز</span></p>
                <div class="input-container text-center my-1">
                    <input type="number" v-model="tedad_daneshamooz"
                           oninput="validity.valid" id="tedad-input"
                           class="   badge-pill"
                    />
                </div>
            </div>

            <div class="col-md-6 col-sm-6 my-1">
                <p class="divider text-center "><span>تعداد پایه تحصیلی</span></p>
                <div class="input-container text-center my-1">
                    <input type="number" v-model="tedad_paye_tahsili"
                           oninput="validity.valid" id="tedad-paye-input"
                           class="   badge-pill"
                    />
                </div>
            </div>

            <div class="col-md-6 col-sm-6 my-1">
                <p class="divider text-center "><span>تعداد همکاران</span></p>
                <div class="input-container text-center my-1">
                    <input type="number" v-model="tedad_hamkaran"
                           oninput="validity.valid" id="tedad-hamkaran-input"
                           class="   badge-pill"
                    />
                </div>
            </div>

            <div class="toggle-container filters-container col-12 row   rounded p-2 mx-2 border-1 border-primary">
                <div class="btn-group btn-group-toggle    col-md-6  justify-content-center   "
                     data-toggle="buttons">
                    <label id="roozane" for="roozane"
                           class="btn btn-outline-success  col-xs-6   left-border   active"
                           @click="is_roozane=true;  ">
                        <input type="radio" name="options" autocomplete="off" class=" ">روزانه
                    </label>
                    <label id="shabane" for="shabane"
                           class="btn btn-outline-dark  col-xs-6   right-border  "
                           @click=" is_roozane=false ;">
                        <input type="radio" name="options" autocomplete="off" class=" ">شبانه
                    </label>
                </div>

                <div class="btn-group   btn-group-toggle    col-md-6    justify-content-center "
                     data-toggle="buttons">

                    <label class="btn   btn-outline-dark-green  left-border mr-1 "
                           @click=" doore['ebte']=!doore['ebte']; "> ابتدایی
                    </label>
                    <label class="btn   btn-outline-dark-red  no-radius "
                           @click="doore['mote1']=!doore['mote1']; "> متوسطه ۱
                    </label>
                    <label class="btn   btn-outline-dark-blue   right-border ml-1"
                           @click="doore['mote2']=!doore['mote2']; "> متوسطه ۲
                    </label>
                </div>

                <div class="btn-group   btn-group-toggle    col-md-6    justify-content-center "
                     data-toggle="buttons">
                    <label class="btn   btn-outline-dark-green  left-border mr-1 "
                           @click=" jensiat['b']=!jensiat['b']; "> پسرانه
                    </label>
                    <label class="btn   btn-outline-dark-red  right-border  "
                           @click="jensiat['g']=!jensiat['g']; ">دخترانه
                    </label>
                </div>

                <div class="btn-group btn-group-toggle    col-md-6  justify-content-center   "
                     data-toggle="buttons">
                    <label id="chador" for="chador"
                           class="btn btn-outline-dark-green  col-xs-6   left-border   active"
                           @click="noe_faza['c']=true; noe_faza['k']=false; noe_faza['s']=false;  ">
                        <input type="radio" name="options" autocomplete="off" class=" ">چادر
                    </label>
                    <label id="kanex" for="kanex"
                           class="btn btn-outline-dark-red  col-xs-6   no-radius  "
                           @click=" noe_faza['c']=false; noe_faza['k']=true; noe_faza['s']=false; ">
                        <input type="radio" name="options" autocomplete="off" class=" ">کانکس
                    </label>
                    <label id="sakhteman" for="sakhteman"
                           class="btn btn-outline-dark-blue  col-xs-6   right-border  "
                           @click=" noe_faza['c']=false; noe_faza['k']=false; noe_faza['s']=true; ">
                        <input type="radio" name="options" autocomplete="off" class=" ">ساختمان
                    </label>
                </div>
            </div>

            <!--mostaghel zamime-->
            <div class="  filters-container col-12 row  mt-4">
                <div class="btn-group btn-group-toggle     col-md-6  justify-content-center   "
                     data-toggle="buttons">
                    <label id="mostaghel" for="mostaghel"
                           class="btn btn-outline-dark-green  col-xs-6   left-border   active"
                           @click="vaziat['m']=true; vaziat['d']=false; vaziat['a']=false;  ">
                        <input type="radio" name="options" autocomplete="off" class=" ">مستقل
                    </label>
                    <label id="zamd" for="zamd"
                           class="btn btn-outline-dark-red  col-xs-6   no-radius  "
                           @click=" vaziat['m']=false; vaziat['d']=true; vaziat['a']=false; ">
                        <input type="radio" name="options" autocomplete="off" class=" ">ضمیمه دارد
                    </label>
                    <label id="zama" for="zama"
                           class="btn btn-outline-dark-blue  col-xs-6   right-border  "
                           @click=" vaziat['m']=false; vaziat['d']=false; vaziat['a']=true; ">
                        <input type="radio" name="options" autocomplete="off" class=" ">ضمیمه است
                    </label>
                </div>
            </div>
            <div class="toggle-container filters-container col-12 row   rounded p-2 mx-2 border-1 border-primary mt-3"
                 v-if="vaziat['d'] || vaziat['a']">
                <!--schools-->
                <selector :data-link="this.schoolsLink" :for="'school'" :newable="true"
                          class=""></selector>
            </div>


            <div class="toggle-container filters-container col-12 row   rounded p-2 mx-2 border-1 border-primary">

                <!--saabet koochroo-->
                <div class=" btn-group btn-group-toggle    col-md-6  justify-content-center mt-4  "
                     data-toggle="buttons">
                    <label id="saabet" for="roozane"
                           class="btn btn-outline-success  col-xs-6   left-border   active"
                           @click=" schoolable_type= 'App\\Saabet'  ">
                        <input type="radio" name="options" autocomplete="off" class=" ">ثابت
                    </label>
                    <label id="koochroo" for="shabane"
                           class="btn btn-outline-dark  col-xs-6   right-border  "
                           @click=" schoolable_type= 'App\\Koochroo'">
                        <input type="radio" name="options" autocomplete="off" class=" ">کوچ رو
                    </label>
                </div>

                <div id="map" class="map"></div>

                <div class="row col-12">
                    <div class="loc-container   col-md-6 col-sm-6">
                        <p class="divider   ">
                            <span> {{schoolable_type == 'App\\Saabet' ? 'مکان' : 'مکان ییلاق'}} </span></p>
                        <div class="input-group col-md-6 col-sm-12 pt-1 ">
                            <div class="input-group-prepend   btn-group-vertical p-1">
                                <i class="fa fa-map-marker  text-primary  "></i>
                            </div>
                            <input type="text" placeholder="طول" v-model="loc1.lat" id="loc1-lat-input"
                                   class="my-1 py-1 pr-1 form-control  " aria-label="SearchName">

                        </div>
                        <div class="input-group col-md-6 col-sm-12 pt-1 ">
                            <div class="input-group-prepend   btn-group-vertical p-1">
                                <i class="fa fa-map-marker  text-primary  "></i>
                            </div>
                            <input type="text" placeholder="عرض" v-model="loc1.lon" id="loc1-lon-input"
                                   class="my-1 py-1 pr-1 form-control right-border " aria-label="SearchName">
                        </div>
                    </div>

                    <div v-if="schoolable_type== 'App\\Koochroo'" class="loc-container   col-md-6 col-sm-6">
                        <p class="divider  ">
                            <span>    مکان قشلاق   </span></p>
                        <div class="input-group col-md-6 col-sm-12 pt-1 ">
                            <div class="input-group-prepend   btn-group-vertical p-1">
                                <i class="fa fa-map-marker  text-primary  "></i>
                            </div>
                            <input type="text" placeholder="طول" v-model="loc2.lat" id="loc2-lat-input"
                                   class="my-1 py-1 pr-1 form-control  " aria-label="SearchName">

                        </div>
                        <div class="input-group col-md-6 col-sm-12 pt-1 ">
                            <div class="input-group-prepend   btn-group-vertical p-1">
                                <i class="fa fa-map-marker  text-primary  "></i>
                            </div>
                            <input type="text" placeholder="عرض" v-model="loc2.lon" id="loc2-lon-input"
                                   class="my-1 py-1 pr-1 form-control right-border " aria-label="SearchName">
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>


</template>

<script>
    import schoolMap from './map.vue';
    import dropdown from './dropdown.vue';
    import selector from './selector.vue';
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
    let marker1, marker2;
    let layer;
    let kerman = [57.0532, 30.2880];
    export default {

        props: ['schoolsLink', 'hoozesLink'],
        components: {
            school_map: schoolMap,
            dropdown,
            selector,
        },
        data() {
            return {
                sName: '',
                is_roozane: true,
                doore: {'ebte': false, 'mote1': false, 'mote2': false},
                jensiat: {'b': false, 'g': false,},
                noe_faza: {'c': false, 'k': false, 's': false},
                sale_tasis: '',
                tedad_daneshamooz: '',
                tedad_paye_tahsili: '',
                tedad_hamkaran: '',
                code_madrese: '',
                code_faza: '',
                schoolable_type: 'App\\Saabet',
                vaziat: {'m': true, 'd': false, 'a': false},
                loc1: {lat: null, lon: null},
                loc2: {lat: null, lon: null},
                marker1: '', marker2: '',

            }
        },
        mounted() {
//            this.getSchools();

            this.initialize_map();

            this.setEvents();
//            this.setSliders(0);
        },
        created() {

        },
        updated() {

        },
        methods: {

            setSliders(type) {


                if (type === 0) { //init sliders
                    $(() => {
                        $("#slider-sal").slider({
                            range: false,
                            orientation: "horizontal",
                            value: 1300,
                            min: 1300,
                            max: 1500,
                            step: 1,

                            slide: (event, ui) => {
                                this.sale_tasis = (ui.value);
                            }
                        });
                        $("#slider-tedad").slider({
                            range: false,
                            orientation: "horizontal",
                            value: 0,
                            min: 0,
                            max: 1000,
                            step: 1,

                            slide: (event, ui) => {
                                this.tedad_daneshamooz = (ui.value);
                            }
                        });
                    });

                } else if (type === 1) { //sale tasis slider update

                    $("#slider-sal").slider({
                        value: this.sale_tasis
                    });
                } else if (type === 2) { //tedad   slider update

                    $("#slider-tedad").slider({
                        value: this.tedad_daneshamooz
                    });
                }
            },
            initialize_map() {
                console.log('init');
                let iconFeatures = [];

                let iconStyle1 = new ol.style.Style({
                    image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                        anchor: [.5, 1],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'fraction',
                        scale: .5,
                        opacity: .9,
                        src: '../img/marker-school-blue.png'
                    }))
                });
                let iconStyle2 = new ol.style.Style({
                    image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                        anchor: [.5, 1],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'fraction',
                        opacity: .9,
                        scale: .5,
                        src: '../img/marker-school-red.png'
                    }))
                });
                let lineStyle = new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: '#09ef00',
                        width: 8
                    })
                });

                marker1 = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.transform(kerman, 'EPSG:4326', 'EPSG:3857')),
                    name: this.sName,

                });
                marker2 = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.transform(kerman, 'EPSG:4326', 'EPSG:3857')),
                    name: this.sName,

                });


                let startPt = ol.proj.fromLonLat(kerman);
                let endPt = ol.proj.fromLonLat(kerman);

                let lineMarker = new ol.Feature({
                    geometry: new ol.geom.LineString([startPt, endPt]),
                    name: 'Line',
                });


                marker1.setStyle(iconStyle1);
                marker2.setStyle(iconStyle2);
                lineMarker.setStyle(lineStyle);

                iconFeatures.push(marker1);
                iconFeatures.push(marker2);
                iconFeatures.push(lineMarker);

                if (this.map) {
                    this.map.setTarget(null);
                    this.map = null;
                }
                let vectorSource = new ol.source.Vector({
                    features: iconFeatures

                });
                let markersLayer = new ol.layer.Vector({
                    source: vectorSource,
                    name: "markers"
                });
//                console.log(marker2.getGeometry().getCoordinates());
                this.bingLayer = new ol.layer.Tile({
                    source: new ol.source.BingMaps({
                        key: 'AodEaqQSDksfjZDM0HwxhdvJQDnj0Y6wgtaP6gi_wpDBcFMaefn8kz8bjvmFpN_s',
                        imagerySet: 'Aerial', //or 'Road', 'AerialWithLabels',
                        maxZoom: 19,
                    }),

                    name: "bingHybrid",
                    title: 'عوارض',
                });
                this.layer = new ol.layer.Tile({
                    source: new ol.source.OSM(
                        {
                            url: "http://mt.google.com/vt/lyrs=m&x={x}&y={y}&z={z}&s=IR&hl=fa",
                        }
                    ),
//                    style: iconStyle,
                    name: "main",
                    title: 'ساده',
                });
                this.GoogleHybridlayer = new ol.layer.Tile({
                    source: new ol.source.OSM(
                        {
                            url: 'http://mt0.google.com/vt/lyrs=y&hl=fa&x={x}&y={y}&z={z}&s=IR',

                        }
                    ),
//                    style: iconStyle1,
                    name: "googleHybrid",
                    title: 'گوگل',
                });


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

                this.map.addControl(new ol.control.OverviewMap());

                this.map.addControl(new LayerSwitcher());

//                drag features

                let translate1 = new ol.interaction.Translate({
                    features: new ol.Collection([marker1])
                });
                let translate2 = new ol.interaction.Translate({
                    features: new ol.Collection([marker2])
                });
                this.map.addInteraction(translate1);
                this.map.addInteraction(translate2);

                let coordMarker1, coordMarker2;
                translate1.on('translatestart', function (evt) {
                    coordMarker2 = marker2.getGeometry().getCoordinates();
                });
                translate1.on('translating', function (evt) {
                    lineMarker.getGeometry().setCoordinates([coordMarker2, evt.coordinate]);
                });
                translate2.on('translatestart', function (evt) {
                    coordMarker1 = marker1.getGeometry().getCoordinates();
                });
                translate2.on('translating', function (evt) {
                    lineMarker.getGeometry().setCoordinates([coordMarker1, evt.coordinate]);
                });

                let map = this.map;
                map.on('pointermove', function (e) {
                    if (e.dragging) return;
                    let hit = map.hasFeatureAtPixel(map.getEventPixel(e.originalEvent));
                    map.getTargetElement().style.cursor = hit ? 'pointer' : '';
                });

                marker1.style = {display: 'none'};
                lineMarker.style = {display: 'none'};
                this.layer.getSource().changed();
                map.render();
            },


//                this.layer = layer;
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

<style>
    .toggle-container {
        border-radius: 1rem;
        /*border-width: 1rem;*/
        /*border-style: dashed;*/
        border: .2rem dashed;

    }

</style>
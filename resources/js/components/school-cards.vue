<template>

    <div class="row  mx-1  gallery">

        <div v-show="show=='card'" class="row mt-1">
            <div v-for="s,idx in schools" class="col-12 col-sm-6 col-md-4 col-lg-3 p-1">

                <div class="m-card h-100 d-flex align-items-end flex-column  " :key="s.id" data-toggle="modal"
                     data-target="#mapModal"
                     @click="selectedSchool=s">
                    <div class="m-card-header bg-transparent   ">

                        <div v-if="s.jensiat!=null" class="icon-container d-inline-block" data-toggle="tooltip"
                             data-placement="top"
                             title="جنسیت">
                            <div class="" v-if="s.jensiat=='b'"><i class="fas  fa-lg fa-male   "></i></div>
                            <div class="" v-else-if="s.jeniat=='g'"><i class="fas fa-lg fa-female"></i></div>
                            <div class="" v-else>
                                <i class="fas fa-lg fa-male"></i>
                                <i class="fas fa-lg fa-female"></i>
                            </div>
                        </div>
                        <div class="header-left  d-inline-block float-left  ">
                    <span class="right-border px-2 float-left  badge-pill bg-primary   small-1" data-toggle="tooltip"
                          data-placement="top"
                          title="تعداد دانش آموز">
                        {{s.tedad_daneshamooz}}
                    </span>

                            <span v-if="s.is_roozane!=null" class="  float-left px-1 text-white   small-1"
                                  :class="[s.is_roozane ?'bg-success':'bg-dark-gray']">
                        {{s.is_roozane ? "روزانه" : "شبانه"}}
                    </span>
                            <span class="left-border px-2 float-left  badge-pill text-white   small-1 bg-light-red"
                                  data-toggle="tooltip" data-placement="top" title="نوع فضا">
                        {{getType(s, "faza")}}
                    </span>
                        </div>
                        <img class="back-header-img" src="/img/card-header.png" alt="">
                        <img class="school-img" :src="getImage(s.docs)" alt="">


                    </div>

                    <!--<img v-else src="img/school-no.png" alt=""></div>-->
                    <div class="m-card-body  px-2   flex-column align-self-stretch">

                        <p class="text-purple mb-0 text-center"> {{s.name}}</p>

                        <div class="codes d-flex justify-content-center pt-1">
                            <small class="  left-border badge-pill bg-gray text-white small d-inline-block "
                            > کد مدرسه:
                                <span v-if="s.code_madrese"> {{s.code_madrese}}</span>
                                <span v-else> <i class="fas  fa-question-circle text-white"></i> </span>
                            </small>
                            <small class="  right-border badge-pill bg-dark-green text-white small d-inline-block "
                            >کد فضا:
                                <span v-if="s.code_faza"> {{s.code_faza}}</span>
                                <span v-else> <i class="fas  fa-question-circle text-white"></i> </span>
                            </small>
                        </div>

                        <div class="card-divider"></div>

                        <p class="card-text text-dark-blue">
                            <i class="fas  fa-arrow-circle-left"></i> تاسیس:
                            <span v-if="s.sale_tasis"> {{s.sale_tasis}}</span>
                            <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span>
                        </p>
                        <p class="card-text text-dark-blue">
                            <i class="fas  fa-arrow-circle-left"></i>حوزه نمایندگی:
                            <span v-if="s.hooze"> {{s.hooze.name}}</span>
                            <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span>
                        </p>

                        <p class="card-text text-dark-blue p-type">
                            <i class="fas  fa-arrow-circle-left"></i> {{getType(s, "kooch")}}
                            <i v-if="s.schoolable_type==='App\\Koochro'"
                               class="fas  fa-arrow-circle-left text-dark-red"></i>{{getType(s, "sayyar")}}
                        </p>
                        <p class="card-text text-dark-blue p-type">
                            <i class="fas  fa-arrow-circle-left"></i> تعداد همکاران:
                            <span v-if="s.tedad_hamkaran"> {{s.tedad_hamkaran}}</span>
                            <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span>
                        </p>
                        <p class="card-text text-dark-blue p-type">
                            <i class="fas  fa-arrow-circle-left"></i> تعداد پایه تحصیلی:
                            <span v-if="s.tedad_paye_tahsili"> {{s.tedad_paye_tahsili}}</span>
                            <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span>
                        </p>

                        <div class="card-divider"></div>

                        <div v-if="s.doore" class="doore">
                        <span v-for="d in s.doore.split('$')"
                              class="card-text badge-pill bg-purple text-white px-2  mx-1 d-inline-block">{{getType(d, "doore")}}</span>
                        </div>

                        <p v-if="s.vaziat!=null && s.vaziat!='m'"
                           class="vaziat card-text badge-pill text-dark-blue text-center  mt-2 "
                           @click.stop="$root.$emit('dropdownResponse',{'ids':getType(s, 'zamime_ids')})">
                            <i class="fas  fa-eye "></i>{{getType(s, "zamime")}}


                        </p>
                        <!--search button-->
                        <div class="  m-1 mt-4 d-block ">
                            <label id="search" for="search" class="btn bg-gradient-blue   btn-block"
                                   @click.stop="selectedSchool=s;lastShow=show;show='edit';">
                                <i class="fa fa-edit"></i> ویرایش
                            </label>
                        </div>

                    </div>
                    <div class="m-card-footer  bg-transparent      ">
                        <img class="mb-auto  back-footer-img" src="/img/card-footer.png" alt="">
                    </div>

                </div>
            </div>

        </div>

        <div v-show="show=='list'" class="col-12 mt-1   ">
            <div class="table-responsive ">
                <table class="table   table-sm table-bordered table-striped   ">
                    <!--<caption> لیست مدارس</caption>-->
                    <thead class="bg-gradient-blue text-center text-white  ">
                    <tr>
                        <th scope="col">کد مدرسه</th>
                        <th scope="col">نام</th>
                        <th scope="col">کد فضا</th>
                        <th scope="col">تاسیس</th>
                        <th scope="col">حوزه نمایندگی</th>
                        <th scope="col">نوع</th>
                        <th scope="col">تعداد همکاران</th>
                        <th scope="col"> پایه تحصیلی</th>
                        <th scope="col">تعداد پایه تحصیلی</th>
                        <th scope="col">ضمیمه</th>
                        <th scope="col">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="s,idx in schools" class=" small    ">
                        <th scope="row" class="text-center align-middle">{{s.code_madrese}}</th>
                        <td class="align-middle">{{s.name}}</td>
                        <td class="align-middle">{{s.code_faza}}</td>
                        <td class="align-middle">{{s.sale_tasis}}</td>

                        <td class="align-middle" v-if="s.hooze">{{s.hooze.name}}</td>
                        <td class="align-middle" v-else=""><i class="fas  fa-question-circle text-danger"></i></td>


                        <td class="align-middle" v-if="s.schoolable_type==='App\\Saabet' ">ثابت</td>
                        <td class="align-middle" v-else-if="s.schoolable_type==='App\\Koochro' ">کوچ رو
                            {{getType(s, "sayyar")}}
                        </td>
                        <td v-else="" class="align-middle"><i class="fas  fa-question-circle text-danger   "></i></td>

                        <td class="align-middle" v-if="s.tedad_hamkaran">{{s.tedad_hamkaran}}</td>
                        <td class="align-middle" v-else=""><i class="fas  fa-question-circle text-danger"></i></td>

                        <td v-if="s.doore" class="align-middle">
                            <div v-for="d in s.doore.split('$')">
                                <span>{{getType(d, 'doore')}}</span>
                            </div>
                        </td>
                        <td v-else="" class="align-middle">
                            <i class="fas  fa-question-circle text-danger"></i>
                        </td>

                        <td class="align-middle" v-if="s.tedad_paye_tahsili">{{s.tedad_paye_tahsili}}</td>
                        <td class="align-middle" v-else=""><i class="fas  fa-question-circle text-danger"></i></td>

                        <td class="align-middle" v-if="s.vaziat && s.vaziat.startsWith('a')"
                            @click.stop="$root.$emit('dropdownResponse',{'ids':getType(s, 'zamime_ids')})">
                            <span class="  hoverable">است</span>
                        </td>
                        <td class="align-middle" v-else-if="s.vaziat && s.vaziat.startsWith('d')"
                            @click.stop="$root.$emit('dropdownResponse',{'ids':getType(s, 'zamime_ids')})">
                            <span class="  hoverable">دارد</span>
                        </td>
                        <td class="align-middle" v-else-if="s.vaziat && s.vaziat=='m'">
                            <span class="   "><i class="fas  fa-minus text-danger"></i></span>
                        </td>
                        <td class="align-middle" v-else=""><i class="fas  fa-question-circle text-danger"></i></td>


                        <td class="align-middle">
                            <nav class="nav  justify-content-between ">
                                <div class=" p-1 nav-link text-green hoverable" :key="s.id" data-toggle="modal"
                                     data-target="#mapModal"
                                     @click="selectedSchool=s"> نقشه
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </div>
                                <div class=" p-1 nav-link text-blue hoverable"
                                     @click="selectedSchool=s;lastShow=show;show='edit';"> ویرایش
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </div>

                                <div class=" p-1 nav-link text-red  hoverable "
                                     @click="showDialog(0,s)"> حذف
                                    <i class="fa fa-window-close" aria-hidden="true"></i>
                                </div>
                            </nav>
                        </td>


                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <school_create class="mt-1" v-if=" show=='create'" :sitekey="sitekey"
                       :hoozes-link="hoozesLink">
        </school_create>

        <school_edit class="mt-1" v-if="selectedSchool && show=='edit'" :selectedSchool="selectedSchool"
                     :sitekey="sitekey" :hoozes-link="hoozesLink" :panel-link="panelLink" :schools-link="schoolsLink">
        </school_edit>

        <div class="modal fade px-2 " id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel"
             aria-hidden="true">
            <div class="modal-dialog  max-w-full show" role="document">

                <div class="modal-content" v-if="selectedSchool">
                    <div class="modal-header  ">

                        <h5 class="modal-title text-primary "> {{selectedSchool.name}}</h5>
                        <h5 v-if="(selectedSchool.schoolable_type==='App\\Saabet' && (selectedSchool.schoolable===null||!selectedSchool.schoolable.loc)) ||
                          (selectedSchool.schoolable_type==='App\\Koochro' &&(!selectedSchool.schoolable|| !selectedSchool.schoolable.loc_yeylagh))"
                            class="modal-title text-danger "> اطلاعات مکانی موجود نیست</h5>
                        <i class="glyphicon glyphicon-remove text-danger  clear-btn" data-dismiss="modal"
                           aria-label="Close"
                           @click="cancel()">

                        </i>
                    </div>
                    <div class="modal-body   ">

                        <school_map id="map_card" :map="map"
                                    :s="selectedSchool"
                                    :editMode="false">
                        </school_map>
                        <!--:key="selectedSchool.id"-->
                        <div class="modal-footer justify-content-start text-dark-blue"
                             :key="selectedSchool.id+'-modal'">
                            <div v-if="selectedSchool.schoolable_type==='App\\Saabet'">
                                <p class="small text-primary"> آدرس <i class="fas fa-arrow-circle-left"></i>
                                    <span v-if="selectedSchool.schoolable&&selectedSchool.schoolable.address"> {{selectedSchool.schoolable.address}}</span>
                                    <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span>
                                    <i class="fas fa-circle"></i> فاصله از شهرستان
                                    <i class="fas fa-arrow-circle-left"></i>
                                    <span v-if="selectedSchool.schoolable&&selectedSchool.schoolable.fasele_az_shahrestan"> {{selectedSchool.schoolable.fasele_az_shahrestan}} کیلومتر </span>
                                    <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span>
                                </p>
                            </div>
                            <div v-else-if="selectedSchool.schoolable_type==='App\\Koochro'">
                                <p class="small text-primary"> آدرس ییلاق <i class="fas fa-arrow-circle-left"></i>
                                    <span v-if="selectedSchool.schoolable&&selectedSchool.schoolable.address_yeylagh"> {{selectedSchool.schoolable.address_yeylagh}}</span>
                                    <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span>
                                    <i class="fas fa-circle"></i> فاصله از شهرستان
                                    <i class="fas fa-arrow-circle-left"></i>
                                    <span v-if="selectedSchool.schoolable&&selectedSchool.schoolable.fasele_az_shahrestan_yeylagh"> {{selectedSchool.schoolable.fasele_az_shahrestan_yeylagh}} کیلومتر </span>
                                    <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span></p>
                                <p class="small text-danger"> آدرس قشلاق <i class="fas fa-arrow-circle-left"></i>
                                    {{selectedSchool.schoolable ? selectedSchool.schoolable.address_gheshlagh : ''}}
                                    <i class="fas fa-circle"></i> فاصله از شهرستان
                                    <i class="fas fa-arrow-circle-left"></i>
                                    <span v-if="selectedSchool.schoolable && selectedSchool.schoolable.fasele_az_shahrestan_gheshlagh"> {{selectedSchool.schoolable.fasele_az_shahrestan_gheshlagh}} کیلومتر </span>
                                    <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span></p>
                                <p class="small text-dark"> مسافت کوچ <i class="fas fa-arrow-circle-left"></i>
                                    <span v-if="selectedSchool.schoolable&&selectedSchool.schoolable.masafate_kooch"> {{selectedSchool.schoolable.masafate_kooch}} کیلومتر </span>
                                    <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span></p>
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
    import schoolEdit from './school-edit.vue';
    import schoolCreate from './school-create.vue';
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

        props: ['schoolsLink', 'panelLink', 'hoozesLink', 'sitekey'],
        components: {
            school_map: schoolMap,
            school_edit: schoolEdit,
            school_create: schoolCreate,
        },
        data() {
            return {
                show: 'list', //card and table
                lastShow: 'list', //card and table
                schools: [],
                params: null,
                selectedSchool: null,
                map: null,
                layer: null,
                bingLayer: null,
                loading: null,
                errors: '',

            }
        },
        mounted() {
//            this.getSchools();

            this.setEvents();
            this.initialize_map();
            this.add_marker();
            this.loading = $('.loading-page');

        },
        created() {

        },
        updated() {

        },
        methods: {
            deleteSchool(school) {
                this.loading.removeClass('hide');


//                console.log(this.panelLink + "/delete/s=" + school.id);
//                console.log(param);
                axios.post(this.panelLink + "/delete/s=" + school.id, {

                    id: school.id,
                    schoolable_id: school.schoolable ? school.schoolable.id : 0,
                    schoolable_type: school.schoolable_type,

                })
                    .then((response) => {
//                        console.log(response);
                        this.loading.addClass('hide');
                        if (response.status === 200) {
                            this.showDialog(1);

                        }

                    }).catch((error) => {
//                    console.log('res error:');
                    console.log(error);
                    this.errors = '';
                    if (error.response && error.response.status === 422)
                        for (let idx in error.response.data.errors)
                            this.errors += error.response.data.errors[idx] + '<br>';
                    else {
                        this.errors = error;
                    }
                    this.showDialog();
                    this.loading.addClass('hide');

                })
            },
            showDialog(type, data) {
                // 0  ready for save
                // 1  success  save
                // else show errors
                if (type === 0)
                    swal.fire({
                        title: 'توجه',
                        text: 'مدرسه حذف شود؟',
                        type: 'warning',
                        showCancelButton: true,
                        showCloseButton: true,
                        cancelButtonText: 'خیر',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: ' بله',
                    }).then((result) => {
                        if (result.value) {
                            this.deleteSchool(data);
                        }
                    });
                else if (type === 1) {
                    swal.fire({
                        title: 'توجه',
                        text: ' با موفقیت حذف شد!',
                        confirmButtonColor: '#60aa2f',
                        type: 'success',
                        confirmButtonText: ' باشه',
                    }).then((result) => {
                        if (result.value) {
//                            location.reload();
                            this.$root.$emit('search');
                        }
                    });

                } else {
                    swal.fire({
                        title: 'خطایی رخ داد',
                        html: ` <p   class="text-danger">` + this.errors + `</p>`,
//                        text: this.errors,
                        confirmButtonColor: '#d33',
                        type: 'error',
                        confirmButtonText: ' باشه',
                    });
                }
            },

            add_marker() {
                console.log("add marker");

                let iconFeatures = [];

                let layer;
//                layer = this.map.getLayers().getArray()[2];

                layer = this.map.getLayers().getArray()[0].getLayers().getArray()[3]; //markers layer


                let marker1 = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.transform(kerman, 'EPSG:4326',
                        'EPSG:3857')),
                    name: "kerman",


                });
                iconFeatures.push(marker1);
                this.map.getView().setCenter(ol.proj.fromLonLat(kerman), 4);


                layer.getSource().clear();
                layer.getSource().addFeatures(iconFeatures);

//                    layer.getSource().addFeature(iconFeatures[1]);
                this.map.setTarget($("#map")[0]);
                let extent = layer.getSource().getExtent();
                extent = [extent[0] - 100, extent[1] - 50, extent[2] + 50, extent[3] + 100]; //add padding to borders
                this.map.getView().fit(extent, this.map.getSize());

                this.map.getView().setZoom(15);
//                this.map.addLayer(layer);
//                this.map.renderSync();
//                this.map.render();
//                this.map.updateSize();
//                this.map.changed();


            },
            initialize_map() {
                console.log('init map');
                let iconFeatures = [];

                let iconStyle = new ol.style.Style({
                    image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                        anchor: [0.5, 1],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'fraction',
                        opacity: .9,
                        src: '/img/marker-school-blue.png'
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
//                            var urlTpl = 'https://{1-4}.{base}.maps.cit.api.here.com' +
//                                '/{type}/2.1/maptile/newest/{scheme}/{z}/{x}/{y}/256/png' +
//                                '?app_id={app_id}&app_code={app_code}';
//                            url: "https://a.tile.openstreetmap.org/maptile/newest/hybrid.day/{z}/{x}/{y}/256/png",
                            url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png",
//                            url: "http://mt.google.com/vt/lyrs=m&x={x}&y={y}&z={z}&s=IR&hl=fa",

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

                let extent = vectorSource.getExtent();
                extent = [extent[0] - 100, extent[1] - 50, extent[2] + 50, extent[3] + 100]; //add padding to borders
                this.map.getView().fit(extent, this.map.getSize());

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
                    else
                        text = ' نوع: ---';
                }
                else if (_for === "sayyar") {
                    if (school.schoolable && school.schoolable.type === 'n')
                        text = ' نیمه سیار ';
                    else if (school.schoolable && school.schoolable.type === 's')
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
                    if (school.vaziat && school.vaziat.startsWith('a')) //zamime ast
                        text = ' ضمیمه است ';
                    else if (school.vaziat && school.vaziat.startsWith('d')) //zamime darad
                        text = ' ضمیمه دارد ';

                }
                else if (_for === "zamime_ids") {
                    if (school.vaziat && school.vaziat !== 'm')
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
                    return '/storage/' + doc[0].path;
                else
                    return "/img/school-no.png";
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
                this.$root.$on('viewChange', (view) => {
//                    console.log(view);
                    this.show = view;

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
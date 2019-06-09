<template>

    <div class="dropdowns col-md-6 col-sm-6">


        <!--                             dropdown hooze               -->
        <div id="hDropdown" class="dropdown-content ">
            <div class="input-group   center-block ">
                <div class="input-group-prepend   btn-group-vertical p-1">
                    <i class="fa fa-search text-primary  "></i>
                </div>
                <input type="text" placeholder="حوزه نمایندگی" v-model="sHooze" id="hoozeInput"
                       class="my-1 py-1 pr-1 form-control"
                       @focus="openDropdown('h')"
                       @click="openDropdown('h')"
                       @blur="closeDropdown('h')"
                       @keypress.enter="closeDropdown('h')"
                       @keyup="selectHooze(sHooze,'key')">
                <div class=" input-group-append  btn-group-vertical   ">
                    <i class=" glyphicon glyphicon-remove text-danger  clear-btn"
                       @click="sHooze=''; selectHooze(sHooze,'clr');$root.$emit('search')"></i>
                </div>
            </div>

            <ul class="list-group mt-2  hide" ref="listItems" id="list-hoozes">
                <li v-for="h in   this.filteredHoozes" class="list-group-item  hooze-items"
                    :id="'h'+h['id']" :ref="'h'+h['id']" :key="h['id']"
                    @mousedown.prevent="sHooze='';selectHooze(h,h['id'])">
                    {{h['name']}}
                </li>

            </ul>
        </div>
    </div>

</template>

<script>

    export default {
        props: ['hoozesLink'],
        data() {
            return {
                hooze_dropdown: null,
                province_input: null,
                filteredHoozes: [],
                hoozes: [],
                sHooze: 'همه نمایندگی ها ',
                activeHoozes: [false],

                backspace: false,
                params: [], //send dropdown params for search
            }
        },

        computed: {},


        mounted() {

//            this.setAxiosCsrf();
            this.getHoozes();
//            this.activeHoozes[0] = true;
            this.setEvents();
//************* hooze parameters
            this.hooze_dropdown = $('#list-hoozes');
            this.hooze_input = $('#hoozeInput');
            this.hooze_input.on('keydown', (e) => {
                if (e.keyCode === 8) {
                    this.backspace = true;
                    this.searchCounty = '';
                    this.filteredCounties = [];
                    this.openDropdown('h');
                } else {
                    this.backspace = false;
                }
            });
        },
        created() {

        },
        methods: {

            setEvents() {


                this.$root.$on('search', (params) => {
                    this.params['hoozes'] = [];
                    if (params !== undefined)
                        this.params['page'] = params['page'];

                    if (!this.activeHoozes[0])
                        for (let i in this.activeHoozes)
                            if (this.activeHoozes[i])
                                this.params['hoozes'].push(i);

//                    console.log(this.params);
                    this.$root.$emit('dropdownResponse', this.params);
                });
            },

            getHoozes() {
                axios.post(this.hoozesLink, {
                    params: {}
                })
                    .then((response) => {
//                        console.log(response);
                        this.hoozes = response.data;
                        this.hoozes.unshift({'name': 'همه نمایندگی ها', 'id': 0});
                        this.filteredHoozes = this.hoozes;
//                        console.log(this.filteredHoozes);

                    }).catch((error) => {
                    console.log(' error:');
                    console.log(error);
                });
            },
            openDropdown(el) {
                if (el === 'h') {
                    this.filteredHoozes = this.hoozes;
                    this.hooze_dropdown.removeClass('hide');

                }
            },
            closeDropdown(el) {

                if (el === 'h') {

                    this.filteredHoozes = this.hoozes;
                    let i = 0;
                    let selected = [];
//                    this.activeHoozes[0] = false; //dont count in find
                    if (this.activeHoozes[0] === true) {
//                        console.log('h');
                        this.sHooze = 'همه نمایندگی ها ';
                        this.params['h'] = [];//no filter on types
                    } else {
                        this.activeHoozes.find((t, index) => {
                            if (t) {
                                i++;
//                                selected = selected + index + ','
                                selected.push(index);
                            }

                        });
                        if (selected.length === 0)
                            this.params['h'] = [];//no filter on types
                        else
                            this.params['h'] = selected;
//                            this.params['t'] = selected.slice(0, -1) + ')';

//                        console.log(this.params['h']);
                        if (i < 4) {
                            this.sHooze = '';
                            for (let i in selected) {
//                                console.log(selected[i]);
                                this.sHooze += this.filteredHoozes[selected[i]]['name'] + ', ';
                            }
                            this.sHooze = this.sHooze.slice(0, this.sHooze.length - 2); //remove last ,

                        }
                        else if (i > 0)
                            this.sHooze = i + ' انتخاب ';
//                        else
//                            this.sHooze = '';
                    }
                    this.hooze_dropdown.addClass('hide');
                }
            },

            selectHooze(h, hId) {

//                console.log(hId);
                let all = $('#h0.hooze-items');
                if (hId === 'clr') {
                    all.removeClass('active');
                    $('.hooze-items').removeClass('active');
                    for (let i in this.activeHoozes)
                        this.activeHoozes[i] = false;
                }
                else if (hId === 'key') {

                    this.filteredHoozes = this.hoozes.filter(entry => {
                        return entry['name'].includes(this.sHooze);
                    });
                    if (this.filteredHoozes[0]['name'].includes('همه'))
                        this.filteredHoozes.shift(); //remove first item (همه نمایندگی ها)
                    if (this.sHooze === '' || this.sHooze === ' ')
                        this.filteredHoozes = this.hoozes;
                    if (this.filteredHoozes.length === 0)
                        this.filteredHoozes = this.hoozes;
                }
                else {

                    let item = $('#h' + hId + '.hooze-items');

                    item.toggleClass('active');

                    if (hId === 0)
                        if (all.hasClass('active')) {
                            $('.hooze-items').addClass('active');
                            this.activeHoozes[0] = true;
                        }
                        else {
                            $('.hooze-items').removeClass('active');
                            this.activeHoozes[0] = false;
                            this.sHooze = '';
                        }
                    else {
                        // one item deselected => remove active class from همه
                        if (!item.hasClass('active')) {
                            all.removeClass('active');
                            this.activeHoozes[0] = false;
                        }
                    }

//                    this.activeHoozes[0] = false;//only for undefined error!
                    for (let i = 1; i < this.hoozes.length; i++)
//                        this.activeHoozes[i] = ($('#h' + i).hasClass('active'));
                        this.activeHoozes[i] = ($(this.$refs['h' + i]).hasClass('active'));
//                        console.log(this.$refs['h' + i]);
//                    console.log(this.activeHoozes);

                }


//                this.filteredHoozes = this.hoozes.filter(entry => {
//                    return entry['name'].includes(this.sHooze);
//                });
//                if (this.filteredHoozes.length === 0)
//                    this.filteredHoozes = this.hoozes;

//                for (let i = 1; i < this.hoozes.length; i++)
//                    if ($('#h' + i).hasClass('active'))
//                        console.log($('#h' + i)[0]);
            },

            setAxiosCsrf() {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] =
                    $('meta[name="csrf-token"]').prop('content');

            }
        }

    }


</script>
<template>

    <form @submit.prevent="check('all');$forceUpdate();errors? showDialog(): showDialog(0)">

        <input type="hidden" name="_token" :value="csrf">

        <div class="form-group row">
            <label for="username"
                   class="col-md-2 col-form-label text-md-left">نام کاربری</label>

            <div class="col-md-6">
                <input id="username"

                       class="form-control " name="username" v-model="fields.username"
                       :class="{'is-invalid': errors&&errors.username }"
                       autocomplete="username" @input="check('username');">


                <span v-if="errors&&errors.username" class="invalid-feedback" role="alert">
                 <strong>{{ errors.username[0] }}</strong>
                  </span>

            </div>
        </div>

        <div class="form-group row">
            <label for="email"
                   class="col-md-2 col-form-label text-md-left">ایمیل</label>

            <div class="col-md-6">
                <input id="email" type="email" v-model="fields.email"
                       class="form-control " name="email"
                       :class="{'is-invalid': errors&&errors.email }"
                       autocomplete="email" @input="check('email');">


                <span v-if="errors&&errors.email" class="invalid-feedback" role="alert">
                 <strong>{{ errors.email[0] }}</strong>
                  </span>

            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-left">نام</label>

            <div class="col-md-6">
                <input id="name" type="text" v-model="fields.name"
                       class="form-control  " name="name"
                       :class="{'is-invalid': errors&&errors.name }"
                       autocomplete="name" autofocus @input="check('name');">
                <span v-if="errors&&errors.name" class="invalid-feedback" role="alert">
                    <strong>{{ errors.name[0] }}</strong>
                </span>

            </div>
        </div>
        <div class="form-group row">
            <label for="family" class="col-md-2 col-form-label text-md-left">نام خانوادگی</label>

            <div class="col-md-6">
                <input id="family" type="text" v-model="fields.family"
                       class="form-control  " name="family"
                       :class="{'is-invalid': errors&&errors.family }"
                       autocomplete="family" autofocus @input="check('family');">
                <span v-if="errors&&errors.family" class="invalid-feedback" role="alert">
                    <strong>{{ errors.family[0] }}</strong>
                </span>

            </div>
        </div>

        <div class="form-group row">
            <label for="phone_number" class="col-md-2 col-form-label text-md-left">شماره تماس</label>

            <div class="col-md-6">
                <input id="phone_number" type="text" v-model="fields.phone_number"
                       class="form-control  " name="phone_number"
                       :class="{'is-invalid': errors&&errors.phone_number }"
                       autocomplete="phone_number" autofocus @input="check('phone_number');">
                <span v-if="errors&&errors.phone_number" class="invalid-feedback" role="alert">
                    <strong>{{ errors.phone_number[0] }}</strong>
                </span>

            </div>
        </div>


        <div class="form-group row">
            <label for="password"
                   class="col-md-2 col-form-label text-md-left"> گذرواژه</label>

            <div class="col-md-6">
                <input id="password" type="password"
                       class="form-control  " name="password" v-model="fields.password"
                       :class="{'is-invalid': errors&&errors.password }"
                       autocomplete="new-password" @input="check('password');">

                <span v-if="errors&&errors.password" class="invalid-feedback" role="alert">
                 <strong>{{ errors.password[0] }}</strong>
                </span>

            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                   class="col-md-2 col-form-label text-md-left">تایید گذرواژه</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control"
                       :class="{'is-invalid': errors&&errors.repassword }"
                       v-model="fields.repassword"
                       name="password_confirmation" autocomplete="new-password" @input="check('password');">

                <span v-if="errors&&errors.repassword" class="invalid-feedback" role="alert">
                 <strong>{{ errors.repassword[0] }}</strong>
                </span>
            </div>
        </div>


        <div class="card card-primary">
            <!--<h4 class="card-title">مجوزها</h4>-->
            <div class="card-header border">
                <div class="d-inline-block">مجوزها</div>
                <div class="select-all-access    float-left">
                    <input :checked="access_all" type="checkbox" name="check-access-all" id="check-access-all"
                           autocomplete="off" @click="access_all=!access_all; select(access_all)"/>
                    <div class=" btn-group ">
                        <label for="check-access-all" class=" btn btn-outline-blue left-border hov-pointer">
                            <span class=" glyphicon glyphicon-ok hov-pointer"></span>
                            <span class="hov-pointer"></span>
                        </label>
                        <label for="check-access-all" class=" btn btn-blue  right-border hov-pointer">
                            انتخاب همه
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="  col-md-4 col-sm-6">
                        <input :checked="  access_view_schools" type="checkbox" name="check-access-view-schools"
                               id="check-access-view-schools"
                               autocomplete="off" @click="access_all=false;access_view_schools=!access_view_schools"/>
                        <div class=" btn-group  w-100">
                            <label for="check-access-view-schools"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=""></span>
                            </label>
                            <label for="check-access-view-schools"
                                   class=" btn btn-blue  right-border hov-pointer w-100">
                                مشاهده مدارس                        </label>
                        </div>
                    </div>
                    <div class="  col-md-4 col-sm-6">
                        <input :checked="  access_create_schools" type="checkbox"
                               name="check-access-create-schools"
                               id="check-access-create-schools"
                               autocomplete="off"
                               @click="access_all=false;access_create_schools=!access_create_schools"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-create-schools"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-create-schools"
                                   class=" btn btn-purple  right-border hov-pointer w-100">
                                ساخت مدارس</label>
                        </div>
                    </div>
                    <div class="  col-md-4 col-sm-6">
                        <input :checked="  access_edit_schools" type="checkbox"
                               name="check-access-edit-schools"
                               id="check-access-edit-schools"
                               autocomplete="off" @click="access_all=false;access_edit_schools=!access_edit_schools"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-edit-schools"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-edit-schools"
                                   class=" btn btn-orange text-white  right-border hov-pointer w-100">
                                ویرایش مدارس</label>
                        </div>
                    </div>
                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_remove_schools" type="checkbox"
                               name="check-access-remove-schools"
                               id="check-access-remove-schools"
                               autocomplete="off"
                               @click="access_all=false;access_remove_schools=!access_remove_schools"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-remove-schools"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-remove-schools"
                                   class=" btn btn-danger   right-border hov-pointer w-100">
                                حذف مدارس</label>
                        </div>
                    </div>
                </div>
                <div class="row  ">
                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_view_users" type="checkbox"
                               name="check-access-view-users"
                               id="check-access-view-users"
                               autocomplete="off" @click="access_all=false;access_view_users=!access_view_users"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-view-users" class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-view-users"
                                   class=" btn btn-blue   right-border hov-pointer w-100">
                                مشاهده کاربران</label>
                        </div>
                    </div>

                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_create_users" type="checkbox"
                               name="check-access-create-users"
                               id="check-access-create-users"
                               autocomplete="off" @click="access_all=false;access_create_users=!access_create_users"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-create-users"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-create-users"
                                   class=" btn btn-purple   right-border hov-pointer w-100">
                                ساخت کاربران</label>
                        </div>
                    </div>

                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_edit_users" type="checkbox"
                               name="check-access-edit-users"
                               id="check-access-edit-users"
                               autocomplete="off" @click="access_all=false;access_edit_users=!access_edit_users"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-edit-users" class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-edit-users"
                                   class=" btn btn-orange text-white   right-border hov-pointer w-100">
                                ویرایش کاربران</label>
                        </div>
                    </div>

                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_remove_users" type="checkbox"
                               name="check-access-remove-users"
                               id="check-access-remove-users"
                               autocomplete="off" @click="access_all=false;access_remove_users=!access_remove_users"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-remove-users"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-remove-users"
                                   class=" btn btn-danger     right-border hov-pointer w-100">
                                حذف کاربران</label>
                        </div>
                    </div>
                </div>

                <div class="row   ">
                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_create_hoozes" type="checkbox"
                               name="check-access-create-hoozes"
                               id="check-access-create-hoozes"
                               autocomplete="off"
                               @click="access_all=false;access_create_hoozes=!access_create_hoozes"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-create-hoozes"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-create-hoozes"
                                   class=" btn btn-purple   right-border hov-pointer w-100">
                                ساخت حوزه ها</label>
                        </div>
                    </div>
                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_edit_hoozes" type="checkbox"
                               name="check-access-edit-hoozes"
                               id="check-access-edit-hoozes"
                               autocomplete="off" @click="access_all=false;access_edit_hoozes=!access_edit_hoozes"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-edit-hoozes" class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-edit-hoozes"
                                   class=" btn btn-orange text-white   right-border hov-pointer w-100">
                                ویرایش حوزه ها</label>
                        </div>
                    </div>
                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_remove_hoozes" type="checkbox"
                               name="check-access-remove-hoozes"
                               id="check-access-remove-hoozes"
                               autocomplete="off"
                               @click="access_all=false;access_remove_hoozes=!access_remove_hoozes"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-remove-hoozes"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-remove-hoozes"
                                   class=" btn btn-red   right-border hov-pointer w-100">
                                حذف حوزه ها</label>
                        </div>
                    </div>

                </div>
                <div class="row  ">
                    <div class="  col-md-4 col-sm-6 ">
                        <input :checked="  access_view_reports" type="checkbox"
                               name="check-access-view-reports"
                               id="check-access-view-reports"
                               autocomplete="off" @click="access_all=false;access_view_reports=!access_view_reports"/>
                        <div class=" btn-group w-100">
                            <label for="check-access-view-reports"
                                   class=" btn btn-outline-gray left-border hov-pointer">
                                <span class=" glyphicon glyphicon-ok  "></span>
                                <span class=" "></span>
                            </label>
                            <label for="check-access-view-reports"
                                   class=" btn btn-blue   right-border hov-pointer w-100">
                                مشاهده کاربران</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!--hoozes access-->

        <div class="card card-primary mt-2">
            <!--<h4 class="card-title">مجوزها</h4>-->
            <div class="card-header border">
                <div class="d-inline-block">حوزه های دسترسی</div>
                <div class="select-all-hoozes    float-left">
                    <input :checked="hoozes_all" type="checkbox" name="check-access-all" id="check-hoozes-all"
                           autocomplete="off"
                           @click="hoozes_all=!hoozes_all; if(hoozes_all) {$refs.selector.selected=[];$refs.selector.placeholder='همه حوزه ها' }else $refs.selector.placeholder='حوزه ها'  "/>
                    <div class=" btn-group ">
                        <label for="check-hoozes-all" class=" btn btn-outline-blue left-border hov-pointer">
                            <span class=" glyphicon glyphicon-ok hov-pointer"></span>
                            <span class="hov-pointer"></span>
                        </label>
                        <label for="check-hoozes-all" class=" btn btn-blue  right-border hov-pointer">
                            انتخاب همه
                        </label>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <selector ref="selector" :data-link="this.hoozesLink" :for="'hooze'" :newable="false"
                          class=" "></selector>
            </div>
        </div>

        <!--activate date-->

        <div class="card card-primary mt-2">
            <!--<h4 class="card-title">مجوزها</h4>-->
            <div class="card-header border">
                <div class="d-inline-block">فعال سازی</div>
                <div class="select-all-hoozes    float-left">
                    <input :checked="deactivate_user" type="checkbox" name="check-access-all" id="check-deactivate-user"
                           autocomplete="off"
                           @click="deactivate_user=!deactivate_user;   "/>
                    <div class=" btn-group ">
                        <label for="check-deactivate-user" class=" btn btn-outline-danger left-border hov-pointer">
                            <span class=" glyphicon glyphicon-ok hov-pointer"></span>
                            <span class="hov-pointer"></span>
                        </label>
                        <label for="check-deactivate-user" class=" btn btn-danger  right-border hov-pointer">
                            غیر فعال کردن کاربر
                        </label>
                    </div>
                </div>
            </div>

            <div class="card-body row">

                <div class="d-block d-flex align-items-center">
                    <label for="date-picker" class="px-2   align-self-baseline"> تاریخ انقضا </label>

                    <date-picker :editable="false" id="date-picker" class="  d-inline-block  align-self-baseline"
                                 v-model="date"></date-picker>

                    <i class="  glyphicon glyphicon-remove text-danger  clear-btn  "
                       @click="date='';  "></i>
                </div>
            </div>
        </div>

        <vue-recaptcha class="  mx-2 my-2"
                       ref="recaptcha"
                       @verify="onVerify"
                       :sitekey="sitekey">

        </vue-recaptcha>
        <span v-if="errors&&errors.recaptcha" class="text-danger d-inline-block">
                 <strong class="small font-weight-bold">{{ errors.recaptcha[0] }}</strong>
        </span>

        <div class="form-group row my-3">
            <div class="col-md-6  ">
                <button type="submit" class="btn btn-block btn-blue p-2 left-border mt-2"
                >
                    ثبت نام
                </button>
            </div>
            <div class="col-md-6  ">
                <button class="btn btn-block btn-danger p-2 right-border mt-2">
                    انصراف
                </button>
            </div>
        </div>
    </form>

</template>

<script>
    import swal from 'sweetalert2';
    import VueRecaptcha from 'vue-recaptcha';
    import selector from './selector.vue';
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

    const EventBus = new Vue();
    let regMail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let regOnlyNumber = /^[0-9]*[0-9]*$/;

    export default {

//        extends: bannerCards,

        props: ['schoolsLink', 'createUserLink', 'hoozesLink', 'sitekey', 'registerLink'],
        components: {

            selector,
            VueRecaptcha,
            datePicker: VuePersianDatetimePicker,
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                recaptcha: '',
                fields: {username: '', email: '', name: '', family: '', phone_number: '', password: '', repassword: ''},
                errors: {},
                access_all: false,
                access_view_schools: false,
                access_create_schools: false,
                access_edit_schools: false,
                access_remove_schools: false,
                access_view_users: false,
                access_create_users: false,
                access_edit_users: false,
                access_remove_users: false,
                access_create_hoozes: false,
                access_edit_hoozes: false,
                access_remove_hoozes: false,
                access_view_reports: false,
                hoozes_all: false,
                deactivate_user: false,
                date: '',

                loading: null,
            }
        },
        computed: {
//            access_all_watcher: function (oldVal) {
//                console.log(this.access_all);
//
//                return oldVal + ',' + this.access_all;
//            }
        },
        created() {


        },
        mounted() {
            this.loading = $('.loading-page');
        },
        updated() {
//            console.log(this.access_all);
        },

        methods: {
            check(_for) {

                if (_for === 'username' || _for === 'all') {
                    this.errors.username = [];
                    if (this.fields.username.length < 6)
                        this.errors.username.push('نام کاربری حداقل 6 حرف باشد');
                    else if (this.fields.username.length > 20)
                        this.errors.username.push('نام کاربری حداکثر 20 حرف باشد');
                    else this.errors.username = null;
                }

                if (_for === 'email' || _for === 'all') {

                    this.errors.email = [];
                    if (!regMail.test(this.fields.email))
                        this.errors.email.push('ایمیل نامعتبر است');
                    else this.errors.email = null;
                }
                if (_for === 'name' || _for === 'all') {

                    this.errors.name = [];
                    if (this.fields.name.length < 3)
                        this.errors.name.push('نام  حداقل 3 حرف باشد');
                    else if (this.fields.name.length > 50)
                        this.errors.name.push('نام  حداکثر 50 حرف باشد');
                    else this.errors.name = null;
                }
                if (_for === 'family' || _for === 'all') {

                    this.errors.family = [];
                    if (this.fields.family.length < 3)
                        this.errors.family.push('نام خانوادگی حداقل 3 حرف باشد');
                    else if (this.fields.family.length > 50)
                        this.errors.family.push('نام خانوادگی حداکثر 50 حرف باشد');
                    else this.errors.family = null;
                }
                if (_for === 'phone_number' || _for === 'all') {

                    this.errors.phone_number = [];
                    if (this.fields.phone_number !== '' && !regOnlyNumber.test(this.fields.phone_number))
                        this.errors.phone_number.push('شماره تماس فقط عدد باشد');
                    else if (this.fields.phone_number.length < 1)
                        this.errors.phone_number.push('شماره تماس ضروری است');
                    else if (this.fields.phone_number.length > 20)
                        this.errors.phone_number.push('شماره تماس حداکثر 20 عدد باشد');
                    else this.errors.phone_number = null;
                }
                if (_for === 'password' || _for === 'all') {
//                    console.log(this.fields.repassword + this.fields.password);
                    this.errors.password = [];
                    this.errors.repassword = [];

                    if (this.fields.repassword !== this.fields.password)
                        this.errors.repassword.push('گذرواژه با تایید گذرواژه تطابق ندارد');
                    else if (this.fields.password.length < 6)
                        this.errors.password.push('گذرواژه حداقل 6 حرف باشد');
                    else if (this.fields.password.length > 50)
                        this.errors.password.push('گذرواژه حداکثر 50 حرف باشد');
                    else if (this.fields.password !== '' && regOnlyNumber.test(this.fields.password))
                        this.errors.password.push('گذرواژه نمی تواند فقط عدد باشد');

                    else {
                        this.errors.password = null;
                        this.errors.repassword = null;
                    }
                }
                if (_for === 'all') {
                    this.errors.recaptcha = [];
                    if (this.recaptcha === '')
                        this.errors.recaptcha.push('لطفا گزینه من ربات نیستم را علامت بزنید');
                    else this.errors.recaptcha = null;

                    if (!this.errors.name && !this.errors.family && !this.errors.username &&
                        !this.errors.email && !this.errors.phone_number && !this.errors.password && !this.errors.repassword && !this.errors.recaptcha)
                        this.errors = null;
//                    console.log(!this.errors);
                }
            },
            select(select_all) {
                if (select_all) {
                    this.access_view_schools = true;
                    this.access_view_users = true;
                    this.access_create_schools = true;
                    this.access_edit_schools = true;
                    this.access_remove_schools = true;
                    this.access_create_users = true;
                    this.access_edit_users = true;
                    this.access_remove_users = true;
                    this.access_create_hoozes = true;
                    this.access_edit_hoozes = true;
                    this.access_remove_hoozes = true;
                    this.access_view_reports = true;
                }
                else {
                    this.access_view_schools = false;
                    this.access_view_users = false;
                    this.access_create_schools = false;
                    this.access_edit_schools = false;
                    this.access_remove_schools = false;
                    this.access_create_users = false;
                    this.access_edit_users = false;
                    this.access_remove_users = false;
                    this.access_create_hoozes = false;
                    this.access_edit_hoozes = false;
                    this.access_remove_hoozes = false;
                    this.access_view_reports = false;
                }
            },
            submit() {

                this.loading.removeClass('hide');
                this.errors = {};
                axios.post(this.registerLink, {
                        recaptcha: this.recaptcha,
                        username: this.fields.username,
                        name: this.fields.name,
                        family: this.fields.family,
                        phone_number: this.fields.phone_number,
                        email: this.fields.email,
                        password: this.fields.password,
                        password_confirmation: this.fields.repassword,
                        access_all: this.access_all,
                        access_view_schools: this.access_view_schools,
                        access_create_schools: this.access_create_schools,
                        access_edit_schools: this.access_edit_schools,
                        access_remove_schools: this.access_remove_schools,
                        access_view_users: this.access_view_users,
                        access_create_users: this.access_create_users,
                        access_edit_users: this.access_edit_users,
                        access_remove_users: this.access_remove_users,
                        access_create_hoozes: this.access_create_hoozes,
                        access_edit_hoozes: this.access_edit_hoozes,
                        access_remove_hoozes: this.access_remove_hoozes,
                        access_view_reports: this.access_view_reports,
                        hoozes_all: this.hoozes_all,
                        hoozes:
                            this.$refs.selector.selected.map(function (item) {
                                return item.id;
                            }),
                        deactivate_user: this.deactivate_user,
                        ex_date: this.date,
                    }
                ).then(response => {
                    this.loading.addClass('hide');
                    console.log(response);
                    if (response.status === 200) {
                        this.showDialog(1);

                    }
                    this.$refs.recaptcha.reset();
                }).catch(error => {
                    this.loading.addClass('hide');
                    this.showDialog();
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                    this.$refs.recaptcha.reset();
                });
            },
            onVerify(token) {
//                console.log(event);
                this.recaptcha = token;
            },
            showDialog(type, data) {
                // 0  ready for save
                // 1  success  save
                // else show errors

                if (type === 0)
                    swal.fire({
                        title: 'توجه',
                        text: 'اطلاعات ثبت شود؟',
                        type: 'warning',
                        showCancelButton: true,
                        showCloseButton: true,
                        cancelButtonText: 'خیر',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: ' بله',
                    }).then((result) => {
                        if (result.value) {
                            this.submit();
                        }
                    });
                else if (type === 1) {
                    swal.fire({
                        title: 'توجه',
                        text: ' با موفقیت ذخیره شد!',
                        confirmButtonColor: '#60aa2f',
                        type: 'success',
                        confirmButtonText: ' باشه',
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                } else {

                    swal.fire({
                        title: 'خطاهای موجود را اصلاح نمایید',

//                        text: this.errors,
                        confirmButtonColor: '#d33',
                        type: 'error',
                        confirmButtonText: ' باشه',
                    }).then((result) => {
                        if (result.value) {

                        }
                    });

                }
            }
        },


    }

</script>
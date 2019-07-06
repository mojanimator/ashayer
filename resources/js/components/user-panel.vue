<template>
    <div class=" m-panel container-fluid">
        <div class="row col-12 ">
            <div class="   col-md-4 ">
                <div class="panel-part">
                    <div class=" colored-half bg-primary d-flex flex-column align-items-center  justify-content-between">
                        <div class="image-container    ">
                            <img class="image  " src="/storage/img/white-user.png" alt="">
                        </div>
                        <div class="h5 pt-1 text-white">کاربران</div>
                    </div>
                </div>
            </div>
            <div class=" col-md-4">
                <div class="panel-part">
                    <div class=" colored-half bg-green d-flex flex-column align-items-center  justify-content-between">
                        <div class="image-container    ">
                            <img class="image  " src="/storage/img/white-user.png" alt="">
                        </div>
                        <div class="h5 pt-1 text-white">مدارس</div>
                    </div>
                </div>
            </div>
            <div class=" col-md-4">
                <div class="panel-part">
                    <div class=" colored-half bg-red d-flex flex-column align-items-center  justify-content-between">
                        <div class="image-container    ">
                            <img class="image  " src="/storage/img/white-user.png" alt="">
                        </div>
                        <div class="h5 pt-1 text-white">گزارشات</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row  col-12">
            <div class="col-sm-6 col-md-4 user-panel d-flex  flex-column   ">
                <div class="user-panel-header bg-gradient-blue    ">
                    <div class="user-image-container">
                        <img class="user-image" src="/storage/img/blue-user.png" alt="">
                    </div>
                </div>

                <div class="user-panel-body   px-4 d-flex flex-column align-items-center  ">

                    <p class="h3 font-weight-bold text-primary ">
                        <span v-if="user.username"> {{user.username}}</span>
                        <span v-else> <i class="fas  fa-question-circle text-danger"></i> </span>
                    </p>
                    <div class="card-divider"></div>
                </div>

            </div>
            <div class="col-sm-8">
                <div class="panel-part mt-0 pl-0 ">
                    <div class=" colored-half bg-red d-flex flex-column align-items-center  justify-content-between">
                        <div class="image-container    ">
                            <img class="image  " src="/storage/img/white-user.png" alt="">
                        </div>
                        <div class="h5 pt-1 text-white">گزارشات</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    const EventBus = new Vue();

    export default {

//        extends: bannerCards,

        props: ['user',],

        data() {
            return {}
        },
        created() {


        },
        mounted() {

        },
        updated() {

        },

        methods: {}
    }

</script>

<style lang="scss">


</style>
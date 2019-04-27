<template>

    <div class="row gallery">

        <div v-for="school in schools">

            <div class="card">
                <div class="card-header">Header</div>
                <div class="card-body">

                    {{school.name}}
                    {{school.location}}
                    {{school.students_num}}

                </div>
                <div class="card-footer">Footer</div>
            </div>
        </div>

    </div>

</template>

<script>

    export default {

        props: ['schoolsLink'],

        data() {
            return {
                schools: null,
                params: null,
            }
        },
        mounted() {
            this.getSchools();
        },
        created() {

        },
        methods: {

            getSchools() {
                axios.post(this.schoolsLink, this.params)
                    .then((response) => {
//                        console.log(response);
                        if (response.status === 200) {
//                            console.log(response.data);
                            this.schools = response.data;
//                            this.banners = response.data['data'];

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
            }

        }

    }


</script>
import schoolCards from './components/school-cards.vue'
import login from './components/login.vue'
import searchBox from './components/search-box.vue'
import pagination from './components/pagination.vue'

const app = new Vue({
    el: '#app',

    components: {
        schoolCards,
        login,
        searchBox,
        pagination
    }
});
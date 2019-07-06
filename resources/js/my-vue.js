import schoolCards from './components/school-cards.vue'
import schoolCreate from './components/school-create.vue'
import login from './components/login.vue'
import searchBox from './components/search-box.vue'
import pagination from './components/pagination.vue'
import selector from './components/selector.vue'
import userPanel from './components/user-panel.vue'

const app = new Vue({
    el: '#app',

    components: {
        schoolCards,
        schoolCreate,
        login,
        searchBox,
        pagination,
        selector,
        userPanel,
    }
});
'use strict';

var _schoolCards = require('./components/school-cards.vue');

var _schoolCards2 = _interopRequireDefault(_schoolCards);

var _schoolCreate = require('./components/school-create.vue');

var _schoolCreate2 = _interopRequireDefault(_schoolCreate);

var _schoolEdit = require('./components/school-edit.vue');

var _schoolEdit2 = _interopRequireDefault(_schoolEdit);

var _login = require('./components/login.vue');

var _login2 = _interopRequireDefault(_login);

var _searchBox = require('./components/search-box.vue');

var _searchBox2 = _interopRequireDefault(_searchBox);

var _pagination = require('./components/pagination.vue');

var _pagination2 = _interopRequireDefault(_pagination);

var _selector = require('./components/selector.vue');

var _selector2 = _interopRequireDefault(_selector);

var _userPanel = require('./components/user-panel.vue');

var _userPanel2 = _interopRequireDefault(_userPanel);

var _register = require('./components/register.vue');

var _register2 = _interopRequireDefault(_register);

var _hoozesForm = require('./components/hoozes-form.vue');

var _hoozesForm2 = _interopRequireDefault(_hoozesForm);

var _usersForm = require('./components/users-form.vue');

var _usersForm2 = _interopRequireDefault(_usersForm);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

Vue.config.devtools = false;
Vue.config.debug = false;
Vue.config.silent = true;
var app = new Vue({
    el: '#app',
    mode: 'production',

    components: {
        schoolCards: _schoolCards2.default,
        schoolCreate: _schoolCreate2.default,
        schoolEdit: _schoolEdit2.default,
        login: _login2.default,
        searchBox: _searchBox2.default,
        pagination: _pagination2.default,
        selector: _selector2.default,
        userPanel: _userPanel2.default,
        registerForm: _register2.default,
        hoozesForm: _hoozesForm2.default,
        usersForm: _usersForm2.default

    }
});
//# sourceMappingURL=my-vue.js.map
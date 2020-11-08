require('./bootstrap');
window.Vue = require('vue');
import vuetify from './vuetify';
import router from './router';

import Example from './components/ExampleComponent';

new Vue({
    el: '#app',
    router,
    vuetify,
    components: {
        'example-component': Example
    }
});
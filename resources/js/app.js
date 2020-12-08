require('./bootstrap');

window.Vue = require('vue');


import VehicleComponent from './components/VehicleComponent.vue';
import AddVehicleComponent from './components/AddVehicleComponent.vue';
import { BootstrapVue } from 'bootstrap-vue';
import Form from './components/Form.js';
window.Form = Form

Vue.component('vehicle-component', VehicleComponent);
Vue.component('addvehicle-component', AddVehicleComponent);



const app = new Vue({
	el: "#app",
});




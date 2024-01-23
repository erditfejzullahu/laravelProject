import './bootstrap';
import { createApp } from "vue";

import Dashboard from './components/dashboard.vue';


const app = createApp();

app.component('example-component', Dashboard);

app.mount('#app');
// Register the Vue component globally


// Mount the app to the DOM


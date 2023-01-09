import './bootstrap';
import { createApp } from "vue";
import App from "./App.vue";
import Firestore from "./components/firestore-component.vue"

const app = createApp(App);
app.mount("#app");

const firestore = createApp(Firestore);
firestore.mount("#firestore");

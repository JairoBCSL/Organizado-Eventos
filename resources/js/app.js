/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import { createApp } from "vue";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import Login from "./components/Login.vue";
app.component("login-component", Login);
import Register from "./components/Register.vue";
app.component("register-component", Register);
import Email from "./components/Email.vue";
app.component("email-component", Email);
import Carroussel from "./components/Carroussel.vue";
app.component("carroussel-component", Carroussel);
import SlideShow from "./components/SlideShow.vue";
app.component("slideshow-component", SlideShow);
import Modal from "./components/Modal.vue";
app.component("modal-component", Modal);
import GridEventos from "./components/GridEventos.vue";
app.component("grid-evento-component", GridEventos);
import NovoEvento from "./components/NovoEvento.vue";
app.component("novo-evento-component", NovoEvento);
import EditarEvento from "./components/EditarEvento.vue";
app.component("editar-evento-component", EditarEvento);
import DetalheEvento from "./components/DetalheEvento.vue";
app.component("detalhe-evento-component", DetalheEvento);
import NovaInscricao from "./components/NovaInscricao.vue";
app.component("nova-inscricao-component", NovaInscricao);
import GridInscricoes from "./components/GridInscricoes.vue";
app.component("grid-inscricao-component", GridInscricoes);
import ManageInscricoes from "./components/ManageInscricoes.vue";
app.component("manage-grid-component", ManageInscricoes);
import NovoPagamento from "./components/NovoPagamento.vue";
app.component("novo-pagamento-component", NovoPagamento);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount("#app");

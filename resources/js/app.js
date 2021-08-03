require('./bootstrap');

window.Vue = require("vue").default;

// Register our components (in the next step)

const app = new Vue({
    el: "#app"
});

// Register our components
Vue.component("kanban-board", require("./components/KanbanBoard.vue").default);
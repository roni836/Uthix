import axios from 'axios';
import Echo from "laravel-echo";

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.Echo = new Echo({
    broadcaster: "reverb",
});

window.Echo.private("chat").listen(".message.sent", (e) => {
    console.log("New message: ", e.message);
});

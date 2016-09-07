/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

//Vue.component('example', require('./components/Example.vue'));
Vue.config.delimiters = ['[[', ']]'];
const app = new Vue({
    el: 'body',
    data: {
        roomId: roomId,
        userId: userId,
        content: '',
        users: [],
        messages: []
    },
    ready(){
        Echo.join(`room.${roomId}`)
            .listen('SendMessage', (e) => {
                this.messages.push(e);
            })
            .here((users) => {
                this.users = users;
            })
            .joining((user) => {
                this.users.push(user);
                jQuery.notify(`<strong>${user.name}</strong> entrou no chat.`, {allow_dismiss: true});
            })
            .leaving((user) => {
                this.users.$remove(user);
            })
    },
    methods: {
        sendMessage(){
            Vue.http.post(`/chat/rooms/${this.roomId}/message`, {
                'content': this.content
            });
        },
        createPhoto(email){
            return `http://www.gravatar.com/avatar/${md5(email)}.jpg`;
        }
    }
});
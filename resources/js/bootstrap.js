window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import {io} from 'socket.io-client';

window.Pusher = require('pusher-js');

// window.socketio = io("https://www.buscargo.pt", {path: '/mysocket', secure: true});
window.socketio = io("http://localhost:9000", { path: '/mysocket' });
socketio.on('connect', () => console.log('Connected to websocket'))

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '79f8e1054a38372bd45e',
    cluster: 'eu',
    encrypted: true,
    forceTLS: false,
    authorizer: (channel, options) => {
        return {
            authorize: (socketId, callback) => {
                axios.post('/api/broadcasting/auth', {
                    socket_id: socketId,
                    channel_name: channel.name
                }, { 
                    headers:{
                        'Authorization': 'Bearer '+localStorage.getItem('token')
                    }
                })
                .then(response => {
                    // console.log('Success');
                    callback(false, response.data);
                })
                .catch(error => {
                    // console.log('Error');
                    callback(true, error);
                });
            }
        };
    }
});
// Pusher.logToConsole = true;
// Echo.logToConsole = true;

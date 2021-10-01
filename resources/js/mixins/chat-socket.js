import store from "../store/index"
export default {
    mounted() {
        // register user
        socketio.emit("register", this.authUser.id)
        // Listen for any incoming message
        socketio.on('get-message', (msg) => {
            store.commit("front/SET_ADD_MESSAGE", msg)
        })
    },
}

export function sendMessageIO(msg) {
    socketio.emit("send-msg", msg)
}

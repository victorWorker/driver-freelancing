
const io = require('socket.io');

class Socket {
    users = {}
    constructor(server, config) {
        this.io = io(server, config)
        this.onConnect();
    }

    // When user connected
    onConnect() {
        this.io.on('connection', (socket) => {
            console.log(`Connected users: ${this.clientNumber()}`);
            // Register user
            socket.on("register", (id) => {
                this.users[id] = socket.id
            });
            // Send message
            socket.on("send-msg", (msg) => {
                socket.to(this.users[msg.to_id]).emit('get-message', msg)
            });
        })
    }

    // Clients connected to the server 
    clientNumber() {
        return this.io.sockets.server.engine.clientsCount
    }
}

module.exports = Socket

const app = require('express')();
const server = require('http').createServer(app);
const cors = require('cors')
const Socket = require('./socket')

  
// Middlewares
app.use(cors())

// Start Socket
new Socket(server, { cors: { origin: '*' }, path: '/mysocket'  })

// Start the server
const port = 9000;
server.listen(port, () => {
    console.log(`NODE Server Running at port ${port}`);
});

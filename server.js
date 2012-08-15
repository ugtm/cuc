// module
var app = require('http').createServer(handler)
  , io = require('socket.io').listen(app)
  , fs = require('fs')

app.listen(8080); //port

//fisiere si pagini WEB
function handler (req, res) {
  fs.readFile(__dirname + '/index.php',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading index.html');
    }

    res.writeHead(200);
    res.end(data);
  });
}

//variabile globale
var pocket="32";
var users={};
var user='';
var money="1000";
var message={};
var message_id=0;
var message_username={};

//functii
io.sockets.on("connection", function (socket) {
	socket.on("adduser",function (username) {
		users[username]=username;
		user=socket.id;
		socket.emit("recive_chat","Server","Te-ai conectat");
		socket.broadcast.emit("recive_caht","Server",username+" s-a conectat");
	});
	socket.on("send_chat",function (message) {
		message[message_id]=message;
		message_id+=1;
		message_username[message]=socket.username;
		socket.broadcast.emit("recive_chat",socket.username,message);
		socket.emit("recive_chat", 'Eu', message);
	});
	socket.on("disconnect",function() {
		delete users[socket.username];

	});
});
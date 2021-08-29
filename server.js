const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http);
const port 	= process.env.PORT || 3000;

app.get('/', (req, res, next) => {
	res.Send('Hello word');
	console.log('Helo word');
})

http.listen(port, function () {
	console.log('Server listening at port %d', port);
});

io.on('connection', function (socket) {
	socket.on('new_message', function(data) {
		io.sockets.emit('new_message', {
			id_inbox: data.id_inbox,
			nama: data.nama,
			nohp: data.nohp,
			email: data.email,
			pesan: data.pesan,
			tanggal: data.tanggal,
			hitung: data.hitung,
		});
	});
});
<script type="text/javascript">
	$(document).ready(function(){
		$('#sendmsg').submit(function(e){
			e.preventDefault();
			var dataString = { 
              nama : $("#namaKontak").val(),
              nohp : $("#notlpKontak").val(),
              email : $("#emailKontak").val(),
              pesan : $("#pesanKontak").val(),
              tanggal : $("#tanggalKontak").val()
            };

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Contact/send_msg');?>",
				data: dataString,
				dataType: "json",
				cache:false,
				success: function(data){
					$("#namaKontak").val('');
					$("#notlpKontak").val('');
					$("#emailKontak").val('');
					$("#pesanKontak").val('');
					$("#tanggalKontak").val('');

					console.log(data.id_inbox);
					if(data.success == true){
						$('#diceksek').html(data.hitung);
						$('#hitung').html(data.hitung);
						var socket = io.connect('http://'+window.location.hostname+':3000', {
							secure: true,
							transports: ['websocket', 'polling'],
						});

						socket.emit('new_message', {
							id_inbox: data.id_inbox,
							nama: data.nama,
							nohp: data.nohp,
							email: data.email,
							pesan: data.pesan,
							tanggal: data.tanggal,
							hitung: data.hitung,
						});
					}
				} ,error: function(xhr, status, error) {
					alert(error);
				}
			})
		});
	});
</script>
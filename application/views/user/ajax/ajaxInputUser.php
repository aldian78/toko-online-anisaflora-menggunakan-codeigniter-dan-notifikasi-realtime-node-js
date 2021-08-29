
<!-- EDIT PROFLE USER -->
<script type="text/javascript">
	$('#isiusername').on('input', function() { //validasi isi nama
		var value = document.getElementById('isiusername').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#username').hide();
      	}else{
      		username.style.display = "block";
      		$('#username').html('<i>*Username tidak boleh kosong</i>');
      	}
  	});
  	$('#isiemail').on('input', function() { //validasi isi email
		var value = document.getElementById('isiemail').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#email').hide();
      	}else{
      		email.style.display = "block";
      		$('#email').html('<i>*Email tidak boleh kosong</i>');
      	}
  	});
  	$('#isinotlp').on('input', function() { //validasi isi nohp
		var value = document.getElementById('isinotlp').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#notlp').hide();
      	}else{
      		notlp.style.display = "block";
      		$('#notlp').html('<i>*No telepon tidak boleh kosong</i>');
      	}
  	});
  	$('#isiprovinsi').on('change', function() { //validasi isi provinsi
		var value = document.getElementById('isiprovinsi').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#provisiprofile').hide();
      	}else{
      		provisiprofile.style.display = "block";
      		$('#provisiprofile').html('<i>*Provinsi tidak boleh kosong</i>');
      	}
  	});
  	$('#kabataukota').on('change', function() { //validasi isi kabataukota
		var value = document.getElementById('kabataukota').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#kotaprofile').hide();
      	}else{
      		kotaprofile.style.display = "block";
      		$('#kotaprofile').html('<i>*Kabupaten atau kota tidak boleh kosong</i>');
      	}
  	});
  	$('#isikodepos').on('input', function() { //validasi isi kodepos
		var value = document.getElementById('isikodepos').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#kodepos').hide();
      	}else{
      		kodepos.style.display = "block";
      		$('#kodepos').html('<i>*Kodepos tidak boleh kosong</i>');
      	}
  	});
  	$('#isialamat').on('input', function() { //validasi isi alamat
		var value = document.getElementById('isialamat').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#alamat').hide();
      	}else{
      		alamat.style.display = "block";
      		$('#alamat').html('<i>*Alamat tidak boleh kosong</i>');
      	}
  	});

	// AJAX FORM CREATE
  	$('#edit_profil').submit(function(e){
	    e.preventDefault();
	    var myformData = new FormData(this); 

	    $.ajax({
	    type : "POST",
	    url  : "<?php echo site_url('Homeuser/proses_edit')?>",
	    dataType : "JSON",
	    data : myformData,
	    processData:false,
	    contentType:false,
	    success: function(data){
	    	if(data.success == true){
	    		Swal.fire({
	    			title: 'Congratss!',
	    			text : 'Akun anda berhasil diupdate',
	    			icon: 'success',
	    			showLoaderOnConfirm: true,
	    			preConfirm: function () {
	    				window.location.href="<?php echo base_url();?>Homeuser/"; 
	    			}
	    		});
	    		document.getElementById("edit_profil").reset();
	    	}else{
	    		for (var i = 0; i < data.inputerror.length; i++) 
	    		{
	    			$('[id="'+data.inputerror[i]+'"]').html(data.error_string[i]);
	    			username.style.display = "block";
	    			notlp.style.display = "block";
	    		}
	    	}
	    }
    	});
  	});

  	$('#ubahpassword').submit(function(e){
  		e.preventDefault();
  		var myformData = new FormData(this);

  		$.ajax({
  			type : "POST",
  			url  : "<?php echo site_url('Homeuser/ubah_password')?>",
  			data : myformData,
  			dataType : "JSON",
  			processData:false,
  			contentType:false,
  			success: function(data){
  				if(data.success == true){
  					Swal.fire({
  						title: 'Congratss!',
  						text : 'Password anda berhasil diubah',
  						icon: 'success',
  					});
  					$('#changepassword').modal('hide');
  				}else{
  					for (var i = 0; i < data.inputerror.length; i++) 
  					{
  						$('[id="'+data.inputerror[i]+'"]').html(data.error_string[i]);
  						passwordlama.style.display = "block";
  						passwordbaru.style.display = "block";
		    		}

		    	}
		    }
		});
  	});
</script>
<!-- END EDIT PROFILE USER -->

<!-- RESET FORM MODAL JIKA DITUTUP TAPI TIDAK DISUBMIT -->
<script type="text/javascript">
	$('#changepassword').on('hidden.bs.modal', function (event) {
		$('#ubahpassword')[0].reset(); // reset form on modals
		$('#passwordlama').hide();
		$('#passwordbaru').hide();
	})
</script>
<!-- END RESET MODAL -->

<!-- LIHAT PASSWORD ATAU MATA PASSWORD -->
<script type="text/javascript">
	$('#isipasswordlama').on('keyup', function() { //validasi isi password lama
		var value = document.getElementById('isipasswordlama').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#passwordlama').hide();
      		$('#alertpassword').hide();
      	}else{
      		$('#passwordlama').html('<i>*Password lama tidak boleh kosong</i>');
      		passwordlama.style.display = "block";
      	}
    });
  	$('#isipasswordbaru').on('keyup', function() { //validasi isi password lama
  		var value = document.getElementById('isipasswordbaru').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#passwordbaru').hide();
      		$('#alertpasswordbaru').hide();
      	}else{
      		$('#passwordbaru').html('<i>*Password baru tidak boleh kosong</i>');
      		passwordbaru.style.display = "block";
      	}
    });
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('#isipasswordlama').attr('type','text');
				$('#isipasswordbaru').attr('type','text');
				$('#isikonfirmasi').attr('type','text');
			}else{
				$('#isipasswordlama').attr('type','password');
				$('#isipasswordbaru').attr('type','password');
				$('#isikonfirmasi').attr('type','password');
			}
		});
	});
</script>

<!-- END MATA PASSWORD -->

<!-- AJAX INPUT ID PROVISI DIEDIT USER -->
<script type="text/javascript">
  //FUNGSI JIKA USER EDIT AKUN MAKA AMBIL KOTA UNTUK VALUE SELECTED OPTION
	$(document).ready(function(){
    var id_provinsi = $("select[name=provisiprofile]").find(":selected").attr('id_provinsi');
    $.ajax({
      type: "POST",
      dataType: 'JSON',
      url: "<?php echo site_url('Homeuser/get_kota/') ?>" + id_provinsi,
      beforeSend: function(){
       $('#kabataukota').empty();
       $('#kabataukota').append('<option disabled selected>Tunggu sebentar ....</option>');
      },
      success: function(valueKota)
      {
        $.each(valueKota, function(i , data) {
          $.each(data.results, function(k , v) {
            var x = '<?= $user['kabataukota'] ?>'
            var i = v.type +" "+ v.city_name;
            if(x == i){
              $('#kabataukota').append('<option selected value="'+v.type+' '+v.city_name+'">'+v.type+' '+v.city_name+'</option>');
            }else{
              $('#kabataukota').append('<option value="'+v.type+' '+v.city_name+'">'+v.type+' '+v.city_name+'</option>');
            }
        });
      });
    }
    })
  });
  //END KOTA VALUE SELECTED OPTION

  //FUNGSI GET ID PROVINSI DAN GET KOTA
  function id_provinsi(){
    var id_provinsi = $("select[name=provisiprofile]").find(":selected").attr('id_provinsi');
    $.ajax({
      type: "POST",
      dataType: 'JSON',
      url: "<?php echo site_url('Homeuser/get_kota/') ?>" + id_provinsi,
      beforeSend: function(){
        $('#kabataukota').empty();
        $('#kabataukota').append('<option disabled selected>Tunggu sebentar ....</option>');
      },
      success: function(valueKota)
      {
        $('#kabataukota').empty();
        $('#kabataukota').append('<option disabled selected>Silahkan pilih kabupaten / kota</option>');
        $.each(valueKota, function(i , data) {
          $.each(data.results, function(k , v) {
            $('#kabataukota').append('<option value="'+v.type+' '+v.city_name+'">'+v.type+' '+v.city_name+'</option>');
          });
        });
      }
    })
  }
	//END GET ID PROVINSI DAN GET KOTA
</script>
<!-- END AJAX INPUT ID PROVISI DIEDIT USER -->


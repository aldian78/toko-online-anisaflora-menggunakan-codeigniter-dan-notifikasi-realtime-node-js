
<!-- VALIDASI DAN INPUT KOMENTAR BLOG -->
<script type="text/javascript">
	$('#isinama').on('input', function() { //validasi isi nama
		var value = document.getElementById('isinama').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#nama').hide();
      	}else{
      		nama.style.display = "block";
      		$('#nama').html('<i>*Nama tidak boleh kosong</i>');
      	}
  	});
  	$('#isiemailblog').on('input', function() { //validasi isi email
		var value = document.getElementById('isiemailblog').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#email').hide();
      	}else{
      		email.style.display = "block";
      		$('#email').html('<i>*Email tidak boleh kosong</i>');
      	}
  	});
  	$('#isikomen').keyup(function() { //validasi isi komentar
		var value = document.getElementById('isikomen').value;
      	if (value.length > 0) {  //jika inputan ada
      		$('#komentar').hide();
      	}else{
      		komentar.style.display = "block";
      		$('#komentar').html('<i>*Komentar tidak boleh kosong</i>');
      	}
  	});

	// AJAX FORM CREATE
  	$('#comment').submit(function(e){
	    e.preventDefault();
	    var myformData = new FormData(this); 
	    var id = $('#id').attr('value');   

	    $.ajax({
	    type : "POST",
	    url  : "<?php echo site_url('Blogs/comment')?>",
	    dataType : "JSON",
	    data : myformData,
	    processData:false,
	    contentType:false,
	    success: function(data){
	        if(data.success == true){
	            Swal.fire({
		            title: 'Terima kasih!',
		            text : 'Anda sudah berkomentar',
		            icon: 'success',
		            showLoaderOnConfirm: true,
		            preConfirm: function () {
		              window.location.href="<?php echo base_url();?>Blogs/blogs_detail/"+id; 
		            }
	          	});
	          	document.getElementById("comment").reset();
	        }else{
	          	for (var i = 0; i < data.inputerror.length; i++) 
	          	{
	            	$('[id="'+data.inputerror[i]+'"]').html(data.error_string[i]);
	          	}
        	}
      	}
    	});
  	});
</script>
<!-- END VALIDASI KOMENTAR BLOG -->

<!-- LIHAT PASSWORD ATAU MATA PASSWORD -->
<script type="text/javascript">
	$(".toggle-login").click(function() {

		$(this).toggleClass("fa-eye-slash fa-eye");
		var input = document.getElementById("password");
		if (input.type === "password") {
			input.type = "text";
		} else {
			input.type = "password";
		}
	});

	$(".toggle-register").click(function() {

		$(this).toggleClass("fa-eye-slash fa-eye");
		var input = document.getElementById("password1");
		if (input.type === "password") {
			input.type = "text";
		} else {
			input.type = "password";
		}
	});

	$(".toggle-konfirmasi").click(function() {

		$(this).toggleClass("fa-eye-slash fa-eye");
		var input = document.getElementById("Konfirmasipass");
		if (input.type === "password") {
			input.type = "text";
		} else {
			input.type = "password";
		}
	});
</script>
<!-- END MATA PASSWORD -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".tambahcart").click(function() {
			var id_produk 	= $(this).data("productid");
			var nama_produk = $(this).data("productname");
			var harga 		= $(this).data("price");
			var qty     	= $(this).data("qty");
			var gambar     	= $(this).data("gambar");

			$.ajax({
				url: "<?= base_url() . 'Cart/tambah_keranjang'; ?>",
				method: "POST",
				datatype: "JSON",
	            data: {
	            	id_produk: id_produk,
	            	nama_produk: nama_produk,
	            	harga: harga,
	            	qty: qty,
	            	gambar: gambar,
	            },
	            success: function(data) {
	            	get_cart_icon();
	            	if(data.tambahqty == true){
	            		toastr.warning("Produk sudah ada dicart, Kuantitas ditambahkan", nama_produk);
	            	}else{
	            		$('.score').text(data);
	            		toastr.info("Ditambahkan ke keranjang", nama_produk);
	            	}
	            }
        	});
		});

		//ambil data icon dropdown dicontroller lalu pasangkan kehtml
		get_cart_icon();
		function get_cart_icon(){
			$.ajax({
				url: "<?= base_url() . 'Cart/get_cart'; ?>",
				method: "POST",
				success: function(data) {
		            $('#headerfixed').html(data);
		            $('#headerdesktop').html(data);
		            $('#headermobile').html(data);
		        }
		    });	
		}
		//end

		//ambil data tabel cart dicontroller lalu pasangkan kehtml
		var urlcreate = window.location.href.substr(window.location.href.lastIndexOf('/') + 1); //cek uri segment terakhir
		if(urlcreate == 'Cart'){
			get_cart_table();
			function get_cart_table(){
				$.ajax({
					url: "<?= base_url() . 'Cart/cart_table'; ?>",
					method: "POST",
					success: function(data) {
						$('#cart_table').html(data);
					}
				});	
			}
	
			//ambil data total cart dicontroller lalu pasangkan kehtml
			cart_total();
			function cart_total(){
				$.ajax({
					url: "<?= base_url() . 'Cart/cart_total'; ?>",
					method: "POST",
					success: function(data) {
						$('#cart_total').html(data);
					}
				});	
			}
		}
		//end

		//Hapus items pada cart
		$(document).on('click','.hapuscart',function(){
			var iduser 		= $(this).attr("iduser");
			var idproduk 	= $(this).attr("idproduk");
			var nama 		= $(this).attr("nama");

			$.ajax({
				url: "<?= base_url() . 'Cart/hapus_keranjang/'; ?>",
				method: "POST",
	            data: {iduser: iduser, idproduk: idproduk},
	            success: function(data) {
	            	$('.score').text(data);
	            	get_cart_icon();
	            	get_cart_table();
	            	cart_total();
	            	toastr.error("Dihapus dikeranjang", nama); 
	            }
        	});
		});
		//end

		//Clear semua items pada cart
		$(document).on('click','.clearcart',function(){
			var iduser 	= $(this).attr("iduser");
			$.ajax({
				url: "<?= base_url() . 'Cart/clear_keranjang/'; ?>",
				method: "POST",
				data: {iduser: iduser},
	            success: function(data) {
	            	$('.score').text(data);
	            	get_cart_icon();
	            	get_cart_table();
	            	cart_total();
	            	toastr.error("Kerajang dikosongkan"); 
	            }
        	});
		});
		//end

		//Ketika button minus diclick
		$(document).on('click','.btn-num-product-down',function(e){
			e.preventDefault();
			var id_produk 	= $(this).attr("idupdate");
			var nama 		= $(this).attr("nama");

			var numProduct = Number($(this).next().val());
			if(numProduct > 1) {
				var min =  $(this).next().val(numProduct - 1);
				$.ajax({
					url: "<?= base_url() . 'Cart/update_cart'; ?>",
					method: "POST",
					 data: {id_produk: id_produk, qty: min.val()},
		            success: function(data) {
		            	get_cart_table();
		            	cart_total();
		            	get_cart_icon();
		            	toastr.warning("Kuantitas dikurang", nama); 
		            }
	        	});
			}
		});
		//end

		//Ketika button plus diklik
		$(document).on('click','.btn-num-product-up',function(e){
			e.preventDefault();
			var id_produk 	= $(this).attr("idupdate");
			var nama 		= $(this).attr("nama");

			var numProduct = Number($(this).prev().val());
			var plus = $(this).prev().val(numProduct + 1);
			
			$.ajax({
				url: "<?= base_url() . 'Cart/update_cart'; ?>",
				method: "POST",
				 data: {id_produk: id_produk, qty: plus.val()},
	            success: function(data) {
	            	get_cart_table();
	            	cart_total();
	            	get_cart_icon();
	            	toastr.info("Kuantitas ditambahkan", nama); 
	            }
        	});
		});
		//end

		//Ketika input qty dan keyboard dilepas
		$(document).on('keyup','.num-product',function(e){
			var id_produk 	= $(this).attr("idupdate");
			var valqty 		= Number($(this).val());
			if(valqty > 0) {
					$.ajax({
						url: "<?= base_url() . 'Cart/update_cart'; ?>",
						method: "POST",
						data: {id_user: id_user, id_produk: id_produk, qty: valqty},
						success: function(data) {
		            	get_cart_table();
		            	cart_total();
		            	get_cart_icon();
		            }
	        	});	
			}
		});
		//end

		$("#btn-cart-detail").click(function() {
			$("#cart-detail").each( function () {
				var id_user 	= $(this).attr("iduser");
				var id_produk 	= $(this).attr("productid");
				var nama_produk = $(this).attr("productname");
				var harga 		= $(this).attr("price");
				var qty     	= $(this).attr("qty");
				var gambar     	= $(this).attr("gambar");
				var qty 	= Number($(this).val());
				$.ajax({
					url: "<?= base_url() . 'Cart/tambah_keranjang'; ?>",
					method: "POST",
		            data: {
		            	id_user: id_user,
		            	id_produk: id_produk,
		            	nama_produk: nama_produk,
		            	harga: harga,
		            	gambar: gambar,
		            	qty: qty,
		            },
		            success: function(data) {
		            	$('.score').text(data);
		            	get_cart_icon();
		            	toastr.info("Ditambahkan ke keranjang", nama_produk); 
		            }
	        	});
			});
		});
	});	
</script>
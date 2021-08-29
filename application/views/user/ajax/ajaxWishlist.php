<script type="text/javascript">
	$(document).ready(function(){	
		//*==================AJAX WISHLIST==========================*//
		$(".tambahwishlist").click(function() {
			var id_produk 	= $(this).data("idproduk");
			var produk 		= $(this).data("produk");
			var harga 		= $(this).data("harga");
			var gambar     	= $(this).data("gambar");

			$.ajax({
				url: "<?= base_url() . 'Homeuser/tambah_wishlist'; ?>",
				method: "POST",
	            datatype: "json",
	            data: {
	            	id_produk: id_produk,
	            	produk: produk,
	            	harga: harga,
	            	gambar: gambar,
	            },
	            success: function(response){
	            	//digunakan untuk menentukan apakah suatu objek kosong.
	            	if(response.success){
	            		toastr.info("Ditambahkan ke dalam wishlist", produk);
	            	}else{
	            		toastr.error("Produk sudah ada didalam wishlist", produk);
	            	}
	            }
        	});
		});

		$(".tambahwishlist").on("click",function(){
			$(this).removeClass("block2-btn-addwishlist");
			$(this).addClass("block2-btn-towishlist");
		});

		//HAPUS WISHLIST
		$(document).on('click','.hapuswishlist',function(){
			var id		= $(this).attr("id");
			var nama	= $(this).attr("nama");

			$.ajax({
				url: "<?= base_url() . 'Homeuser/hapus_wishlist/'; ?>" + id,
				method: "POST",
				datatype: "JSON",
	            success: function(data) {
	            	reload_table();
	            	toastr.info("Berhasil dihapus di dalam wishlist", nama); 
	            }
        	});
		});

        //DATATABLES
		function reload_table()
		{
		    table.ajax.reload(null,false); //reload datatable ajax 
		}

	    table = $('#table').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 			
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('Homeuser/tableWishlist')?>",
	            "type": "POST"
	        },
	 
	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [-1], //first column / numbering column
	            "orderable": false, //set not orderable
	        },

	        ],
	        "language": {
	        	"processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
	        	"emptyTable": 'Tidak ada produk didalam wishlist',
	        }
	 
	    });

      	//*===================END AJAX WISHLIST========================*//

	});

</script>
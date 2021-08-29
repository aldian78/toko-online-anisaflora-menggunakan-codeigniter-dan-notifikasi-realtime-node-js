<script>
  var save_method; //for save method string
  var table;
    //datatables
  $(document).ready(function() {

    table = $('#tabelkat').DataTable({ 
      responsive: {
        details: {
          renderer: function ( api, rowIdx ) {
          var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
            var header = $( api.column( cell.column ).header() );
              return  '<p style="color:#00A">'+header.text()+' : '+api.cell( cell ).data()+'</p>';  // changing details mark up.
          } ).toArray().join('');
 
          return data ?    $('<table/>').append( data ) :    false;
          }
        }
      },
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
      "url": "<?php echo site_url('admin/Kategori/ajax_list')?>",
      "type": "POST"
      },

      //Set column definition initialisation properties.
      "columnDefs": [
        { 
          "targets": [-1], //last column
          "orderable": false, //set not orderable
          "className": 'text-center'
        },
      ],
    });

    //datepicker
    $('.datepicker').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd",
      todayHighlight: true,
      orientation: "top auto",
      todayBtn: true,
      todayHighlight: true,  
    });

  });


  $('#nama_kategori').on('input', function() { //validasi isi judul
    var value = document.getElementById('nama_kategori').value;
      if (value.length > 0) {  //jika inputan ada
        $(this).removeClass('is-invalid'); 
        $(this).addClass('is-valid');
      }else{
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $('#namKat').html('*Nama kategori tidak boleh kosong');
      }
    });

  function add_person()
  {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#gambar').removeClass('is-valid is-invalid');
    $('#nama_kategori').removeClass('is-valid is-invalid');  
    $('#valueimage').hide(); // clear error string
    $('#reviewImage').hide(); // clear error string
    preview_text.style.display = "block"; //ubahh display css
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah kategori'); // Set title to Bootstrap modal title
  }

  function edit_person(id)
  {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    var base_url = "<?php echo base_url();?>";
    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('admin/Kategori/ajax_edit')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {

        $('[name="id"]').val(data.id_kategori);
        $('[name="nama_kategori"]').val(data.nama_kategori);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit kategori'); // Set title to Bootstrap modal title

            if(data.gambar)
            {
              $('#valueimage').html('<img src="'+base_url+'assets_admin/img/kategori/'+data.gambar+'" class="thumb">'); // show photo
              document.getElementById("valueimage").style.display = "block";
              preview_text.style.display = "none"; //ubahh display css
              $('#gambar').removeClass('is-valid is-invalid'); 
              $('#reviewImage').remove(); // clear error string

            }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error get data from ajax');
      }
    });
  }

  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax 
  }
 
  function save()
  {
    event.preventDefault();
    $('#btnSave').text('wait...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('admin/Kategori/ajax_add')?>";
    } else {
        url = "<?php echo site_url('admin/Kategori/ajax_update')?>";
    }

    var formData = new FormData($('#form')[0]);
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
          if(data.status) //if success close modal and reload ajax table
          {
            $('#modal_form').modal('hide');
            reload_table();
            if(save_method == 'add'){
              Swal.fire({
                title: 'Data Kategori!',
                text : 'Berhasil ditambahkan!',
                icon : 'success',
              });
            }else{
              Swal.fire({
                title: 'Data Kategori!',
                text : 'Berhasil diedit!',
                icon : 'success',
              });
            }
          }else{
            for (var i = 0; i < data.inputerror.length; i++) 
            {
              $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
              $('[id="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
            }
              $('#form input, #form textarea').on('keyup', function(){ //Ubah css invalid dan valid pada setiap input      
                $(this).addClass('is-valid');             
              });
          }
          
          $('#btnSave').text('save'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Server error !');
          $('#btnSave').text('save'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
  }

  function readImage(){ //cek file ekstensi image dan preview image
    var inputFile = document.getElementById('gambar');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
      $('#gambar').removeClass('is-valid'); 
      $('#gambar').addClass('is-invalid'); // clear error string        
      $('#fail_upload_msg').html('*Pastikan semua jenis file harus bertype gif | jpg | png | jpeg |');  
      inputFile.value = ''; //jika bukan image input file kosong
      return false;
    }else{
      //upload preview
      if(inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('uploadPreview').innerHTML = '<img src="'+e.target.result+'" class="thumb" id="reviewImage"/>';
          preview_text.style.display = "none"; //ubahh display css
          $('#gambar').removeClass('is-invalid');
          $('#gambar').addClass('is-valid');
          document.getElementById("valueimage").style.display = "none";
          $('#remove').remove(); // clear error string
        };
        reader.readAsDataURL(inputFile.files[0]);
      }
    }
  }

  $(document).on('click', '#reload', function(e){
    table.ajax.reload(null,false); //reload datatable ajax 
  });
</script>

<script type="text/javascript">

  function reload_table()
  {
    table.ajax.reload(null,false); //reload datatable ajax 
  }

  function delete_produk(id)
  {
    $('#ModalDelete').modal('show');
    $('#deleteProduk').submit(function(e){
    e.preventDefault();
      // ajax delete data to database
      $.ajax({
        url : "<?php echo site_url('admin/Kategori/ajax_delete')?>/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          //if success reload ajax table
          Swal.fire({
            title: 'Data Kategori!',
            text : 'Berhasil dihapus!',
            icon: 'success',
          });
          
          $('#ModalDelete').modal('hide');
          reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error deleting data');
        }
      });
    });
  }
</script>
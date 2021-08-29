<script>
  var save_method; //for save method string
  var table;
    //datatables
  $(document).ready(function() {
      
      table = $('#table').DataTable({ 
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
      "url": "<?php echo site_url('admin/Blog/ajax_list')?>",
      "type": "POST"
      },

      //Set column definition initialisation properties.
      "columnDefs": [
        { 
          "targets": [4], //last column
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

    $('#judul').on('input', function() { //validasi isi judul
      var value = document.getElementById('judul').value;
      if (value.length > 0) {  //jika inputan ada
        $(this).removeClass('is-invalid'); 
        $(this).addClass('is-valid');
      }else{
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $('#jdl').html('*Judul tidak boleh kosong');
      }
    });

    $('#kategori').on('change', function(){ //validasi isi dropdown
       var my = document.getElementById('kategori').value;
      if (my.length > 0) {
        $(this).removeClass('is-invalid'); 
        $(this).addClass('is-valid');
      }else{
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        $('#kat').html('*Kategori tidak boleh kosong');
      }
    });

    var urlcreate = window.location.href.substr(window.location.href.lastIndexOf('/') + 1); //cek uri segment terakhir
    var urlupdate = window.location.href.split('/'); //ambil url update blog

    if (urlcreate == 'page_create' || urlupdate[6] == 'page_update') {
      $(document).ready(function() {  //menghapus validasi ckeditor jika tidak kosong
          CKEDITOR.instances.isi.on('change', function() {  
            if(CKEDITOR.instances.isi.getData().length >  0) {
              $('#isi').removeClass('is-invalid');
            }else{
              $('#isi').addClass('is-invalid');
              $('#des').html('*Deskripsi tidak boleh kosong');
            }
          });
      });
    }

  // AJAX FORM CREATE
  $('#form-create').submit(function(e){
    e.preventDefault();
    var myformData = new FormData(this);        
    myformData.append('isi', CKEDITOR.instances['isi'].getData());

    var ins = document.getElementById('gambar').files.length;
    for (var x = 0; x < ins; x++) { 
      myformData.append("files[]", document.getElementById('gambar').files[x]);
    }

    $.ajax({
    type : "POST",
    url  : "<?php echo site_url('admin/Blog/ajax_create')?>",
    dataType : "JSON",
    data : myformData,
    processData:false,
    contentType:false,
    success: function(data){
        if(data.success == true){
          Swal.fire({
            title: 'Data blog!',
            text : 'Berhasil ditambahkan!',
            icon: 'success',
            showLoaderOnConfirm: true,
            timer : 10000,
            preConfirm: function () {
              // Swal.showLoading()
              window.location.href="<?php echo base_url();?>admin/Blog"; 
            }
          });
        }else{
          for (var i = 0; i < data.inputerror.length; i++) 
          {
            $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
            $('[id="'+data.inputerror[i]+'"]').siblings('.invalid-feedback').html(data.error_string[i]);
            $('#imgerror').addClass('is-invalid');
            $('#gambar').addClass('is-invalid');
          }
        }
      }
    });
  });

  //keyword limit image multiple with javascript
  $("#gambar").on('change', function () { //cek jumlah image apakah lebih dari yang ditentukan
     //Dapatkan hitungan file yang dipilih
     var limitupload = $("input[type='file']");
     var countFiles = $(this)[0].files.length;
     var a = document.getElementById('fail_upload_msg');
     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#uploadPreview");
     image_holder.empty();

      if (extn == "gif" || extn == "jpg" || extn == "png" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

            if(countFiles > 3 ){ // if jika image lebih dari 3
              $('#imgerror').addClass('is-invalid');
              // $('.thumb').remove();
                $('#text_preview').html('<p><strong>' + '*Maaf ! Silahkan upload ulang. ' + '</strong><i>' + 'Max 3 image' + '</i></p>'); 
                preview_text.style.display = "none"; //ubahh display css
                $('#submit').prop('disabled', true);
            }else{
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                  var reader = new FileReader();
                  reader.onload = function (e) {
                  $("<img />", {
                     "src": e.target.result,
                     "class": "thumb"
                    }).appendTo(image_holder);
                  }

                  $('#image').remove();
                  $('#imgerror').removeClass('is-invalid');
                  $('#imgerror').addClass('is-valid');
                  preview_text.style.display = "none"; //ubahh display css
                  text_preview.style.display = "none"; //ubahh display css
                  $('#submit').prop('disabled', false);

                  image_holder.show();
                  reader.readAsDataURL($(this)[0].files[i]);
                }
            }

          } else {
              alert("Browser ini tidak mendukung File yang diupload !");
          }

      } else {
          $('#imgerror').removeClass('is-valid');
          $('#imgerror').addClass('is-invalid');
          $('#fail_upload_msg').html('<p class="text-danger">' + '*Pastikan semua jenis file harus bertype gif | jpg | png | jpeg |' + '</p>');  
          $('#remove').remove();            
          $('#submit').prop('disabled', true);
      }
  });
  // END AJAX FORM CREATE

  // AJAX FORM UPDATE
  $('#form-update').submit(function(e){
    e.preventDefault();
    var myformData = new FormData(this);        
    myformData.append('isi', CKEDITOR.instances['isi'].getData());

    var ins = document.getElementById('gambarupdate').files.length;
    for (var x = 0; x < ins; x++) { 
        myformData.append("files[]", document.getElementById('gambarupdate').files[x]);
    }

    $.ajax({
    type : "POST",
    url  : "<?php echo site_url('admin/Blog/ajax_update')?>",
    dataType : "JSON",
    data : myformData,
    processData:false,
    contentType:false,
    success: function(data){
        if(data.success == true){
          Swal.fire({
            title: 'Data blog!',
            text : 'Berhasil diupdate!',
            icon: 'success',
            showLoaderOnConfirm: true,
            timer : 10000,
            preConfirm: function () {
              // Swal.showLoading()
              window.location.href="<?php echo base_url();?>admin/Blog"; 
            }
          });
        }else{
          for (var i = 0; i < data.inputerror.length; i++) 
          {
            $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
            $('[id="'+data.inputerror[i]+'"]').siblings('.invalid-feedback').html(data.error_string[i]);
            $('#imgerror').addClass('is-invalid');
          }
        }
      }
    });
  });
  
  $("#gambarupdate").on('change', function () { //cek jumlah image apakah lebih dari yang ditentukan
     //Dapatkan hitungan file yang dipilih
     var limitupload = $("input[type='file']");
     var countFiles = $(this)[0].files.length;
     var a = document.getElementById('fail_upload_msg');
     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#uploadPreview");
     image_holder.empty();

      if (extn == "gif" || extn == "jpg" || extn == "png" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

            if(countFiles > 3 ){ // if jika image lebih dari 3
              $('#imgerror').addClass('is-invalid');
              $('.thumb').remove();
                preview_text.style.display = "block"; //ubahh display css
                $('#submit').prop('disabled', true);
            }else{
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                  var reader = new FileReader();
                  reader.onload = function (e) {
                  $("<img />", {
                     "src": e.target.result,
                     "class": "thumb"
                    }).appendTo(image_holder);
                  }

                  $('#imgerror').removeClass('is-invalid');
                  $('#imgerror').addClass('is-valid');
                  preview_text.style.display = "none"; //ubahh display css
                  $('#submit').prop('disabled', false);

                  image_holder.show();
                  reader.readAsDataURL($(this)[0].files[i]);
                }
            }

          } else {
              alert("Browser ini tidak mendukung File yang diupload !");
          }

     } else {
          $('#imgerror').removeClass('is-valid');
          $('#imgerror').addClass('is-invalid');
          $('#fail_upload_msg').html('<p class="text-danger">' + '*Pastikan semua jenis file harus bertype gif | jpg | png | jpeg |' + '</p>');  
          $('#remove').remove();            
          $('#submit').prop('disabled', true);
     }
  });
  // END AJAX FORM UPDATE

  $(document).on('click', '#reload', function(e){
    table.ajax.reload(null,false); //reload datatable ajax 
  });
});
</script>

<script type="text/javascript">

  function reload_table()
  {
    table.ajax.reload(null,false); //reload datatable ajax 
  }

  function delete_blog(id)
  {
    $('#ModalDelete').modal('show');
    $('#delete').submit(function(e){
    e.preventDefault();
      // ajax delete data to database
      $.ajax({
        url : "<?php echo site_url('admin/Blog/ajax_delete')?>/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          //if success reload ajax table
          Swal.fire({
            title: 'Data blog!',
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
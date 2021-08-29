 <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url('assets_admin/vendors/js/vendor.bundle.base.js') ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo base_url('assets_admin/vendors/chart.js/Chart.min.js') ?>"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url('assets_admin/js/off-canvas.js') ?>"></script>
    <script src="<?php echo base_url('assets_admin/js/hoverable-collapse.js') ?>"></script>
    <script src="<?php echo base_url('assets_admin/js/misc.js') ?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?php echo base_url('assets_admin/js/todolist.js') ?>"></script>
    <!-- End custom js for this page -->
    <!-- CKEDITOR -->
    <script src="<?php echo base_url('assets_admin/ckeditor/ckeditor.js')?>"></script>
    <script src="<?php echo base_url('assets_admin/ckeditor/adapters/jquery.js')?>"></script>
    <script src="<?php echo base_url('assets_admin/js/file-upload.js')?>"></script>
    <!-- End CKEDITOR -- >
    <!-- Sweetalert -->
    <script src="<?php echo base_url().'assets_admin/sweetalert/sweetalert2.all.min.js'?>"></script>
    <!-- End Sweetalert -->
    <!-- Datatables -->
    <script src="<?php echo base_url('assets_admin/datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    <script src="<?php echo base_url('assets_admin/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets_admin/datatables/js/dataTables.responsive.min.js') ?>"></script>
    <script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integritas="SHA384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9 / 5WLra3rrnMcyTyOnh"  crossorigin="anonymous"> </script>

    <?php if($this->uri->segment(2) == 'Blog') : ?>  
      <?php $this->load->view('admin/crudAjax/blog/crudBlog'); ?>
    <?php endif ?>
    <?php if($this->uri->segment(2) == 'Produk') : ?>
      <?php $this->load->view('admin/crudAjax/produk/crudProduk'); ?>
    <?php endif ?>
    <?php if($this->uri->segment(2) == 'Kategori') : ?>
      <?php $this->load->view('admin/crudAjax/kategori/crudKategori'); ?>
    <?php endif ?>
    <!-- End datatables -->

    <script>
        $(function() {
          $('textarea.texteditor').ckeditor();
          // CKEDITOR.replace('isi');
        });
    </script>

    <?php if ($this->uri->segment(2) == 'Dashboard') : ?>
        <?php
    /* Mengambil query report*/
    foreach($grafik as $result){
        $bulan[] = $result->bulan; //ambil bulan
        $value[] = (float) $result->ip; //ambil nilai
    } ?>
      <?php
    /* Mengambil query report*/
    foreach($grafikphi as $result){
        $bul[] = $result->day;//ambil bulan
        $val[] = (float) $result->ip; //ambil nilai
    } ?>
      <?php
    /* Mengambil query report*/
    foreach($grafikpo as $result){
        $day[] = $result->day;//ambil bulan
        $on[] = (float) $result->ip; //ambil nilai
    } ?>
    <script type="text/javascript">
      $(function(){
        var areaData = {
        labels: <?php echo json_encode($bulan);?>,
        datasets: [{
            label: '# Orang',
            data: <?php echo json_encode($value);?>,
            backgroundColor: [
            'rgba(3, 73, 252, 0.26)'
            ],
            borderColor: [
            'rgba(3, 73, 252, 0.76)',
            'rgba(255,99,132,1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            fill: true, // 3: no fill
          }]
        };
        var areaOptions = {
          plugins: {
            filler: {
              propagate: true
            }
          }
        }
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        var areaChart = new Chart(areaChartCanvas, {
          type: 'line',
          data: areaData,
          options: areaOptions
        });
      });
    </script>
    <?php endif; ?>
    <script type="text/javascript">
      
      var socket = io.connect('http://'+window.location.hostname+':3000', {
        secure: true,
        transports: ['websocket', 'polling'],
      });

      socket.on('new_message', function(data) {
        // var base_url = '<?= base_url(); ?>';
        // $('#namemsg').prepend('<div class="dropdown-divider"></div>'+
        //         '<a class="dropdown-item preview-item detailkontak" data="'+data.id_inbox+'">'+
        //           '<div class="preview-thumbnail">'+
        //             '<img src="'+base_url+'assets_admin/images/faces/face4.jpg'+'" alt="image" class="profile-pic">'+
        //           '</div>'+
        //           '<div class="preview-item-content d-flex align-items-start flex-column justify-content-center">'+
        //             '<h6 class="preview-subject ellipsis mb-1 font-weight-normal">'+data.nama+'</h6>'+
        //             '<p class="text-gray mb-0">'+data.tanggal+'</p>'+
        //           '</div>'+
        //         '</a>');
        // // $("#hitung").html(data.hitung);
        // if(data.hitung > 0){
        //   console.log(data.hitung);
        //   // $("#hitung").addClass('count-symbol bg-warning');
        //   $('#ttl').html('<div class="dropdown-divider"></div><h6 class="p-3 mb-0 text-center">'+data.hitung+' '+'pesan baru'+'</h6>');
        // }else{
        //   $('#ttl').hide();
        // }
        get_status();
      });

      function get_status()
        {
          $.ajax({
            type : "GET",
            async : true,
            dataType : 'json',
            url  : "<?php echo base_url()?>Contact/status_where",
            success: function(data){
                var html  = ''; // kekurangan jika database kosong sama sekali, " tidak ada notifikasi" tidak muncul
                var myObj = [];
                for ( var i = 0; i < data.length; i++ ) {
                  myObj.push(data[i]['status']);
                }
                var join = myObj.join(",").split(',').map(Number);

                var eq = join.every( (val, i, arr) => val === 0 );
                var count = 0;
                $("#namemsg").empty();
                if (eq == true) {
                  $("#hitung").removeClass('count-symbol bg-warning');
                  $('#total').empty();
                  $('#ttl').html('<div class="dropdown-divider"></div><h6 class="p-3 mb-0 text-center">Belum ada pesan</h6></div>');
                } else {
                  $.each(data, function(key, value) {
                    if (value.status == 1) {
                      count++;
                      var base_url = '<?= base_url(); ?>';
                      var a = value.tanggal;
                      var y = '<?php echo time_ago('a'); ?>';
                      console.log(y);
                      console.log(a);
                      $('#namemsg').append('<div class="dropdown-divider"></div>'+
                        '<a class="dropdown-item preview-item detailkontak" data="'+value.id_inbox+'">'+
                        '<div class="preview-thumbnail">'+
                        '<img src="'+base_url+'assets_admin/images/faces/face4.jpg'+'" alt="image" class="profile-pic">'+
                        '</div>'+
                        '<div class="preview-item-content d-flex align-items-start flex-column justify-content-center">'+
                        '<h6 class="preview-subject ellipsis mb-1 font-weight-normal">'+value.nama+'</h6>'+
                        '<p class="text-gray mb-0">'+y+'</p>'+
                        '</div>'+
                        '</a>');
                    }
                  });
                  $("#hitung").addClass('count-symbol bg-warning');
                  $('#ttl').empty();
                  $('#total').html('<div class="dropdown-divider"></div><h6 class="p-3 mb-0 text-center">'+count+' '+'pesan baru'+'</h6>');
                }


              // var html = '';
              // var i;
              // var x = data.getData

              // for(i=0; i<x.length; i++){
              //   if(x[i].status == '1'){
              //     var base_url = '<?= base_url(); ?>';
              //     html +='<div class="dropdown-divider"></div>'+
              //     '<a class="dropdown-item preview-item detailkontak" data="'+x[i].id_inbox+'">'+
              //     '<div class="preview-thumbnail">'+
              //     '<img src="'+base_url+'assets_admin/images/faces/face4.jpg'+'" alt="image" class="profile-pic">'+
              //     '</div>'+
              //     '<div class="preview-item-content d-flex align-items-start flex-column justify-content-center">'+
              //     '<h6 class="preview-subject ellipsis mb-1 font-weight-normal">'+x[i].nama+'</h6>'+
              //     '<p class="text-gray mb-0">'+x[i].tanggal+'</p>'+
              //     '</div>'+
              //     '</a>';
              //   }
              // }
              // $('#namemsg').html(html);
              // if(data.hitung > 0){
              //    // $('#ttl').hide();
              //    $("#hitung").html(data.hitung);
              //    console.log(data.hitung);
              //    $('#ttl').html('<div class="dropdown-divider"></div><h6 class="p-3 mb-0 text-center">'+data.hitung+' '+'pesan baru'+'</h6>');
              // }else{
              //     console.log(data.hitung);
              //     $('#ttl').hide();
              //     $("#hitung").html(data.hitung);
              //     $('#namemsg').html('<div class="dropdown-divider"></div><h6 class="p-3 mb-0 text-center">Belum ada pesan</h6></div>');
              //     // $("#hitung").hide();
              // }
            }
          });
        }

       $(document).ready(function(){
         $('#namemsg').on('click','.detailkontak',function(){
          var id=$(this).attr('data');
          $.ajax({
            type : "GET",
            url  : "<?php echo base_url()?>Contact/getpesanKontak",
            dataType : "JSON",
            data : {id:id},
              success: function(data){
                console.log(data);
                $.each(data,function(id_inbox,nama, nohp, email,pesan){
                  $('#showmodal').modal('show');
                  $('#idKontak').val(data.id_inbox);
                  $('#namaKontak').val(data.nama);
                  $('#notlpKontak').val(data.nohp);
                  $('#emailKontak').val(data.email);
                  $('#pesanKontak').val(data.pesan);
                });
              }
            });
        })

        $('#sudahdibaca').on("click", function(e) {
          event.preventDefault();
          var id_inbox = $('[name="id_inbox"]').val();
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url()?>Contact/update_status",
            data : {id_inbox:id_inbox},
            success: function(data){
              $('#showmodal').modal('hide');
              get_status();
            }
          });
        })
        
        get_status();
      });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="showmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-body">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="hidden" name="id_inbox" class="form-control" id="idKontak">
                <input type="text" name="nama" class="form-control" id="namaKontak">
              </div>
              <div class="form-group">
                <label for="notlp">No telepon</label>
                <input type="text" name="notlp" class="form-control" id="notlpKontak">
              </div>
              <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" name="email" class="form-control" id="emailKontak">
              </div>
              <div class="form-group">
                <label for="pesan">Pesan</label>
                <input type="text" name="pesan" class="form-control" id="pesanKontak">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-gradient-danger btn-fw" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-gradient-info btn-fw" id="sudahdibaca">Tandai sudah dibaca</button>
          </div>
        </div>
      </div>
    </div>
</html>

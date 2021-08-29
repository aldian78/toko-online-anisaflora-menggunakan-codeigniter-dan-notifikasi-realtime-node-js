<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Blog </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/Blog') ?>">Blog</a></li>
          <li class="breadcrumb-item active" aria-current="page">Pages</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Pages blog admin</h4>
            <a class="btn btn-sm btn-gradient-success" href="<?php echo base_url('admin/Blog/page_create') ?>"><i class="mdi mdi-plus"></i></a>
            <button class="btn btn-sm btn-gradient-dark" id="reload"><i class="mdi mdi-refresh"></i></button>
            <br></br>
            <table id="table" class="table table-striped" cellspacing="0" style="width:100%">
              <thead>
                <tr>
                  <th> Gambar </th>
                  <th> Judul </th>
                  <th> Tanggal </th>
                  <th> Kategori </th>
                  <th style="text-align: center;"> Action </th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <!-- Modal delete Product-->
      <form class="forms-sample" id="delete" method="post">
         <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <strong>Apakah anda yakin ingin menghapus blog ini ?</strong>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-gradient-dark" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-gradient-danger">Ya</button>
                  </div>
                </div>
            </div>
         </div>
     </form>
  </div>

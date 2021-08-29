<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Kategori </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/Produk') ?>">Kategori</a></li>
          <li class="breadcrumb-item active" aria-current="page">Pages</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Pages Kategori admin</h4>
             <button class="btn btn-sm btn-gradient-success" onclick="add_person()"><i class="mdi mdi-plus"></i></button>
            <button class="btn btn-sm btn-gradient-dark" id="reload"><i class="mdi mdi-refresh"></i></button>
            <br></br>
            <table id="tabelkat" class="table table-striped" cellspacing="0" style="width:100%">
              <thead>
                <tr>
                  <th> Gambar </th>
                  <th> Nama kategori </th>
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
    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
              <input type="hidden" value="" name="id"/> 
              <div class="form-body">
                <div class="form-group">
                  <label for="exampleInputName1">Nama kategori</label>
                  <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Nama kategori" />
                  <span class="invalid-feedback" id="namKat"></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Gambar</label>
                  <input type="file" name="gambar" id="gambar" class="form-control" onchange="return readImage()"/>
                  <span class="invalid-feedback" id="remove"></span>
                  <span class="invalid-feedback" id="fail_upload_msg"></span>
                </div>
                <div class="preview_holder">
                <div id="preview">
                  <div id="valueimage"></div>
                  <div id="uploadPreview"></div>
                  <span id="preview_text" class="preview_text"><p><strong>Max 1 image</strong></p></span>
                </div>
              </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-gradient-danger">Save</button>
            <button type="button" class="btn btn-gradient-dark" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->
  <!-- Modal delete Product-->
      <form class="forms-sample" id="deleteProduk" method="post">
         <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <input type="hidden" name="product_code" class="form-control" required>
                      <strong>Apakah anda yakin ingin menghapus kategori ini ? <i class="text-danger"> Produk sesuai kategori juga akan terhapus ! </i></strong>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-gradient-dark" data-dismiss="modal" id="cancel">Cancel</button>
                      <button type="submit" class="btn btn-gradient-danger">Ya</button>
                  </div>
                </div>
            </div>
         </div>
     </form>
  </div>

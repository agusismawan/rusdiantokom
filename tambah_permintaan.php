<?php include "head.php" ?>
<!-- <?php
  if (isset($_GET['action']) && $_GET['action']=="tambah_barang") {
    include "tambah_barang.php";
  }
  else if (isset($_GET['action']) && $_GET['action']=="edit_barang") {
    include "edit_barang.php";
  }
  else{
    ?> -->
    <script type="text/javascript">
      <?php  
      date_default_timezone_set("Asia/Jakarta");
      $id =  "REQ-".date("ymd", strtotime(date('Y-m-d'))).date('Hi');
      ?> 
      document.title="Permintaan Barang";
      document.getElementById('tambah_permintaan').classList.add('active');
    </script>
    <script type="text/javascript" src="assets/jquery.tablesorter.min.js"></script>
    <script type="text/javascript">
      $(function(){
        $.tablesorter.addWidget({
          id:"indexFirstColumn",
          format:function(table){
            $(table).find("tr td:first-child").each(function(index){
              $(this).text(index+1);
            })
          }
        });
        $("table").tablesorter({
          widgets:['indexFirstColumn'],
          headers:{
            0:{sorter:false},
            3:{sorter:false},
            4:{sorter:false},
            5:{sorter:false},
            6:{sorter:false},
            7:{sorter:false},
          }
        });
      });
    </script>
    <div class="content">
      <div class="padding">
        <div class="bgwhite">
          <div class="padding">
            <div class="contenttop">
              <div class="right">
                <script type="text/javascript">
                  function gotocat(val){
                    var value=val.options[val.selectedIndex].value;
                    window.location.href="tambah_permintaan.php?id_cat="+value+"";
                  }
                </script>
                <select class="leftin1" onchange="gotocat(this)">
                  <option value="">Semua Kategori</option>
                  <?php
                  $data=$root->con->query("select * from kategori");
                  while ($f=$data->fetch_assoc()) {
                    ?>
                    <option <?php if (isset($_GET['id_cat'])) { if ($_GET['id_cat'] == $f['id_kategori']) { echo "selected"; } } ?> value="<?= $f['id_kategori'] ?>"><?= $f['nama_kategori'] ?></option>
                    <?php
                  }
                  ?>
                </select>
                <form class="leftin">
                  <input type="search" name="q" placeholder="Cari Barang..." value="<?php echo $keyword=isset($_GET['q'])?$_GET['q']:""; ?>">
                  <button><i class="fa fa-search"></i></button>
                </form>
              </div>
              <div class="both"></div>
            </div>

            <div>
              <form action="handler.php?action=tambah_permintaan_barang" method="post">
                <h2>Form Permintaan Barang</h2>
                <table width="40%"" border="0">
                  <tr>
                    <td><h4>Kode Permintaan</td>
                    <td>

                      <h4><input type="text" name="kode_permintaan" readonly value="<?php echo $id ?>"></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal Permintaan</td>
                    <td><input type="date" class="form-control" name="tgl_permintaan" value="<?php echo date('Y-m-d') ?>" /></td>
                  </tr>
                  <tr>
                    <td>Keterangan Permintaan</td>
                    <td><input type="text" class="form-control" name="ket_permintaan" placeholder="Keterangan Permintaan" /></td>
                  </tr> 
                </table> </h4>
                
                <span class="label">Jumlah Barang : <?= $root->show_jumlah_barang() ?></span>
                <table class="datatable" id="datatable">
                  <thead>
                    <tr>
                      <th width="10px">#</th>
                      <th width="50px">Kode Barang</th>
                      <th style="cursor: pointer;">Nama Barang <i class="fa fa-sort"></i></th>
                      <th style="cursor: pointer;" width="100px">Kategori <i class="fa fa-sort"></i></th>
                      <th width="120px">Merk</th>
                      <th width="150px">Supplier</th>
                      <th>Stok</th>
                      <th width="60px">Jumlah Permintaan</th>
                    </tr>
                  </thead>
                  <button type="submit" style="background: #41b3f9;color: #fff;border-radius: 3px;border-color: #41b3f9;border:1px solid #41b3f9;padding: 7px"><i class="fa fa-send"></i> Submit</button> 
                  <tbody>
                    <?php
                    if (isset($_GET['id_cat']) && $_GET['id_cat']) {
                      $root->tampil_permintaan_barang_filter($_GET['id_cat']);
                    }else{
                      $root->tampil_permintaan_barang($keyword);
                    }
                    ?>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php 
  }
  include "foot.php" ?>
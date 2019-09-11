<?php include 'root.php' ?>

<!DOCTYPE html>
  <head>
    <title>Home - Rusdianto Komputer</title>

    <script type="text/javascript" src="assets/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" src="assets/DataTables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/dataTables.bootstrap.css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-post.css" rel="stylesheet">
    
  </head>

  <body>
    <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="assets/img/logo.png" width="35px"> &nbsp; <strong>Rusdianto Komputer</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login_view.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <br><br>
          <h1 class="mt-4">List Product Update</h1>
          <hr>

          <!-- Preview Image -->
          <img class="img-fluid rounded" src="assets/img/header-post.png" alt="">

          <hr>

          <!-- Post Content -->
          <span class="label">Jumlah Barang : <?= $root->show_jumlah_barang() ?></span>
          <br><br>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover data">
                    <thead>
                      <tr>      
                          <!-- <th>#</th> -->
                          <th>Nama Barang</th>
                          <th>Kategori</th>
                          <th>Merek</th>
                          <th>Harga</th>
                          <th>Stok</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $root->tampil_barang_pelanggan($keyword); ?>
                    </tbody>
                  </table>
                </div>
          <hr>
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <form>
              <div class="input-group">
                <input type="search" name="q" class="form-control" placeholder="Search..." value="<?php echo $keyword=isset($_GET['q'])?$_GET['q']:""; ?>">
                <button class="btn btn-secondary">Go!</button>
              </div>
            </form>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Sosial Media</h5>
              <div class="card-body">
                <div class="col-lg-10">
                  <div class="fb-page" data-href="https://www.facebook.com/rusdiantokomputer" data-tabs="timeline" data-width="340" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/rusdiantokomputer" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/rusdiantokomputer">Rusdianto Komputer</a></blockquote>
                  </div>        
              </div>
            </div>
          </div>

          <!-- Side Widget -->
<!--           <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div> -->

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Rusdianto Komputer 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.data').DataTable();
      });
    </script>

  </body>

</html>

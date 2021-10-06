<?php 

$this->load->view('nav');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  

  <div class="content-wrapper">
  <div>
    <?php
    if (!empty($this->session->flashdata('error'))) {
      echo ("<div class='alert alert-danger'>" . $this->session->flashdata('error') . "</div>");
    }
    ?>
    <?php
    if (!empty($this->session->flashdata('success'))) {
      echo ("<div class='alert alert-success'>" . $this->session->flashdata('success') . "</div>");
    }
    ?>
  </div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Product Type</h1>
            <form action="logout" method="post">
          </div>
          <button type="submit" name="logout" algin ='center' class="btn btn-secondary">Logout</button>
          </form>
        </div>
      </div>
    </div>
    <div class="conatiner">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ADD PRODUCT TYPE</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="pname">Product Type</label>
                    <input type="text" class="form-control" id="pname" name="pname" placeholder="Product Name">
                  </div>
                  <div class="form-group">
                    <label for="price">Product Subtype</label>
                    <input type="number" name="price" class="form-control" id="price" >
                  </div>
                  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" value="upload">Submit</button>
                </div>
              </form>
            </div>

 
  </div>

  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>

      CKEDITOR.replace('prod_desc');
    </script>
</body>
</html>

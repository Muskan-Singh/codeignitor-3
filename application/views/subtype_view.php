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
            <h1 class="m-0">Add Product Subtype</h1>
            <form action="logout" method="post">
          </div>
          <button type="submit" name="logout" algin ='center' class="btn btn-secondary">Logout</button>
          </form>
        </div>
      </div>
    </div>
    <div class="container">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ADD PRODUCT SUBTYPE</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post"  action =""enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="pname">Product Subtype</label>
                    <input type="text" class="form-control" id="sub_name" name="sub_name" placeholder="Product Subtype">
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name = "submit" class="btn btn-primary" value="upload">Submit</button>
                </div>
              </form>
            </div>


            <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Table</h1>
            <form action="" method="post">
          </div>
         
          </form>
        </div>
      </div>
    </div>
    <div class="container">
    <div class="card card-primary">
              <div class="card-header">
                <h2 class="card-title">LIST OF PRODUCT TYPE</h2>
              </div>

              <form method="post"  action ="">
                <div class="card-body">
                  <div class="form-group">

                <table class = "table">

                  <tr>

                    <td>Product ID</td>
                    <td>Product Name</td>
                    <td>Update</td>
                    <td>Delete</td>
                  </tr>

                


                </table>

                </form>

            </div>
            </div>
            </div>
            </div>
 

 
  </div>

  

  

<script>

      CKEDITOR.replace('prod_desc');
    </script>
</body>
</html>

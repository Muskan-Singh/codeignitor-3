
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

    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Product Gallery</h1>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Gallery</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title">Manage your products</h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="filter-container p-0 row">
                                            <div class="card-columns">
                                              
                                                 <?php if ($result) 
                                                 {
                                                    //  dd($result);
                                                    foreach ($result as $d) {
                                                        if(!empty($d)){
                                                            
                                                  ?>
                                                        <div class="container">
                                                            <div class="card" style="width: 18rem;">
                                                            <img src="./uploads/<?php  ?>" class="card-img-top" alt="Oops!!!" height="100%" width="30%">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $d->pname; ?></h5>
                                                                <p class="card-text"><?php echo $d->prod_desc; ?></p>
                                                                <a href="mainProdCont?id=<?php echo $d->prod_id; ?>" class="btn btn-primary">Open</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                  
                                                  <?php } }
                                                  } ?>
                                        </div>

                                        <nav >
                                            <div class="container">
                                                <?=$links?>
                                            </div>
                                        </nav>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

</body>

</html>
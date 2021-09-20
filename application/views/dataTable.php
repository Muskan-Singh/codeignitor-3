<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Codeigniter 4 Datatables Example - positronx.io</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

</head>
<body>

<div class="container mt-5">
  <div class="mt-3">
     <table class="display" id="table">
       <thead>
          <tr>
             <th>User_Id</th>
             <th>Full Name</th>
             <th>Email</th>

          </tr>
       </thead>
       <!-- <tbody>
  
          
          <?php foreach($listss as $user): ?>
          <tr>
             <td><?php echo $user['user_id']; ?></td>
             <td><?php echo $user['full_name']; ?></td>
             <td><?php echo $user['email']; ?></td>
          </tr>
         <?php endforeach; ?>
         
       </tbody> -->
     </table>
  </div>
</div>
 
<script type="text/javascript">
  $(document).ready(function() {
 
    //datatables
    $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            url: "<?= base_url('ProductController/DataTable') ?>",
            type: "GET"
        },
        // $output = array(
				// 		"recordsTotal" => $this->customers->count_all(),
				// 		"recordsFiltered" => $this->customers->count_filtered(),
				// 		"data" => $data,
				// );
 
        //Set column definition initialisation properties.
        
 
    });
 
});
</script>



</body>
</html>
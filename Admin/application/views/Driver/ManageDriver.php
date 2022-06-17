<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Driver Details
      <hr/>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Driver</a></li>
        <li class="active">View Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Driver Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="display:none;">#</th>
                  <th>Name</th>
                  <th>NIC</th>
                  <th>Vehicle No</th>
                  <th>Contact No</th>
                  <th>Location</th> 
                </tr>
                </thead>
                <tbody>
                    
                    <?php 

                      foreach ($All_Driver as $item) { ?>
                        
                       <tr>
                         <td style="display: none"><?php echo $item['id']; ?></td>
                         <td><?php echo $item['name']; ?></td>
                         <td><?php echo $item['nic']; ?></td>
                         <td><?php echo $item['vehiNo']; ?></td>
                         <td><?php echo $item['conNo']; ?></td>
                         <td>
                                  <a class="btn btn-primary" href="<?php echo base_url()?>index.php/Driver/DriverLocation?id=<?php echo $item['nic']; ?>" onclick="deleteRow(this);" aria-label="Delete">
                                  <i class="fa fa-street-view" aria-hidden="true"></i></a>

                         </td>
                       </tr>

                        <?php
                      }

                     ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- page script -->
<script>
  $(function () {
   $("#example1").DataTable();



    // $('#example1').DataTable({
    //   "paging": true,
    //   "lengthChange": true,
    //   "searching": true,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": true
    // });
  });






</script>
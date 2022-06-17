<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      School 
      <hr/>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View School Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="display:none;">#</th>
                  <th>School Name</th>
                  <th>Location</th>
                </tr>
                </thead>
                <tbody>
								
                    <?php
											
											foreach($All_School as $item){
												?>
												<tr>
												<td style="display:none;"><?php echo $item['id']; ?></td>
												<td><?php echo $item['name']; ?></td>
												<td><?php echo $item['location']; ?></td>

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

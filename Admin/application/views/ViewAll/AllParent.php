<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Parent Details
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
              <table id="example12" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="display:none;">#</th>
                  <th>Name</th>
                  <th>NIC</th>
                  <th>Address</th>
                  <th>Contact No</th>
                  <th>Email</th>
                  <th>Children</th>
                </tr>
                </thead>
                <tbody>
                    
                    <?php 

                      foreach ($All_Parent as $item) { ?>
                        
                       <tr>
                         <td style="display: none"><?php echo $item['id']; ?></td>
                         <td><?php echo $item['name']; ?></td>
                         <td><?php echo $item['nic']; ?></td>
                         <td><?php echo $item['address']; ?></td>
                         <td><?php echo $item['tel']; ?></td>
                         <td><?php echo $item['email']; ?></td>
                         <td><a href="#" onclick="show(this)" class="btn btn-success">SHOW</a></td>
                        
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

            <!--Non-Register Cus Modal -->
    <div class="modal fade" id="myModalShow" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Children List</h4>
          </div>
          <div class="modal-body">
               
            <table id="example1" class="table">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>School</th>
                </tr>
                </thead>
                <tbody>
                    
                    

                </tbody>
              </table>

       
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>





  </div>
  <!-- /.content-wrapper -->
  <!-- page script -->
<script>
  $(function () {
   $("#example12").DataTable();



    // $('#example1').DataTable({
    //   "paging": true,
    //   "lengthChange": true,
    //   "searching": true,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": true
    // });
  });

   function show(obj) {

        $("#example1 tbody tr").remove();

         var currentRow = $(obj).closest('tr');

          var id=currentRow.find("td:eq(2)").text();

          //alert(id);

          var dbChildren = <?php echo json_encode($All_Children); ?>;

          for (var i = 0; i < dbChildren.length; i++) {

            var dbOid = dbChildren[i]['parentid'];

              if(id == dbOid){

                var dbName = dbChildren[i]['name'];
                var dbSchool = dbChildren[i]['school'];

               var markup = "<tr><td>" + dbName + "</td><td>" + dbSchool + "</td></tr>";


                $("#example1 tbody").append(markup);

              }

               $('#myModalShow').modal('show');



          }




  }






</script>
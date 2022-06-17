<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Service 
        <br/>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Service</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Service</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="leAddaccount" method="post">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="txt_name">Name</label>
                      <input type="text" class="form-control" id="txtName" name="txtName"  required >
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                      <label for="txt_name">Contact</label>
                      <input type="text" class="form-control" id="txtContact" name="txtContact"  required >
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

        <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">View Area Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="display:none;">#</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Manage</th>
                </tr>
                </thead>
                <tbody>

                   <?php 

                      foreach ($All_Item as $item) { ?>
                        
                       <tr>
                         <td style="display: none"><?php echo $item['id']; ?></td>
                         <td><?php echo $item['name']; ?></td>
                         <td><?php echo $item['contact']; ?></td>
                         <td>
                           <a class="btn btn-danger" href="#" onclick="deleteRow(this);" aria-label="Delete">
                                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                          </a>
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




  </div>

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

  $('#leAddaccount').submit(function (e) {

    $("#txtName").val().toUpperCase()
     
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url() ?>index.php/Service/SaveItem',
                type: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (status, data)
                {
                    console.log(status);
                    console.log(data);
                    var o = jQuery.parseJSON(status);
                    console.log(status);
                    console.log(data);

                    if (o.status !== 'error')
                    {
                            alertify.logPosition("bottom right");
                            alertify.success("Saved Successfull..");
                            $("#txtName").val("");
                            location.reload();

                    } else {
                        alertify.logPosition("bottom right");
                        alertify.error(o.msg);
                        console.log(o.msg)
                    }
                }
            });
    }); 



  </script>
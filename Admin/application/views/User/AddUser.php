<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Register User
        <br/>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Register User</a></li>
        <li class="active">Add user</li>
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
              <h3 class="box-title">Add User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="leAddaccount" method="post">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="txt_name">Full Name</label>
                      <input type="text" class="form-control" id="txtfName" name="txtfName" placeholder="Full Name" required>
                  </div>

                  <div class="form-group">
                      <label for="txt_name">User Name</label>
                      <input type="text" class="form-control" id="txtuName" name="txtuName" placeholder="User Name" required>
                  </div>

                  <div class="form-group">
                      <label for="txt_name">User Type</label>
                      <select class="form-control" name="txtuType" id="txtuType" style="text-transform: uppercase">
                          <option value="Admin">Admin</option>
                          <option value="Cashier">Cashier</option>
                      </select> 
                  </div>
                  
                  <div class="form-group">
                      <label for="txt_name">Password</label>
                      <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password" required>
                  </div>

                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success col-sm-6">Save</button>
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


  </div>

  <script>


  $(function () {
      
  });
  $('#leAddaccount').submit(function (e) {

    // $("#txtName").val().toUpperCase()

    console.log("run");
     
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url() ?>index.php/Login/Save',
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
                            alertify.success("User Registered Successfull..");
                            $("#txtuName").val("");
                            $("#txtfName").val("");
                            $("#txtPassword").val("");
                            // location.reload();

                    } else {
                        alertify.logPosition("bottom right");
                        alertify.error(o.msg);
                        console.log(o.msg)
                    }
                }
            });
    }); 


   


  </script>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Driver 
        <br/>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Driver</a></li>
        <li class="active">Add Driver</li>
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
              <h3 class="box-title">Add Driver</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-6">

                  <div class="form-group">
                      <label for="txt_name">Name</label>
                      <input type="text" class="form-control" id="txtName" name="txtName">
                  </div>

                  <div class="form-group">
                      <label for="txt_name">NIC ( Nic Use as UserName )</label>
                      <input type="text" class="form-control" id="txtNic" name="txtNic">
                  </div>

                  <div class="form-group">
                      <label for="txt_name">Vehicle Number</label>
                      <input type="text" class="form-control" id="txtVehiNo" name="txtVehiNo">
                  </div>

                  <div class="form-group">
                      <label for="txt_name">Contact Number</label>
                      <input type="text" class="form-control" id="txtConNo" name="txtConNo">
                  </div>

                  <div class="form-group">
                      <label for="txt_name">Password</label>
                      <input type="password" class="form-control" id="txtpassword" name="txtpassword">
                  </div>

                </div>
              </div>
              <div class="box-footer">
                <button  class="btn btn-primary col-md-2" onclick="validate()">Save</button>
                <button type="reset" class="btn btn-danger col-md-2" style="margin-left: 5px">Clear</button>
              </div>
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

    function validate() {
      
      var name = $('#txtName').val().trim();
      var nic = $('#txtNic').val().trim();
      var vehiNo = $('#txtVehiNo').val().trim();
      var conNo = $('#txtConNo').val().trim();
      var pw = $('#txtpassword').val().trim();

      if(name == "" || nic == "" || vehiNo == "" || conNo == "" || pw == ""){
        swal("Empty Field", "Please Fill Details(Name, Nic, Vehicle No, Contact No, Password)", "error");
        //alert("Please Fill Details(Name, Nic, Vehicle No, Contact No)");
      }else{
        saveData(name, nic, vehiNo,conNo,pw);
      }

    }

    function saveData(name,nic,vehiNo,conNo,pw) {

                $.ajax({
                url: '<?php echo base_url() ?>index.php/Driver/SaveDriver',
                type: 'post',
                data: { name:name, nic:nic, vehiNo:vehiNo, conNo:conNo, pw:pw },
                success: function (status, data)
                {
                    console.log(status);
                    console.log(data);
                    var o = jQuery.parseJSON(status);
                    console.log(status);
                    console.log(data);

                    if (o.status !== 'error')
                    {
                             swal("Success", o.msg, "success");
                           
                            console.log(o.msg);
                            clearField();

                    } else {
                        // alertify.logPosition("bottom right");
                        // alertify.error(o.msg);
                        swal("Success", o.msg, "success");
                        console.log(o.msg);
                    }
                }
            });
    }

    function clearField(){

     name = $('#txtName').val("");
     nic = $('#txtNic').val("");
     vehiNo = $('#txtVehiNo').val("");
     conNo = $('#txtConNo').val("");


    }


  </script>
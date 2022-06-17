<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Driver Current Location
      <hr/>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Driver</a></li>
        <li class="active">View </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <div id="map" style="width: 200; height: 500px"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


              
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

  function initMap() {

    var ItemFromDB = <?php echo json_encode($All_Driver); ?>;

    var dblng = parseFloat(ItemFromDB[0]['lat']);
    var dblat = parseFloat(ItemFromDB[0]['lng']);


    // console.log(dblng);




    var myLatLng = {lat: dblat, lng: dblng};

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: myLatLng
    });

    var iconBase = 'http://icons.iconarchive.com/icons/matthew-kelleigh/mac-town-vol2/32/';
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      icon: iconBase + 'School-Bus-2-icon.png',
      title: 'Hello World!'
    });


    
}







</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      School 
        <br/>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">School</a></li>
        <li class="active">Add School</li>
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
              <h3 class="box-title">Add School</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-6">

                  <div class="form-group">
                      <label for="txt_name">School Name</label>
                      <input type="text" class="form-control" id="txtName" name="txtName">
                  </div>

                  <div class="form-group">
                      <label for="txt_name">Location:</label>
                      <input type="text" class="form-control" id="searchInput" name="txtLocation">
                  </div>
                  
                </div>
              </div>
              <div class="box-footer">
                <button class="btn btn-primary col-md-2" onclick="saveData()">Save</button>
              </div>

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
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div id="map" style="width: 200; height: 500px"></div>
            <ul id="geoData">
                <li>Full Address: <span id="location"></span></li>
                <li>Postal Code: <span id="postal_code"></span></li>
                <li>Country: <span id="country"></span></li>
                <li>Latitude: <span id="lat"></span></li>
                <li>Longitude: <span id="lon"></span></li>
            </ul>
           
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


function saveData() {

    //validate 
    var location =  $('#searchInput').val();
    var name =  $('#txtName').val().trim();
    var lat = $('#lat').text();
    var log = $('#lon').text();

    if(name == "" || location == ""){
      swal("Empty Field", "Please Fill Details(School Name , Location)", "error");
      return;
    }
 
    console.log(location + name + lat + log);
     
                $.ajax({
                url: '<?php echo base_url() ?>index.php/School/SaveSchool',
                type: 'post',
                data: { location:location, name:name, lat:lat, lon:log },
                success: function (status, data)
                {
                    console.log(status);
                    console.log(data);
                    var o = jQuery.parseJSON(status);
                    console.log(status);
                    console.log(data);

                    if (o.status !== 'error')
                    {
                            swal("Success","School detail saved Successfull..", "success");

                            $('#txtName').val("");
                            $('#searchInput').val("");


                    } else {
                        alertify.logPosition("bottom right");
                        alertify.error(o.msg);
                        console.log(o.msg);
                    }
                }
            });
    }




function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat:  6.927079, lng: 79.861244},
      zoom: 13
    });
    var options = { componentRestrictions: { country: 'LK'} };
    var input = document.getElementById('searchInput');
    //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input,options);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        //Location details
        for (var i = 0; i < place.address_components.length; i++) {
            if(place.address_components[i].types[0] == 'postal_code'){
                document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'country'){
                document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }
        }
        document.getElementById('location').innerHTML = place.formatted_address;
        document.getElementById('lat').innerHTML = place.geometry.location.lat();
        document.getElementById('lon').innerHTML = place.geometry.location.lng();
    });
}




  </script>


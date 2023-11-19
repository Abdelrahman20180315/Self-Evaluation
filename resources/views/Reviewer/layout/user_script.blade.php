      <script src="UserFront/js/jquery.min.js"></script>
      <script src="UserFront/js/popper.min.js"></script>
      <script src="UserFront/js/bootstrap.bundle.min.js"></script>
      <script src="UserFront/js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="UserFront/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="UserFront/js/custom.js"></script>
      <script>
         // This example adds a marker to indicate the position of Bondi Beach in Sydney,
         // Australia.
         function initMap() {
           var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 11,
             center: {lat: 40.645037, lng: -73.880224},
             });
         
         var image = 'UserFront/images/maps-and-flags.png';
         var beachMarker = new google.maps.Marker({
             position: {lat: 40.645037, lng: -73.880224},
             map: map,
             icon: image
           });
         }
      </script>
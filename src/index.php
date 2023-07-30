<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Task</title>
  <style>
.flex-container {
  /* display: flex; */
  background-color: #f1f1f1;
  text-align: -webkit-center;
}

.flex-container > div {
  
  background-color: #0c345a;
  color: white;
  width: 50%;
  margin-bottom: 10px;
  font-size: 30px;
  padding: 5px;
}
.room{
  margin-bottom: 10px;
}
small{
  font-size: 20px;
}

  </style>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>
<body>

<div id="hotels" class="flex-container"> </div>
 
<script>
(function() {
  var url = "./src/API/hotels.php";
  $.getJSON(url)
    .done(function( data ) {
      $.each( data, function( i, item ) {
        let tr = "<div class='hotel'>";
        tr = tr + "<b>"+item.hotel_name+": Room("+item.code+")</b><br><small>("+item.hotel_stars+" Stars)</small>";
        tr = tr + "<div class='room'>€"+item.total+"</div>";
        tr = tr + "</div>";
        $( tr ).appendTo( "#hotels" );
        // if ( i === 3 ) {
        //   return false;
        // }
      });
    });
})();
</script>
 
</body>
</html>
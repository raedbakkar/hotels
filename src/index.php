<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Task</title>
  <style>
.flex-container {
  display: flex;
  background-color: #f1f1f1;
}

.flex-container > div {
  background-color: DodgerBlue;
  color: white;
  width: 33%;
  margin: 10px;
  text-align: center;
  font-size: 30px;
  padding: 5px;
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
  $.getJSON( url, {
    tags: "mount rainier",
    tagmode: "any",
    format: "json"
  })
    .done(function( data ) {
      $.each( data, function( i, item ) {
        let tr = "<div class='hotel'>";
        tr = tr + "<b>"+item.name+"</b><br><small>("+item.stars+" Stars)</small>";
        tr = tr + "<div class='room'>"+item.rooms[0].code+"</div>";
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
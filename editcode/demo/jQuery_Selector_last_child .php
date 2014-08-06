<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>last-child demo</title>
  <style>
  span.solast {
    text-decoration: line-through;
  }
  </style>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
 
<div>
  <span>John,</span>
  <span>Karl,</span>
  <span>Brandon,</span>
  <span>Sam</span>
</div>
<div>
  <span>Glen,</span>
  <span>Tane,</span>
  <span>Ralph,</span>
  <span>David</span>
</div>
 
<script>
$( "div span:last-child" )
  .css({ color:"red", fontSize:"80%" })
  .hover(function() {
    $( this ).addClass( "solast" );
  }, function() {
    $( this ).removeClass( "solast" );
  });
</script>
 
</body>
</html>
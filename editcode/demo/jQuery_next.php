<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>next demo</title>
  <style>
  span {
    color: blue;
    font-weight: bold;
  }
  button {
    width: 100px;
  }
  </style>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
 
<div><button disabled="disabled">First</button> - <span></span></div>
<div><button>Second</button> - <span></span></div>
<div><button disabled="disabled">Third</button> - <span></span></div>
 
<script>
$( "button[disabled]" ).next().text( "this button is disabled" );
</script>
 
</body>
</html>
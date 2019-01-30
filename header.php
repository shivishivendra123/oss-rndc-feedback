<?php
error_reporting(0);
require_once 'connect.inc.php';
require_once 'portal.inc.php';
?>

<html>
<head>
  <style>
    .navbar{
      background-color: #64B8E9;
    }
  </style>
<title>Student Feedback</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="table2excel.js" type="text/javascript"></script>

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Anton|Playfair+Display" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="stylefeed.css"> -->
<link rel="stylesheet" href="custom/css/bootstrap.css">
<!--  <!-- Compiled and minified CSS
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">

  <!-- Compiled and minified JavaScript
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
-->
  <script type="text/javascript">
<!-- $(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $('.modal').modal();
    $('select').material_select();
  $('body').on('click',function(){
      $('select').material_select();
  })

});
   </script>
  <style type="text/css">
  .prmodal {max-height: 70% !important }
@media print {
    .noPrint {
        display:none;
      }
    }
  </style>
</head>
</html>

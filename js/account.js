$(document).ready(function(){
  $("#show_audio").click(function(){
    $("#track").load("member_files.php");
  });
   $("#show_bundle").click(function(){
   	$("#track").load("member_bundles.php");
  });
});
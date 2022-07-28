<html>
<script src="<?=base_url();?>js/jquery-1.11.2.js"></script>
<script >
function load_file(){
$.ajax({
url:"data",
success:function(data){
$('#content').html(data);}})}
setInterval(function(){load_file();},2000000);
</script>
<div id='content'>

</div>

</html>
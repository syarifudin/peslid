
	<form  ACTION="log_in" method='POST'>
	 <table style='margin-left: 40%; margin-top:30%;''>
        <tr><td></td><td > <?php if(isset($messg)) echo $messg;?></td></tr>
        <tr><td>User</td><td> <input type="text" name="username"style="display: block; margin: 0 auto;"></td></tr>
        <tr><td>Pass</td><td><input type="password" name="password"style="display: block; margin: 0 auto;"></td></tr>
        <tr><td></td><td><input type="submit" value="LOGIN" style="display: block; margin: 0 auto;"></td></tr>
	 </table>	
	 
    </form>
<style type="text/css">
 body
 {
   font-family: "Courier New", Times, serif;
   font-size:12px;
 }
 </style>

<?php
if(isset($eusr))
foreach ($eusr as $usr);

 ?>
<form method='POST' action='register_user'>
<table class='form_login' >
		<tr>
		<td>id</td><td>: <input type="text" name="emp_id" value='<?php echo isset($usr['emp_id'])?$usr['emp_id']:""?>'></td>
		</tr>
		<tr>
		<td>username</td><td>: <input type="text" name="username" value='<?php echo isset($usr['username'])?$usr['username']:""?>'></td>
		</tr>
		<tr>
		<td>password</td><td>: <input type="password" name="password" value='<?php echo isset($usr['password'])?$usr['password']:""?>'></td>
		</tr>
		<tr>
		<td>control</td><td>: <input type="text" name="control" value='<?php echo isset($usr['control'])?$usr['control']:""?>'></td>
		</tr>
		<tr>
		<td>user group</td><td>: <input type="text" name="user_group" value='<?php echo isset($usr['user_group'])?$usr['user_group']:""?>'></td>
		</tr>
		</table>
		<button type="reset" value="Reset" style="margin-left: 14%;width: 8%; margin-bottom: 5px;font-family: Courier New, Times, serif;">reset</button>
		<input type="submit" value="save" style="width: 8%; margin-bottom: 5px;font-family: Courier New, Times, serif;">
</form>

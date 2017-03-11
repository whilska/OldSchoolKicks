<!DOCTYPE html>
<html>
<?php
echo
"<form >
<h2 align='center'>Create Account</h2>
First Name: <input type='text' name='firstName'><br>
Last Name: <input type='text' name='lastName'><br>
Email: <input type='text' name='email'><br>
Enter a Password: <input type='password' name='pass1'><br>
Re-enter Password: <input type='password' name='pass2'><br>
<input type='button' value='Submit' onclick='createAccount(this)'>
</form>
";
?>
</html>
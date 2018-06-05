<!DOCTYPE HTML> 
<html>
<head>
<meta charset="utf-8">
<title>菜鸟教程(runoob.com)</title>
<style>
.error {color: #FF0000;}
.left{text-align:right}
.submit{border:1px solid #666; color:#ff3300; border-radius:4px}
</style>
</head>
<body> 

<?php
// 定义变量并默认设置为空值
$nameErr = $emailErr = $sexErr = $websiteErr = "";
$name = $email = $sex = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["name"]))
    {
        $nameErr = "名字是必需的";
    }
    else
    {
        $name = test_input($_POST["name"]);
    }
    
    if (empty($_POST["email"]))
    {
      $emailErr = "邮箱是必需的";
    }
    else
    {
        $email = test_input($_POST["email"]);
        // 检测邮箱是否合法
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
        {
            $emailErr = "非法邮箱格式"; 
        }
    }
    
    if (empty($_POST["website"]))
    {
        $website = "";
    }
    else
    {
        $website = test_input($_POST["website"]);
        // 检测 URL 地址是否合法
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
        {
            $websiteErr = "非法的 URL 的地址"; 
        }
    }
    
    if (empty($_POST["comment"]))
    {
        $comment = "";
    }
    else
    {
        $comment = test_input($_POST["comment"]);
    }
    
    if (empty($_POST["sex"]))
    {
        $sexErr = "性别是必需的";
    }
    else
    {
        $sex = test_input($_POST["sex"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP 表单验证</h2>
<p><span class="error">*为必需字段。</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   
   <table>
   <tr>
	<td class="left">名字: </td>
	<td><input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span></td>
   </tr>
    <tr>
	<td class="left">性别:</td>
	<td>
		<input type="radio" name="sex" <?php if (isset($sex) && $sex=="female") echo "checked";?>  value="female">女
		 <input type="radio" name="sex" <?php if (isset($sex) && $sex=="male") echo "checked";?>  value="male">男
		<span class="error">* <?php echo $sexErr;?></span>
	</td>
   </tr>
   <tr>
	<td class="left">E-mail:</td>
	<td><input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span></td>
   </tr>
   <tr>
	<td class="left">网址: </td>
	<td><input type="text" name="website" value="<?php echo $website;?>">
   <span class="error"><?php echo $websiteErr;?></span></td>
   </tr>
   <tr>
	<td class="left">备注: </td>
	<td><textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea></td>
   </tr>
  
   <tr>
	<td></td>
	<td><input type="submit" name="submit" value="提交" class="submit"> </td>
   </tr>
   </table>
   
 
</form>

</body>
</html>
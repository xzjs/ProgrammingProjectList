<?php
/**
 * 正则表达式查询工具——用户可以输入一段文本，在另外的控件里输入一个正则表达式。运行以后会返回匹配的内容或者正则表达式中的错误。
 */

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = '解析结果';
} else {
    $result = preg_replace($_POST['regular'], '<span class="highlight">${0}</span>', $_POST['str']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>正则表达式测试工具</title>
    <style>
        .highlight {
            background-color: yellow;
        }
    </style>
</head>
<body>
<form action="" method="post">
    <div>
        <label for="str">字符串</label>
        <input type="text" id="str" name="str" value="abcd17612341234abcd13812341234">
    </div>
    <div>
        <label for="regular">正则表达式</label>
        <input type="text" id="regular" name="regular" value="/0?(13|14|15|17|18|19)[0-9]{9}/">
    </div>
    <div>
        <input type="submit" value="提交">
    </div>
    <div>
        <p><?php echo $result ?></p>
    </div>
</form>
</body>
</html>


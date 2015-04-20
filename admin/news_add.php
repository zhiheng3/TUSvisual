<?php
require_once "adminhead.php";
require_once "../phplib/dbAPI.php";
$id = $_GET['id'];
$tmp = "添加";
$title = "";
$preview = "";
$content = "";
$is_show = -1;
$type = -1;
$url = "";
if ($id) {
	$tmp = "修改";
	$new = db_getNew($id);
	$title = $new['title'];
	$preview = $new['preview'];
	$content = $new['content'];
	$is_show = intval($new['is_show']);
	$type = intval($new['news_type']);
	$url = $new['url'];
}
?>

<div class="top">
    <?php echo $tmp;?>新闻<a class="btn left_btn" href="./news.php">返回</a>
</div>
<form action="./update.php" method="post" enctype="multipart/form-data">
    <input name="id" type="hidden" value="<?php echo $id;?>">
    <input name="method" type="hidden" value="new">
    <input name="oldurl" type="hidden" value="<?php echo $url;?>">
<table class="add_table">
    <tr>
        <th style="width: 140px" valign="top">标题</th>
        <td><input type="text" class="px" name="title" value="<?php echo $title;?>"></td>
    </tr>
    <tr>
        <th style=" vertical-align: top;">内容</th>
        <td>
            <textarea class="px"  id="Hfcontent" maxlength="200" name="content"
            style="width: 580px; height: 100px"><?php echo $content;?></textarea>
        </td>
    </tr>
    <tr>
        <th>封面图片</th>
        <td>
        <!--<td> <input type="text" name="name" id="picurl" value="" class="px" style="width:400px;"/>-->
            <input type="file" name="imageurl"  class="px"/>
            <img src="<?php echo $url;?>" onerror="this.src='./static/images/noimage.jpg'"
            class="px" style="height: 80px;float: right;">
        <!--<a href="javascript:;" onclic<a href="javascript:;" onclick="viewImg('picurl')">预览</a></td>-->
        </td>
    </tr>
    <tr>
        <th>显示模式</th>
        <td>图文<input type="radio" name="type" value="1" <?php if ($type == 1) {echo "checked";}?> >
            标文<input type="radio" name="type" value="0" <?php if ($type == 0) {echo "checked";}?> >
        </td>
    </tr>
    <tr>
        <th>是否显示</th>
        <td>
        是<input type="radio" name="is_show" value="1" <?php if ($is_show == 1) {echo "checked";}?> >
        否<input type="radio" name="is_show" value="0" <?php if ($is_show == 0) {echo "checked";}?> >
        </td>
    </tr>
    <tr>
        <th></th>
        <td><input type="submit" class="btn submit_btn" value="确 认"></td>
    </tr>
</table>

</form>

</body>
</html>
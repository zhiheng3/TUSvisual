<?php
require_once "adminhead.php";
require_once "../phplib/dbAPI.php";
$id = $_GET['id'];
$tmp = "添加";
$name = "";
$author = "";
$content = "";
$category_id = 0;
$tags = "";
$url = "";
if ($id) {
	$tmp = "修改";
	$work = db_getWork($id);
	$name = $work['name'];
	$author = $work['author'];
	$content = $work['content'];
	$category_id = intval($work['category_id']);
	$tags = $work['tags'];
	$url = $work['url'];
}
?>
<div class="top">
    <?php echo $tmp;?>作品<a class="btn left_btn" href="./works.php">返回</a>
</div>
<hr/>
<form action="./update.php" method="post" enctype="multipart/form-data">
    <input name="id" type="hidden" value="<?php echo $id;?>">
    <input name="method" type="hidden" value="work">
    <input name="oldurl" type="hidden" value="<?php echo $url;?>">
    <input type="hidden" id = "category" value="<?php echo $category_id;?>">
    <table class="add_table">
        <tr>
            <th style="width: 140px" valign="top">作品名称</th>
            <td><input type="text" class="px" name="name" value="<?php echo $name;?>"></td>
        </tr>
        <tr>
            <th style="width: 140px" valign="top">作品作者</th>
            <td><input type="text" class="px" name="author" value="<?php echo $author;?>"></td>
        </tr>
        <tr>
            <th style=" vertical-align: top;">作品介绍</th>
            <td>
                <textarea class="px"  id="Hfcontent" maxlength="200" name="content" style="width: 580px; height: 100px"><?php echo $content;?></textarea>
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
            <th>作品分类</th>
            <td>
                <select id="category_id" class="px" name="category_id">
                    <option value="0" >未分类</option>
                    <option value="1">标志设计</option>
                    <option value="2">VIS设计</option>
                    <option value="3">GUI设计</option>
                    <option value="4">网站设计</option>
                    <option value="5">建筑设计</option>
                    <option value="6">景观设计</option>
                    <option value="7">画册设计</option>
                    <option value="8">视频设计</option>
                    <option value="9">清华图库</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>标签</th>
            <td><input type="text" name="tags" class="px" value="<?php echo $tags;?>">
            </td>
        </tr>
        <!--
        <tr>
            <th>添加标签</th>
            <td><input type="text" id="label_text" class="px">
                <input id="label_btn" style="height: 26px;line-height: 10px;" type="button" class="btn" value="确 认">
            </td>
        </tr>
        <tr>
            <th style=" vertical-align: top;">已添加</th>
            <td>
                <div class="label_div">

                    <volist name="works.label" id="vo">
                        <if condition="$vo"><label class="label">{$vo}<span class="label_del">×</span></label></if>
                    </volist>

                </div>

            </td>
        </tr>
        -->
        <tr>
            <th></th>
            <td><input class="btn submit_btn" type="submit" value="确 认"></td>
        </tr>
    </table>

</form>
<style>
    .label_div{
        width: 580px;
        height: 27px;
        border: 1px solid #eeeeee;
        padding: 5px;
        display: inherit;
    }
    .label{
        display: inline-block;
        float: left;
        height: 25px;
        line-height: 25px;
        margin: 5px;
        padding: 2px 3px;
        background: #eeeeee;
        border: 1px solid #eeeeee;
    }
    .label_del{
        cursor:pointer;
    }
</style>
<script>
    $(document).ready(function(){
        var tmp = parseInt($("#category").val());
        $("#category_id")[0][tmp].selected = true;
    });
</script>
</body>
</html>
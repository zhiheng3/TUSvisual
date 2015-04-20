<?php
require_once "adminhead.php";
?>

<div class="top">
    作品列表<a class="btn left_btn" href="./works_add.php">添加</a>
</div>
<div class="data-table">
    <table>
        <thead>
        <tr>
            <th>作品名称</th>
            <th>作品作者</th>
            <th>作品介绍</th>
            <th>作品图片</th>
            <th>作品分类</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
<?php
require_once "../phplib/dbAPI.php";
$lists = db_getLists();
for ($i = 0; $i < count($lists); ++$i) {
	$tmp = $lists[$i];
	$id = $tmp['id'];
	$url = $tmp['url'];
	$name = $tmp['name'];
	$author = $tmp['author'];
	$category = $tmp['category_name'];
	$like = $tmp['likes'];
	$browse = $tmp['browses'];
	$content = $tmp['content'];
	echo <<< EOT
            <tr id="row$id">
                <td>$name</td>
                <td>$author</td>
                <td><div style="width: 200px;overflow: hidden;height: 30px;line-height: 30px">$content</div></td>
                <td><img src="$url" onerror="this.src='./static/images/noimage.jpg'" style="height: 30px" ></td>
                <td>$category</td>
                <td><a href="./works_add.php?id=$id">修改</a>　　<a class="del" href="javascript:deleteWork($id);">删除</a></td>
            </tr>
EOT;
}
if (count($lists) == 0) {
	echo <<< EOT
            <tr>
                <td colspan="5">
                    <div style="width: 100%;text-align: center">暂无作品</div>
                </td>
            </tr>
EOT;
}
?>
        </tbody>
    </table>
</div>
<script>
function deleteWork(id){
    var data = Object();
    data["id"] = id;
    var json = JSON.stringify(data);
    $.post("../phplib/ajax.php", {
        "method":"dl_works",
        "args": json
    },function(data){
        var result = JSON.parse(data);
        if (result['code'] == 0){
            $("#row" + id).remove();
        }
    });
}
</script>
</body>
</html>

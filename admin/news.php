<?php
require_once "adminhead.php";
?>

   <div class="top">
       新闻列表<a class="btn left_btn" href="./news_add.php">添加</a>
   </div>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>标题</th>
                    <th>内容</th>
                    <th>封面</th>
                    <th>是否显示</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
<?php
require_once "../phplib/dbAPI.php";
$news = db_getNews(1);
for ($i = 0; $i < count($news); ++$i) {
	$tmp = $news[$i];
	$id = $tmp['id'];
	$type = $tmp['news_type'];
	$title = $tmp['title'];
	$url = $tmp['url'];
	$preview = $tmp['preview'];
	$content = $tmp['content'];
	if ($tmp['is_show'] == 0) {
		$is_show = '否';
	} else {
		$is_show = '是';
	}
	$updatetime = $tmp['updatetime'];
	echo <<< EOT

                <tr id="row$id">
                    <td>$title</td>
                    <td><div style="width: 200px;overflow: hidden;height: 30px;line-height: 30px">$preview</div></td>
                    <td><img src="$url" onerror="this.src='./static/images/noimage.jpg'"style="height: 30px" ></td>
                    <td>$is_show</td>
                    <td><a href="./news_add.php?id=$id">修改</a>　　<a href="javascript:deleteNew($id);">删除</a></td>
                </tr>
EOT;
}

if (count($news) == 0) {
	echo <<< EOT
                <tr>
                    <td colspan="5">
                        <div style="width: 100%;text-align: center">暂无新闻</div>
                    </td>
                </tr>
EOT;
}
?>
            </tbody>

        </table>
    </div>
<script>
function deleteNew(id){
    var data = Object();
    data["id"] = id;
    var json = JSON.stringify(data);
    $.post("../phplib/ajax.php", {
        "method":"dl_news",
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

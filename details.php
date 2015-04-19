<?php
require_once "homehead.php";
require_once "./phplib/dbAPI.php";

$id = $_GET['id'];

if (is_null($id)) {
	$id = -1;
}
db_incWorkNumber($id, "browses");
$work = db_getWork($id);
if (!$work) {
	echo <<< EOT1
		<div name="lists">
			<span style="margin-left: 45%">未找到对应作品</span>
		</div>
EOT1;
}
$url = $work['url'];
$name = $work['name'];
$author = $work['author'];
$browse = $work['browses'];
$like = $work['likes'];
$content = $work['content'];
$tags = $work['tags'];
echo <<< EOT2
		<div class="list_center">
			<div class="details" >
				<img src="$url"  style="height: 450px;"/>
				<div class="details_div"><span class="details_name">作品名称：$name</span></div>
				<div class="details_div"><span>作　者：$author</span>　｜　<span>浏览量：$browse</span>　｜　<span>❤  $like</span></div>
				<div class="details_div"><span>标签内容：</span><span style="color: #989898;">$tags</span></div>
				<div class="details_div"><span>作品介绍：</span></div>
				<div>
					$content
				</div>
			</div>
			<div style="height: 50px;"></div>
		</div>
EOT2;

?>
		<div class="list_bottom">
			<div class="list_bottom_sub">
				©2013 Copyright TusHoldings 版权所有-启迪控股股份有限公司——事业部  京ICP备0503286
			</div>
		</div>
	</body>
</html>

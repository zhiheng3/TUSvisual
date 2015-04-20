<?php
require_once "homehead.php";
?>
		<div class="list_center">
			<div class="news_center_release" style="text-align: center;">
				<!--NEWS-->
				<div class="news">
					<div class="news_">新闻动态</div>
				</div>
<?php
require_once "./phplib/dbAPI.php";
$news = db_getNews();
for ($i = 0; $i < count($news); ++$i) {
	$tmp = $news[$i];
	$id = $tmp['id'];
	$type = $tmp['news_type'];
	$title = $tmp['title'];
	$url = $tmp['url'];
	$preview = $tmp['preview'];
	$content = $tmp['content'];
	$is_show = $tmp['is_show'];
	$updatetime = $tmp['updatetime'];

	if ($type == 1) {
		//Image
		echo <<< EOT1
	<div class="news_list">
		<img class="news_img" src="$url"/>
		<div class="news_content">$preview</div>
	</div>
EOT1;
	} else {
		//Text
		echo <<< EOT2
	<div class="news_list">
		<div class="news_title">$title</div>
		<div class="news_text_content">$preview</div>
	</div>
EOT2;
	}
}

if (count($news) == 0) {
	echo <<< EOT
		<div name="news">
			<span style="margin-left: 45%">暂无新闻</span>
		</div>
EOT;
}
?>
			</div>
		</div>

		<div class="list_bottom">
			<div class="list_bottom_sub">
				©2013 Copyright TusHoldings 版权所有-启迪控股股份有限公司——事业部  京ICP备0503286
			</div>
		</div>
	</body>
</html>

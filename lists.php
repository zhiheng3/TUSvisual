<?php
require_once "homehead.php";
?>
<div class="list_center">
	<div class="list_center_sub">
<?php
require_once "./phplib/dbAPI.php";
$category_id = $_GET['category_id'];
$lists = db_getLists($category_id);

for ($i = 0; $i < count($lists); ++$i) {
	$tmp = $lists[$i];
	$id = $tmp['id'];
	$url = $tmp['url'];
	$name = $tmp['name'];
	$author = $tmp['author'];
	$category = $tmp['category_name'];
	$like = $tmp['likes'];
	$browse = $tmp['browses'];

	echo <<< EOT
		<div class="list">
			<a href="./details.php?id=$id"><img src="$url"/></a>
			<div class="list_text">
				<div class="list_1">
					<a href="./details.php?id=$id"><span class="list_span_1">$name</span></a>
					<span class="list_span_2">by</span>
					<span class="list_span_3">$author</span>
				</div>
				<div class="list_2">
					<span>$category</span>
				</div>
			</div>
			<div class="list_3">
				<div class="thumbs_up">
				<span>
					<a id="like" href="javascript:like_click($id)">
					<img src="./static/images/thumbs_up.png" style="width: 15px;height: 15px;"/>
					</a>
					<a id="like_num$id" style="cursor:default;">$like</a>
				</span>
				<span>
					<img src="./static/images/see.png" style="display: inline-block;width: 17px;height: 15px;"/>
					$browse
				</span>

				</div>
				<div class="rss">
					<img src="./static/images/rss.png" style="width: 15px;height: 15px;" />
				</div>
			</div>
		</div>

EOT;
}

if (count($lists) == 0) {
	echo <<< EOT
		<div name="lists">
			<span style="margin-left: 45%">暂无作品</span>
		</div>
EOT;
}
?>


		<div style="clear: both;"></div>
	</div>
</div>
		<div class="list_bottom">
			<div class="list_bottom_sub">
				©2013 Copyright TusHoldings 版权所有-启迪控股股份有限公司——事业部  京ICP备0503286
			</div>
		</div>
	</body>
</html>

<?php
require_once "homehead.php";
?>
		<div class="list_center">
			<div class="list_center_release">
				<!--作品名称-->
				<div class="release_name">
					<div class="release_information_1">作品名称<span style="color: #b4130b;">*</span></div>
					<div class="release_name_2">
						<input type="text" class="name_text text"/>
					</div>
				</div>
				<!--作品说明-->
				<div class="release_explain">
					<div class="release_information_1">作品说明<span style="color: #b4130b;">*</span></div>
					<div class="release_explain_2">
						<textarea name="" rows="8" class="release_text text"></textarea>
					</div>
				</div>
				<!--上传图片-->
				<div class="release_name">
					<div class="release_information_1">上传图片<span style="color: #b4130b;">*</span></div>
					<div class="release_name_2">
						<input type="text" />
					</div>
				</div>
				<!--作品分类-->
				<div class="release_name">
					<div class="release_information_1">作品分类<span style="color: #b4130b;">*</span></div>
					<div class="release_name_2">
						<select class="text select_release">
							<option>请选择一级分类</option>
							<option>标志设计</option>
							<option>VIS设计</option>
							<option>GUI设计</option>
							<option>网页设计</option>
							<option>建筑设计</option>
							<option>景观设计</option>
							<option>视频设计</option>
							<option>清华图库</option>
						</select>
					</div>
				</div>
				<!--作品标签-->
				<div class="release_label">
					<div class="release_label_1">
						<div class="release_information_1">添加标签</div>
						<div class="release_name_2">
							 <input type="text" class="text label_text"/>
							 <input type="button" class="label_botton" value="确  认" />
						</div>
					</div>
					<div class="release_label_2">
						<div class="release_information_label">已添加</div>
						<div class="release_label_sub">
							<div class="lable">Label<span class="del"> ╳</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="list_bottom">
			<div class="list_bottom_sub">
				©2013 Copyright TusHoldings 版权所有-启迪控股股份有限公司——事业部  京ICP备0503286
			</div>
		</div>
	</body>
</html>

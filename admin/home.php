<?php
require_once "./adminhead.php";
?>
    <table class="add_table">
        <tr>
            <th style="width: 140px" valign="top"></th>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">
                <span style="font-size: 20px">修改管理信息</span>
            </td>
        </tr>
        <!--
        <tr>
            <th style=" vertical-align: top;" >修改名称</th>
            <td>
                <input type="text" name="name_a" class="px" value="{$name}">
            </td>
        </tr>-->
        <tr>
            <th style=" vertical-align: top;">修改登录密码</th>
            <td>
                <input type="password" id="password1" class="px">
            </td>
        </tr>
        <tr>
            <th style=" vertical-align: top;">确认登录密码</th>
            <td>
                <input type="password" id="password2" class="px">
            </td>
        </tr>
        <tr>
            <th></th>
            <td id="info"></td>
        </tr>
        <tr>
            <th></th>
            <td><input class="btn submit_btn" type="submit" onclick="javascript:confirm();" value="确 认"></td>
        </tr>
    </table>
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
    #info{
        display:none;
    }
</style>
<script>
    function confirm(){
        $("#info").css("display", "block");
        if ($("#password1").val() != $("#password2").val()){
            $("#info").text("两次输入的密码不一致");
            return ;
        }
        var data = Object();
        data["username"] = "admin";
        data["password"] = $("#password1").val();
        var json = JSON.stringify(data);
        $.post("../phplib/ajax.php",{
            "method":"lg_modify",
            "args":json
        },function(data){
            var result = JSON.parse(data);
            if (result["code"] == 0){
                $("#info").text("修改成功");
            }
            else{
                $("#info").text(result["result"]);
            }
        });
    }
</script>

</body>
</html>
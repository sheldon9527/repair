<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>西安思源学院</title>
<meta http-equiv="Content-Type" content="text/html;" />
<meta name="author" content="西安思源学院">
<meta name="description" content="西安思源学院宿管维修" />
<link href="images/index.css" rel="stylesheet" type="text/css">
<script src="/bower/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="/bower/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<link href="/bower/AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/front/css/myRewards.css">
</head>
<body>
		<table cellSpacing=0 cellPadding=0 align=center width="66%">
		  <tr>
		    <td colSpan=3 id="banner">大学生宿管维修上报_西安思源学院</td>
		  </tr>
		</table>
			<i class="fa fa-mobile" aria-hidden="true"></i>
		<table width="66%" align="center" bgcolor="#FAFAFA">
		<form id="form1" name="form1" method="post" action="" class="form-inline">
			<tr>
				<td id="info" colspan="12">为了同学们能够及时的上报需要维修的东西且能够得到更快的反馈，往同学们发现问题就及时的填写.
				</td>
			</tr>
			<tr>
				<td id="info2" colspan="6"></td>
			</tr>

			@if (session('status'))
				<?php
                echo "<script>alert('操作成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                    ?>
            @endif
            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;margin-top:20px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                            <td>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;margin-top:20px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                          <td style='height:50px;'><b><span style="color:red;margin-right:10px">*</span>联系姓名</b></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" style='width:100%;height:40px;font-size:16px' placeholder="Sheldon Yi" required>
                                  </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;margin-top:10px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                          <td style='height:50px;'><b><span style="margin-right:10px"></span><span style="margin-right:10px">*</span>联系方式</b></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" style='width:100%;height:40px;font-size:16px' placeholder="184****2878" >
                                  </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;margin-top:20px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                          <td style='height:50px;' ><b><span style="color:red;margin-right:10px">*</span>宿舍楼号</b></td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                                        @foreach($droms as $key => $drom)
                                            <li role="presentation" @if($key == 0) class="active" @endif>
                                                <a href="#drom-{{$drom->id}}" role="tab" style="color:black">{{$drom->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        @foreach($droms as  $key => $drom)
                                            <div role="tabpanel" class="tab-pane @if($key == 0) active @endif in" id="drom-{{$drom->id}}">
                                                @foreach($drom->children as $child)
                                                    <div>
                                                        <label class="checkbox-inline ng-scope">
                                                            <div class="radio">
                                                               <label><input type="radio" name="dorm_id" value="{{$child->id}}">{{$child->name}}</label>
                                                            </div>

                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;margin-top:20px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                          <td style='height:50px;'><b><span style="color:red;margin-right:10px">*</span>宿舍房号</b></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="home_number" style='width:100%;height:40px;font-size:16px' placeholder="336" required>
                                  </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;margin-top:20px;">
            <td colspan="4">
                <table width="98%" cellpadding="0" cellspacing="5" align="center">
                    <tr>
                      <td style='height:50px;'><span style="color:red;margin-right:10px">*</span><b>报修种类</b></td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                                    @foreach($categories as $key => $category)
                                        <li role="presentation" @if($key == 0) class="active" @endif>
                                            <a href="#categoty-{{$category->id}}" role="tab" style="color:black">{{$category->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    @foreach($categories as  $key => $category)
                                        <div role="tabpanel" class="tab-pane @if($key == 0) active @endif in" id="categoty-{{$category->id}}">
                                            @foreach($category->children as $child)
                                                <div class="col-md-10">
                                                    <label style='margin-top:10px' class="checkbox-inline ng-scope">
                                                        <input type="checkbox"
                                                            value="{{$child->id}}"
                                                            name="category_ids[]">
                                                        <span class="ng-binding">{{$child->name}}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;margin-top:20px;">
            <td colspan="4">
                <table width="98%" cellpadding="0" cellspacing="5" align="center">
                    <tr>
                      <td style='height:50px;'><b><span style="color:red;margin-right:10px;">*</span>报修详情</b></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <textarea name="description" class="form-control" rows="5" placeholder="描述详情便于报修。。。。。。" style='font-size:16px' required></textarea>
                              </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;margin-top:20px;">
            <td colspan="4">
                <table width="98%" cellpadding="0" cellspacing="5" align="center">
                    <tr>
                      <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                               <div >
                                 <button type="submit" class="btn btn-primary">提交</button>
                               </div>
                             </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        </form>
        </table>
        <table cellSpacing=0 cellPadding=0 align=center bgcolor="#FAFAFA" background="images/botbj.jpg" width="66%">
          <tr>
            <td height=60 align="center"><a href="" target="_blank">西安思源学院</a> Copyright 2016-2017 西安思源学院 版权所有 大学生宿管维修上报_西安思源学院 </td>
          </tr>
        </table>
</body>
<script>
$('#myTabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
});
$('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
});
window.tctipConfig = {
        buttonImageId:  3,
        buttonTip:  "dashang",
        list:{
            alipay: {qrimg: "/images/sao.png"},
        }
};
</script>
<script src="/js/tctip.min.js"></script>
</html>

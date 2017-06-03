<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>大学生宿管维修上报_西安思源学院</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="author" content="西安思源学院">
<meta name="description" content="西安思源学院宿管维修" />
<link href="images/index.css" rel="stylesheet" type="text/css">
<script src="/bower/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="/bower/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<link href="/bower/AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
		<table cellSpacing=0 cellPadding=0 align=center width="960px">
		  <tr>
		    <td colSpan=3 id="banner">大学生宿管维修上报_西安思源学院</td>
		  </tr>
		</table>
		<table width="960px" align="center" bgcolor="#FAFAFA">
		<form id="form1" name="form1" method="post" action="" class="form-inline">
			<tr>
				<td id="info" colspan="6">为了同学们能够及时的上报自己宿舍需要维修的东西且能够得到更快的反馈，往同学们抽出一点点时间为填一下.</td>
			</tr>
			<tr>
				<td id="info2" colspan="6"></td>
			</tr>
			@if (session('status'))
				<?php
                echo "<script>alert('操作成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                    ?>
            @endif
            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                          <td><b><span style="color:red;margin-right:10px">*</span>姓名</b></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" style='width:100%;height:34px;font-size:14px' placeholder="Sheldon Yi" required>
                                  </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                          <td><b><span style="color:red;margin-right:10px">*</span>楼号</b></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="build_number" style='width:100%;height:34px;font-size:14px' placeholder="5" required>
                                  </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                          <td><b><span style="color:red;margin-right:10px">*</span>宿舍号</b></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="home_number" style='width:100%;height:34px;font-size:14px' placeholder="336" required>
                                  </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;">
                <td colspan="4">
                    <table width="98%" cellpadding="0" cellspacing="5" align="center">
                        <tr>
                          <td><b><span style="margin-right:10px"></span>联系方式</b></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" style='width:100%;height:34px;font-size:14px' placeholder="184****2878" >
                                  </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'" style="margin-bottom:10px;">
            <td colspan="4">
                <table width="98%" cellpadding="0" cellspacing="5" align="center">
                    <tr>
                      <td><span style="color:red;margin-right:10px">*</span><b>报修</b></td>
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
                                                    <label class="checkbox-inline ng-scope">
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

        <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'">
            <td colspan="4">
                <table width="98%" cellpadding="0" cellspacing="5" align="center">
                    <tr>
                      <td><b><span style="color:red;margin-right:10px;">*</span>报修具体详情</b></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <textarea name="description" class="form-control" rows="5" required></textarea>
                              </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr onMouseOver="this.bgColor='#F0F7FF'" bgcolor="#FAFAFA" onMouseOut="this.bgColor='#FAFAFA'">
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
        <table cellSpacing=0 cellPadding=0 align=center bgcolor="#FAFAFA" background="images/botbj.jpg" width="960px">
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

</script>

</html>

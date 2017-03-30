/**
 * 
 */
$(function () { 
	//说一说
	$(".chat").click(function(){
		var url = $(this).attr("url");
		var content = $("textarea").val(); //获取文本框内容
	
		
		if(content == ''){
			$(".field-feed-content").addClass("has-error");
			return false;
		}
			
		
		$.ajax(url,{
			type:"post",
			dataType:"json",
			data:{ content:content },
			success:function(data){
				if(data.status){
					
var say ="<div class='media'><div class='media-left'><a href='#'>"+"<img class='media-object' src='"+data.arr.avatar+"' width='35' height='35' class='img-responsive'></a>"
	 +"</div><div class='media-body'><h5 class='media-heading'>"+"<span class='pull-left'>"+data.arr.username+"</span> &nbsp发表于"+data.arr.addtime+"</h5><p>"+data.arr.content+"</p>"+"</div></div>";
	 $(".comment").prepend(say);

				}else{
					alert(data.msg);
					
				}
			},
		})
	})
	
//	$("button").click(function(){
//        var url = "";  //调用的地址
//        var content = $("textarea").val(); //获取文本框内容
//        $.ajax(url,{
//            type : "get",
//            dataType : "json",
//            data:{ content:content },
//            success : function (data) {
//                if(data.status == 0){
//                    //成功后执行的代码写在这里
//                }
//                else{
//                    alert(data.msg);
//                    return false;
//                }
//            },
//            error : function () {
//                alert("接口网络错误");
//                return false;
//            }
//        })
//    })

});
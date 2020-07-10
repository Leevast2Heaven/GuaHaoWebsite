function  submitForm(){
    if(document.getElementById('gh_yanzheng').value == ''){
        alert('请输入验证码！');
        return;
    }
    if(document.getElementById('gh_name').value == ''){
        alert('请输入您的姓名！');
        return;
    }
    if(document.getElementById('gh_age').value == ''){
        alert('请输入您的年龄！');
        return;
    }
    if(document.getElementById('gh_subject').value == ''){
        alert('请选择正确的科室！');
        return;
    }
    if(document.getElementById('gh_tel').value == ''){
        alert('请输入您的联系方式！');
        return;
    }
    if(document.getElementById('gh_comedate').value == ''){
        alert('请选择您的来院日期！');
        return;
    }
    document.getElementById('gh_form').submit();
}
var outObject;
var outButton;		//点击的按钮
var outDate="";		//存放对象的日期
var odatelayer=window.frames.meizzDateLayer.document.all;		//存放日历对象
function setday(tt,obj) //主调函数
{
    if (arguments.length >  2){alert("对不起！传入本控件的参数太多！");return;}
    if (arguments.length == 0){alert("对不起！您没有传回本控件任何参数！");return;}
    var dads  = document.all.meizzDateLayer.style;
    var th = tt;
    var ttop  = tt.offsetTop;     //TT控件的定位点高
    var thei  = tt.clientHeight;  //TT控件本身的高
    var tleft = tt.offsetLeft;    //TT控件的定位点宽
    var ttyp  = tt.type;          //TT控件的类型
    while (tt = tt.offsetParent){ttop+=tt.offsetTop; tleft+=tt.offsetLeft;}
    dads.top  = (ttyp=="image")? ttop+thei : ttop+thei+6;
    dads.left = tleft;
    outObject = (arguments.length == 1) ? th : obj;
    outButton = (arguments.length == 1) ? null : th;	//设定外部点击的按钮
    //根据当前输入框的日期显示日历的年月
    var reg = /^(\d+)-(\d{1,2})-(\d{1,2})$/;
    var r = outObject.value.match(reg);
    if(r!=null){
        r[2]=r[2]-1;
        var d= new Date(r[1], r[2],r[3]);
        if(d.getFullYear()==r[1] && d.getMonth()==r[2] && d.getDate()==r[3]){
            outDate=d;		//保存外部传入的日期
        }
        else outDate="";
        meizzSetDay(r[1],r[2]+1);
    }
    else{
        outDate="";
        meizzSetDay(new Date().getFullYear(), new Date().getMonth() + 1);
    }
    dads.display = '';

    event.returnValue=false;
}
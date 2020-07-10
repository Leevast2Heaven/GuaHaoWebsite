// JavaScript Document
function  drugDelete(drid){
            if(confirm('删除后无法恢复，确定要删除该药品？'))
			  top.location= '?m=drug&o=drugdelete&drid='+drid;
			return;
}

function  patientDelete(pid){
            if(confirm('患者档案以及患者的所有就诊记录都将删除，删除后无法恢复，确定要删除该患者？'))
			  top.location= '?m=patient&o=delete&pid='+pid;
			return;
}


function  recordIndexDelete(riid){
            if(confirm('删除后无法恢复，确定要删除该就诊记录？'))
			  top.location= '?m=record&o=indexdelete&riid='+riid;
			return;
}

function  recordDelete(rid){
            if(confirm('删除后无法恢复，确定要删除该就诊记录？'))
			  top.location= '?m=record&o=delete&rid='+rid;
			return;
}

function  createXmlHttp(){
            if(window.XMLHttpRequest)
              xmlHttp=new XMLHttpRequest();
            else
              xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			return xmlHttp;
}

function  ajaxExec(url,action){
	        var xmlHttp = createXmlHttp();//alert(action);
			xmlHttp.onreadystatechange=function(){
			  if(xmlHttp.readyState==4 && xmlHttp.status==200){
				  execScript(action);
			  }
               
            }
            xmlHttp.open('get',encodeURI(url+'&rand='+Math.random()),true);
            xmlHttp.send();
}

				
function  choose(model,id,id2){
	          document.getElementById('diagnosis_check').checked = true;
              if(model == 'room'){
				var labels = document.getElementById("rooms").childNodes;
				for(i = 0;i <labels.length;i++){
				  var label = labels[i];
				  if(label.nodeName == 'A'){
				    if(label.id == 'room'+id)
					  label.className = 'choose';
					else
					  label.className = '';
				  }
				}

				ajaxExec('?m=ajax&o=choose&object=doctor&rid='+id,'chooseRoom('+id+');');
			  }
			  else if(model == 'doctor'){
				var labels = document.getElementById("doctors").childNodes;
				for(i = 0;i <labels.length;i++){
				  var label = labels[i];
				  if(label.nodeName == 'A'){
				    if(label.id == 'doctor'+id)
					  label.className = 'choose';
					else
					  label.className = '';
				  }
				}
				var labels = document.getElementById("rooms").childNodes;
				for(i = 0;i <labels.length;i++){
				  var label = labels[i];
				  if(label.nodeName == 'A'){
				    if(label.id == 'room'+id2)
					  label.className = 'choose';
					else
					  label.className = '';
				  }
				}
			    document.getElementById('rid').value = id2;
			    document.getElementById('did').value = id;
			  }
}

function chooseRoom(id){
				  document.getElementById('doctors').innerHTML = xmlHttp.responseText;
			      document.getElementById('rid').value = id;
			      document.getElementById('did').value = '';
}

function check(model,id){
             document.getElementById(model+'choose'+id).checked='checked';
             var tmp = document.getElementById(model+id);
			 if(tmp)
			   tmp.select();
             var tmp = document.getElementById(model+'_check');
			 if(tmp)
			   tmp.checked = true;
}

function inputDrugName(operate,object,id){
	         if(operate == 'clear'){
               if(object.value == '请输入药品名称')
			     object.value = '';
			 }
			 else if(operate == 'change'){
			   if(object.value != ''){
				 if(object.value.length >= 2)
			       ajaxExec('?m=ajax&o=getdrug&inputid='+id+'&drugname='+object.value,'chooseDrug('+id+')');
			   }
			 }
			 
}

function chooseDrug(id){
	              if(xmlHttp.responseText == '')
				    return;
				  var drugchoose =  document.getElementById('drugchoose'+id);
				  if(drugchoose){
				    drugchoose.style.display = 'block';
					drugchoose.innerHTML = xmlHttp.responseText;
				  }
				 
}

function selectDrug(inputId,id,name,price,dunit){
                  document.getElementById('drugname'+inputId).value = name;
                  document.getElementById('drugprice'+inputId).value = price;
                  document.getElementById('drugid'+inputId).value = id;
                  document.getElementById('drugunit'+inputId).innerHTML = dunit;
                  document.getElementById('drugfee'+inputId).value = 0;
                  document.getElementById('drugnum'+inputId).value = 0;
                  document.getElementById('drugchoose'+inputId).innerHTML = '';
				  
}

function addDrug(){
				var labels = document.getElementById("drugs").childNodes;
				ajaxExec('?m=ajax&o=adddrug&num='+labels.length,'addDrugDo()');
                  
}

function addDrugDo(){
	              var drugs = document.getElementById('drugs');
				  drugs.innerHTML = drugs.innerHTML + xmlHttp.responseText;
				  document.getElementById('drug_inputnum').value += 5;
}

function getFee(inputId){
	              var price = document.getElementById('drugprice'+inputId).value;
	              var num = document.getElementById('drugnum'+inputId).value;
                  document.getElementById('drugfee'+inputId).value = price * num;
}


function selectFreeGuaHao(object,operate){
	              if(operate == 'free'){
	                if(object.checked == true){
                      document.getElementById('guahao_price').value = 0;
					  document.getElementById('guahao').checked = true;
					}
				  }
				  else if(operate == 'price'){
					document.getElementById('guahao').checked = true;
				    if(object.value != '0')
					  document.getElementById('guahao_free').checked = false;
					else
					  document.getElementById('guahao_free').checked = true;
				  }
	              else if(operate == 'guahao'){
	                if(object.checked == false){
                      document.getElementById('guahao_price').value = 0;
					  document.getElementById('guahao_free').checked = false;
					}
				  }
}

function checkForm(operate){
	if(document.getElementById('patient_name').value == ''){
	  alert('请输入患者姓名！');
	  return;
	}
	if(!document.getElementById('patient_gender_male').checked && !document.getElementById('patient_gender_female').checked){
	  alert('请选择患者性别！');
	  return;
	}
	if(operate == 'add'){
      if(!document.getElementById('diagnosis_check').checked){
	    alert('患者首次就诊必须填写看诊信息！');
	    return;
	  }
	  if(document.getElementById('rid').value == ''){
	    alert('请选择患者所属诊室！');
	    return;
	  }
	  if(document.getElementById('did').value == ''){
	    alert('请选择患者所属医生！');
	    return;
	  }
	}
	document.getElementById('recordAddForm').submit();

}




function inputPatientName(object){
			   if(object.value != ''){
				 if(object.value.length >= 2)
			       ajaxExec('?m=ajax&o=getpatient&pname='+object.value,'choosePatient()');
			   }
}

function choosePatient(){
	              if(xmlHttp.responseText == '')
				    return;
				  var patientchoose = document.getElementById('patientchoose');
				  patientchoose.innerHTML = xmlHttp.responseText;
				  patientchoose.style.display = 'block';
}

function selectPatient(pid,rid,did){
			   if(pid != ''){
			     ajaxExec('?m=ajax&o=getpatient&pid='+pid,'selectPatientDo()');
			     choose('doctor',did,rid)
			   }
				  
}

function selectPatientDo(){
	              if(xmlHttp.responseText == '')
				    return;
				  document.getElementById('patient').innerHTML = xmlHttp.responseText;
}

function displayBlock(id){
                   var object = document.getElementById(id);
				   if(object)
				     object.style.display = 'block';
}

function displayNone(id){
                   var object = document.getElementById(id);
				   if(object)
				     object.style.display = 'none';
}



function deleteDrug(id){
                   var drug = document.getElementById(id);
				   if(drug){
					  drug.parentNode.removeChild(drug);
				   }
}

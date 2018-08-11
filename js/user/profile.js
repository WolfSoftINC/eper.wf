
<<<<<<< HEAD
=======
class Profile{static gl(id){var url='profile';var str="";str+='gl=1';if(data['user_id'])
{str+="&user_id="+data['user_id'];}
$.ajax({url:url,type:'POST',data:str,contentType:'application/x-www-form-urlencoded; charset=UTF-8',success:function(list){list=JSON.parse(list);var row=Profile.row(list['login'],"Логин","login");$("#profile_list").append(row);var row=Profile.row(list['name'],"Имя","name");$("#profile_list").append(row);var row=Profile.row(list['phone'],"Номер телефона","phone");$("#profile_list").append(row);var row=Profile.row(list['mail'],"E-mail","mail");$("#profile_list").append(row);$(document).ready(function(){$("#login_button").click(function(){alert("OK");});});}});}
static row(value,text,id)
{var row=$('<div/>',{class:id+"_block",});var _text=$('<p>',{text:text+" :",id:id+"_text",});row.append(_text);var _value=$('<p>',{text:value,id:id+"_value",});row.append(_value);var _button=$('<button>',{text:'Изменить',id:id+'_button'});row.append(_button);return row;}
static edit(){}}
>>>>>>> fbbb79dfde975802fdbaadc53b9bd2c717fb0393

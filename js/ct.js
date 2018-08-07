
class	Connect{static js(url){var script=document.createElement('script');script.src='/js/'+url+'.js';script.async=false;document.head.appendChild(script);}
static scripts(scripts){scripts.forEach(function(url){var script=document.createElement('script');script.src='/js/'+url+'.js';script.async=true;document.head.appendChild(script);});}
static view(id,url){var url='/views/'+url+'.html';if(!url)alert('Error url not found');else{$.ajax({url:url,type:'POST',success:function(result){$('#'+id).append(result);}});}}
static css(url){var ms=document.createElement("link");ms.rel="stylesheet";ms.href="/css/"+url+".css";document.getElementsByTagName("head")[0].appendChild(ms);}}
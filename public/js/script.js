function MM_preloadImages() { //v3.0
    var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
      var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
      if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
  }
  function MM_swapImgRestore() { //v3.0
    var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
  }
  function MM_findObj(n, d) { //v4.01
    var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
      d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
    if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
    if(!x && d.getElementById) x=d.getElementById(n); return x;
  }
  function MM_swapImage() { //v3.0
    var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
     if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
  }


function Lock_onoff(obj, current_path, category) {
    if (obj.src == current_path+'/keylockon.png') {
        obj.setAttribute('src', current_path + '/keylockoff.png');
        let elements = document.getElementsByClassName(category);
        for (let i = 0; i < elements.length; i++) {
            elements[i].readOnly = false;
        }
        let btn = document.getElementById(category + 'btn');
        btn.type = 'submit';

    }else{
        obj.setAttribute('src', current_path + '/keylockon.png');
        let elements = document.getElementsByClassName(category);
        for (let i = 0; i < elements.length; i++) {
            elements[i].readOnly = true;
        }
        let btn = document.getElementById(category + 'btn');
        btn.type = 'hidden';
    }
}



function Lock_onoff_mytasks(obj, current_path, category) {
    if (obj.src == current_path+'/keylockon.png') {
        obj.setAttribute('src', current_path + '/keylockoff.png');
        let elements = document.getElementsByClassName(category);
        console.log(elements);
        for (let i = 0; i < elements.length; i++) {
            elements[i].contentEditable = "true";
        }

    }else{
        obj.setAttribute('src', current_path + '/keylockon.png');
        let elements = document.getElementsByClassName(category);
        for (let i = 0; i < elements.length; i++) {
            elements[i].contentEditable = "false";
        }
    }
}


//ページの読み込みが終わるのを待つ
window.addEventListener("load", function(){
    let processes = document.getElementsByClassName("processes");
    for (let i = 0; i < processes.length; i++) {
        let process = processes[i];
        process.addEventListener("keypress",function(event){
            //Enterを押すと、そのデフォルト操作（改行）を中止して、フォーカスを外す
            //さらに、Input hidddenに更新したい値を埋め込み、formにて送信
            if (event.key === "Enter") {
                event.preventDefault();
                process.blur();
                document.getElementById("taskid_processname").value = process.id;
                document.getElementById("input_value").value = process.textContent;
                document.mytasks_form.submit();
                console.log(document.getElementById("taskid_processname"));
                console.log(document.getElementById("input_value"));
            }else{
                //console.log(event.key)
            }
         });
    }

    //editor.addEventListener("input",function(){
       //console.log("input");
    //});

})


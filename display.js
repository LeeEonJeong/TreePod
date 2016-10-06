
function deleteOption(type){
    var select_option = document.getElementById(type);
 //   alert(select_option);
    for(i=0; i<select_option.length-1;){
        select_option.remove(select_option.length-1);
    }
}

function display(my_id,type){

    var send_form = document.getElementById('sendform');

    var zone = document.getElementById('zoneid');
    var zone_val = zone.options[zone.selectedIndex].value;

    var e = document.getElementById(my_id);
    var sel_val = e.options[e.selectedIndex].value;

   
    var data = my_id+'='+sel_val;

    var xhr = new XMLHttpRequest();
    var asyPage = "";
    var next_type = "";
    if(type!="diskofferingid"){
        deleteOption(type);
    }
    if(type == "product"){
        next_type = 'templateid';
        asyPage = 'asyProductTYPE.php';
        deleteOption('templateid');
        deleteOption('serviceofferingid');
        
    }
    else if(type =="templateid"){    
        next_type = 'serviceofferingid';
        asyPage = 'asyProductOS.php';
        data += '&zoneid='+zone_val;
        deleteOption('serviceofferingid');
    } 
    else if(type=='serviceofferingid'){
        next_type = 'diskofferingid';
        asyPage = 'asyProductCore.php';
        
        data += '&zoneid='+zone_val;

        var productType = document.getElementById('product');
        var product_val = productType.options[productType.selectedIndex].value;
        data += '&product='+product_val;

    } 
    else if(type=='diskofferingid'){
        asyPage = 'asyProductDisk.php';
        data += '&zoneid='+zone_val;
        var productType = document.getElementById('product');
        var product_val = productType.options[productType.selectedIndex].value;
        data += '&product='+product_val;

        var servType = document.getElementById('templateid');
        var servType_val = servType.options[servType.selectedIndex].value;
        data += '&templateid='+servType_val;
    }
    else {

        return false;
    }
    xhr.open('POST',asyPage);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(data);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200) {

            var temp_text = xhr.responseText;
         //   alert(temp_text);
            var option_array = temp_text.split("<option>");

            if(type=="diskofferingid"){
                var disk_id = option_array[1];
                document.getElementById('diskofferingid').options[0].value=disk_id;
                return true;
            }

            
            var input_id = document.getElementById(type);

            var opt = document.createElement("OPTION");
        
            if(type=="templateid" || type=="serviceofferingid" ){
                for( i=0; i<option_array.length-1; i = i + 2 ){
                    var opt = document.createElement("OPTION");
                    opt.setAttribute("value", option_array[i+1]);
                    opt.label = option_array[i];
                    input_id.add(opt);
                }
                return true;    
            }
            for( i=0; i<option_array.length-1; i++){
                var opt = document.createElement("OPTION");
                opt.setAttribute("value", option_array[i]);
                opt.label = option_array[i];
                input_id.add(opt);
            }

        }
    }
}


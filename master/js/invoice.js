/*===================== Inset Date and Time ========================== */
let x = new Date();
document.getElementById('inv-date').value = `${x.getFullYear()}-${x.getMonth()}-${x.getDate()}`;
document.getElementById('inv-time').value = `${x.getHours()}:${x.getMinutes()}:${x.getSeconds()}`;
// =================================================================
// get patinet  phone
function getMob(){
    let patid = document.getElementById('patid').value;
    if( patid == 0){
        document.getElementById('mob').value = "";
    }
    else{
        let getData = new XMLHttpRequest;
        getData.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('mob').value = this.responseText
            }
        }
        getData.open("GET","../pages/getmob.php?q="+patid,true);
        getData.send();
    }
}
document.getElementById('patid').addEventListener('change',getMob);
// get patient age
 function getAge(){
    let patid = document.getElementById('patid').value;
    if( patid == 0){
        document.getElementById('age').value = "";
    }
    else{
        let getData = new XMLHttpRequest;
        getData.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('age').value = this.responseText
            }
        }
        getData.open("GET","../pages/getage.php?q="+patid,true);
        getData.send();
    }
}
document.getElementById('patid').addEventListener('change',getAge);
// get patient treat doctor
function getTreat(){
    let patid = document.getElementById('patid').value;
    if( patid == 0){
        document.getElementById('tdoc').value = "";
    }
    else{
        let getData = new XMLHttpRequest;
        getData.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('tdoc').value = this.responseText
            }
        }
        getData.open("GET","../pages/gettreat.php?q="+patid,true);
        getData.send();
    }
}
document.getElementById('patid').addEventListener('change',getTreat);
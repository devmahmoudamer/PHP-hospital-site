document.getElementById('e-click').onclick = function(){
    let myTag = document.getElementsByClassName("hide"),
        i;
    for( i = 0 ; i < myTag.length; i++){
        myTag[i].style.display = "block";
    }
    this.style.display = "none";
    document.getElementById('show').style.display = "inline-block"
}
let a=1;
function show_hide()
{
    if(a===1)
    {
        document.getElementById("formulaire").style.display="inline";
        document.getElementById("form2").style.display="inline";
        return a=0;
    }
    else{
        document.getElementById("formulaire").style.display="none";
        document.getElementById("form2").style.display="none";
        return a=1;
    }
}
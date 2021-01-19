function toggel()
{
    var el = document.getElementById('tog');
    var x = document.getElementById('jj');

    if(el.className == "handburger")
    {
        el.className = "active"; 
        x.className = "mobnav";
    }
    else
    {
        el.className = "handburger";
        x.className = "mobnavc"
    }
}


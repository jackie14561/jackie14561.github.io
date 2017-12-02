function makeCloud()
{
	
	var text_arr = document.getElementById("tags").value;
	document.getElementById("tags").innerHTML = text_arr;
	alert(text_arr);
	var elements=text_arr.split(" ");
	elements.sort();
    elements.join(' ');
	var current = null;
	var count = 0;

	for(var i = 0; i < elements.length; i++)
	{
    if(elements[i] != current)
	{
    if(count > 0)
    {
        alert(current + ": " + count+" occurences");
    }
    current = elements[i];
    count = 1;
  }
  else
  {
    count++;
  }
}

if(count > 0)
{
    alert(current + ": " + count+" occurences");
	
}




function mode(array)
{
    if(array.length == 0)
        return null;
    var modeMap = {};
    var maxEl = array[0], maxCount = 1;
    for(var i = 0; i < array.length; i++)
    {
        var el = array[i];
        if(modeMap[el] == null)
            modeMap[el] = 1;
        else
            modeMap[el]++;  
        if(modeMap[el] > maxCount)
        {
            maxEl = el;
            maxCount = modeMap[el];
        }
    }
    return maxEl;
}

alert(mode(elements));






var element, newElement, parent;
function main() {
    var spanObj = "<span>" + elements + "</span>"
	element = document.getElementById("cloud");

// Assuming it exists...
if (element) {
    // Get its parent
    parent = element.parentNode;

    // Create the new element
    newElement = document.createElement('div');

    // Set its ID and content
    newElement.id = "newcloud";
    newElement.innerHTML = spanObj;

    // Insert the new one in front of the old one (this temporarily
    // creates an invalid DOM tree [two elements with the same ID],
    // but that's harmless because we're about to fix that).
    parent.insertBefore(newElement, element);

    // Remove the original
    parent.removeChild(element);
	document.body.appendChild(element);
	elements[index] = spanObj
	
}
   
	
   document.getElementById("cloud").style.outline = "solid silver";
    
	
}

main();


/*



var div = document.getElementById('newcloud');
    // get an array of child nodes
    divChildren = div.childNodes;

for (var i=0; i<divChildren.length; i++) {
    divChildren[i].style.font = "serif";
    divChildren[i].style.textAlign = "center";
}
*/
}

function saveCloud(){
	    

        var exdate=new Date();

        exdate.setDate(exdate.getDate()+expiredays);

        document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());

    

    function getCookie(c_name) {

        if (document.cookie.length>0) {

            c_start=document.cookie.indexOf(c_name + "=");

            if (c_start!=-1) { 

                c_start=c_start + c_name.length+1; 

                c_end=document.cookie.indexOf(";",c_start);

                if (c_end==-1) c_end=document.cookie.length;

                var cookieContent = "Welcome back " + unescape(document.cookie.substring(c_start,c_end));

                document.getElementById('myDiv2').innerHTML = cookieContent;

            } 

        }

    }
	getCookie(elements);
	

    getCookie('content');
}
function clearArea()
{
	 document.getElementById("tags").value = "";
  
}

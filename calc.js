Memory  = "0";       
   Current = "0";        
    Operation = 0;       
    MAXLENGTH = 30;
	 function display(num) {
        var node = document.getElementById("display");  
		node.value=num;
     }
	 
function AddDigit(dig)          
 { if (Current.indexOf("!") == -1)  
    { if (    (eval(Current) == 0)
              && (Current.indexOf(".") == -1)
         ) { Current = dig;
           } else
           { Current = Current + dig;
           };
      Current = Current.toLowerCase(); 
    } else
    { Current = "Hint! Press 'AC'";  
    };
   if (Current.indexOf("e0") != -1)
     { var epos = Current.indexOf("e");
       Current = Current.substring(0,epos+1) + Current.substring(epos+2);
     };
  if (Current.length > MAXLENGTH)
     { Current = "Aargh! Too long"; 
     };
   document.Calculator.Display.value = Current;
 }

function Dot()                 
 {
  if ( Current.length == 0)     
    { Current = "0.";
    } else
    {  if (   ( Current.indexOf(".") == -1)
            &&( Current.indexOf("e") == -1)
          )
         { Current = Current + ".";
    };   };
  document.Calculator.Display.value = Current;
 }





function Operate(op)            
 {
 if (Operation != 0) { Calculate(); }; 

  if (op.indexOf("*") > -1) { Operation = 1; };       
  if (op.indexOf("/") > -1) { Operation = 2; };       
  if (op.indexOf("+") > -1) { Operation = 3; };      
  if (op.indexOf("-") > -1) { Operation = 4; };       

  Memory = Current;                 
  
  Current = "";
  document.Calculator.Display.value = Current;
 }

function Calculate()            
 { 
  if (Operation == 1) { Current = eval(Memory) * eval(Current); };
  if (Operation == 2)
    { if (eval(Current) != 0)
      { Current = eval(Memory) / eval(Current)
      } else
      { Current = "Aargh! Divide by zero"; 
      }
    };
  if (Operation == 3) { Current = eval(Memory) + eval(Current); };
  if (Operation == 4) { Current = eval(Memory) - eval(Current); };
  Operation = 0;                
  Memory = "0";                  
  Current = Current + "";       
  if (Current.indexOf("Infinity") != -1)        
    { Current = "Aargh! Value too big";
    };
  if (Current.indexOf("NaN") != -1)        
    { Current = "Aargh! I don't understand";
    };
  document.Calculator.Display.value = Current;
 
 }

function FixCurrent()
 {
  Current = document.Calculator.Display.value;
  Current = "" + parseFloat(Current);
  if (Current.indexOf("NaN") != -1)
    { Current = "Aargh! I don't understand";
    };
  document.Calculator.Display.value = Current;
 }

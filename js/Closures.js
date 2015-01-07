/* 
 * 
 function registerHandlers() {
  var as = document.getElementsByTagName('a');
  for (i = as.length; i-- >= 0;) {
    as[i].onclick = function() {
      alert(i);
      return false;
    }
  }
}
 * 
 */

$('document').ready(function(){
  registerHandlers();  
});


function registerHandlers() {
  var as = document.getElementsByTagName('a');
  var tab = new Array();
  var i;
  
  
  for (i = as.length-1; i >= 0; i--) {
//    tab[i] = i;  
    (function(e) {
        as[i].onclick = function() {
          alert(e);
          return false;
        };
    })(i);
   
  }
}


//function celebrityName(firstName) {
//    var nameIntro = "This celebrity is ";
//    // this inner function has access to the outer function's variables, including the parameter​
//    function lastName(theLastName) {
//        return nameIntro + firstName + " " + theLastName;
//    }
//    return lastName;
//}
//
//
//wynik = celebrityName("Nelson");
//console.log(wynik("Jackson")); // This celebrity is Michael Jackson 
//console.log(wynik("Kaczorowski"));
//console.log(wynik("Kowalski"));
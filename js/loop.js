function appendChildren() {
   
  var allDivs = document.getElementsByTagName("div");
  for (i = 0; i < allDivs.length; i++) {
    var newDiv = document.createElement("div");
    decorateDiv(newDiv);
    // allDivs[i].appendChild(newDiv);
  }
}
$('document').ready(function(){
    appendChildren();
});
// Mock of decorateDiv function for testing purposes
function decorateDiv(div) {
    
}


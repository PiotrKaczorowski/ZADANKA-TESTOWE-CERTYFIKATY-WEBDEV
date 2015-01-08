function appendChildren() { 
  var allDivs = document.getElementsByTagName("div");
  for (i = 0; i < allDivs.length; i++) {
    decorateDiv(allDivs[i]);  
  }
}
// Mock of decorateDiv function for testing purposes
function decorateDiv(allDiv) {
    var newDiv = document.createElement("div");
    allDiv.appendChild(newDiv);
}
$('document').ready(function(){
    appendChildren();
});

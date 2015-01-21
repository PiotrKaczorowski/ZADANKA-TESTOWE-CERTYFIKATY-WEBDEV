function appendChildren() { 
  var allDivs = document.getElementsByTagName("div");
  var count = allDivs.length;
  
  for (var i = 0; i < count; i++) {
    decorateDiv(allDivs[i]);  
  }
}
// Mock of decorateDiv function for testing purposes
function decorateDiv(allDiv) {
    var newDiv = document.createElement("div");
    allDiv[i].appendChild(newDiv);
}
$('document').ready(function(){
    appendChildren();
});

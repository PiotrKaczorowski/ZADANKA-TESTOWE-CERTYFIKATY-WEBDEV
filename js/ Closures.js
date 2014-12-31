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
function registerHandlers() {
  var as = document.getElementsByTagName('a');
  for (i = as.length; i-- >= 0;) {
    as[i].onclick = function() {
      alert(i);
      return false;
    }
  }
}

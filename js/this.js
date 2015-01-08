function registerClickHandler() {
  $('#clickme').click(function() {
    var zm = this.innerHTML;
    setTimeout(function() {
      alert(zm);
    }, 200);
    return false;
  });
}
$(function(){
   registerClickHandler(); 
});

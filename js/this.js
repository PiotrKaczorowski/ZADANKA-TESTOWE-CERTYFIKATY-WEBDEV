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

//function registerClickHandler() {
//  $('#clickme').click(function() {
//    //var zm = this.innerHTML;
//    var that = this;
//    setTimeout(function() {
//      alert(that.innerHTML);
//    }, 200);
//    return false;
//  });
//}
//$(function(){
//   registerClickHandler(); 
//});


//
//
//function Constructor()
//{
//    this.x = 'jestem wartością Constructor.x';
//    this.test = function() { console.log(this.x); }
//};
//obj = new Constructor(); // w konsoli pokaże się "jestem wartością Constructor.x"
//
//obj.test();

//var x = 'window'
//,   obj1 = {
//        x : 'obj1',
//        test : function() { console.log('obj1.test ' + this.x); }
//},  obj2 = {
//        x : 'obj2',
//};
//
//function test() { console.log('po prostu test ' + this.x); }


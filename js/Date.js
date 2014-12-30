/*
 * 100%
 *
Write a function that converts user entered date formatted as M/D/YYYY to a format required by an API (YYYYMMDD). The parameter "userDate" and the return value are strings.
For example, it should convert user entered date "12/31/2014" to "20141231" suitable for the API.

function formatDate(userDate) {
   // format from M/D/YYYY to YYYYMMDD
}
*
*/
function formatDate(userDate) {
    var aMy = userDate.split("/");
   
    if(aMy[0]<=9){
        aMy[0] = '0' + aMy[0];
    }
     if(aMy[1]<=9){
        aMy[1] = '0' + aMy[1];
    }
    
    return aMy[2]+aMy[0]+aMy[1];
}
alert(formatDate('2/1/2014'));
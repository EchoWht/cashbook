/**
 * Created by wang on 2017/2/3.
 */
function addNumber(number) {

    var a=$("#text-number").val();
  if (number=='.'){
      if (a.indexOf(".")>0){
          return
      }
  }
  b=a+number
    $("#text-number").val(b);
}
function delNumber(num) {
    var a=$("#text-number").val();
    var l=a.length;
    var m=l-num;
console.log(m)
    if (m>=0){
        var b=a.substring(0,m);
        $("#text-number").val(b)
    }
}
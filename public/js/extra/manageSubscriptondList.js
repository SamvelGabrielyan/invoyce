
//for pagination
    function changePagination(pageNo){
    document.getElementById("page").value=pageNo;
    filterJobDetails();
    }



    function filterStanDetails(){
    var search='';
    var giveQ='?';
    var prepa=$("#prepage").val();
    var page=$("#page").val();
    var remove='&page=';
    var filter_type=$("#filter_type").val();
    var end_date=$("#end_date").val();
    var start_date=$("#start_date").val();


    if(typeof prepa!="undefined" && prepa!=""){
    search=search+prepa;
    }
    if(typeof page!="undefined" && page!=''){
    search=search+"&";
    search=search+"page="+page+"";
    }
    if(typeof filter_type!="undefined" && filter_type!=''){
    search=search+"&";
    search=search+"filter_type="+filter_type+"";
    }


     if(typeof start_date!="undefined" && start_date!=''){
    search=search+"&";
    search=search+"start_date="+start_date+"";
    }
    if(typeof end_date!="undefined" && end_date!=''){
    search=search+"&";
    search=search+"end_date="+end_date+"";
    }
   


 // alert(search);
    if(search!=''){
    var resultval=giveQ+""+search;
    resultval = resultval.replace("?&",'?');
    resultval=removeLastPlus(resultval);
    }else{
    resultval='';
    }
    var baseUrlPath=getbaseUrlPath();

     window.location.href=baseUrlPath+'dashboard/invoices/subscription-invoices-list'+resultval;
    }
  function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
  }
  function removeLastPlus(str) {
  if (str.slice(-1) == '&') {
  return str.slice(0, -1);
  }
  return str;
  }
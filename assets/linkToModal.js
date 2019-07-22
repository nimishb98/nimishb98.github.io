jQuery(function($) {
var site_url=$('#click').data('siteurl');
var link=$('#click').data('link');


//CSS Loading

var link = document.createElement('link');  
link.rel = 'stylesheet';  
link.type = 'text/css'; 
link.href =site_url+'assets/css/bootstrap-modal.css';  
document.getElementsByTagName('HEAD')[0].appendChild(link);  

//Modal js Loading
var imported = document.createElement('script');
imported.src = site_url+'assets/js/bootstrap-modal.js';
document.head.appendChild(imported);

//Modal HTML Append
var modal ='<div class="modal fade" id="myFormModel" ><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Lead Capture Form</h4></div><div class="modal-body" id="hello"><iframe id="frameUrl" src="http://localhost/Portal/SimplyIDo/Development/p/df/f1625bb5e5a5a47185765a4165c2dced" onload="setIframeHeight(this.id)"   width="100%"  frameborder="0" ></iframe></div></div></div></div>'
$('body').append(modal);

//Function for modal execution
$( "#click" ).on( "click", function() {
 	/*var link = $(this).data('link');
  popUp(link);*/
  $('#myFormModel').modal('show');
});
/*function popUp(link){
    $('#myFormModel').modal({backdrop: 'static', keyboard: false});
  var url=link;
  $('#frameUrl').attr('src', url);
} 
*/

 });
//resize modal
function getDocHeight(doc) {
    doc = doc || document;
    // stackoverflow.com/questions/1145850/
    var body = doc.body, html = doc.documentElement;
    var height = Math.max( body.scrollHeight, body.offsetHeight, 
        html.clientHeight, html.scrollHeight, html.offsetHeight );
    return height;
}
function setIframeHeight(id) {
    var ifrm = document.getElementById(id);
    var doc = ifrm.contentDocument? ifrm.contentDocument: 
        ifrm.contentWindow.document;
    ifrm.style.visibility = 'hidden';
    ifrm.style.height = "10px"; // reset to minimal height ...
    // IE opt. for bing/msn needs a bit added or scrollbar appears
    ifrm.style.height = getDocHeight( doc ) + 4 + "px";
    ifrm.style.visibility = 'visible';
}

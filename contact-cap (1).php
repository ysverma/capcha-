<?php
ob_start();
error_reporting(0);
session_start();

if(isset($_POST['submit'])){

    if (isset($_POST['g-recaptcha-response'])) {
        $recaptcha = post_captcha($_POST['g-recaptcha-response']);
    } else {
        $recaptcha = false;
    }

    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LcBedkZAAAAACWn0BvieCfUPlQIs-8k7cRnDxDn',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
            $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

//echo 'welcome\r'.$_SESSION['security_code'].'    '.$_POST['security_code'];

/*$session_code=$_SESSION['security_code'];
$page_cap=$_POST['security_code'];
$session_lower=strtolower($session_code);
$page_lower=strtolower($page_cap);*/

if($recaptcha->success==true && $recaptcha->score <= 0.5) {

		// Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
		//echo 'Thank you. Your message said "'.$_POST['message'].'"';
		$success="Thank you for filling the form, we will be in touch with you to confirm the details. We look forward to working with you!"; 
		//unset($_SESSION['security_code']);
		//$to='vluthra@dotzoo.net';
		$to='manishphp@dotzoo.net';
		$subject = 'Buy-Properties Contact Information';
		$n=$_POST['name'];
        $ph=$_POST['phone'];
		$email=$_POST['email'];
		$rec=$_POST['recipient'];
		$pro=$_POST['programes'];
		$ser=$_POST['services'];
        $comm=$_POST['comments'];
		 $message .= "<html>";
	$message .= "<head>";
	$message .= "</head>";
	$message .= "<body>";
	$message .= '<table width="400"  cellspacing="0" cellpadding="0" align="center"  border="0" style="border:2px #2D348E solid; background-color:##E1DDBA;">
				  <tr>
  					 <td height="30" bgcolor="#2D348E" align="center" >
					<font color="#FFFFFF" size="3" face="Arial,Helvetica, sans-serif"><b>&nbsp;&nbsp;&nbsp;Buy-Properties Contact Information</b></font></td>
 				 </tr>
 				 <tr>
  				  <td align="left"><font size="2" face="Arial,Helvetica,sans-serif">
				  <br/><b>&nbsp;&nbsp;Your Name:&nbsp;&nbsp;&nbsp;</b>'.$n.'<br/>
				  <br/><b>&nbsp;&nbsp;Phone No.:&nbsp;&nbsp;&nbsp;</b>'.$ph.'<br/>
				   <br/><b>&nbsp;&nbsp;Email:&nbsp;&nbsp;&nbsp;</b>'.$email.'<br/>
				  <br/><b>&nbsp;&nbsp;Recipient:&nbsp;&nbsp;&nbsp;</b>'.$rec.'<br/>
				  <br/><b>&nbsp;&nbsp;Programes:&nbsp;&nbsp;&nbsp;</b>'.$pro.'<br/>
				  <br/><b>&nbsp;&nbsp;Services:&nbsp;&nbsp;&nbsp;</b>'.$ser.'<br/>
				  <br/><b>&nbsp;&nbsp;Comments:&nbsp;&nbsp;&nbsp;</b>'.$comm.'<br/><br/></font>
				  </td>
  </tr></table></body></html>';
		$from = $_POST['email'];
		$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; UTF-8' . "\r\n";
     $headers .= 'From:'.$_POST['email'] . "\r\n" .
    'Reply-To:'.$_POST['email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
		
		//echo "($to, $subject, $message, $headers)"; 
		mail($to, $subject, $message, $headers);
		
		
		
		echo "<script language='javascript'>";
//echo "alert('Record has been added successfully');";
		echo "location.href='thanks.html';";
		echo "</script>";
		}
		else
       {
		// Insert your code for showing an error message here
		$errormsg="Please go back and make sure you check the Security Check Box.";
	   }

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

<title>Buy-properties.com - Contact Us Intelligent Forms!</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META name="verify-v1" content="7bKuc2gnmsfuQklCCpoyuu/hZZ1fXaT+dxlPfGxflMQ=" />

<link href="buy-prop.css" type="text/css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=6LcBedkZAAAAAHXNz4hjL0WBGJ6OFFp0B8Z2ZBGQ"></script>
    <script>
        grecaptcha.ready(function() {
            // do request for recaptcha token
            // response is promise with passed token
            grecaptcha.execute('your reCAPTCHA site key here', {action:'validate_captcha'})
                .then(function(token) {
                    // add token value to form
                    document.getElementById('g-recaptcha-response').value = token;
                });
        });
    </script>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}


function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;

}


function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
  if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


<script language = "Javascript">
/**
 * DHTML phone number validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */

/***************************  Validation for Phone Number******************/
// Declaring required variables
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()-.";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 7;
var maxDigitsInIPhoneNumber = 12;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}
function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
var bracket=3
strPhone=trim(strPhone)
if(strPhone.indexOf("+")>1) return false
if(strPhone.indexOf("-")!=-1)bracket=bracket+1
if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false
var brchr=strPhone.indexOf("(")
if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false
if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
s=stripCharsInBag(strPhone,validWorldPhoneChars);
return (isInteger(s)  && s.length <= maxDigitsInIPhoneNumber);
}

//========================   start functions for Phone check =======

var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

</script>

<script type="text/javascript">

function form_validate(form1)
{
var Phone=document.form1.phone;
if( document.form1.name.value=="" )
	{
       alert("Please enter the Name");
       document.form1.name.focus();
		return false;
    }
 if ((Phone.value==null)||(Phone.value=="")){

		alert("Please Enter your Phone Number")
		Phone.focus();
		return false;
	}
	if (checkInternationalPhone(Phone.value)==false){
	
		alert("Please Enter a Valid Phone Number")
		Phone.value=""
		Phone.focus();
		return false;
	}
if(is_email(document.form1.email.value) == "")
{
  alert("Please enter valid E-mail!!");
    document.form1.email.focus();
    return false;
}	
	
if(document.form1.recipient.value=="" )
	{
       alert("Please Enter the Recipient");
     // department.focus();
		return false;
    }
if(document.form1.programes.value=="" )
	{
       alert("Please Select dZo Programes");
     // department.focus();
		return false;
    }	
if(document.form1.services.value=="" )
	{
       alert("Please Select dZo Services");
     // department.focus();
		return false;
    }				
if(document.form1.security_code.value=="")
{
alert("Enter security_code");
document.form1.security_code.focus();
return false;
}	
	
}
function is_email(email)
	{
		if(!email.match(/^[A-Za-z0-9\._\-+]+@[A-Za-z0-9_\-+]+(\.[A-Za-z0-9_\-+]+)+$/))
			return false;
		return true;
	}
	</script>  
    
</head>

<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="80%"  vspace="0" align="center" >

<tr valign="top">
    <td colspan="2" align="left"  valign="top"><a href="index.php"><img src="images/buyprop_10.gif" border="0" vspace="0" align="left"></a></td>
  </tr>
 <tr>

 <td width="704" height="150" align="center">
 <table width="677"  height="150" bgcolor= "#2464a4"  vspace="0">
	   <tr valign="middle">
	<td width="677" height="140" align="center" valign="middle">
	<h1 class="book">
<script language="JavaScript1.2">

/*
Neon Lights Text
By JavaScript Kit (http://javascriptkit.com)
For this script, TOS, and 100s more DHTML scripts,
Visit http://www.dynamicdrive.com
*/

var message="Contact Us"
var neonbasecolor="#9bd1f0"
var neontextcolor="white"
var flashspeed=200 //in milliseconds

///No need to edit below this line/////

var n=0
if (document.all||document.getElementById){
document.write('<font color="'+neonbasecolor+'">')
for (m=0;m<message.length;m++)
document.write('<span id="neonlight'+m+'">'+message.charAt(m)+'</span>')
document.write('</font>')
}
else
document.write(message)

function crossref(number){
var crossobj=document.all? eval("document.all.neonlight"+number) : document.getElementById("neonlight"+number)
return crossobj
}

function neon(){

//Change all letters to base color
if (n==0){
for (m=0;m<message.length;m++)
//eval("document.all.neonlight"+m).style.color=neonbasecolor
crossref(m).style.color=neonbasecolor
}

//cycle through and change individual letters to neon color
crossref(n).style.color=neontextcolor

if (n<message.length-1)
n++
else{
n=0
clearInterval(flashing)
setTimeout("beginneon()",1500)
return
}
}

function beginneon(){
if (document.all||document.getElementById)
flashing=setInterval("neon()",flashspeed)
}
beginneon()


</script>
</h1>	</td>
	</tr>
	</table> </td>
  <td width="182" height="150" align="center" >
<script type="text/javascript">

/***********************************************
* Translucent Slideshow script- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var trans_width='300px' //slideshow width
var trans_height='150px' //slideshow height
var pause=3000 //SET PAUSE BETWEEN SLIDE (3000=3 seconds)
var degree=10 //animation speed. Greater is faster.

var slideshowcontent=new Array()
//Define slideshow contents: [image URL, OPTIONAL LINK, OPTIONAL LINK TARGET]

slideshowcontent[0]=["images/dl1.jpg", " "]
slideshowcontent[1]=["images/bm1.jpg", "", ""]
slideshowcontent[2]=["images/bb1.jpg", " ", ""]
slideshowcontent[3]=["images/ch1.jpg", "", ""]
slideshowcontent[4]=["images/dd2.jpg", " ", ""]
slideshowcontent[5]=["images/h1.jpg", " ", ""]
slideshowcontent[6]=["images/h2.jpg", " ", ""]
slideshowcontent[7]=["images/pp.jpg", " "]



////NO need to edit beyond here/////////////

var bgcolor='white'

var imageholder=new Array()
for (i=0;i<slideshowcontent.length;i++){
imageholder[i]=new Image()
imageholder[i].src=slideshowcontent[i][0]
}

var ie4=document.all
var dom=document.getElementById&&navigator.userAgent.indexOf("Opera")==-1

if (ie4||dom)
document.write('<div style="position:relative;width:'+trans_width+';height:'+trans_height+';overflow:hidden"><div id="canvas0" style="position:absolute;background-color:'+bgcolor+';width:'+trans_width+';height:'+trans_height+';left:-'+trans_width+';filter:alpha(opacity=20);-moz-opacity:0.2;"></div><div id="canvas1" style="position:absolute;background-color:'+bgcolor+';width:'+trans_width+';height:'+trans_height+';left:-'+trans_width+';filter:alpha(opacity=20);-moz-opacity:0.2;"></div></div>')
else if (document.layers){
document.write('<ilayer id=tickernsmain visibility=hide width='+trans_width+' height='+trans_height+' bgColor='+bgcolor+'><layer id=tickernssub width='+trans_width+' height='+trans_height+' left=0 top=0>'+'<img src="'+slideshowcontent[0][0]+'"></layer></ilayer>')
}

var curpos=trans_width*(-1)
var curcanvas="canvas0"
var curindex=0
var nextindex=1

function getslidehtml(theslide){
var slidehtml=""
if (theslide[1]!="")
slidehtml='<a href="'+theslide[1]+'" target="'+theslide[2]+'">'
slidehtml+='<img src="'+theslide[0]+'" border="0">'
if (theslide[1]!="")
slidehtml+='</a>'
return slidehtml
}

function moveslide(){
if (curpos<0){
curpos=Math.min(curpos+degree,0)
tempobj.style.left=curpos+"px"
}
else{
clearInterval(dropslide)
if (crossobj.filters)
crossobj.filters.alpha.opacity=100
else if (crossobj.style.MozOpacity)
crossobj.style.MozOpacity=1
nextcanvas=(curcanvas=="canvas0")? "canvas0" : "canvas1"
tempobj=ie4? eval("document.all."+nextcanvas) : document.getElementById(nextcanvas)
tempobj.innerHTML=getslidehtml(slideshowcontent[curindex])
nextindex=(nextindex<slideshowcontent.length-1)? nextindex+1 : 0
setTimeout("rotateslide()",pause)
}
}

function rotateslide(){
if (ie4||dom){
resetit(curcanvas)
crossobj=tempobj=ie4? eval("document.all."+curcanvas) : document.getElementById(curcanvas)
crossobj.style.zIndex++
if (crossobj.filters)
document.all.canvas0.filters.alpha.opacity=document.all.canvas1.filters.alpha.opacity=20
else if (crossobj.style.MozOpacity)
document.getElementById("canvas0").style.MozOpacity=document.getElementById("canvas1").style.MozOpacity=0.2
var temp='setInterval("moveslide()",50)'
dropslide=eval(temp)
curcanvas=(curcanvas=="canvas0")? "canvas1" : "canvas0"
}
else if (document.layers){
crossobj.document.write(getslidehtml(slideshowcontent[curindex]))
crossobj.document.close()
}
curindex=(curindex<slideshowcontent.length-1)? curindex+1 : 0
}

function jumptoslide(which){
curindex=which
rotateslide()
}

function resetit(what){
curpos=parseInt(trans_width)*(-1)
var crossobj=ie4? eval("document.all."+what) : document.getElementById(what)
crossobj.style.left=curpos+"px"
}

function startit(){
crossobj=ie4? eval("document.all."+curcanvas) : dom? document.getElementById(curcanvas) : document.tickernsmain.document.tickernssub
if (ie4||dom){
crossobj.innerHTML=getslidehtml(slideshowcontent[curindex])
rotateslide()
}
else{
document.tickernsmain.visibility='show'
curindex++
setInterval("rotateslide()",pause)
}
}

if (window.addEventListener)
window.addEventListener("load", startit, false)
else if (window.attachEvent)
window.attachEvent("onload", startit)
else if (ie4||dom||document.layers)
window.onload=startit

</script>  </td>
 </tr>
 <tr>
          <td colspan="2">
		  <table width="100%" height= align="center" class="navbar">
      <tr valign="top">
         <td  width="120" height="60" valign="top" ><a href="delhi.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','images/d%20copy.jpg',1)"><img src="images/delhi%20button.jpg" alt="delhi" name="Image8" width="108" height="36" border="0"></a> </td>
         <td width="40"></td>

        <td   width="120"  valign="top"><a href="mumbai.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/m%20copy.jpg',1)"><img src="images/mumbai%20button.jpg" alt="mumbai" name="Image9" width="108" height="36" border="0"></a>        </td>

       <td width="40"></td>
        <td   width="120"  valign="top"><a href="bangalore.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/b%20copy.jpg',1)"><img src="images/bangalore%20button.jpg" alt="bangalore" name="Image10" width="108" height="36" border="0"></a>          </td>
        <td width="40"></td>
         <td   width="120"  valign="top"><a href="chandigarh.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image11','','images/c%20copy.jpg',1)"><img src="images/chandigarh%20button.jpg" alt="chandigarh" name="Image11" width="108" height="36" border="0"></a>         </td>



         <td width="40"></td>
          <td class="menuNormal"  width="120"  valign="top"><a href="hyderabad.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image12','','images/h%20copy.jpg',1)"><img src="images/hyderabad%20button.jpg" alt="hyderabad" name="Image12" width="108" height="36" border="0"></a> </td>



        <td width="40"></td>
         <td   width="120"  valign="top"><a href="pune.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','images/p%20copy.jpg',1)"><img src="images/pune%20button.jpg" alt="pune" name="Image13" width="108" height="36" border="0"></a> </td>
   </tr>
    </table></td></tr>


<tr>
  <td height="260" colspan="2" valign="top"  align="left">
<form name="form1" id="form1" action=""  method="post"  onSubmit="return form_validate(this);">
			<table width="620" align="center"  border="0" cellpadding="2" cellspacing="2">
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                <input type="hidden" name="action" value="validate_captcha">
                <tr>
                 <td valign="top" height="15" class="black_para" colspan="2" align="center">
				<?php if($success){ echo '<span style="color:#22bb33; font-weight:bold;" >'.$success.'</span>'; }
				 else echo '<span style="color:#ff0000; font-weight:bold;">'.$errormsg.'</span>'; ?>
                 </td>
                </tr>
                <tr>
                <td colspan="2" align="right" class="black_para" style=" text-align: center; padding-left:30px;"><font color="#cc0000">*</font>Mark fields are required.</td>
              </tr>
                <tr>
                 <td valign="top" height="15" colspan="2" align="center">&nbsp;</td>
                </tr>
				 <tr>

                  <td width="201" class="text2">Your Name &nbsp;&nbsp;<font color="#cc0000">*</font></td>

                  <td width="233"><input type="text" name="name" id="name" value="<?=$_POST['name']?>" ></td>
              </tr>
				 <tr>
					 <td width="201"  class="text2">Phone No. &nbsp;&nbsp;<font color="#cc0000">*</font></td>
				   <td width="233"><input type="text" name="phone" id="phone"  value="<?=$_POST['phone']?>"  ></td>
              </tr>
              <tr>
					 <td width="201" class="text2">Email &nbsp;&nbsp;<font color="#cc0000">*</font></td>
			    <td width="233"><input type="text" name="email" id="email"  value="<?=$_POST['email']?>"  ></td>
              </tr>
				<tr>
				  <td class="text2" valign="top">Recipient: &nbsp;&nbsp;<font color="#cc0000">*</font></td>
				  <td><select tabindex="27" style="width:255px;" name="recipient" id="recipient">
                    <option value="">Please Select Ur Options for Recipient</option>
                    <option value="dZo Programes">dZo Programes</option>
                    <option value="dZo Services">dZo Services</option>
                  </select><span id="other_box"></span></td>
			    </tr>
                <tr>
				  <td class="text2" valign="top">&nbsp;</td>
				  <td><select tabindex="27" style="width:208px;" name="programes" id="programes">
                    <option value="">Please Select dZo Programes</option>
                    <option value="Buy">Buy</option>
                    <option value="Sales">Sales</option>
                  </select><span id="other_box"></span></td>
			    </tr>
                <tr>
				  <td class="text2" valign="top">&nbsp;</td>
				  <td><select tabindex="27" style="width:208px;" name="services" id="services">
                    <option value="">Please Select dZo Services</option>
                    <option value="Advertising">Advertising</option>
	                <option value="eMarketing">eMarketing</option>
	                <option value="eCommerce">eCommerce</option>
	                <option value="BPO">BPO</option
                  ></select><span id="other_box"></span></td>
			    </tr>
				
				<tr>

                  <td width="201" class="text2" valign="top">Comments</td>

                  <td width="233"><textarea name="comments" cols="23" rows="4"><?=$_POST['comments']?></textarea></td>
              </tr>
				<tr>

                    <td></td>
                  <!--<td class="text2" valign="top">Security Code &nbsp;&nbsp;<font color="#cc0000">*</font></td>

                  <td width="233">
                   <div style="width:200px;">
                       <div style="float:left; padding-top:3px;"><input type="text" name="security_code" id="security_code"  style="height:22px;"  /></div>
                        <div style="float:right; padding-top:3px;"><img src="CaptchaSecurityImages.php?width=80&height=20&characters=5" align="bottom" style="padding:3px; border:#990000 1px solid; font-size:12px;" /></div></div>
					
				
                </td>-->
              </tr>
              <tr><td></td>
              <td class="black_para">
                      <!--<div class="g-recaptcha" data-sitekey="6LcBedkZAAAAAHXNz4hjL0WBGJ6OFFp0B8Z2ZBGQ" style="transform:scale(0.85);-webkit-transform:scale(0.85);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>-->
              </td>
              <tr>

                  <td>&nbsp;</td>

                  <td  class="black_para" colspan="2" style="padding:15px 0 20px 0"><input type="submit" name="submit" value="Submit"></td>
                </tr>
			</table>
</form>
<table width="620" align="center" >
               <tr>
	         <td width="35%" height="32" valign="top" class="text2" ><strong>Phone:</strong></td>
	         <td width="65%" height="32" valign="top" class="text1"><strong>(425)793-8900</strong> </td>
	       </tr>
	       <tr>
	         <td height="26" valign="top" class="text2" ><strong>General Info:</strong></td>
	         <td height="26" valign="top" class="text1" ><a href="mailto:info@dotzoo.com" class="text1">info@buy-properties.com </a> </td>
	       </tr>
	       <tr>
	         <td height="26" valign="top" class="text2" ><strong>Sales:</strong></td>
	         <td height="26" valign="top" class="text1"><a href="mailto:sales@dotzoo.com"  class="text1">sales@</a><a href="mailto:info@dotzoo.com"  class="text1">buy-properties</a><a href="mailto:sales@dotzoo.com" class="text1">.com </a> </td>
	       </tr>
	       <tr>
	         <td height="26" valign="top" class="text2" ><strong>Marketing:</strong></td>
	         <td height="26" valign="top" class="text1" ><a href="mailto:marketing@dotzoo.com" class="text1">marketing@</a><a href="mailto:info@dotzoo.com"  class="text1">buy-properties</a><a href="mailto:marketing@dotzoo.com" class="text1">.com </a> </td>
	       </tr>
	       <tr>
	         <td height="26" valign="top" class="text2" ><strong>Operations:</strong></td>
	         <td height="26" valign="top" class="text1"><a href="mailto:operations@dotzoo.com" class="text1">operations@</a><a href="mailto:info@dotzoo.com"  class="text1">buy-properties</a><a href="mailto:operations@dotzoo.com" class="text1">.com </a> </td>
	       </tr>
	       <tr>
	         <td height="26" valign="top" class="text2" ><strong>Webmaster:</strong></td>
	         <td height="26" valign="top" class="text1"  ><a href="mailto:webmaster@dotzoo.com" class="text1"> webmaster@</a><a href="mailto:info@dotzoo.com"  class="text1">buy-properties</a><a href="mailto:webmaster@dotzoo.com" class="text1">.com </a> </td>
	       </tr>
                </table>

 <tr bgcolor="#336699" valign="top">
    <td height="36" colspan="3"><div align="center">
      <table width="59%" height="26" vspace="0" >
          <tr align="center" valign="top">
            <td class="footer"><a href="buyproperty.htm">Buy / Sell Property</a> </td>
            <td class="footer">|</td>
            <td class="footer"><a href="contact.php">Contact Us</a></td>
            <td class="footer">|</td>
            <td class="footer"><a href="ourservices.htm">Our Services</a> </td>
			<td class="footer">|</td>
			<td class="footer"><a href="resource.htm">Resources</a> </td>
			<td class="footer">|</td>
            <td class="footer"><a href="sitemap.xml">XML</a></td>
            <td class="footer">|</td>
            <td class="footer"><a href="sitemap.htm">Sitemap  </a></td>
          </tr>
        </table>
    </div></td>
  </tr><tr valign="top">
    <td colspan="2" align="center" valign="middle"><tr><td colspan="2"><div align="center" class="style9">Copyright@Buy-Properties.com All Right Reserved </div></td>
  </tr>
    <tr valign="top">
    <td colspan="2" align="center" valign="middle"><a href="http://www.dzogroup.com/"><img src="images/dzologo.jpg" width="86" height="34" border="0"></a></td>
  </tr>
</table>

</td>
</tr>


</body>

</html>


		
		
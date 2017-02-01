<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> Payment </TITLE>
 </HEAD>

 <BODY>
 <form action="submit.php" method="post">

<INPUT TYPE="hidden" NAME="product" value="OSTELLO">
<INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">

<INPUT TYPE="hidden" NAME="clientcode" value="007">
<INPUT TYPE="hidden" NAME="AccountNo" value="1234567890">

<INPUT TYPE="hidden" NAME="ru" value="http://amerytech.net/ostello/">
<input type="hidden" name="bookingid" value="100001"/>
 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
        <td>* Name</td> 
        <td>:</td>
        <td><input name="udf1" type="text" value="" /></td>
        <td><span style="color:Red;visibility:hidden;">Client Name is mandatory.</span></td>

    </tr>
    <tr>
        <td>* Email ID</td> 
        <td>:</td>
        <td><input name="udf2" type="text" value="" /></td>
        <td><span style="color:Red;visibility:hidden;">Email is mandatory.</span></td>
    </tr>
    <tr>

        <td>* Mobile No</td> 
        <td>:</td>
        <td><input name="udf3" type="text" value="" /></td>
        <td><span style="color:Red;visibility:hidden;">Mobile No</span></td>
    </tr>
    <tr>
        <td>* Billing Address</td> 
        <td>:</td>

        <td><input name="udf4" type="text" value=""  /></td>
        <td><span style="color:Red;visibility:hidden;">Billing Address is mandatory.</span></td>
    </tr>
   <!--  <tr>
        <td>* Bank Name</td> 
        <td>:</td>
        <td><input name="udf5" type="text" value="bank1" /></td>
        <td><span style="color:Red;visibility:hidden;">Bank Name is mandatory.</span></td>

    </tr> -->
    
<tr>
<td>
Amount
</td>
<td>:</td>
<td>
<input type="text" name="amount" value="" />
</td>
</tr>

  
<tr>
<td>
</td>
<td></td>
<td>
<input type="submit" name="Submit" value="Submit" />
</td>
</tr>
</table>
 </form>
 </BODY>
</HTML>

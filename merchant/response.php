<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> Payment </TITLE>
 </HEAD>

 <BODY>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td>
  <?php if($_POST['f_code']=="Ok"){ ?>
  Success : Your Transaction is been processed.
  <?php } else { ?>
Failure : Your Transaction couldnot be processed.
  <?php } ?>
 </td>
 </tr>
</table>
 </BODY>
</HTML>

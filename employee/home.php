<?php
include ('header.php');
// $user_name = $_SESSION['name'];
// echo $user_name;
// echo "test";
?>
    <form id="form1" name="form1" method="post" action="">
        <div align="right">
            <table class="table table-striped" border="0">

        

              
				
                <tr>
                    <td height="80">
                        <div align="right" dir="rtl">
                            <a href="takrer1.php?id=1" class="style1"> <span style="color:red">تقارير بأنشـطـة خدمـة الـمـجـتـمع التى تمت بالفـعـل</span>
</a> </div>

                    </td>
                </tr>				
				 <!--  <tr>
                    <td height="80">
                        <div align="right" dir="rtl">
                            <a href="takrer1.php?id=2" class="style1"> خطة الأنشطة الطلابية المستقبلية</a> </div>

                    </td>
                </tr>			
				  </tr>	-->
				   <tr >
                    <td height="80">
                        <div align="right" dir="rtl">
                            <a href="plan.php" class="style1"><span style="color:red">الخــــطـــة المـــجـــمـــعـــة</span></a> </div>

                    </td>
                </tr>
                <tr >
                    <td height="80">
                        <div align="right" dir="rtl">
                            <a href="activityBulk.php" class="style1"><span style="color:red">خطـــة الأنــشــطــة المــســتقبليــة بالعام الجامعى</span></a> </div>

                    </td>
                </tr>					  
				   <tr hidden>
                    <td height="80">
                        <div align="right" dir="rtl">
                            <a href="report.php" class="style1">تقارير احصائية للمتابعة</a> </div>

                    </td>
                </tr>
   </tr>				
				  </tr>				
				<!--  <tr>
                    <td height="80">
                        <div align="right" dir="rtl">
                            <a href="report2.php" class="style1">بيان بالأنشطة الطلابية خلال فترة معينة</a> </div>

                    </td>
                </tr>	-->			
            </table>
        </div>
    </form>
<?php

include 'footer.php';
?>
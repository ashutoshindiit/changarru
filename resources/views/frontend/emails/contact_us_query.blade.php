<body>
   <table width="100%" cellpadding="0" cellspacing="0" style="float:left; margin-bottom:50px;">
   <table width="100%"  align="center" style="" cellpadding="0" cellspacing="0" >
      <tr>
         <td>
            <table width="100%"  style="margin:0 auto; max-width:800px;" cellpadding="0" cellspacing="0" >
               <tr>
                  <td>
                     <table width="600px" style="margin:0 auto; border:3px solid #4096ee; " cellpadding="0" cellspacing="0"  >
                        @include('frontend.emails.include.email_header')

                        <tr>
                           <td>
                              <p style="padding: 10px;">Dear <b style="color:#4096ee;">Admin</b>,</p>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <p style="padding: 10px; font-weight: bolder;">Query :-</p>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <p style="padding: 10px; margin-top: -17px;">{{$title}}</p>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>
                              <p style="padding: 10px; margin-top: -17px;">{{$description}}</p>
                           </td>
                        </tr>
                        
                        @include ('frontend.emails.include.email_footer')
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</table>
</body>

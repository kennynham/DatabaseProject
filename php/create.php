<html>
   
   <head>
      <title>Add New Account</title>
   </head>
   
   <body>
      <?php
         if(isset($_POST['add'])) {
            $dbhost = '**************************STUDENTIPADDESS'; // STUDENT IP ADDRESS
            $dbuser = 'root';
            $dbpass = 'rootpassword';
            $conn = mysql_connect($dbhost, $dbuser, $dbpass);
            
            if(! $conn ) {
               die('Could not connect: ' . mysql_error());
            }
            
    
            
            $sql = "INSERT INTO ACCOUNTS ". "(user_id, firstnames, lastname, 
               email, login, password, date_joined) ". "VALUES('$user_id','$firstname','$lastname','$email','$login','$password','date_joined' NOW())";
               
            mysql_select_db('STUDENT_DATABASE');//*******Student SERVER
            $retval = mysql_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not enter data: ' . mysql_error());
            }
            
            echo "Entered data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
            
               <form method = "post" action = "<?php $_PHP_SELF ?>">
                  <table width = "400" border = "0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr>
                        <td width = "100">First Name</td>
                        <td><input name = "First Name" type = "text" 
                           id = "firstname"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> Last Name</td>
                        <td><input name = "Last Name" type = "text" 
                           id = "lastnames"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> Email</td>
                        <td><input name = "email" type = "text" 
                           id = "email"></td>
                     </tr>

                     <tr>
                        <td width = "100"> login</td>
                        <td><input name = "login" type = "text" 
                           id = "login"></td>
                     </tr>

                     <tr>
                        <td width = "100"> password</td>
                        <td><input name = "password" type = "text" 
                           id = "login"></td>
                     </tr>
                 
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "add" type = "submit" id = "add" 
                              value = "submit">
                        </td>
                     </tr>
                  
                  </table>
               </form>
            
            <?php
         }
      ?>
   
   </body>
</html>
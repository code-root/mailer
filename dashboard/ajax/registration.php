<?php
include '../conn.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                         
                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                $username_V1 = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $password1 = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
                $password2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);
///              $checkbox = filter_var($_POST['checkbox'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);


                   preg_match('/[a-zA-Z0-9 ]+/i',$username_V1,$username_v4);
              @     $username =  $username_v4[0];
            

                   if ( $username == '' ) 
                   {
                    $message='<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm">لم تقم بإضافة إسم المستخدم </p>';
                    echo json_encode(['code'=>1, 'msg'=>$message]);
                    exit;
                   };

                   
                   if ( $name == '' ) 
                   {
                    $message='<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> لم تقم بإضافة إسمك  </p>';
                    echo json_encode(['code'=>1, 'msg'=>$message]);
                    exit;
                   };


               if ( $email == '' ) 
               {
                $message='<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> لم تقم بإضافة  البريد الأكتروني  </p>';
                echo json_encode(['code'=>2, 'msg'=>$message]);
                exit;
               };
    
                                          
               if ( $password1 == '' ) 
               {
                $message='<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> لم تقم بإضافة كلمة المرور </h4> ';
                echo json_encode(['code'=>3, 'msg'=>$message]);
                exit;
               };

               if ( $password2 == '' ) 
               {
                $message='<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> لم تقم بإضافة تكرار كلمة المرور </h4> ';
                echo json_encode(['code'=>4, 'msg'=>$message]);
                exit;
               };




               if ($password1 !== $password2 ) {

                $message='<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> كلمة المرور غير متطابقة </h4> ';
                echo json_encode(['code'=>5, 'msg'=>$message]);
                exit;

               }

               if (strlen($password1)  < 7  ) {

                $message='<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> يجب أن تكون كلمة المرور أكثر من 8  حروف  </h4> ';
                echo json_encode(['code'=>5, 'msg'=>$message]);
                exit;

            } 


            if (strlen($username)  < 4  ) {

                $message='<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> إسم المستخدم يجب أن يكون أكثر من 3 حروف   </h4> ';
                echo json_encode(['code'=>5, 'msg'=>$message]);
                exit;

            } 

             $password =  sha1($password1);

                      if (!isset($username) ==''){ 
                                    // chack Username 
            $sql = "SELECT Username FROM users WHERE Username = '$username'";
            $result = $conn->query($sql);
             if ($result->num_rows == 1) {

                $msg = '<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> إسم المستخدم هذا مسجل لدينا حاول مره أخرى بإسم مختلف </h4> ';
                echo json_encode(['code'=>6, 'msg'=>$msg]);
                exit; 
            } 
        }             
        
        if (!isset($email) ==''){ 
             // chack Username 
            $sql = "SELECT Email FROM users WHERE Email LIKE '$email'";
            $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                $msg = '<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> هذا البريد اللإكتروني مسجل لدينا حاول مره أخرى ببريد إكتروني مختلف </h4> ';
                echo json_encode(['code'=>7, 'msg'=>$msg]);
                exit; 
            } 
        }


        if (!isset($username) == '' && !isset($password) == '' && !isset($email) == '' && !isset($name) == ''  ){


                    $sql = "INSERT INTO users (Full_name, username, password , number , email , img , status , Registration)
                                      VALUES ('$name', '$username', '$password' , 'null' , '$email' , 'null' , 0 ,   now() ) ";
        
                    $conn->query($sql);
              
                    $msg = '<h4 class="block text-sm text-left text-indigo-600 bg-indigo-200 border border-indigo-400 h-12 flex items-center p-4 rounded-sm"> تم تسجيل البيانات بنجاح جاري تحويلك لتسجيل الدخول  </h4> ';
                    echo json_encode(['status'=>'done', 'msg'=>$msg]);
                    exit; 

            
            
        } else {

            $msg = '<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> بعض البيانات لم تقم بإداخلها بشكل صحيح راجع البيانات وعاود الحاولة   </h4> ';
            echo json_encode(['code'=>8, 'msg'=>$msg]);
            exit;    
        }
               }else {

                        $msg = 'You do not have permission to view the content';
                        echo json_encode(['code'=>'You do not have powers', 'Message'=>$msg]);
                        exit; 
                      }
                ?>
                

<?php
include '../conn.php';
session_start(); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                         
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $password1 = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

                           
               if ( $username == '' ) 
               {
                $message=" <p class='block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm'> لم تقم بإضافة إسم المستخدم </p>";
                echo json_encode(['code'=>200, 'msg'=>$message]);
                exit;
               };

                                          
               if ( $password1 == '' ) {
                $message=" <p class='block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm'> لم تقم بإضافة كلمة المرور </p>";
                echo json_encode(['code'=>200, 'msg'=>$message]);
                exit; 
              };

                 $password =  sha1($password1);

                $sql = "SELECT * FROM users where username = '$username' AND password = '$password' ";
                $result = $conn->query($sql);
            
                if ($result->num_rows == 1 ) {
                    $get = $result->fetch_assoc();
                   $_SESSION['customerId']   = $get['id']; // Register User ID in Session               
                    $_SESSION['username']     = $get['username'] ;   // RegisterUsername   
                    $_SESSION['username']     = $get['username'] ;   // RegisterUsername   
                    $message="<div class='block text-sm text-left text-indigo-600 bg-indigo-200 border border-indigo-400 h-12 flex items-center p-4 rounded-sm'>
                    Logged in successfully welcome ". $_SESSION['username'] ." :) 
                     </div>";
                    echo json_encode(['status'=>'done','msg'=>$message]);
                    exit;
    
  

            } else {
            
                $message= '<h4 class="block text-sm text-left text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm"> حاول مرة أخرى المعلومات خطأ </h4> ' ;
                echo json_encode(['code'=>200, 'msg'=>$message]);
                exit;
            
                }

            $conn->close();

                    }else {

                        $msg = 'You do not have permission to view the content';
                        echo json_encode(['code'=>'You do not have powers', 'Message'=>$msg]);
                        exit; 
                      }
                ?>
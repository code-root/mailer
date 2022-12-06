<?php  include'layout/nav.php'; ?>
<!-- include libraries(jQuery, bootstrap) -->

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">

                            <h3 class="text-gray-700 text-3xl font-semibold">Mailer inBOX</h3>
                            <div class="RE"></div>

    <div class="mt-8 xxx">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg text-gray-700 font-semibold capitalize"> Form Mailer  </h2>
                <form action="" method="POST" enctype="multipart/form-data" >
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="text-gray-700" for="username">الإميل المرسل من</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="" id="from" type="text">
                            <input  value=""  hidden name="id" type="text">
                        </div>

                        <div>
                            <label class="text-gray-700" for="emailAddress">إسم الخارجي للإميل </label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600"  value="" placeholder="إسم الخارجي للإميل "  id="name" type="text">
                        </div>

                        <div>
                            <label class="text-gray-700" for="password">الإرسال لـ </label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600"  value="" placeholder="الإرسال لـ "  type="text" id="to">
                        </div>

                        <div>
                            <label class="text-gray-700" for="passwordConfirmation">موضوع الرسالة</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600"  value="" placeholder="موضوع الرسالة" id="sub" type="txt">
                        </div>

                    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

                    <!-- include summernote css/js -->
                    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

                    </div>
                    <div>
                            <label class="text-gray-700" for="passwordConfirmation"></label>
                            <textarea id="mes" class="summernote"></textarea>
                        </div>

                    <div class="flex justify-end mt-4">
                        <input type="submit" value="إرسال الرسالة" class=" api px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700" > </input>
                    </div>
                </form>
            </div>
        </div>
    </div>
          

          <script>
          $(document).ready(function() {
                 $('.summernote').summernote({
                    height: 300,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                 // set focus to editable area after initializing summernote
                });
});

$(document).ready(function() {
$('.api').click(function(e){
  e.preventDefault();
$.ajax({
    type: "POST",
    url: "../ajax/MailerInbox.php",
    dataType: "json",
    data: {from:$("#from").val() , name:$("#name").val()
       , to:$("#to").val()  , sub:$("#sub").val() ,
       mes:$("#mes").val()  },

            success : function(data){
                if (data.status == "done"){
                    $(".RE").html('<span class="text-green-500 font-semibold">تم بنجاح  </span>');
                    $('.xxx').hide();
                } else {
                    $(".RE").html('<h4 class="btn btn-danger btn-lg btn-fill">'+data.msg+'</h4>');
                }
            } 
  });
});
});


          </script>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
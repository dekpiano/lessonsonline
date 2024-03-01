$(document).on("submit","#loginForm", function(e) {
    e.preventDefault();
    
    $.ajax({
        type: "POST",
        url: "../../../php/Login/MainLogin.php",
        data: $(this).serialize(),
        success: function(response) {
            console.log(response);
            if(response == 1){
               
            }else{
                Swal.fire({
                    title: "แจ้งเตือน!",
                    text: "ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง?",
                    icon: "error"
                  });
            }
           
       }
   });
 });
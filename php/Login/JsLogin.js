$(document).on("submit","#loginForm", function(e) {
    e.preventDefault();
    
    $.ajax({
        type: "POST",
        url: "../../../php/Login/PhpLoginMain.php",
        data: $(this).serialize(),
        success: function(response) {
            console.log(response);
            if(response == "teacher"){
               window.location.href = "../../../pages/Teacher/Home/HomeMain";
            }else if(response == "student"){
                window.location.href = "../../../pages/Users/Home/HomeMain";
            }
            else{
                Swal.fire({
                    title: "แจ้งเตือน!",
                    text: "ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง?",
                    icon: "error"
                  });
            }
           
       }
   });
 });
$(document).on("submit","#FormInsertQuizzes", function(e) {
    e.preventDefault();

    $('input[name="OptAnswer[]"]').each(function() {
        // ถ้าไม่มี checkbox ไหนถูกเลือกในรอบนี้
        if (!$(this).is(":checked")) {
            // เพิ่ม checkbox ที่ไม่ได้ถูกเลือกเข้าไปในฟอร์ม โดยกำหนดค่า default เป็น 0
            console.log($(this).after('<input type="hidden" name="OptAnswer[]" value="0">'));
        }
    });

    var formData = new FormData($("#FormInsertQuizzes")[0]);
    $.ajax({
        type: "POST",
        url: "../../../pages/Teacher/Quizzes/Php/QuizzesPhpInsert.php",
        data: formData,
        contentType: false,
        processData: false,
        dateType:"json",
        success: function(response) {          
          console.log(response);
          if(response == 1){
            Swal.fire({
              title: "แจ้งเตือน!",
              text: "บันทึกคำถามเรียบร้อย!",
              icon: "success"
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            });           
          }else{
            Swal.fire({
              title: "แจ้งเตือน!",
              text: response.Text,
              icon: "error"
            });
          }
         
        },
        error: function() {
            $("#result").html("<div class='alert alert-danger'>There was an error processing your request</div>");
        }
    });
});
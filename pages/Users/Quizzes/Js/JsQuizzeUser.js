
$(document).on("submit","#FormCheckAnswers", function(e) {
    e.preventDefault();
    var formData = new FormData($("#FormCheckAnswers")[0]);
    $.ajax({
        type: "POST",
        url: "../../../pages/Users/Quizzes/Php/CheckAnswersUser.php",
        data: formData,
        contentType: false,
        processData: false,
        dateType:"json",
        success: function(response) {          
          console.log(response);
        //   if(response == 1){
        //     Swal.fire({
        //       title: "แจ้งเตือน!",
        //       text: "บันทึกข้อมูลคอร์สเรียนเรียบร้อย!",
        //       icon: "success"
        //     }).then((result) => {
        //       if (result.isConfirmed) {
        //         window.location.href = '../../../pages/Teacher/Course/CourseMain';
        //       }
        //     });           
        //   }else{
        //     Swal.fire({
        //       title: "แจ้งเตือน!",
        //       text: response.Text,
        //       icon: "error"
        //     });
        //   }
         
        },
        error: function() {
            $("#result").html("<div class='alert alert-danger'>There was an error processing your request</div>");
        }
    });
});
$('#Tb_Couesr').DataTable({
    "paging": true,   
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });

$(document).on("submit","#courseForm", function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../../../pages/Teacher/Course/Php/CoursePhpInsert.php",
        data: formData,
        success: function(response) {
            Swal.fire({
                title: "แจ้งเตือน!",
                text: "บันทึกข้อมูลคอร์สเรียนเรียบร้อย!",
                icon: "success"
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = '../../../pages/Teacher/Course/CourseMain';
                }
              });
        },
        error: function() {
            $("#result").html("<div class='alert alert-danger'>There was an error processing your request</div>");
        }
    });
});

$(document).on("submit","#courseFormUpdate", function(e) {
  e.preventDefault();
  var formData = $(this).serialize();
  $.ajax({
      type: "POST",
      url: "../../../pages/Teacher/Course/Php/CoursePhpUpdate.php",
      data: formData,
      success: function(response) {
        console.log(response);
        if(response == 1){
          Swal.fire({
            title: "แจ้งเตือน!",
            text: "แก้ไขข้อมูลคอร์สเรียนเรียบร้อย!",
            icon: "success"
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../../../pages/Teacher/Course/CourseMain';
            }
          });
        }
        
      },
      error: function() {
          $("#result").html("<div class='alert alert-danger'>There was an error processing your request</div>");
      }
  });
});
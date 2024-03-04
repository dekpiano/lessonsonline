$(document).on("submit","#FormRegisterUser", function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../../../pages/Users/Register/Php/RegisterPhpInsert.php",
        data: formData,
        success: function(response) {
            console.log(response);
            Swal.fire({
              title: 'สำเร็จ!',
              text: 'สมัครเรียนเรียบร้อย เข้าสู่ระบบได้เลย',
              icon: 'success',
              confirmButtonText: 'ตกลง'
          }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = '../../../pages/Users/Home/HomeMain'; // หรือหน้าอื่นที่คุณต้องการ
              }
          });

        },
        error: function() {
          Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถสมัครเรียนได้', 'error');
        }
    });
});
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


function validatePassword() {
  var password = document.getElementById("Password").value;
  var confirmPassword = document.getElementById("ConfirmPassword").value;
  var validationMessage = document.getElementById("validationMessage");

  // Password matching check
  if (password !== confirmPassword) {
      validationMessage.textContent = "รหัสผ่านไม่ตรงกัน";
      validationMessage.style.color = "red";
      return false;
  }

  // Password strength check: at least one lowercase, one uppercase letter, and one number
  var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

  if (!regex.test(password)) {
      validationMessage.textContent = "รหัสผ่านจะต้องมีอักษรตัวพิมพ์เล็กอย่างน้อยหนึ่งตัว ตัวพิมพ์ใหญ่หนึ่งตัว และตัวเลขหนึ่งตัว ความยาวขั้นต่ำคือ 8 ตัวอักษร";
      validationMessage.style.color = "red";
      return false;
  }

 validationMessage.textContent = "รหัสผ่านตรงกัน";
  validationMessage.style.color = "green";
  return true;
}

function CheckEmailRegister() {

  var email = $('#Email').val();
  if(email.length === 0) {
    $('#emailStatus').text('');
    return;
}

  $.ajax({
    type: "POST",
    url: "../../../pages/Users/Register/Php/RegisterPhpCheckEmail.php",
    data: {Email: email},
    success: function(response) {
      console.log(response);
        if(response == 1) {
            $('#emailStatus').text('อีเมลนี้มีผู้ใช้งานแล้ว!');
            $('#BtnSubmitRegister').prop('disabled', true);
        } else {
            $('#emailStatus').text('');
            $('#BtnSubmitRegister').prop('disabled', false);
        }
    }
});
  
}

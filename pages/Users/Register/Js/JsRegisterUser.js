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



document.addEventListener('DOMContentLoaded', () => {
  const password1Input = document.getElementById('Password');
  const password2Input = document.getElementById('ConfirmPassword');
  const messageElement = document.getElementById('message');
  const messageElement13 = document.getElementById('message13');
  const numberInput = document.getElementById('UserIdCard');
  const submitButton = document.getElementById('BtnSubmitRegister');

  function validatePassword(password) {
      const minLength = 8;
      const maxLength = 20;
      const minUpper = 1;
      const minLower = 1;
      const minDigit = 1;
      const minSpecial = 1;

      if (password.length < minLength || password.length > maxLength) {
          return `รหัสผ่านต้องมีความยาวระหว่าง ${minLength} ถึง ${maxLength} ตัวอักษร`;
      }
      if ((password.match(/[A-Z]/g) || []).length < minUpper) {
          return `รหัสผ่านต้องมีตัวอักษรพิมพ์ใหญ่ อย่างน้อย ${minUpper} ตัว`;
      }
      if ((password.match(/[a-z]/g) || []).length < minLower) {
          return `รหัสผ่านต้องมีตัวอักษรพิมพ์เล็ก อย่างน้อย ${minLower} ตัว`;
      }
      if ((password.match(/[0-9]/g) || []).length < minDigit) {
          return `รหัสผ่านต้องมีตัวเลข อย่างน้อย ${minDigit} ตัว`;
      }
      if ((password.match(/[\W_]/g) || []).length < minSpecial) {
          return `รหัสผ่านต้องมีตัวอักษรพิเศษ อย่างน้อย ${minSpecial} ตัว`;
      }

      return "รหัสผ่านถูกต้อง";
  }

  function validateNumber(number) {
    if (number.length === 13 && /^\d+$/.test(number)) {
        return "หมายเลขถูกต้อง";
    } else {
        return "หมายเลขต้องมีความยาว 13 หลักและประกอบด้วยตัวเลขเท่านั้น";
    }
  }

  function validateNumberField() {
    const number = numberInput.value;
       // ตรวจสอบและตัดข้อมูลที่เกิน 13 หลัก
       if (number.length > 13) {
        number = number.slice(0, 13);
        numberInput.value = number;
    }

    const numberMessage = validateNumber(number);
    
    if (numberMessage !== "หมายเลขถูกต้อง") {
        messageElement13.textContent = numberMessage;
        messageElement13.style.color = "red";
        submitButton.disabled = true; // ปิดการใช้งานปุ่ม data-inputmask="'mask': '9999999999999'"
        return false;
    }else{
      messageElement13.textContent = "";
    }

    return true;
  }

  function validateForm() {
      const password1 = password1Input.value;
      const password2 = password2Input.value;

      const validationMessage = validatePassword(password1);

      if (validationMessage !== "รหัสผ่านถูกต้อง") {
          messageElement.textContent = validationMessage;
          messageElement.style.color = "red";
          submitButton.disabled = true; // ปิดการใช้งานปุ่ม
          return;
      }

      if (password1 === password2) {
          messageElement.textContent = "รหัสผ่านตรงกัน";
          messageElement.style.color = "green";
          submitButton.disabled = false; // เปิดใช้งานปุ่ม
      } else {
          messageElement.textContent = "รหัสผ่านไม่ตรงกัน";
          messageElement.style.color = "red";
          submitButton.disabled = true; // ปิดการใช้งานปุ่ม
      }
  }

  password1Input.addEventListener('input', validateForm);
  password2Input.addEventListener('input', validateForm);
  numberInput.addEventListener('input', validateNumberField);
});

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

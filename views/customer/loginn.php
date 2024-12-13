<div class="bodyLogin">
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    .bodyLogin {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: url('../../assets/customer/images/Background.png') no-repeat;
      background-size: cover;
      background-position: center;
    }

    .login {
      width: 500px;
      background-color: rgb(102, 164, 184);
      height: 400px;
      position: relative;
      border-radius: 20px;
    }

    .signUp {
      width: 500px;
      background-color: rgb(102, 164, 184);
      height: 700px;
      position: relative;
      border-radius: 20px;
    }

    h1 {
      font-family: 'Lora', serif;
      text-align: center;
      margin-bottom: 30px;
    }

    .formLogin {
      margin-top: 40px;
    }

    .input-box {
      width: 100%;
      height: 50px;
      margin-top: 20px;
    }

    .input-box i {
      position: absolute;
      right: 65px;
      margin-top: 12px;
      font-size: 20px;
    }

    .input-box input {
      margin-left: 10%;
      width: 80%;
      height: 46px;
      border-radius: 10px;
      border: none;
      outline: none;
      padding: 10px;
      font-size: 16px;
    }


    .show {
      margin-left: 50px;
      display: flex;
      font-size: 15px;
    }

    .btnLogin {
      width: 130px;
      height: 40px;
      border-radius: 10px;
      outline: none;
      border: none;
      margin-left: 185px;
      margin-top: 20px;
      background-color: aqua;
      font-size: 20px;
      font-weight: 600;
      color: rgb(83, 81, 81);
    }

    .btnLogin:hover {
      background-color: rgb(41, 112, 235);
      color: white;
      cursor: pointer;
    }

    .dk,
    .dn {
      width: 50%;
      margin: 20px 0 0 150px;
    }

    .login {
      display: block;
    }

    .signUp {
      display: none;
    }
  </style>
  <div class="login">
    <form class="formLogin" action="login-authentication.php" method="post">
      <h1>Đăng nhập</h1>
      <div class="input-box">
        <input name="user" type="text" placeholder="Tên tài khoản">
        <i class='bx bx-user'></i>
      </div>
      <div class="input-box">
        <input name="pass" id="pass" type="password" placeholder="Mật khẩu">
        <i class='bx bxs-lock-alt'></i>
      </div>

      <div class='show'>
        <input id="check" type='checkbox'><label for="">Hiển thị mật khẩu</label>
      </div>
      <button class='btnLogin' type="submit">Đăng nhập</button>
      <div class='dk'>
        <p>Chưa có tài khoản? <a href="registerr.php">Đăng ký</a></p>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const check = document.getElementById('check');
      const pass = document.getElementById('pass');

      check.addEventListener('change', () => {
        if (check.checked) {
          pass.type = 'text';
        } else {
          pass.type = 'password'
        }
      });

    });
  </script>
</div>
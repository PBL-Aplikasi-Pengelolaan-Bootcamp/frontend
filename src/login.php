<?php 

  include("function.php");
  if (isset($_POST["login"])) {
    login($_POST);
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Simplify | Masuk</title>
  <link href="output.css" rel="stylesheet" />
  <link href="img/logo.png" rel="shortcut icon" />
</head>

<body class="">
  <div class="contanier">
    <!-- FORM -->
    <div class="container login-width md:login-width-md m-auto flex relative top-10 flex-col gap-8 leading-3">
      <div class="hero m-auto mb-5">
        <img src="img/logo.png" alt="" />
      </div>
      <h1 class="font-poppins font-medium md:font-semibold text-3xl text-slate-700">Masuk</h1>

      <form method="post">
      <div class="flex flex-col gap-5">
        <input type="text" name="username" placeholder="Username" class="border border-slate-300 py-2 px-2 rounded-sm" />
        <input type="password" name="password" placeholder="Password" class="border border-slate-300 py-2 px-2 rounded-sm" />
        <!-- <a href="#" class="text-right font-poppins text-sm">Lupa Password?</a> -->
        <button type="submit" name="login" class="bg-blue-700 rounded-sm text-white font-poppins font-semibold py-4 px-6">
          Masuk
        </button>
      </div>
      </form>

      <div class="flex gap-4 my-2">
        <header
          class="border border-b-slate-300 w-44 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
        </header>
        <h3 class="text-center text-slate-500">atau</h3>
        <header
          class="border border-b-slate-300 w-44 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
        </header>
      </div>

      <p class="font-quicksand font-normal text-center text-slate-500">
        Belum punya akun? Ayo
        <a href="buat-akun.php" class="text-slate-700 font-semibold">daftar</a>
      </p>
    </div>
    <!-- FORM END -->
  </div>
</body>

</html>
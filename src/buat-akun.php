<?php 

include("function.php");
if (isset($_POST["register"])) {
  register($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Simplify | Buat Akun</title>
  <link href="output.css" rel="stylesheet" />
  <link href="img/logo.png" rel="shortcut icon" />
</head>

<body class="">
  <div class="contanier">
    <!-- FORM -->
    <div class="container login-width md:login-width-md m-auto flex relative top-10 flex-col gap-8 leading-3" style="width: 500px; margin-top: 10vh;">
      <div class="hero m-auto mb-5">
        <img src="img/logo.png" alt="" />
      </div>
      <h1 class="font-poppins font-medium text-3xl md:font-semibold text-slate-700">Daftar</h1>

      <form method="post">
      <div class="flex flex-col gap-5">
        <input type="text" name="nama" placeholder="Nama Lengkap" class="border border-slate-300 py-2 px-2 rounded-sm" required/>
        <input type="text" name="username" placeholder="Username" class="border border-slate-300 py-2 px-2 rounded-sm" required/>
        <input type="email" name="email" placeholder="Email" class="border border-slate-300 py-2 px-2 rounded-sm" required/>
        <input type="password" name="password" placeholder="Password" class="border border-slate-300 py-2 px-2 rounded-sm" required/>
        <input type="password" name="password2" placeholder="Confirmation Password" class="border border-slate-300 py-2 px-2 rounded-sm" required/>
        <button type="submit" name="register" class="bg-blue-700 rounded-sm text-white font-poppins font-semibold py-4 px-6">
          Daftar
        </button>
      </div>
      </form>

      <div class="flex gap-4 my-2">
        <header
          class="border border-b-slate-300 w-44 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
        </header>
        <h3 class="text-center text-slate-500 m-auto">atau</h3>
        <header
          class="border border-b-slate-300 w-44 border-l-transparent border-t-transparent border-r-transparent relative bottom-1">
        </header>
      </div>

      <p class="font-quicksand font-normal text-center text-slate-500">
        Sudah punya akun? Ayo
        <a href="login.php" class="text-slate-700 font-semibold">masuk</a>
      </p>
    </div>
    <!-- FORM END -->
  </div>
</body>

</html>
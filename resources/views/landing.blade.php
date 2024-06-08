<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Whizcyle</title>
    <link rel="icon" href="{{url('assets/img/logo.png')}}" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .navbar {
        background-color: rgba(255, 255, 255, 0.5); /* Transparent background */
        backdrop-filter: blur(10px); /* Optional: Adds a blur effect */
      }
      .section {
        padding: 100px 0;
      }
      .primary-font-color{
        color:#276561
      }
      .primary-bg-color{
        background-color:#276561;
        color:white;
      }
      .white-bg-color {
        background-color: #fff;
        border-color: #276561;
        padding-left: 35px;
        padding-right: 35px;
        padding-top: 13px;
        padding-bottom: 13px;
        color: #276561; /* Set the default text color */
        transition: background-color 0.3s, color 0.3s; /* Add smooth transition */
    }

    .white-bg-color:hover {
        background-color: #276561; /* Change background color on hover */
        color: #fff; /* Change text color on hover */
    }
      .fixed-top {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1030;
      }
      h1,a,p {
        color:black
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#home" style="margin-left:150px;">
          <img src="{{ url('assets/img/logo.png')}}" alt="Logo" width="120" height="80" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a  class="nav-link active" aria-current="page" href="#home" style="font-size:18px;">Home</a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="#tentang-kami" style="margin-left:10px;font-size:18px;">Tentang Kami</a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="#layanan" style="margin-left:10px;font-size:18px;">Layanan</a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="#kontak" style="margin-left:10px;font-size:18px;">Kontak</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Sections -->
    <section id="home" class="section bg-light">
      <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p style="margin-top:300px;font-size:35px;" class="primary-font-color">Halo, Salam Hijau!</p>
                <b><h1>SELAMAT DATANG DI <br> WhizCycle!</h1></b>
                <p style="margin-top:80px;">Layanan pengelolaan sampah yang cepat, efisien, dan ahli dalam mendaur ulang sampah</p>
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ url('register') }}" style="padding-left:35px;padding-right:35px;padding-top:13px;padding-bottom:13px;" class="btn primary-bg-color">Daftar</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ url('login') }}" class="btn white-bg-color" style="border-color:#276561;padding-left:35px;padding-right:35px;padding-top:13px;padding-bottom:13px;">Login</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <img src="{{ url('assets/img/landing1.png')}}" alt="Logo" width="1000" height="700" class="d-inline-block align-text-top">
            </div>
        </div>
      </div>
    </section>

    <section id="tentang-kami" class="section primary-bg-color text-white">
      <div class="container text-center">
        <h2>Tentang Kami</h2>
        <br><br>
        <p style="color:#ffffff">Penyedia layanan yang bertujuan untuk memperluas konsep bank sampah dengan memanfaatkan teknologi digital. Whizcycle hadir untuk memudahkan Anda dalam menjaga lingkungan dengan cara yang praktis dan efisien.
Melalui platform kami, Anda dapat dengan mudah mengatur penjemputan sampah dari rumah Anda.
<br><br>

Whizcycle bukan hanya tentang mengelola sampah, tetapi juga tentang mendorong gaya hidup berkelanjutan dan kesadaran lingkungan. Bergabunglah dengan kami untuk menjadi bagian dari perubahan positif dalam menjaga kelestarian lingkungan.</p>
      </div>
    </section>

    <section id="layanan" class="section bg-light">
      <div class="container text-center">
        <h2>How can we help you?</h2>
        <br><br><br>
        <div class="row">
            <div class="col-md-4">
                <img src="{{ url('assets/img/1.png')}}" alt="Logo" width="250" height="300" class="d-inline-block align-text-top">
                <p>
                    Pelanggan dapat dengan mudah mengajukan permintaan penjemputan sampah melalui aplikasi. hal ini memberikan kemudahan untuk pelanggan dalam melestarikan lingkungan.
                </p>
            </div>
            <div class="col-md-4">
                <img src="{{ url('assets/img/2.png')}}" alt="Logo" width="250" height="300" class="d-inline-block align-text-top">
                <p>
                Memudahkan pelanggan untuk menjelajahi dan memilih produk-produk daur ulang yang tersedia memberikan keuntungan dalam mengurangi pemborosan sumber daya, dan berkontribusi pada pelestarian lingkungan.
                </p>
            </div>
            <div class="col-md-4">
                <img src="{{ url('assets/img/3.png')}}" alt="Logo" width="250" height="300" class="d-inline-block align-text-top">
                <p>
                    kumpulkan poin setiap kali berbelanja dan tukarkan dengan hadiah atau manfaat eksklusif melalui promo-promo spesial dan diskon-diskon menarik
                </p>
            </div>
        </div>
        <br><br><br>
        <h2>"Investing in our services is investing in your future"</h2>
        <p>unlock new possibilities and achieve sustainable growth.</p>
        <img src="{{ url('assets/img/logo.png')}}" alt="Logo" width="120" height="80" class="d-inline-block align-text-top">
        <br><br>
        <h2>Meet Our Super Team</h2>
        <br><br>
        <div class="row">
            <?php 
            for ($i=1; $i <=6 ; $i++) {
            $margin = "10px";
            if ($i == 2 || $i == 5) {
                $margin = "150px";
            }    
            ?>
                
                <div class="col-md-4" style="margin-top:{{ $margin }};">
                    <img src="{{ url('assets/img/p'.$i.'.png')}}" alt="Logo" width="250" height="400" class="d-inline-block align-text-top">
                </div>
            <?php
            }
            ?>
        </div>
      </div>
    </section>

    <section id="kontak" class="section primary-bg-color text-white">
      <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ url('assets/img/logo-foot.png')}}" alt="Logo" width="220" height="160" class="d-inline-block align-text-top">
            </div>
            <div class="col-md-8">
                <h2>Contact Info</h2>
                <br>
                <table border=0>
                    <tr>
                        <td>
                            <img src="{{ url('assets/img/gmail.png')}}" alt="Logo" width="20" height="20" class="d-inline-block align-text-top">
                        </td>
                        <td>
                            <p style="color:#ffffff;font-size:18px;margin-left:15px;margin-top:10px;">admin@WhizCycle.id</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ url('assets/img/whatsapp.png')}}" alt="Logo" width="20" height="20" class="d-inline-block align-text-top">
                        </td>
                        <td>
                            <p style="color:#ffffff;font-size:18px;margin-left:15px;margin-top:10px;">+685883431624</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ url('assets/img/internet.png')}}" alt="Logo" width="20" height="20" class="d-inline-block align-text-top">
                        </td>
                        <td>
                            <p style="color:#ffffff;font-size:18px;margin-left:15px;margin-top:10px;">www.WhizcCycle.id</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
      </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

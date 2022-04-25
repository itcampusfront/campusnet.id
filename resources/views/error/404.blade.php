<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Error 404</title>
  @include('template/front/_head')
</head>
<body>
<div class="bg-theme-1">
  <div class="d-flex justify-content-end align-items-center text-white h-100">
    <div class="container text-center">
      <div class="d-flex justify-content-center">
        <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-anchor-placement="top-bottom">4</h1>
        <h1 data-aos="fade-up" data-aos-duration="1500" data-aos-anchor-placement="top-bottom" style="color: rgba(0,0,0,.2);">0</h1>
        <h1 data-aos="fade-up" data-aos-duration="2000" data-aos-anchor-placement="top-bottom">4</h1>
      </div>
      <h5 class="text-capitalize mb-4" data-aos="fade-up" data-aos-duration="2500">We are Sorry, but the page you are requested was <span style="color: rgba(0,0,0,.2);" class="fw-bold">not found</span></h5> 
      <a data-aos="fade-up" data-aos-duration="3000" href="/" class="btn btn-theme text-uppercase btn-theme-1 me-2">Home</a>
    </div>
    <p class="position-absolute start-50 translate-middle" style="top: 93%">Made with <i class="fa fa-heart" style="font-size: .8rem; color: rgba(230, 57, 70, 1);"></i></p>
		<p class="position-absolute start-50 translate-middle" style="top: 96%"><i class="fab fa-github"></i> Powered by <a href="https://spandiv.xyz/" class="text-white" target="_blank">Spandiv</a></p>
  </div>
</div>
<style type="text/css">
  .start-50{left:50%}
  .translate-middle {transform: translate(-50%,-50%)!important;}
  nav {display: none!important;}
  footer{display: none;}
  h1{font-size: 12rem}
  h1, h5, p {color: rgba(255,255,255,1);}
  .bg-theme-1{animation: changebg 7s infinite; height: 100vh}
  .btn-theme-1{background-color: rgba(0,0,0,.2); animation: animatebtn 7s infinite!important}
  @keyframes changebg {
    0% {background-color: var(--color-1)}
    25%{background-color: var(--color-2)}
    50% {background-color: var(--color-1)}
    74% {background-color: var(--color-2)}
    100% {background-color: var(--color-1)}
  }
  @keyframes animatebtn {
    0% {width: 150px}
    25% {width: 200px}
    50% {width: 250px}
    75% {width: 200px}
    100% {width: 150px}
  }
</style>
</body>
</html>

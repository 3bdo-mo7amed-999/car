
<?php include("includes/header.php"); ?>


<?php
require_once 'auth.php';
require_login(); // هذا سيتحقق من تسجيل الدخول وإلا سيحول إلى صفحة التسجيل
include("includes/connect.php");

?>

<style>
 
  .card-img-fixed {
    height: 200px;
    object-fit: cover;
    width: 100%;
  }
</style>

<div class="container mt-5">
  <h1 class="text-center">Welcome to the Car Review Website</h1>
  <p class="text-center">Explore the latest car reviews and news</p>

  <div class="row g-4">





    <!-- Card 1 -->
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
      <div class="card h-100" style="width: 18rem;">
        <img src="./accets/img/1.jpg" class="card-img-top card-img-fixed" alt="Volkswagen Golf">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Volkswagen Golf GTI (Mk7) review</h5>
          <p class="card-text flex-grow-1">Some quick example text to build on the card title.</p>
          <a href="https://garage.gitspro.online/public/" class="btn btn-primary align-self-start flex-grow-1 align-self-center">View Details</a>
        </div>
      </div>
    </div>





    <!-- Card 2 -->
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
      <div class="card h-100" style="width: 18rem;">
        <img src="./accets/img/2.jpg" class="card-img-top card-img-fixed" alt="Volkswagen Golf">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Volkswagen Golf GTI (Mk7) review</h5>
          <p class="card-text flex-grow-1">Some quick example text to build on the card title.</p>
          <a href="https://garage.gitspro.online/public/" class="btn btn-primary align-self-start flex-grow-1 align-self-center">View Details</a>
        </div>
      </div>
    </div>





    <!-- Card 3 -->
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
      <div class="card h-100" style="width: 18rem;">
        <img src="./accets/img/1.jpg" class="card-img-top card-img-fixed" alt="Volkswagen Golf">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Volkswagen Golf GTI (Mk7) review</h5>
          <p class="card-text flex-grow-1">Some quick example text to build on the card title.</p>
          <a href="https://garage.gitspro.online/public/" class="btn btn-primary align-self-start flex-grow-1 align-self-center">View Details</a>
        </div>
      </div>
    </div>





    <!-- Card 4 -->
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
      <div class="card h-100" style="width: 18rem;">
        <img src="./accets/img/2.jpg" class="card-img-top card-img-fixed" alt="Volkswagen Golf">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Volkswagen Golf GTI (Mk7) review</h5>
          <p class="card-text flex-grow-1">Some quick example text to build on the card title.</p>
          <a href="https://garage.gitspro.online/public/" class="btn btn-primary align-self-start flex-grow-1 align-self-center">View Details</a>
        </div>
      </div>
    </div>





    <!-- Card 5 -->
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
      <div class="card h-100" style="width: 18rem;">
        <img src="./accets/img/1.jpg" class="card-img-top card-img-fixed" alt="Volkswagen Golf">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Volkswagen Golf GTI (Mk7) review</h5>
          <p class="card-text flex-grow-1">Some quick example text to build on the card title.</p>
          <a href="https://garage.gitspro.online/public/" class="btn btn-primary align-self-start flex-grow-1 align-self-center">View Details</a>
        </div>
      </div>
    </div>





    <!-- Card 6 -->
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
      <div class="card h-100" style="width: 18rem;">
        <img src="./accets/img/2.jpg" class="card-img-top card-img-fixed" alt="Volkswagen Golf">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Volkswagen Golf GTI (Mk7) review</h5>
          <p class="card-text flex-grow-1">Some quick example text to build on the card title.</p>
          <a href="https://garage.gitspro.online/public/" class="btn btn-primary align-self-start flex-grow-1 align-self-center">View Details</a>
        </div>
      </div>
    </div>





    <!-- Card 7 -->
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
      <div class="card h-100" style="width: 18rem;">
        <img src="./accets/img/1.jpg" class="card-img-top card-img-fixed" alt="Volkswagen Golf">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Volkswagen Golf GTI (Mk7) review</h5>
          <p class="card-text flex-grow-1">Some quick example text to build on the card title.</p>
          <a href="https://garage.gitspro.online/public/" class="btn btn-primary align-self-start flex-grow-1 align-self-center">View Details</a>
        </div>
      </div>
    </div>





    <!-- Card 8 -->
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
      <div class="card h-100" style="width: 18rem;">
        <img src="./accets/img/2.jpg" class="card-img-top card-img-fixed" alt="Volkswagen Golf">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Volkswagen Golf GTI (Mk7) review</h5>
          <p class="card-text flex-grow-1">Some quick example text to build on the card title.</p>
          <a href="https://garage.gitspro.online/public/" class="btn btn-primary align-self-start flex-grow-1 align-self-center">View Details</a>
        </div>
      </div>
    </div>







  </div>
</div>

<?php include("includes/footer.php"); ?>
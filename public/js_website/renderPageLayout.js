function MainNavigation() {
  document.write(`
      <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg bg-white py-1">
      <div class="container">
        <!-- Logo -->
        <a href="index.html" class="navbar-brand ms-auto me-lg-0">
          <img src="images/Group.svg"  alt="Logo" />
        </a>
        <!-- Navbar Toggler for Mobile View -->
        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
          <span class="navbar-toggler-icon"> </span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul id="navbar" class="navbar-nav ms-auto mb-lg-0 d-flex px-5">
            <!-- Home Link -->
            <li class="nav-item mx-2 fw-semibold">
              <a class="nav-link text-primary active link-secondary text-capitalize" href="index.html#home"> الصفحة الرئيسية</a>
            </li>
            <li class="nav-item mx-2 fw-semibold">
            <a class="nav-link text-primary active link-secondary text-capitalize" href="index.html#about-us"> من نحن</a>
            </li>
            <li class="nav-item mx-2 fw-semibold">
              <a class="nav-link text-primary active link-secondary text-capitalize" href="index.html#our-products">  منتجاتنا</a>
            </li>
            <li class="nav-item mx-2 fw-semibold">
              <a class="nav-link text-primary active link-secondary text-capitalize" href="index.html#our-partners"> شركائنا</a>
            </li>
          </ul>
          
          <div>
            <a class="btn btn-secondary rounded-3" href="index.html#contact-us"> 
              <span class="mx-1">
                تواصل معنا 
              </span>
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M18.3333 9.63926C18.3333 14.0419 14.6018 17.6115 9.99996 17.6115C9.45887 17.6122 8.91933 17.5622 8.38781 17.4624C8.00523 17.3905 7.81394 17.3546 7.6804 17.375C7.54686 17.3954 7.35761 17.496 6.97911 17.6973C5.90841 18.2667 4.65992 18.4678 3.45922 18.2445C3.91558 17.6832 4.22725 17.0097 4.36477 16.2876C4.44811 15.846 4.24163 15.417 3.93237 15.1029C2.52774 13.6766 1.66663 11.7546 1.66663 9.63926C1.66663 5.23663 5.39811 1.66699 9.99996 1.66699C14.6018 1.66699 18.3333 5.23663 18.3333 9.63926Z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M9.99622 10H10.0037M13.3258 10H13.3333M6.66663 10H6.6741" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
          </div>

        </div>
      </div>
    </nav>
    <!-- End Navbar -->
  `);
}

function MainFooter() {
  document.write(`
    <footer class="py-5 bg-info">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <a href="index.html" class="mb-3">
            <img src="images/logo.svg"  class="img-fluid" alt="">
          </a>
          <p class="text-white fs-14 mt-3"> شركة امكانات التطوير هي شركة رائدة في مجال التكنولوجيا والتطوير وهي موزع معتمد لجميع العلامات التجارية الخاصة بالأجهزة الكهربائية. تعتبر الوكيل الحصري لشركه البا لجميع الأجهزة كهربائية.</p>
         
        </div>
        <div class="col-md-4 mt-5 mt-md-3">
          <div>
            <h5 class="text-white fw-semibold">أمكانات للتطوير </h5>
            <div class="row">
              <div class="col-md-6">
                <div class="d-flex flex-column">
                  <a href="index.html#home" class="text-decoration-none text-white mb-2 link-light">الصفحة الرئيسية </a>
                  <a href="index.html#about-us" class="text-decoration-none text-white mb-2 link-light">من نحن</a>
                  <a href="index.html#our-partners" class="text-decoration-none text-white mb-2 link-light">شركائنا</a>
                  <a href="index.html#our-products" class="text-decoration-none text-white mb-2 link-light">منتجاتنا</a>
                </div>
              </div>
              <div class="col-md-6">
                <div class="d-flex flex-column">
                  <a href="terms-conditions.html" class="text-decoration-none text-white mb-2 link-light">الشروط والأحكام</a>
                  <a href="privacy-policy.html" class="text-decoration-none text-white mb-2 link-light">سياسة الخصوصية</a>
                  <a href="index.html#contact-us" class="text-decoration-none text-white mb-2 link-light">تواصل معانا</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mt-5 mt-md-0">
          <h5 class="text-white">تواصل معانا</h5>
          <div>
            <ul class="list-unstyled m-0 p-0">
              <div class="row g-4">
                <div class="col-lg-8 d-flex justify-content-lg-between col-6 col-md-12 justify-content-between">
                <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-whatsapp text-white fs-5 border social-icons rounded-circle rounded-2 link-primary"></i>
                </a>
                <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-twitter text-white fs-5 border social-icons rounded-circle rounded-2 link-primary"></i>
                </a>
                <a href="" class="text-decoration-none" target="_blank"><i class="fa-brands fa-instagram  text-white fs-5 border social-icons rounded-circle rounded-2 link-primary"></i></a>
                <a href="" class="text-decoration-none" target="_blank"><i class="fa-brands fa-facebook-f text-white fs-5 border social-icons rounded-circle rounded-2 link-primary"></i></a>
                
                </div>
              
              </div>
            </ul>   
          </div>
          <div class="mt-4">
            <h5 class="text-white"> حمل التطبيق</h5>
              <div>
                <img src="images/app-store-and-google-play 3.svg" alt="" width="120">
                <img src="images/app-store-and-google-play 2.svg" alt="" width="120">
              </div>
          </div>
        
        </div>
      </div>
        <hr class="text-white border-white">
        <div class="text-center align-items-center">
          <p class="text-white p-0 m-0">شركة أمكانات للتطوير 2024</p>
          <a href="https://emcan-group.com/en" target="_blank" class="text-warning text-decoration-none fw-semibold fs-7"> <span class="text-white">بواسطة</span> Emcan Solutions </a>
        </div>
    </div>
  </footer>
  `);
}


function includeSidebar() {
  document.write(`
  <!--========= start sidebar  =========-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header bg-white">
    <img src="images/Group.svg" width="80"" alt="" />
    <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body bg-white hover-links">
    <ul class="navbar-nav ms-auto me-auto mb-lg-0 d-flex px-3">
  <li class="nav-item me-3 fw-bold ">
      <a class="nav-link text-black active link-success" href="index.html#home">الصفحة الرئيسية</a>
  </li>
  <li class="nav-item me-3 fw-bold ">
      <a class="nav-link text-black active link-success" href="index.html#about-us">من نحن</a>
  </li>
  <li class="nav-item me-3 fw-bold ">
      <a class="nav-link text-black active link-success" href="index.html#our-products">منتجاتنا</a>
  </li>
  <li class="nav-item me-3 fw-bold ">
      <a class="nav-link text-black active link-success" href="index.html#our-partners">شركائنا</a>
  </li>
  <li class="nav-item me-3 fw-bold ">
      <a class="nav-link text-black active link-success" href="index.html#contact-us">تواصل معنا</a>
  </li>
</ul>

  </div>
</div>
<!--========= end sidebar  =========-->
  `);
}



function BtnBackToTop() {
  document.write(`
  <button
        type="button" title="Back to top"
        class="back-to-top btn btn- text-white rounded-circle py-2 px-2">
  <img src="images/arrow-up.svg" class="mb-3" width="18" />
  </button>  
  `);
}
function WhatsApp() {
  document.write(`
  <a href="https://wa.me/+97334479384" class="whats-app btn btn-info py-2 px-2 rounded-circle" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Whatsapp">
  <i class="bi bi-whatsapp my-float"></i>
  </a>  
  `);
}






@extends('layouts.master_home')
@section('home_content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Contact</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Contact</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
   
    <section id="contact" class="contact">
      <div class="container">
      
        <div class="row justify-content-center" data-aos="fade-up">
          
          <div class="col-lg-10">
            
            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="icofont-google-map"></i>
                  <h4>Location:</h4>
                  <p>{{$contacts->address}}</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-envelope"></i>
                  <h4>Email:</h4>
                  <p>{{$contacts->email}}</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-phone"></i>
                  <h4>Call:</h4>
                  <p>{{$contacts->phone}}</p>
                </div>
              </div>
            </div>
            

          </div>
        </div>
        

        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">
          @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif

            <form action="{{route('form.contact')}}" method="post" >
              @csrf 
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" />
                  @error('name')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" />
                  @error('email')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" />
                @error('subject')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5"  placeholder="Message"></textarea>
                @error('message')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
              </div>
              <!-- <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div> -->
              <div class="text-center"><button class="btn btn-success" type="submit">Send Message</button></div>
            </form>

          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

 

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  @endsection


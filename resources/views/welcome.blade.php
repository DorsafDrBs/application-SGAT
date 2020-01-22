<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SOGECLAIR Aerospace Tunisie</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ URL::asset('welcom/css/open-iconic-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/animate.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/aos.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/icomoon.css') }}">
<link rel="stylesheet" href="{{ URL::asset('welcom/css/style.css') }}">
<!--===============================================================================================--> 
    <body>
    <div class="bg-top navbar-light">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-center align-items-stretch">
    		
    				<img src="{{ URL::asset('welcom/images/Image1.png') }}" style="width:200px; height:80px;"  href="http://sogeclairaerospace.com/">
    		
	    	<div class="col-lg-8 d-block">
		    	<div class="row d-flex">
					 <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
					    	<div class="text">
					    		<span>Email</span>
						    	<span>Habiboueslati@sogeclairaerospace.com</span>
						    </div>
							 </div>
							 
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <div class="text">
						    	<span>Contact</span>
						    	<span>Contact us: +216 71 857 601</span>
						    </div>
					        </div>
			             </div>
		            </div>
		         </div>
            </div>
            @if (Route::has('login'))
				
				@auth
				<li><a href="{{ url('admin/affichage/affichage1') }}" class="nav-link pl-0">Accueil</a></li>
				@else
    <div style="background-color:#0191d7; ">
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link"id="accueil" href="{{ url('/') }}">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#service">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"   href="{{ route('login') }}">Log In</a>
      </li>
  
       @endauth
    </ul>
  </div>
</nav>     
	  </div> @endif	


</div>          
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image:url(welcom/images/airbuswallpaper.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<span class="subheading">Welcome to SOGECLAIR Aerospace Tunisie</span>
            <h1 class="mb-4"> </h1>
          
          </div>
        </div>
        </div>
      </div>

      <div class="slider-item" style="background-image:url(welcom/images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<span class="subheading">Welcome to SOGECLAIR Aerospace Tunisie</span>
            <h1 class="mb-4"></h1>
            
          </div>
        </div>
        </div>
      </div>
    </section>

		<section class="ftco-section">
			<div class="container">
				<div class="row d-flex">
					<div class="col-md-5 order-md-last wrap-about align-items-stretch">
						<div class="wrap-about-border ftco-animate">
							<div class="img" style="background-image: url(welcom/images/bg_3.jpg); border"></div>
							<div class="text">
								<h3>SOGECLAIR Aerospace Tunisie</h3>
								<p>Created in 2009, SOGECLAIR Aerospace Tunisia provides experienced teams dedicated to your projects. Whether they are experts, engineers, technicians, developers or attachés to our support service, our staff are all highly qualified. They meet on essential values such as the respect of the commitments, a taste for a challenge, the satisfaction and the achievement of the objectives of our customers</p>
								
							</div>
						</div>
					</div>
					<div class="col-md-7 wrap-about pr-md-4 ftco-animate">
          	<h2 class="mb-4">Advanced multidisciplinary expertise</h2>
						<p>SOGECLAIR Aerospace offers skills in design, integration, numerical simulation, certification, installation of systems, configuration and project management, control and coordination of outsourcing, production and long-term project support.</p>
						<div class="row mt-5">
						
					<div class="col-lg-6">
					<div class="border-bottom-10 rounded">
						<img src="{{ URL::asset('welcom/images/MRO.jpg') }}" width="300px" height="300px">
						</div>
                    <div class="border-bottom-10 rounded">  
					 	<img src="{{ URL::asset('welcom/images/air1.jpg') }}" width="300px" height="300px">
					</div>
					</div>
							
			          	<div class="col-lg-6">
						  <div class="border-bottom-10 rounded">  
						     <img src="{{ URL::asset('welcom/images/imgairbus.jpg') }}" width="300px" height="300px">
							 </div>
						  <div class="border-bottom-10 rounded"> 
						  <img src="{{ URL::asset('welcom/images/new.jpg') }}" width="300px" height="300px">
						  </div>
			     </div>
			       </div>
					
					</div>
				</div>
			</div>
		</section>
		
		<section class="ftco-intro ftco-no-pb img" style="background-image: url(welcom/images/bg_3.jpg);">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-10 text-center heading-section heading-section-white ftco-animate">
            <h2 class="mb-0">You always get the best services</h2>
          </div>
        </div>	
    	</div>
    </section>

		<section class="ftco-counter" id="section-counter">
    	<div class="container">
    		<div class="row d-md-flex align-items-center justify-content-center">
    			<div class="wrapper">
    				<div class="row d-md-flex align-items-center">
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		            	<div class="icon"><span class="flaticon-doctor"></span></div>
		              <div class="text">
		                <strong class="number" data-number="{{$process}}">0</strong>
		                <span>Processes </span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		            	<div class="icon"><span class="flaticon-doctor"></span></div>
		              <div class="text">
		                <strong class="number" data-number="{{$projet}}">0</strong>
		                <span> Projects</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		            	<div class="icon"><span class="flaticon-doctor"></span></div>
		              <div class="text">
		                <strong class="number" data-number="{{$users}}">0</strong>
		                <span>Users</span>
		              </div>
		            </div>
		          </div>
		         
	          </div>
          </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-8 text-center heading-section ftco-animate">
            <h2 class="mb-4" id="service">Our best services</h2>
            <p>SOGECLAIR Aerospace Tunisia is organized around four areas of expertise to cover the entire industrial process, from development to production series :</p>
          </div>
        </div>
				<div class="row no-gutters">
                <div class="col-lg-4 d-flex">
						<div class="services-2 text-center noborder-bottom ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
							<div class="text media-body">
								<h3>Innovation</h3>
								<p>SOGECLAIR Aerospace Tunisia offers an innovation service adapted to its needs.</p>
							</div>
					
					</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 noborder-left text-center ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-analysis"></span></div>
							<div class="text media-body">
								<h3>Mise Au point MAP </h3>
								<p>SOGECLAIR Aerospace Tunisie est organisé autour de quatre domaines d’expertise afin de couvrir l’ensemble du processus Industriel, du développement à la production série :</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-business"></span></div>
							<div class="text media-body">
								<h3> 	Aérostucture-Conception de structure primaire et secondaire</h3>
								<p>SOGELAIR Aerospace Tunisie offers, from development to mass production, the realization of the Definition File, the architecture phase the realization of 2D or 3D plans and associated nomenclatures for the design of complex primary and secondary structural solutions in Metallic and Composite.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-insurance"></span></div>
							<div class="text media-body">
								<h3> 	Aérostructure-Calcul statique, fatigue, thermique, vibratoire </h3>
								<p>SOGECLAIR AEROSPACE Tunisia performs several types of calculations: Static calculations
, F & DT Parts Fatigue Calculation, Finite Element Models using the calculation software: PATRAN, NASRAN, SAMCEF, ANSYS, Abaqus.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 noborder-left noborder-bottom text-center ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-money"></span></div>
							<div class="text media-body">
								<h3> 	Installation Systèmes mécaniques et électriques </h3>
								<p>SOGECLAIR Aerospace Tunisia offers, from development to serial production, the realization of the definition files, from the architecture phase to the realization of the plans (2D or 3D).</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center noborder-bottom ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-rating"></span></div>
							<div class="text media-body">
								<h3>  	Réparation de pièces de structure </h3>
								<p> The repairs apply to all aircraft in service using the standards and methods dictated in different manuals (SRM, AMM, IPC.).</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center noborder-bottom ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
							<div class="text media-body">
								<h3>Gestion de configuration</h3>
								<p> From the Customer's need to the delivery of the Product, SOGECLAIR Aerospace Tunisia offers a service tailored to your needs.</p>
							</div>
						</div>
					</div>
				</div>
                </div>
			
				
			</div>
		</section>
		
		<section class="ftco-intro ftco-no-pb img" style="background-image: url(welcom/images/bg_3.jpg);">
    	<div class="container">
    		<div class="row justify-content-center">
          <div class="col-lg-9 col-md-8 d-flex align-items-center heading-section heading-section-white ftco-animate">
            <h2 class="mb-3 mb-md-0">You always get the best service</h2>
          </div>
          <div class="col-lg-3 col-md-4 ftco-animate">

          </div>
        </div>	
    	</div>
	</section>
	<section class="ftco-section ftco-services">
			<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
			<div class="col-md-8 text-center heading-section ftco-animate">
			<span class="subheading">Organisation</span>
			<h2 class="mb-4">Business organization</h2>
			<p>Our knowledge is articulated around 4 complementary axes: organization, internal communication, training and audits.</p>
			</div>
			</div>
			<div class="row">
			<div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
			<div class="media block-6 d-block text-center">
			<div class="icon d-flex justify-content-center align-items-center">
			<span class="flaticon-drilling"></span>
			</div>
			<div class="media-body p-2 mt-3">
			<h3 class="heading">Our Experience</h3>
			<p>SOGECLAIR Aerospace Tunisia gives you the benefit of its know-how, its experience and its skills to make your organization more alive, more communicative, more creative !.</p>
			</div>
			</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
			<div class="media block-6 d-block text-center">
			<div class="icon d-flex justify-content-center align-items-center">
			<span class="flaticon-tooth"></span>
			</div>
			<div class="media-body p-2 mt-3">
			<h3 class="heading">Our Polyvalence</h3>
			<p> Whatever the size of your company, SOGECLAIR Aerospace Tunisia meets your need to boost the performance of your processes and your organization, in all trades and sectors of your company.</p>
			</div>
			</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
			<div class="media block-6 d-block text-center">
			<div class="icon d-flex justify-content-center align-items-center">
			<span class="flaticon-dental-floss"></span>
			</div>
			<div class="media-body p-2 mt-3">
			<h3 class="heading">Our Pragmatisme</h3>
			<p>Our main concern is the achievement of your objectives, respecting your constraints (planning, budget, ...) and the potential of your teams.</p>
			</div>
			</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
			 <div class="media block-6 d-block text-center">
			<div class="icon d-flex justify-content-center align-items-center">
			<span class="flaticon-shiny-tooth"></span>
			</div>
			<div class="media-body p-2 mt-3">
			<h3 class="heading">Our Performance</h3>
			<p>By the intervention of SOGECLAIR Aerospace Tunisia on your project, you will realize a rapid cultural change and measurable financial gains, your return on investment is immediate!</p>
			</div>
			</div>
			</div>
			
			</section>
			<section class="ftco-section intro" style="background-image: url(welcom/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
			<div class="container">
			<div class="row">
					<div class="col-lg-9 col-md-8 d-flex align-items-center heading-section heading-section-white ftco-animate">
							<h2 class="mb-3 mb-md-0">You always get the best service</h2>
					  </div>
			</div>
			</div>
			</section>
	
		
        <footer class="ftco-footer ftco-bg-dark ftco-section">
          <div class="container">
            <div class="row mb-5">
                
              <div class="col-md-6 col-lg-3">
                <div class="ftco-footer-widget mb-5">
                    <h2 class="ftco-heading-2">SOGECLAIR Aerospace Tunisia</h2>
                    <div class="block-23 mb-3">
                      <ul>
                        <li><span class="icon icon-map-marker"></span><span class="text">Elgazala Cluster of Communication Technologies
                            Route of Raoud km 3.5
                            Cité Elgazala
                            2083 ARIANA
                            TUNISIA</span></li>
                        <li><a href="#"><span class="icon icon-phone"></span><span class="text">+216 71 857 601</span></a></li>
                        <li><a href="#"><span class="icon icon-envelope"></span><span class="text"> habib.oueslati@sogeclairaerospace.com </span></a></li>
                      </ul>
                    </div>
                </div>
              </div>
             
                        
                        <div class="col-md-6 col-lg-3">
                          <div class="ftco-footer-widget mb-5">
                            
                              </div>
                            </div>
                            
                        <div class="col-md-6 col-lg-3">
                          <div class="ftco-footer-widget mb-5 ml-md-4">
                            <h2 class="ftco-heading-2">Liens</h2>
                            <ul class="list-unstyled">
                              <li><a href="#accueil"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a></li>
                              <li><a href="#service"><span class="ion-ios-arrow-round-forward mr-2"></span>Services</a></li>
                              
                            </ul>
                          </div>
                        </div>
                    
                      <div class="row">
                        <div class="col-md-12 text-center">
              
                          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>All rights reserved | through  <a href="http://sogeclairaerospace.com/tunisie" target="_blank">SOGECLAIR Aerospace Tunisia</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                      </div>
                    </div>
                  </footer>
                  
                
      
    
      <!-- loader -->
   	


      <script src="{{ URL::asset('welcom/js/jquery.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/jquery-migrate-3.0.1.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/popper.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/bootstrap.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/jquery.easing.1.3.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/jquery.waypoints.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/jquery.stellar.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/owl.carousel.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/aos.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/jquery.animateNumber.min.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/scrollax.min.js') }}"></script>
     
	  <script src="{{ URL::asset('welcom/js/main.js') }}"></script>
	  
	
        
      </body>
    </html>
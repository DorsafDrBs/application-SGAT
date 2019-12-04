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
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
        <!-- Styles -->
        
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
						    	<span>Contacter nous: +216 71 857 601</span>
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
        <a class="nav-link"id="accueil" href="{{ url('/') }}">Accueill
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#service">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
      </li>
      @if (Route::has('register'))
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">S'inscrire</a>
      </li>
      @endif
       @endauth
    </ul>
  </div>
</nav>     
	  </div> @endif	
                     
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image:url(welcom/images/airbuswallpaper.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<span class="subheading">Bienvenue au SOGECLAIR Aerospace Tunisie</span>
            <h1 class="mb-4">Nous sommes les meilleurs </h1>
          
          </div>
        </div>
        </div>
      </div>

      <div class="slider-item" style="background-image:url(images/0.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<span class="subheading">Bienvenue au SOGECLAIR Aerospace Tunisie</span>
            <h1 class="mb-4">Vous obtenez toujours le meilleur service</h1>
            
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
							<div class="img" style="background-image: url(images/visuel_sogeclair.jpg); border"></div>
							<div class="text">
								<h3>SOGECLAIR Aerospace Tunisie</h3>
								<p>Crée en 2009, SOGECLAIR Aerospace Tunisie fournit des équipes expérimentées dédiées à vos projets. Qu’ils soient experts, ingénieurs, techniciens, développeurs ou attachés à notre service de support, nos personnels sont tous hautement qualifiés. Ils se réunissent sur des valeurs essentielles telles que le respect des engagements, un goût pour un défi, la satisfaction et l’atteinte des objectifs de nos clients</p>
								
							</div>
						</div>
					</div>
					<div class="col-md-7 wrap-about pr-md-4 ftco-animate">
          	<h2 class="mb-4">Expertise multidisciplinaire de pointe</h2>
						<p>SOGECLAIR Aerospace propose des compétences en conception, intégration, simulation numérique, certification, installation de systèmes, configuration et gestion de projet, contrôle et coordination de la sous-traitance, production et support de projets à long terme.</p>
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
            <h2 class="mb-0">Vous obtenez toujours les meilleurs services</h2>
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
		                <strong class="number" data-number="12">0</strong>
		                <span>Processus </span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		            	<div class="icon"><span class="flaticon-doctor"></span></div>
		              <div class="text">
		                <strong class="number" data-number="80">0</strong>
		                <span> Projets</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		            	<div class="icon"><span class="flaticon-doctor"></span></div>
		              <div class="text">
		                <strong class="number" data-number="35">0</strong>
		                <span>Utilisateurs</span>
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
            <h2 class="mb-4" id="service">Nos meilleurs services</h2>
            <p>SOGECLAIR Aerospace Tunisie est organisé autour de quatre domaines d’expertise afin de couvrir l’ensemble du processus Industriel, du développement à la production série :</p>
          </div>
        </div>
				<div class="row no-gutters">
                <div class="col-lg-4 d-flex">
						<div class="services-2 text-center noborder-bottom ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
							<div class="text media-body">
								<h3>Innovation</h3>
								<p> SOGECLAIR Aerospace Tunisie  propose un service d'innovation adapté a ses besoins.</p>
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
								<p>SOGELAIR Aerospace Tunisie propose, du développement à la production en série, 
									la réalisation du Dossier de Définition, de la phase d’architecture
									à la réalisation des plans (2D ou 3D) et des nomenclatures associées pour la conception de solutions complexes de structure primaires et secondaires en Métalliques et Composites.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-insurance"></span></div>
							<div class="text media-body">
								<h3> 	Aérostructure-Calcul statique, fatigue, thermique, vibratoire </h3>
								<p>SOGECLAIR AEROSPACE Tunisie réalise plusieurs types de calculs : Calculs statiques
									 , Calcul de fatigue des pièces F&DT, Modèles éléments finis en utilisant les logiciel de calcul : PATRAN, NASRAN, SAMCEF, ANSYS, Abaqus.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 noborder-left noborder-bottom text-center ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-money"></span></div>
							<div class="text media-body">
								<h3> 	Installation Systèmes mécaniques et électriques </h3>
								<p>SOGECLAIR Aerospace Tunisie propose, du développement à la production série, la réalisation des Dossiers de Définition, de la phase d’architecture à la réalisation des plans (2D ou 3D) .</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center noborder-bottom ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-rating"></span></div>
							<div class="text media-body">
								<h3>  	Réparation de pièces de structure </h3>
								<p> Les réparations s’appliquent sur tous les avions en service utilisant les normes et les méthodes dictés dans différents manuels (SRM, AMM, IPC.).</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-flex">
						<div class="services-2 text-center noborder-bottom ftco-animate">
							<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
							<div class="text media-body">
								<h3>Gestion de configuration</h3>
								<p> Du besoin du Client à la livraison du Produit, SOGECLAIR Aerospace Tunisie vous propose un service adapté à vos besoins.</p>
							</div>
						</div>
					</div>
				</div>
                </div>
			
				
			</div>
		</section>
		
		<section class="ftco-intro ftco-no-pb img" style="background-image: url(welcom/images/bg_1.jpg);">
    	<div class="container">
    		<div class="row justify-content-center">
          <div class="col-lg-9 col-md-8 d-flex align-items-center heading-section heading-section-white ftco-animate">
            <h2 class="mb-3 mb-md-0">Vous obtenez toujours le meilleur service</h2>
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
			<h2 class="mb-4">Organisation de l'entreprise</h2>
			<p>Notre savoir s’articule autour de 4 axes complémentaires : organisation, communication interne, formation et audits.</p>
			</div>
			</div>
			<div class="row">
			<div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
			<div class="media block-6 d-block text-center">
			<div class="icon d-flex justify-content-center align-items-center">
			<span class="flaticon-drilling"></span>
			</div>
			<div class="media-body p-2 mt-3">
			<h3 class="heading">Notre Expérience</h3>
			<p>SOGECLAIR Aerospace Tunisie vous fait bénéficier de son savoir faire, de son expérience et de ses compétences pour rendre votre organisation, plus vivante, plus communicante, plus créative !.</p>
			</div>
			</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
			<div class="media block-6 d-block text-center">
			<div class="icon d-flex justify-content-center align-items-center">
			<span class="flaticon-tooth"></span>
			</div>
			<div class="media-body p-2 mt-3">
			<h3 class="heading">Notre Polyvalence</h3>
			<p>Quel que soit la taille de votre entreprise, SOGECLAIR Aerospace Tunisie répond à votre besoin de dynamiser la performance de vos processus et de votre organisation, cela dans tous les métiers et secteurs de votre entreprise.
				</p>
			</div>
			</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
			<div class="media block-6 d-block text-center">
			<div class="icon d-flex justify-content-center align-items-center">
			<span class="flaticon-dental-floss"></span>
			</div>
			<div class="media-body p-2 mt-3">
			<h3 class="heading">Notre Pragmatisme</h3>
			<p>	Notre principale préoccupation est l’atteinte de vos objectifs, en respectant vos contraintes (planning, budget,…) et le potentiel de vos équipes.</p>
			</div>
			</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
			 <div class="media block-6 d-block text-center">
			<div class="icon d-flex justify-content-center align-items-center">
			<span class="flaticon-shiny-tooth"></span>
			</div>
			<div class="media-body p-2 mt-3">
			<h3 class="heading">Notre Performance</h3>
			<p>Par l’intervention de SOGECLAIR Aerospace Tunisie sur votre projet, vous réaliserez un changement culturel rapide et des gains financiers mesurables, votre retour sur investissement est immédiat !</p>
			</div>
			</div>
			</div>
			
			</section>
			<section class="ftco-section intro" style="background-image: url(welcom/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
			<div class="container">
			<div class="row">
					<div class="col-lg-9 col-md-8 d-flex align-items-center heading-section heading-section-white ftco-animate">
							<h2 class="mb-3 mb-md-0">Vous obtenez toujours le meilleur service</h2>
					  </div>
			</div>
			</div>
			</section>
	
		
        <footer class="ftco-footer ftco-bg-dark ftco-section">
          <div class="container">
            <div class="row mb-5">
                
              <div class="col-md-6 col-lg-3">
                <div class="ftco-footer-widget mb-5">
                    <h2 class="ftco-heading-2">SOGECLAIR Aerospace Tunisie</h2>
                    <div class="block-23 mb-3">
                      <ul>
                        <li><span class="icon icon-map-marker"></span><span class="text">Pôle Elgazala des technologies de la communication
                            Route de Raoud km 3.5
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
                              <li><a href="#accueil"><span class="ion-ios-arrow-round-forward mr-2"></span>Accueil</a></li>
                              <li><a href="#service"><span class="ion-ios-arrow-round-forward mr-2"></span>Services</a></li>
                              
                            </ul>
                          </div>
                        </div>
                    
                      <div class="row">
                        <div class="col-md-12 text-center">
              
                          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>Tous droits réservés | par  <a href="http://sogeclairaerospace.com/tunisie" target="_blank">SOGECLAIR Aerospace Tunisie</a>
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
      <script src="{{ URL::asset('welcom/https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false') }}"></script>
      <script src="{{ URL::asset('welcom/js/google-map.js') }}"></script>
      <script src="{{ URL::asset('welcom/js/main.js') }}"></script>
        
      </body>
    </html>
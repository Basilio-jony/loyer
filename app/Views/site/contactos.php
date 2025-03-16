<?= $this->include("site/baseSite")  ?>

<!--==================================================-->
<!-- Start charina breatcam section  -->
<!--==================================================-->
<div class="breatcam-section d-flex align-items-center" style="
    background-image: url('<?php 
        echo basename($_SERVER['PHP_SELF']) == 'contactos.php' ? 
        'assets/images/resource/csa1.jpg' : 
        'assets/images/resource/contatos1.jpg'; 
    ?>');
    background-size: cover;
    background-position: center;
">



	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breatcam-content text-center">
					<!-- breadcumb title -->
					<div class="breatcam-title">
						<h1> Contactos </h1>
					</div>
					<!-- breatcam menu -->
					<div class="breatcam-menu">
						<ul>
							<li><a href="index.html"> inicio </a></li>
							<li> Contactos </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--==================================================-->
<!-- End charina breatcam section -->
<!--==================================================--> 

<!--==================================================-->
<!-- Start lawyer Contact Section -->
<!--==================================================-->
<div class="contact-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 pb-60">
				<div class="lawyer-section-title text-center">
					<h1> Consulta Gratis </h1>
					<p>para uma consulta gratis não exite em nos contactar a baixo</p>
				</div>
			</div>
			<div id="consul"></div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 pr-4">
				<!-- contact form box -->
				<div class="contact-form-box">
					<form action="https://formspree.io/f/myyleorq" method="POST" id="dreamit-form">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-box">
									<input type="text" placeholder="Your Name">
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-box">
									<input type="text" placeholder="E-Mail Address">
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-box">
									<input type="text" placeholder="Subject">
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-box">
									<input type="text" placeholder="Phone">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-box">
									<textarea name="massage" id="massage" cols="30" rows="10" placeholder="Write Comment"></textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="contact-form">
									<button type="submit">  Submeta Agora </button>
								</div>
							</div>
						</div>
					</form>
					<div id="status"></div>
				</div> 
			</div>
			<div class="col-lg-6 col-md-6 pl-4">
				<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3942.7231824992323!2d13.237388900000001!3d-8.812055599999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zOMKwNDgnNDMuNCJTIDEzwrAxNCcxNC42IkU!5e0!3m2!1sfr!2sao!4v1719165949876!5m2!1sfr!2sao" width="542" height="438" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			</div>
		</div>
	</div>
</div>
<!--==================================================-->
<!-- End lawyer Contac us Section -->
<!--==================================================-->

<!--==================================================-->
<!-- Start charina Contac Inf Section -->
<!--==================================================-->
<div class="contact-info-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 pb-55">
				<div class="lawyer-section-title text-center">
					<h1> Formas de Contacto </h1>
					<p></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="contact-information2">
				<div class="contacts-icon">
				<i class="fa-solid fa-phone"></i>
				</div>
				<div class="contacts-title">
				<h5>Ligue Para Nós</h5>
				<h6>+244 934 41 13 52</h6>
				</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="contact-information2">
				 	<div class="contacts-icon upper">
				 		<i class="fa-solid fa-envelope"></i>
				 	</div>
				 	<div class="contacts-title">
				 		<h5>Mande-nos Um Email</h5>
				 		<h6>csassociados@hotlook.pt</h6>
				 	</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				 <div class="contact-information2">
				 	<div class="contacts-icon upper2">
				 		<i class="fa-solid fa-location-dot"></i>
				 	</div>
				 	<div class="contacts-title">
				 		<h5>Nossa Localização</h5>
				 		<h6>Rua Rainha Ginga, Edificio Javil Office</h6>
				 	</div>
				 </div>
			</div>
		</div>
	</div>
</div>
<!--==================================================-->
<!-- End charina Contac Inf Section -->
<!--==================================================-->







<?= $this->include("site/perna2")  ?>
	

<?= $this->include("site/perna")  ?>
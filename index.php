<?php
session_start();

// if(isset($_SESSION['login'])){
//     header('Location: dashboard/');
//     die;
// }

$page = ['index', ''];

?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta name="theme-color" content="#000000">

	<!-- Title Tag -->
	<title>Digital Repair - Layanan Perbaikan dan Digitalisasi Terbaik</title>

	<!-- Meta Description -->
	<meta name="description" content="Digital Repair adalah layanan profesional yang menawarkan solusi perbaikan dan digitalisasi untuk perangkat elektronik Anda. Hubungi kami untuk layanan cepat dan handal.">

	<!-- Meta Keywords -->
	<meta name="keywords" content="perbaikan kamera, perbaikan drone, layanan perbaikan, servis elektronik, perbaikan cepat, camera repair, drone repair, service komputer, service laptop">

	<!-- Meta Author -->
	<meta name="author" content="Digital Repair Team">

	<!-- Meta Robots -->
	<meta name="robots" content="index, follow">

	<!-- Open Graph Meta Tags -->
	<meta property="og:title" content="Digital Repair - Layanan Perbaikan kamera dan drone terbaik">
	<meta property="og:description" content="Digital Repair menyediakan layanan perbaikan dan digitalisasi profesional untuk berbagai jenis perangkat elektronik. Kualitas layanan yang cepat dan dapat diandalkan.">
	<meta property="og:image" content="https://repair.digitalisasi.net/assets/img/meta/og-img.jpg">
	<meta property="og:url" content="https://repair.digitalisasi.net/">
	<meta property="og:type" content="website">

	<!-- Twitter Card Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Repair Digitalisasi - Layanan Perbaikan dan Digitalisasi Terbaik">
	<meta name="twitter:description" content="Layanan profesional untuk perbaikan dan digitalisasi perangkat elektronik Anda. Dapatkan layanan yang cepat dan terpercaya dari Repair Digitalisasi.">
	<meta name="twitter:image" content="https://repair.digitalisasi.net/assets/img/meta/og-img.jpg">

	<!-- Favicons -->
	<?php include_once ("struktur/favicon.php"); ?>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Main CSS File -->
	<link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

	<?php include_once ('struktur/main/header.php'); ?>

	<main class="main">

		<!-- Hero Section -->
		<section id="hero" class="hero section">
			<div class="hero-bg">
				<img src="assets/img/hero-bg-light.webp" alt="">
			</div>
			<div class="container text-center">
				<div class="d-flex flex-column justify-content-center align-items-center">
					<h1 data-aos="fade-up" class="">Welcome to <span>Digital Repair</span></h1>
					<p data-aos="fade-up" data-aos-delay="100" class="">Pusat perbaikan perlengkapan elektronik anda<br></p>
					<div class="d-flex" data-aos="fade-up" data-aos-delay="200">
						<a href="https://api.whatsapp.com/send?phone=628980000703&text=Halo%20kak%2C%20ada%20yang%20ingin%20saya%20tanyakan%20tentang%20Digital%20Repair.%20Apakah%20bisa%20dibantu%20%3F" class="btn-get-started">Hubungi Kami</a>
					</div>
					<img src="assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
				</div>
			</div>
		</section><!-- /Hero Section -->

		<!-- Featured Services Section -->
		<section id="featured-services" class="featured-services section">

			<div class="container">

				<div class="row gy-4">

					<div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
						<div class="service-item d-flex">
							<div class="icon flex-shrink-0"><i class="bi bi-cash-coin"></i></div>
							<div>
								<h4 class="title"><a href="#" class="stretched-link">Biaya Termurah</a></h4>
								<p class="description">Kami menerapkan Biaya jasa yang sangat terjangkau untuk anda</p>
							</div>
						</div>
					</div>
					<!-- End Service Item -->

					<div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
						<div class="service-item d-flex">
							<div class="icon flex-shrink-0"><i class="bi bi-chat-right-dots-fill"></i></i></div>
							<div>
								<h4 class="title"><a href="#" class="stretched-link">Diskusi Solusi</a></h4>
								<p class="description">Kami mengedepankan solusi paling praktis dan efisien untuk setiap masalah anda.</p>
							</div>
						</div>
					</div><!-- End Service Item -->

					<div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
						<div class="service-item d-flex">
							<div class="icon flex-shrink-0"><i class="bi bi-clock-fill"></i></div>
							<div>
								<h4 class="title"><a href="#" class="stretched-link">Pengerjaan Cepat</a></h4>
								<p class="description">Dengan team yang handal kami dapat melakukan perbaikan dengan cepat tanpa menurangi kualitas hasil pengerjaan.</p>
							</div>
						</div>
					</div><!-- End Service Item -->

				</div>

			</div>

		</section><!-- /Featured Services Section -->

		<!-- About Section -->
		<section id="about" class="about section">

			<div class="container">

				<div class="row gy-4">

					<div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
						<p class="who-we-are">Tentang Kami</p>
						<h3>Tim profesional yang berdedikasi dalam bidang perbaikan alat elektronik sejak tahun 2016</h3>
						<p class="fst-italic">
							Misi kami adalah memberikan pelayanan terbaik kepada setiap pelanggan dengan menawarkan solusi perbaikan yang efektif dan efisien. Kami berkomitmen untuk:
						</p>
						<ul>
							<li><i class="bi bi-check-circle"></i> <span><strong>Kualitas Terbaik:</strong> Menggunakan suku cadang berkualitas tinggi dan teknik perbaikan terbaru untuk memastikan hasil yang tahan lama.</span></li>
							<li><i class="bi bi-check-circle"></i> <span><strong>Layanan Pelanggan Unggul:</strong> Memberikan pengalaman layanan pelanggan yang ramah, transparan, dan responsif.</span></li>
							<li><i class="bi bi-check-circle"></i> <span><strong>Kejujuran dan Integritas:</strong> Selalu memberikan penilaian yang jujur dan harga yang adil tanpa biaya tersembunyi.</span></li>
						</ul>
						<a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
					</div>

					<div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
						<div class="row gy-4">
							<div class="col-lg-6">
								<img src="assets/img/about-company-1.webp" class="img-fluid" alt="electronic-component">
							</div>
							<div class="col-lg-6">
								<div class="row gy-4">
									<div class="col-lg-12">
										<img src="assets/img/about-company-2.webp" class="img-fluid" alt="electronic-component">
									</div>
									<div class="col-lg-12">
										<img src="assets/img/about-company-3.webp" class="img-fluid" alt="electronic-component">
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

			</div>
		</section><!-- /About Section -->

		<!-- Features Section -->
		<section id="features" class="features section">

			<!-- Section Title -->
			<div class="container section-title" data-aos="fade-up">
				<h2 class="">Features</h2>
				<p>kami selalu berupaya untuk menyediakan layanan perbaikan elektronik yang tidak hanya andal tetapi juga memberikan pengalaman terbaik bagi pelanggan kami. Berikut adalah fitur-fitur unggulan yang kami tawarkan:</p>
			</div><!-- End Section Title -->

			<div class="container">
				<div class="row justify-content-between">

					<div class="col-lg-5 d-flex align-items-center">

						<ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
							<li class="nav-item">
								<a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
									<i class="bi bi-search"></i>
									<div>
										<h4 class="d-none d-lg-block"><strong>Diskusi Permasalahan Secara Mendalam</strong></h4>
										<p>
											Kami percaya bahwa memahami permasalahan dengan baik adalah kunci untuk memberikan solusi perbaikan yang efektif dan tepat. Oleh karena itu, kami menyediakan layanan diskusi permasalahan secara mendalam dan detail bagi setiap pelanggan kami.
										</p>
									</div>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
									<i class="bi bi-lightbulb"></i>
									<div>
										<h4 class="d-none d-lg-block"><strong>Solusi dan Penanganan</strong></h4>
										<p>
											Kami memahami bahwa memberikan solusi dan penanganan yang tepat untuk setiap masalah perangkat elektronik adalah inti dari layanan kami. Kami percaya bahwa solusi yang efektif harus didasarkan pada pemahaman mendalam tentang masalah yang dihadapi dan pendekatan yang terstruktur dalam penanganannya.
										</p>
									</div>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
									<i class="bi bi-list-check"></i>
									<div>
										<h4 class="d-none d-lg-block"><strong>Pengujian dan Verifikasi</strong></h4>
										<p>
											Setelah perbaikan selesai, perangkat akan melalui serangkaian pengujian untuk memastikan bahwa semua masalah telah teratasi dan perangkat berfungsi dengan baik. Kami melakukan pengujian komprehensif untuk memverifikasi bahwa solusi yang diberikan benar-benar efektif dan perangkat siap untuk digunakan kembali oleh pelanggan.
										</p>
									</div>
								</a>
							</li>
						</ul><!-- End Tab Nav -->

					</div>

					<div class="col-lg-6">

						<div class="tab-content" data-aos="fade-up" data-aos-delay="200">

							<div class="tab-pane fade active show" id="features-tab-1">
								<img src="assets/img/tabs-1.jpg" alt="" class="img-fluid">
							</div><!-- End Tab Content Item -->

							<div class="tab-pane fade" id="features-tab-2">
								<img src="assets/img/tabs-2.webp" alt="" class="img-fluid">
							</div><!-- End Tab Content Item -->

							<div class="tab-pane fade" id="features-tab-3">
								<img src="assets/img/tabs-3.webp" alt="" class="img-fluid">
							</div><!-- End Tab Content Item -->
						</div>

					</div>

				</div>

			</div>

		</section><!-- /Features Section -->

		<!-- Features Details Section -->
		<section id="features-details" class="features-details section">

			<div class="container">

				<div class="row gy-4 justify-content-between features-item">

					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
						<img src="assets/img/features-1.jpg" class="img-fluid" alt="">
					</div>

					<div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
						<div class="content">
							<h3>Garansi Perbaikan Penuh</h3>
							<p>
								Kami berkomitmen untuk memberikan layanan perbaikan elektronik berkualitas tinggi yang didukung oleh garansi perbaikan penuh. Kami ingin memastikan bahwa pelanggan merasa aman dan puas dengan hasil perbaikan kami. Oleh karena itu, setiap layanan perbaikan yang kami lakukan disertai dengan garansi untuk menjamin bahwa perangkat Anda akan berfungsi dengan baik setelah diperbaiki.
							</p>
							<a href="#" class="btn more-btn">Detail Garansi</a>
						</div>
					</div>

				</div><!-- Features Item -->

				<div class="row gy-4 justify-content-between features-item">

					<div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">

						<div class="content">
							<h3>Kepuasan Pelanggan</h3>
							<p>
								Kepuasan pelanggan adalah prioritas utama kami. Kami berkomitmen untuk memberikan layanan perbaikan elektronik yang tidak hanya memenuhi, tetapi juga melampaui harapan Anda. Setiap langkah yang kami ambil, mulai dari diagnosa hingga penyelesaian perbaikan, dirancang dengan satu tujuan utama: memastikan Anda puas dengan hasil dan pengalaman layanan kami.
							</p>
							<p>
								Dukungan pelanggan yang ramah dan responsif adalah salah satu pilar layanan kami. Kami selalu siap membantu Anda dengan setiap pertanyaan atau kebutuhan yang mungkin Anda miliki. Komitmen kami terhadap transparansi, kejujuran, dan integritas memastikan bahwa Anda selalu mendapatkan informasi yang jelas dan layanan yang adil.
							</p>
							<p>
								Garansi perbaikan penuh yang kami tawarkan adalah bukti kepercayaan kami terhadap kualitas pekerjaan kami dan dedikasi kami terhadap kepuasan Anda. Kami ingin Anda merasa aman dan tenang, mengetahui bahwa perangkat Anda dilindungi oleh garansi yang transparan dan komprehensif.</p>
						</div>

					</div>

					<div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
						<img src="assets/img/features-2.jpg" class="img-fluid" alt="">
					</div>

				</div><!-- Features Item -->

			</div>

		</section><!-- /Features Details Section -->

		<!-- Services Section -->
		<section id="services" class="services section">

			<!-- Section Title -->
			<div class="container section-title" data-aos="fade-up">
				<h2>Services</h2>
				<p>kami berkomitmen untuk memberikan berbagai layanan perbaikan elektronik yang berkualitas tinggi dan terpercaya. Dengan tim teknisi yang berpengalaman dan terlatih, serta fasilitas yang dilengkapi dengan teknologi terkini, kami siap menangani berbagai jenis perbaikan elektronik dengan cepat dan efisien. Berikut adalah layanan yang kami tawarkan :</p>
			</div><!-- End Section Title -->

			<div class="container">

				<div class="row g-5">

					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
						<div class="service-item item-cyan position-relative">
							<i class="bi bi-camera2 icon"></i>
							<div>
								<h3>Photography / Videography</h3>
								<p>Kami menyediakan layanan perbaikan dan perawatan profesional untuk berbagai peralatan fotografi dan videografi berbagai brand. Dengan tim teknisi yang berpengalaman dan peralatan diagnostik canggih, kami siap menangani berbagai masalah teknis pada <strong class="text-primary">Kamera</strong>, <strong class="text-primary">Lensa</strong>, <strong class="text-primary">Drone</strong>, <strong class="text-primary">Tripod</strong>, dan peralatan lainnya.</p>
								<a href="service-details/?photography" class="read-more stretched-link">Lihat Detail <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div><!-- End Service Item -->

					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
						<div class="service-item item-orange position-relative">
							<i class="bi bi-laptop icon"></i>
							<div>
								<h3>Komputer / Laptop</h3>
								<p>Kami menyediakan layanan perbaikan dan perawatan komputer dan laptop berbagai brand yang handal dan berkualitas tinggi. Dengan tim teknisi yang terlatih dan berpengalaman serta peralatan diagnostik yang canggih, kami siap menangani berbagai masalah teknis pada komputer dan laptop Anda.</p>
								<a href="service-details.html" class="d-none read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div><!-- End Service Item -->

					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
						<div class="service-item item-teal position-relative">
							<i class="bi bi-printer icon"></i>
							<div>
								<h3>Printer / Scanner</h3>
								<p>Kami menyediakan layanan perbaikan yang handal dan efisien untuk printer dan scanner. Dengan tim teknisi yang terampil dan berpengalaman serta peralatan diagnostik yang canggih, kami siap menangani berbagai masalah teknis pada peralatan cetak dan pemindaian Anda.</p>
								<a href="service-details.html" class="d-none read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div><!-- End Service Item -->

					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
						<div class="service-item item-red position-relative">
							<i class="bi bi-apple icon"></i>
							<div>
								<h3>Apple Product</h3>
								<p> kami menyediakan layanan perbaikan yang andal dan berkualitas tinggi untuk berbagai produk Apple. Dengan tim teknisi yang terlatih dan berpengalaman dalam teknologi Apple, kami siap menangani berbagai masalah perangkat keras dan perangkat lunak pada produk-produk Apple Anda.</p>
								<a href="service-details.html" class="d-none read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div><!-- End Service Item -->

					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
						<div class="service-item item-indigo position-relative">
							<i class="bi bi-code-slash icon"></i>
							<div>
								<h3>Website dan Software</h3>
								<p>Kami menawarkan layanan profesional dalam pembuatan website dan pengembangan perangkat lunak. Dengan tim ahli yang terdiri dari pengembang web dan perangkat lunak berpengalaman, kami siap membantu Anda mewujudkan visi digital Anda.</p>
								<a href="service-details.html" class="d-none read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div><!-- End Service Item -->

					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
						<div class="service-item item-pink position-relative">
							<i class="bi bi-hdd-network icon"></i>
							<div>
								<h3>Jaringan dan Internet</h3>
								<p>Kami menyediakan layanan perbaikan yang andal dan berkualitas tinggi untuk masalah jaringan dan internet. Dengan tim teknisi yang terampil dan berpengalaman dalam teknologi jaringan, kami siap menangani berbagai masalah yang Anda hadapi dalam menghubungkan perangkat Anda ke internet.</p>
								<a href="service-details.html" class="d-none read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div><!-- End Service Item -->

				</div>

			</div>

		</section><!-- /Services Section -->

		<!-- More Features Section -->
		<section id="more-features" class="more-features section">

			<div class="container">

				<div class="row justify-content-around gy-4">

					<div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
						<h3>Terima Kasih Telah Memilih Layanan Kami</h3>
						<p>Kami ingin mengucapkan terima kasih atas kepercayaan Anda kepada tim kami untuk membantu setiap permasalahan Anda. Bersama <strong class="text-secondary">Digital Repair</strong>, kami berkomitmen untuk memberikan layanan terbaik dan hasil yang memuaskan bagi setiap pelanggan kami.</p>
						<h4 class="text-primary">Kenapa Memilih Kami?</h4>

						<div class="row">

							<div class="col-lg-6 icon-box d-flex">
								<i class="bi bi-easel flex-shrink-0"></i>
								<div>
									<h4>Pengalaman dan Keahlian</h4>
									<p>Tim kami terdiri dari teknisi ahli yang memiliki pengalaman luas dalam perbaikan berbagai jenis alat elektronik. Kami telah menangani berbagai permasalahan mulai dari kerusakan ringan hingga yang kompleks dengan tingkat keberhasilan yang tinggi.</p>
								</div>
							</div><!-- End Icon Box -->

							<div class="col-lg-6 icon-box d-flex">
								<i class="bi bi-patch-check flex-shrink-0"></i>
								<div>
									<h4>Pelayanan Pelanggan Terbaik</h4>
									<p>Kami sangat menghargai setiap pelanggan kami. Kami berusaha untuk memberikan pelayanan yang ramah, responsif, dan profesional setiap saat. Kepuasan Anda adalah prioritas utama kami.</p>
								</div>
							</div><!-- End Icon Box -->

							<div class="col-lg-6 icon-box d-flex">
								<i class="bi bi-award flex-shrink-0"></i>
								<div>
									<h4>Kualitas dan Keterjaminan</h4>
									<p>Kami menggunakan komponen berkualitas tinggi dan teknologi terkini dalam setiap perbaikan. Kami memberikan jaminan atas layanan kami sehingga Anda dapat memiliki ketenangan pikiran setelah alat elektronik Anda diperbaiki.</p>
								</div>
							</div><!-- End Icon Box -->

							<div class="col-lg-6 icon-box d-flex">
								<i class="bi bi-emoji-smile flex-shrink-0"></i>
								<div>
									<h4>Kemudahan dan Kepuasan Pelanggan</h4>
									<p>Kami memahami betapa berharganya waktu dan kenyamanan Anda. Oleh karena itu, kami menawarkan proses perbaikan yang mudah dan transparan. Kami berusaha untuk membuat pengalaman Anda dengan kami sejelas dan sesantai mungkin. Kepuasan pelanggan bukan hanya tujuan kami, tetapi juga komitmen kami setiap hari.</p>
								</div>
							</div><!-- End Icon Box -->

						</div>

					</div>

					<div class="features-image col-lg-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
						<img src="assets/img/features-3.webp" alt="">
					</div>

				</div>

			</div>

		</section><!-- /More Features Section -->

		<!-- Pricing Section -->
		<section id="pricing" class="pricing section">

			<!-- Section Title -->
			<div class="container section-title" data-aos="fade-up">
				<h2>Pricing</h2>
				<p>Harga yang tertera di bawah adalah harga umum atau service tambahan yang dapat berubah tergantung pada kondisi tertentu</p>
			</div><!-- End Section Title -->

			<div class="container">

				<div class="row gy-4">

					<div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
						<div class="pricing-item">
							<h3>Konsultasi dan Diskusi</h3>
							<p class="description">FREE</p>
							<h4><sup>Rp</sup>0,00</h4>
							<a href="#" class="cta-btn">Hubungi Kami</a>
							<ul>
								<li><i class="bi bi-check"></i> <span>Konsultasi tentang kerusakan</span></li>
								<li><i class="bi bi-check"></i> <span>Perkiraan penyebab kerusakan</span></li>
								<li><i class="bi bi-check"></i> <span>Cek unit secara fisik</span></li>
								<li><i class="bi bi-check"></i> <span>Saran dan tips</span></li>
							</ul>
						</div>
					</div><!-- End Pricing Item -->

					<div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
						<div class="pricing-item featured">
							<p class="popular">Optional</p>
							<h3>Pickup and Delivery</h3>
							<p class="description">Harga untuk per 20km</p>
							<h4><sup>Rp</sup>50,000<span></h4>
							<a href="#" class="cta-btn">Hubungi Kami</a>
							<ul>
								<li><i class="bi bi-check"></i> <span>Pengambilan unit di tempat</span></li>
								<li><i class="bi bi-check"></i> <span>Pengiriman unit saat selesai</span></li>
							</ul>
						</div>
					</div><!-- End Pricing Item -->

					<div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
						<div class="pricing-item">
							<h3>General Check</h3>
							<p class="description">Hanya untuk pengecekan kerusakan menyeluruh</p>
							<h4><sup>Rp</sup>150,000</h4>
							<a href="#" class="cta-btn">Hubungi Kami</a>
							<ul>
								<li><i class="bi bi-check"></i> <span>Cek unit secara fisik</span></li>
								<li><i class="bi bi-check"></i> <span>Cek unit secara sistem</span></li>
								<li><i class="bi bi-check"></i> <span>Cek dasar fungsi unit</span></li>
								<li><i class="bi bi-check"></i> <span>Cek board dan jalur kelistrikan</span></li>
								<li><i class="bi bi-check"></i> <span>Cek firmware Unit</span></li>
								<li><i class="bi bi-check"></i> <span>Diagnosa menyeluruh</span></li>
								<li><i class="bi bi-check"></i> <span>Cleaning board dan komponen</span></li>
								<li><i class="bi bi-check"></i> <span>Laporan hasil pengecekan</span></li>
								<li><i class="bi bi-check"></i> <span>Solusi, saran dan tips</span></li>
							</ul>
						</div>
					</div><!-- End Pricing Item -->

				</div>

			</div>

		</section><!-- /Pricing Section -->

		<!-- Faq Section -->
		<section id="faq" class="faq section">

			<!-- Section Title -->
			<div class="container section-title" data-aos="fade-up">
				<h2>Frequently Asked Questions</h2>
			</div><!-- End Section Title -->

			<div class="container">

				<div class="row justify-content-center">

					<div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

						<div class="faq-container">

							<div class="faq-item faq-active">
								<h3>Berapa biaya estimasi untuk perbaikan unit?</h3>
								<div class="faq-content">
									<p>Biaya estimasi perbaikan bergantung pada jenis alat elektronik, kerusakan yang dialami, dan jenis komponen yang perlu diganti. Setelah menerima alat elektronik Anda, kami akan berdiskusi dengan anda secara gratis dan memberikan perkiraan biaya perbaikan.</p>
								</div>
								<i class="faq-toggle bi bi-chevron-right"></i>
							</div><!-- End Faq item-->

							<div class="faq-item">
								<h3>Berapa lama waktu yang dibutuhkan untuk perbaikan?</h3>
								<div class="faq-content">
									<p>Waktu perbaikan juga tergantung pada kompleksitas kerusakan. Kami akan memberi estimasi waktu perbaikan saat Anda membawa alat elektronik Anda ke pusat layanan kami. Kami berusaha secepat mungkin untuk menyelesaikan perbaikan tanpa mengorbankan kualitas.</p>
								</div>
								<i class="faq-toggle bi bi-chevron-right"></i>
							</div><!-- End Faq item-->

							<div class="faq-item">
								<h3>Apakah saya mendapatkan garansi setelah perbaikan?</h3>
								<div class="faq-content">
									<p>Ya, kami memberikan garansi untuk setiap perbaikan yang kami lakukan. Garansi ini mencakup kerusakan yang sama yang telah kami perbaiki. Silakan hubungi kami jika Anda mengalami masalah setelah perbaikan untuk mendapatkan bantuan tambahan.</p>
								</div>
								<i class="faq-toggle bi bi-chevron-right"></i>
							</div><!-- End Faq item-->

							<div class="faq-item">
								<h3>Apakah Anda menerima semua jenis dan brand untuk diperbaiki?</h3>
								<div class="faq-content">
									<p>Ya, kami menerima semua jenis brand dan juga kami menerima berbagai jenis alat elektronik, Jika Anda memiliki pertanyaan tentang jenis alat elektronik tertentu, jangan ragu untuk menghubungi kami.</p>
								</div>
								<i class="faq-toggle bi bi-chevron-right"></i>
							</div><!-- End Faq item-->

							<div class="faq-item">
								<h3>Bagaimana cara saya membayar untuk layanan perbaikan?</h3>
								<div class="faq-content">
									<p>Kami menerima pembayaran dalam bentuk tunai, transfer bank, atau kartu kredit/debit. Detail pembayaran akan dijelaskan kepada Anda saat mengambil Unit Anda setelah perbaikan selesai.</p>
								</div>
								<i class="faq-toggle bi bi-chevron-right"></i>
							</div><!-- End Faq item-->

							<div class="faq-item">
								<h3>Apakah Anda menyediakan layanan pengambilan dan pengantaran?</h3>
								<div class="faq-content">
									<p>Kami bisa menyediakan layanan pengambilan dan pengantaran, namun akan ada tambahan biaya tergantung pada jarak dan waktu yang dibutuhkan. Silakan hubungi kami untuk informasi lebih lanjut tentang biaya dan syarat-syaratnya.</p>
								</div>
								<i class="faq-toggle bi bi-chevron-right"></i>
							</div><!-- End Faq item-->

						</div>

					</div><!-- End Faq Column-->

				</div>

			</div>

		</section><!-- /Faq Section -->

		<!-- Testimonials Section -->
		<section id="testimonials" class="testimonials section">

			<!-- Section Title -->
			<div class="container section-title" data-aos="fade-up">
				<h2>Testimonials</h2>
				<p>Kami tidak bisa sampai sekarang tanpa pelanggan setia yang selalu percaya kepada kami</p>
			</div><!-- End Section Title -->

			<div class="container" data-aos="fade-up" data-aos-delay="100">

				<div class="swiper">
					<script type="application/json" class="swiper-config">
			{
			  "loop": true,
			  "speed": 600,
			  "autoplay": {
				"delay": 5000
			  },
			  "slidesPerView": "auto",
			  "pagination": {
				"el": ".swiper-pagination",
				"type": "bullets",
				"clickable": true
			  },
			  "breakpoints": {
				"320": {
				  "slidesPerView": 1,
				  "spaceBetween": 40
				},
				"1200": {
				  "slidesPerView": 3,
				  "spaceBetween": 1
				}
			  }
			}
		  </script>
					<div class="swiper-wrapper">

						<div class="swiper-slide">
							<div class="testimonial-item">
								<div class="stars">
									<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
								</div>
								<p>
									Saya sangat terkesan dengan pelayanan yang saya terima dari Digital Repair. Mereka tidak hanya memperbaiki kamera canon saya yang sudah tidak bisa diperbaiki oleh service center resmi sekalipun, tapi juga mereka kerjakan dengan cepat dan efisien, dan juga memberikan layanan pelanggan yang luar biasa. Saya sangat merekomendasikan mereka kepada siapa pun yang membutuhkan layanan perbaikan kamera digital terutama merek Canon!.
								</p>
								<div class="profile mt-auto">
									<img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
									<h3>Sarah Juni</h3>
									<h4>Jakarta</h4>
								</div>
							</div>
						</div><!-- End testimonial item -->

						<div class="swiper-slide">
							<div class="testimonial-item">
								<div class="stars">
									<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
								</div>
								<p>
									Saya sangat senang dengan hasil perbaikan yang dilakukan oleh tim Digital Repair. Mereka tidak hanya mengembalikan laptop ASUS saya ke kondisi normal, tetapi juga memberikan penjelasan yang jelas tentang masalah yang terjadi. Layanan mereka sangat profesional dan ramah. Terima kasih banyak!
								</p>
								<div class="profile mt-auto">
									<img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
									<h3>Adi Nugraha</h3>
									<h4>Denpasar</h4>
								</div>
							</div>
						</div><!-- End testimonial item -->

						<div class="swiper-slide">
							<div class="testimonial-item">
								<div class="stars">
									<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
								</div>
								<p>
									Saya mengalami masalah dengan Lensa Nikon saya dan mencoba beberapa layanan perbaikan sebelumnya tanpa hasil yang memuaskan. Namun, ketika saya mencoba Digital Repair, saya sangat terkesan dengan keahlian teknis mereka. Mereka berhasil memperbaiki Lensa saya dengan cepat dan sekarang itu berfungsi dengan sempurna. Saya sangat berterima kasih!
								</p>
								<div class="profile mt-auto">
									<img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
									<h3>Eka Wijaya</h3>
									<h4>Denpasar</h4>
								</div>
							</div>
						</div><!-- End testimonial item -->

						<div class="swiper-slide">
							<div class="testimonial-item">
								<div class="stars">
									<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
								</div>
								<p>
									I had been struggling with my Computer for weeks until I decided to seek help from Digital Repair. They quickly identified the problem and had it fixed promptly. Now my Computer is working perfectly, and I couldn't be happier. Thank you for the fantastic service!
								</p>
								<div class="profile mt-auto">
									<img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
									<h3>Andrew Kell</h3>
									<h4>Australia</h4>
								</div>
							</div>
						</div><!-- End testimonial item -->

						<div class="swiper-slide">
							<div class="testimonial-item">
								<div class="stars">
									<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
								</div>
								<p>
									I had a problem with my projector that I couldn't figure out on my own. I took it to [Company Name], and they were able to identify and fix the issue in no time. Their professionalism and expertise were truly impressive. Thank you for the excellent service!
								</p>
								<div class="profile mt-auto">
									<img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
									<h3>Jason Burde</h3>
									<h4>United States</h4>
								</div>
							</div>
						</div><!-- End testimonial item -->

					</div>
					<div class="swiper-pagination"></div>
				</div>

			</div>

		</section><!-- /Testimonials Section -->

		<!-- Contact Section -->
		<section id="contact" class="contact section">

			<!-- Section Title -->
			<div class="container section-title" data-aos="fade-up">
				<h2>Contact Us</h2>
				<p>Jika Anda memiliki pertanyaan atau ingin menjadwalkan layanan perbaikan, jangan ragu untuk menghubungi kami melalui telepon, email, atau kunjungi kantor kami selama jam kerja. Tim kami yang ramah siap membantu Anda</p>
			</div><!-- End Section Title -->

			<div class="container" data-aos="fade-up" data-aos-delay="100">

				<div class="row gy-4">

					<div class="col-lg-6">
						<div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
							<i class="bi bi-geo-alt"></i>
							<h3>Alamat</h3>
							<p class="text-center">Jl. Tukad Pancoran IV block A4 no 12B <br>
								Denpasar - Bali</p>
						</div>
					</div><!-- End Info Item -->

					<div class="col-lg-3 col-md-6">
						<div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
							<i class="bi bi-telephone"></i>
							<h3>Call Us</h3>
							<p>+62 898 0000 703</p>
						</div>
					</div><!-- End Info Item -->

					<div class="col-lg-3 col-md-6">
						<div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
							<i class="bi bi-envelope"></i>
							<h3>Email Us</h3>
							<p>repair@digitalisasi.net</p>
						</div>
					</div><!-- End Info Item -->

				</div>

				<div class="row gy-4 mt-1">
					<div class="col-12" data-aos="fade-up" data-aos-delay="300">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.0015185736343!2d115.22738387339729!3d-8.691403891357034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd24164330fe689%3A0xfd75b8c0c2a339cf!2sdigital%20repair%20(camera%20and%20drone%20repair)!5e0!3m2!1sen!2sid!4v1716903796144!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div><!-- End Google Maps -->
				</div>

			</div>

		</section><!-- /Contact Section -->

		<!-- Clients Section -->
		<section id="clients" class="clients section">

			<div class="container" data-aos="fade-up">

				<div class="row gy-4">

					<section class="customer-logos slider row gy-4">
						<div class="slide client-logo">
							<img class="img-fluid" src="assets/img/clients/client-1.png">
						</div>
						<div class="slide client-logo">
							<img class="img-fluid" src="assets/img/clients/client-2.png">
						</div>
						<div class="slide client-logo">
							<img class="img-fluid" src="assets/img/clients/client-3.png">
						</div>
						<div class="slide client-logo">
							<img class="img-fluid" src="assets/img/clients/client-4.png">
						</div>
						<div class="slide client-logo">
							<img class="img-fluid" src="assets/img/clients/client-5.png">
						</div>
						<div class="slide client-logo">
							<img class="img-fluid" src="assets/img/clients/client-6.png">
						</div>
						<div class="slide client-logo">
							<img class="img-fluid" src="assets/img/clients/client-7.png">
						</div>
					</section>


					<!-- <div class="col-xl-2 col-md-3 col-6 client-logo">
			<img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
		  </div>

		  <div class="col-xl-2 col-md-3 col-6 client-logo">
			<img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
		  </div>

		  <div class="col-xl-2 col-md-3 col-6 client-logo">
			<img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
		  </div>

		  <div class="col-xl-2 col-md-3 col-6 client-logo">
			<img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
		  </div>

		  <div class="col-xl-2 col-md-3 col-6 client-logo">
			<img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
		  </div>

		  <div class="col-xl-2 col-md-3 col-6 client-logo">
			<img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
		  </div> -->

				</div>

			</div>

		</section><!-- /Clients Section -->

	</main>

	<?php include_once ('struktur/main/footer.php'); ?>

	<!-- Scroll Top -->
	<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Preloader -->
	<div id="preloader"></div>

	<!-- Vendor JS Files -->
	<script src="assets/vendor/jquery/jquery.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/vendor/php-email-form/validate.js"></script>
	<script src="assets/vendor/aos/aos.js"></script>
	<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="assets/vendor/slick/slick.js"></script>
	<!-- Main JS File -->
	<script src="assets/js/main.js"></script>

</body>

</html>
@extends('web.layouts.app')
@section('content')
    <!-- Start Hero Area -->
    <section id="hero-area" class="hero-area style3">
        <img src="{{ asset('assets/web/assets/images/startup-shape.png') }}" alt="#" class="custom-shape" />
        <!-- Single Slider -->
        <div class="hero-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 co-12">
                        <div class="home-slider">
                            <div class="hero-text">
                                <h5 class="wow fadeInUp" data-wow-delay=".3s"
                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp">
                                    Best Businesse Solutions
                                </h5>
                                <h1 class="wow fadeInUp" data-wow-delay=".5s"
                                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp">
                                    Building Industry-Ready Manpower Through Structured Training Systems
                                </h1>
                                <p class="wow fadeInUp" data-wow-delay=".7s"
                                    style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp">
                                    We help companies build skilled, efficient, and performance-driven teams through
                                    our scientifically designed Precureskill Training System.
                                </p>

                                <div class="d-flex py-4">
                                    <div class="a1 col-lg-3">
                                        <p class="wow fadeInUp" data-wow-delay=".9s"
                                            style="
                                            visibility: visible;
                                            animation-delay: 0.5s;
                                            animation-name: fadeInUp;
                                        ">
                                            Reduce Errors
                                        </p>
                                    </div>
                                    <div class="a1 col-lg-4">
                                        <p class="wow fadeInUp" data-wow-delay=".9s"
                                            style="
                                            visibility: visible;
                                            animation-delay: 0.5s;
                                            animation-name: fadeInUp;
                                        ">
                                            Increase Productivity
                                        </p>
                                    </div>
                                    <div class="a1 col-lg-4">
                                        <p class="wow fadeInUp" data-wow-delay=".9s"
                                            style="
                                            visibility: visible;
                                            animation-delay: 0.5s;
                                            animation-name: fadeInUp;
                                        ">
                                            Improve Workforce Stability
                                        </p>
                                    </div>
                                </div>
                                <div class="button wow fadeInUp" data-wow-delay="1s"
                                    style="visibility: visible; animation-delay: 0.9s; animation-name: fadeInUp">
                                    <a href="{{ route('plan') }}" class="btn"> View Training Plans </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="hero-image wow fadeInRight" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight">
                            <img src="{{ asset('assets/web/assets/images/style3.png') }}" alt="#" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Single Slider -->
    </section>
    <!--/ End Hero Area -->

    <section id="explore" class="app-description startup-page-style section white-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <div class="content wow fadeInLeft" data-wow-delay=".4s"
                        style="visibility: hidden; animation-delay: 0.4s; animation-name: none">
                        <div class="icon">
                            <i class="lni lni-grid-alt"></i>
                        </div>
                        <h2>ABOUT PRECURESKILL <br>(A Unit of System Polygon)</h2>
                        <h5>Building Strong Industries Main Power Through Structured Training</h5>
                        <p>
                            Precureskill is a professional industrial training platform designed to bridge the gap
                            between education and real industry requirements.
                        </p>
                        <h5 class="pb-3">Our mission is simple:</h5>

                        <div class="alert alert-warning">
                            <!-- <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span> -->
                            To serve industries and communities by building skilled, structured, and efficient
                            manpower systems.
                        </div>
                        <p>We don't just train employees — We build complete organizational training ecosystems.</p>
                        <div class="button style3">
                            <a href="{{ route('about.us') }}" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="right wow fadeInRight" data-wow-delay=".6s"
                        style="visibility: hidden; animation-delay: 0.6s; animation-name: none">
                        <img src="{{ asset('assets/web/assets/images/img_9.png') }}" alt="#" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="core-section">
        <div class="core-container">
            <div class="core-badge">OUR CORE OBJECTIVE</div>

            <h2 class="core-title">Strengthening Industry Through Skilled Manpower</h2>

            <p class="core-description">
                To serve the community by empowering industries with structured training systems and
                performance-driven workforce development.
            </p>

            <div class="objective-grid">
                <div class="objective-card">
                    <div class="icon-circle">✓</div>
                    <div class="objective-text">Create industry-ready employees</div>
                </div>

                <div class="objective-card">
                    <div class="icon-circle">✓</div>
                    <div class="objective-text">Reduce dependency on external skilled manpower</div>
                </div>

                <div class="objective-card">
                    <div class="icon-circle">✓</div>
                    <div class="objective-text">Improve internal team efficiency</div>
                </div>

                <div class="objective-card">
                    <div class="icon-circle">✓</div>
                    <div class="objective-text">Develop structured organizational systems</div>
                </div>
            </div>

            <div class="highlight-box">Training is not an expense. It is a growth investment.</div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="section-title style3">
                    <span class="wow fadeInDown" data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown">PROBLEM vs
                        SOLUTION</span>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp">
                        What Makes Our Training System Different?
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp">
                        Traditional Training vs Precureskill Structured Industry System
                    </p>
                </div>
            </div>
        </div>
        <div class="comparison">
            <!-- Others Column -->
            <div class="column others">
                <h3>OTHERS</h3>

                <div class="list-item">
                    <div class="iconl">-</div>
                    Generic training without skill analysis
                </div>

                <div class="list-item">
                    <div class="iconl">-</div>
                    No role-based skill mapping
                </div>

                <div class="list-item">
                    <div class="iconl">-</div>
                    One-time training programs
                </div>

                <div class="list-item">
                    <div class="iconl">-</div>
                    No measurable performance tracking
                </div>

                <div class="list-item">
                    <div class="iconl">-</div>
                    Low return on training investment
                </div>
            </div>

            <!-- Precureskill Column -->
            <div class="column skillmatrix">
                <h3>PRECURESKILL</h3>

                <div class="list-item">
                    <div class="iconl">✓</div>
                    Skill Gap Identification before training
                </div>

                <div class="list-item">
                    <div class="iconl">✓</div>
                    Role-Specific & Department Training
                </div>

                <div class="list-item">
                    <div class="iconl">✓</div>
                    Structured Skill Mapping Framework
                </div>

                <div class="list-item">
                    <div class="iconl">✓</div>
                    Measurable Productivity Tracking
                </div>

                <div class="list-item">
                    <div class="iconl">✓</div>
                    70-80% Efficiency Improvement
                </div>
            </div>
        </div>

        <div class="button style3 text-center my-5">
            <a href="#" class="btn">Build Your Industry Training System</a>
        </div>
    </section>

    <!-- Start Why Choose Area -->
    <section id="features" class="why-choose section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title style3">
                        <span class="wow fadeInDown" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown">We are the
                            best</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp">
                            Our Solution - Precureskill System
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp">
                            A complete structured system designed to build skilled manpower and improve industry
                            performance.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp">
                        <div class="icon">
                            <i class="lni lni-cog"></i>
                        </div>
                        <h3>Skill Gap Analysis</h3>
                        <p>
                            We identify the exact gap between required and existing skills to create a clear
                            development roadmap.
                        </p>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp">
                        <div class="icon two">
                            <i class="lni lni-phone-set"></i>
                        </div>
                        <h3>Structured Training Programs</h3>
                        <p>
                            Standard, industry-specific, and organization-specific modules designed for practical
                            performance improvement.
                        </p>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp">
                        <div class="icon three">
                            <i class="lni lni-codepen"></i>
                        </div>
                        <h3>On-Site Practical Implementation</h3>
                        <p>
                            Real-time, hands-on training inside your company environment to ensure direct
                            productivity impact.
                        </p>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".8s"
                        style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp">
                        <div class="icon four">
                            <i class="lni lni-rocket"></i>
                        </div>
                        <h3>Performance & Continuous Growth</h3>
                        <p>
                            Measurable evaluation system with a long-term improvement framework for sustainable
                            efficiency growth.
                        </p>
                    </div>
                    <!-- End Single Choose -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Area -->

    <section class="step-section">
        <div class="step-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title style3">
                        <span class="wow fadeInDown" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown">STEP-BY-STEP
                            SOLUTION</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp">
                            Our Training System - Structured Approach
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp">
                            We solve problems through a structured approach:
                        </p>
                    </div>
                </div>
            </div>

            <div class="step-wrapper">
                <!-- Left Steps -->
                <div class="steps">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <h3>Standard Problems</h3>
                        <p>
                            Pre-designed modules that solve common industrial challenges with proven structured
                            frameworks.
                        </p>
                    </div>

                    <div class="step-item">
                        <div class="step-number">2</div>
                        <h3>Industry-Specific Problems</h3>
                        <p>
                            Customized training systems tailored to meet the operational demands of specific
                            industries.
                        </p>
                    </div>

                    <div class="step-item">
                        <div class="step-number">3</div>
                        <h3>Organization-Specific Problems</h3>
                        <p>
                            Fully personalized solutions based on internal workflow, company structure, and
                            performance goals.
                        </p>
                    </div>
                </div>

                <!-- Right Visual Box -->
                <div class="col-lg-6 col-12">
                    <div class="right wow fadeInRight" data-wow-delay=".6s"
                        style="visibility: hidden; animation-delay: 0.6s; animation-name: none">
                        <img src="{{ asset('assets/web/assets/images/precuresteps.png') }}" alt="#"
                            class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Why Choose Area -->
    <section id="features" class="why-choose section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title style3">
                        <span class="wow fadeInDown" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown">We are the
                            best</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp">
                            Why Choose Precureskills??
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp">
                            We don't provide random training. <br />
                            We provide structured transformation.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp">
                        <div class="icon">
                            <i class="lni lni-cog"></i>
                        </div>
                        <h3>System-Based Approach</h3>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp">
                        <div class="icon two">
                            <i class="lni lni-phone-set"></i>
                        </div>
                        <h3>Performance-Oriented Model</h3>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp">
                        <div class="icon three">
                            <i class="lni lni-codepen"></i>
                        </div>
                        <h3>Industry-Focused Design</h3>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".8s"
                        style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp">
                        <div class="icon four">
                            <i class="lni lni-rocket"></i>
                        </div>
                        <h3>Long-Term Growth Strategy</h3>
                    </div>
                    <!-- End Single Choose -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Area -->

    <!-- Start Intro Video Area -->
    <section class="intro-video-area style3">
        <div class="container">
            <div class="video-inner">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                        <div class="section-title">
                            <span class="wow fadeInDown" data-wow-delay=".2s"
                                style="visibility: hidden; animation-delay: 0.2s; animation-name: none">Intro Video</span>
                            <h2 class="wow fadeInUp" data-wow-delay=".4s"
                                style="visibility: hidden; animation-delay: 0.4s; animation-name: none">
                                Watch our Platform
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".6s"
                                style="visibility: hidden; animation-delay: 0.6s; animation-name: none">
                                Watch how our training platform helps organizations train employees, track progress,
                                and improve team performance.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                        <div class="intro-video-play">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-12">
                                    <div class="play-thumb wow zoomIn" data-wow-delay=".2s"
                                        style="visibility: hidden; animation-delay: 0.2s; animation-name: none">
                                        <a href="https://www.youtube.com/watch?v=r44RKWyfcFw&amp;fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM"
                                            class="glightbox video"><i class="lni lni-play"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Intro Video Area -->

    <!-- Start Testimonials Section -->
    <section id="testimonials" class="section testimonials style3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title style3">
                        <span class="wow fadeInDown" data-wow-delay=".2s"
                            style="visibility: hidden; animation-delay: 0.2s; animation-name: none">Testimonials</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: hidden; animation-delay: 0.4s; animation-name: none">
                            What Industry Leaders Say
                        </h2>
                        <p>
                            See how our structured training system is helping organizations build skilled teams,
                            improve productivity, and achieve long-term growth.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="testimonial-slider-head">
                        <div class="tns-outer" id="tns1-ow">
                            <div class="tns-nav" aria-label="Carousel Pagination">
                                <button type="button" data-nav="0" aria-controls="tns1" style=""
                                    aria-label="Carousel Page 1 (Current Slide)" class="tns-nav-active"></button><button
                                    type="button" data-nav="1" tabindex="-1" aria-controls="tns1" style=""
                                    aria-label="Carousel Page 2"></button><button type="button" data-nav="2"
                                    tabindex="-1" aria-controls="tns1" style=""
                                    aria-label="Carousel Page 3"></button>
                            </div>
                            <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">
                                slide <span class="current">2</span> of 3
                            </div>
                            <div id="tns1-mw" class="tns-ovh">
                                <div class="tns-inner" id="tns1-iw">
                                    <div class="testimonial-slider tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                        id="tns1"
                                        style="transition-duration: 0s; transform: translate3d(-20%, 0px, 0px)">
                                        <div class="single-testimonial tns-item tns-slide-cloned" aria-hidden="true"
                                            tabindex="-1">
                                            <div class="top-section">
                                                <img src="{{ asset('assets/web/assets/images/testi3.jpg') }}"
                                                    alt="#" />
                                                <h3>
                                                    Phet Putrie
                                                    <span>Freelancer</span>
                                                </h3>
                                            </div>
                                            <p>
                                                Time is the most precious thing you have when bootstrapping. You
                                                can't take time to ponder on desig, Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua.
                                            </p>
                                        </div>
                                        <!-- Start Single Testimonial -->
                                        <div class="single-testimonial tns-item tns-slide-active" id="tns1-item0">
                                            <div class="top-section">
                                                <img src="{{ asset('assets/web/assets/images/testi2.jpg') }}"
                                                    alt="#" />
                                                <h3>
                                                    Aaron Almaraz
                                                    <span>CEO &amp; Founder at Gearat</span>
                                                </h3>
                                            </div>
                                            <p>
                                                Time is the most precious thing you have when bootstrapping. You
                                                can't take time to ponder on desig, Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua.
                                            </p>
                                        </div>
                                        <!-- End Single Testimonial -->
                                        <!-- Start Single Testimonial -->
                                        <div class="single-testimonial tns-item" id="tns1-item1" aria-hidden="true"
                                            tabindex="-1">
                                            <div class="top-section">
                                                <img src="{{ asset('assets/web/assets/images/testi5.jpg') }}assets/images/testi5.jpg"
                                                    alt="#" />
                                                <h3>
                                                    Marleah Eagleston
                                                    <span>Founder at Spicenet</span>
                                                </h3>
                                            </div>
                                            <p>
                                                Time is the most precious thing you have when bootstrapping. You
                                                can't take time to ponder on desig, Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua.
                                            </p>
                                        </div>
                                        <!-- End Single Testimonial -->
                                        <!-- Start Single Testimonial -->
                                        <div class="single-testimonial tns-item" id="tns1-item2" aria-hidden="true"
                                            tabindex="-1">
                                            <div class="top-section">
                                                <img src="{{ asset('assets/web/assets/images/testi3.jpg') }}"
                                                    alt="#" />
                                                <h3>
                                                    Phet Putrie
                                                    <span>Freelancer</span>
                                                </h3>
                                            </div>
                                            <p>
                                                Time is the most precious thing you have when bootstrapping. You
                                                can't take time to ponder on desig, Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua.
                                            </p>
                                        </div>
                                        <!-- End Single Testimonial -->
                                        <div class="single-testimonial tns-item tns-slide-cloned" aria-hidden="true"
                                            tabindex="-1">
                                            <div class="top-section">
                                                <img src="{{ asset('assets/web/assets/images/testi2.jpg') }}"
                                                    alt="#" />
                                                <h3>
                                                    Aaron Almaraz
                                                    <span>CEO &amp; Founder at Gearat</span>
                                                </h3>
                                            </div>
                                            <p>
                                                Time is the most precious thing you have when bootstrapping. You
                                                can't take time to ponder on desig, Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Testimonials Section -->

    <!-- Start Pricing Table Area -->
    <section class="pricing-table style3 section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title style3">
                        <span class="wow fadeInDown" data-wow-delay=".2s"
                            style="visibility: hidden; animation-delay: 0.2s; animation-name: none">Pricing Plan</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: hidden; animation-delay: 0.4s; animation-name: none">
                            Choose Your Plan
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: hidden; animation-delay: 0.6s; animation-name: none">
                            Select the training solution that best fits your organization's needs and start building
                            a skilled, efficient workforce.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @foreach($plans as $plan)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Single Table -->
                        <div class="single-table wow fadeInUp" data-wow-delay=".2s"
                            style="visibility: hidden; animation-delay: 0.2s; animation-name: none">
                            <!-- Table Head -->
                            <div class="table-head">
                                <div class="price">
                                    <p class="amount">₹{{ number_format($plan->amount, 2) }}</p>
                                </div>
                                <div class="title">
                                    <h4>{{ $plan->plan_name }}</h4>
                                </div>
                            </div>
                            <!-- End Table Head -->
                            <!-- Table List -->
                            <p class="text-center">
                                {{ $plan->description ?? '-' }}
                            </p>
                            <!-- End Table List -->
                            <!-- Table Bottom -->
                            <div class="button">
                                <a class="btn" href="#">Choose Plan <i class="lni lni-arrow-right"></i></a>
                            </div>
                            <!-- End Table Bottom -->
                        </div>
                        <!-- End Single Table-->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--/ End Pricing Table Area -->

    <!-- Start Faq Area -->
    <section class="faq style3 section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="section-title style3">
                        <span class="wow fadeInDown" data-wow-delay=".2s"
                            style="visibility: hidden; animation-delay: 0.2s; animation-name: none">Frequently asked
                            questions</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: hidden; animation-delay: 0.4s; animation-name: none">
                            We have some FAQ to<br />
                            inform you more
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: hidden; animation-delay: 0.6s; animation-name: none">
                            Find quick answers to common questions about our industry training system and how it
                            helps organizations build skilled, efficient teams.
                        </p>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span>What is the Precure Skill Training System?</span><i
                                        class="lni lni-chevron-down"></i>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        The Precure Skill Training System is a structured approach designed to
                                        identify employee skill gaps and develop the exact competencies required by
                                        an industry. It helps organizations build a skilled workforce internally
                                        through systematic training and evaluation.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>Who is this training system designed for?</span><i
                                        class="lni lni-chevron-down"></i>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        This system is designed specifically for industries, factories, and
                                        organizations that want to improve employee skills, increase productivity,
                                        and reduce dependency on external skilled manpower.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span>How is your training different from traditional training programs?</span><i
                                        class="lni lni-chevron-down"></i>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Traditional training often focuses on theory and generic courses. Our system
                                        focuses on real workplace problems, practical training, and measurable
                                        performance improvements tailored to each organization.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span>How do you measure employee improvement?</span><i
                                        class="lni lni-chevron-down"></i>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        We use a performance evaluation system that tracks skill development,
                                        productivity improvements, and operational efficiency after training
                                        implementation.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Faq Area -->

    <!-- /End Newsletter Area -->

    <!-- Start Cta Area -->
    <section id="call-action" class="call-action section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="inner-content">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s"
                            style="visibility: hidden; animation-delay: 0.2s; animation-name: none">
                            Ready to Build a Skilled & <br />Efficient Workforce?
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: hidden; animation-delay: 0.4s; animation-name: none">
                            Let's design a customized training system for your company.
                        </p>
                        <div class="button style3 wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: hidden; animation-delay: 0.6s; animation-name: none">
                            <a href="{{ route('contact') }}" class="btn">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Cta Area -->

    <!-- Start Contact Area -->
    <section id="contact" class="contact-us style3 section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title style3">
                        <span class="wow fadeInDown" data-wow-delay=".2s"
                            style="visibility: hidden; animation-delay: 0.2s; animation-name: none">Conctact Us</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: hidden; animation-delay: 0.4s; animation-name: none">
                            Let's cooperate!
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: hidden; animation-delay: 0.6s; animation-name: none">
                            There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.
                        </p>
                    </div>
                </div>
            </div>
            <div class="contact-head">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <div class="form-main">
                                <form class="form" method="post"
                                    action="https://demo.graygrids.com/themes/xpeedo/assets/mail/mail.php">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="name" type="text" placeholder="Your Name"
                                                    required="required" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="subject" type="text" placeholder="Your Subject"
                                                    required="required" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="email" type="email" placeholder="Your Email"
                                                    required="required" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="phone" type="text" placeholder="Your Phone"
                                                    required="required" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group message">
                                                <textarea name="message" placeholder="Your Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group button style3">
                                                <button type="submit" class="btn">Send Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="contact-info">
                                <div class="single-head">
                                    <div class="single-info">
                                        <i class="lni lni-map-marker"></i>
                                        <ul>
                                            <li><span>Location</span></li>
                                            <li>
                                                32, Gajendra Nagar, Shobhawato ki Dhani,<br />
                                                Opp. Victorian palace, Pal road, Jodhpur, <br />Rajasthan,
                                                342001,India.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="single-info">
                                        <i class="lni lni-phone"></i>
                                        <ul>
                                            <li><span>Call Us</span></li>
                                            <li><a href="#">+91 85619 03387</a></li>
                                        </ul>
                                    </div>
                                    <div class="single-info">
                                        <i class="lni lni-envelope"></i>
                                        <ul>
                                            <li><span>Mail Us</span></li>
                                            <li><a href="mailto:info@syspoly.com">info@syspoly.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact Area -->
@endsection
@section('script')
@endsection

@extends('web.layouts.app')
@section('content')
    <!-- Start Hero Area -->
    <section id="hero-area" class="hero-area style3">
        <!-- <img src="{{ asset('assets/web/assets/images/startup-shape.png') }}" alt="#" class="custom-shape"> -->
        <!-- Single Slider -->
        <div class="hero-inner hero-inner2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 co-12">
                        <div class="home-slider">
                            <div class="hero-text hero-text2">
                                <h1 class="wow fadeInUp" data-wow-delay=".5s"
                                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp">
                                    About Us
                                </h1>
                            </div>
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
                        <h2>ABOUT PRECURESKILL <br> (A Unit of SYSTEM POLYGON PRIVATE LIMITED)</h2>
                        <h5>Building Skilled Workforces for Stronger Industries</h5>
                        <p>
                            Industries grow when their workforce grows. At Precureskill, our mission is to help organizations
                            build strong, capable, and efficient teams through structured training systems.
                        </p>
                        <p>
                            We work closely with industries to identify skill gaps, develop targeted training
                            programs, and create a sustainable ecosystem where employees continuously improve their
                            abilities.
                        </p>
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

    <section class="mv-section">
        <div class="mv-container">
            <div class="mv-grid">
                <div class="mv-card">
                    <h3>Our Mission</h3>
                    <p>
                        Our mission is to strengthen industries by developing skilled manpower through practical,
                        structured, and measurable training systems.
                    </p>

                    <p>
                        We believe that when employees grow, organizations grow. By investing in skill development,
                        companies can create a more productive, confident, and future-ready workforce.
                    </p>
                </div>

                <div class="mv-card">
                    <h3>Our Vision</h3>
                    <p>
                        Our vision is to create a system where industries can develop skilled professionals
                        internally without relying heavily on external manpower.
                    </p>

                    <p>
                        We aim to build a culture where continuous learning, efficiency, and performance improvement
                        become part of every organization.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <style></style>

    <script>
        const mvCards = document.querySelectorAll(".mv-card");

        function revealCards() {
            mvCards.forEach((card) => {
                const cardTop = card.getBoundingClientRect().top;
                const trigger = window.innerHeight - 100;

                if (cardTop < trigger) {
                    card.style.opacity = "1";
                    card.style.transform = "translateY(0)";
                }
            });
        }

        window.addEventListener("scroll", revealCards);
    </script>

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
                            What We Do
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp">
                            We provide a complete training ecosystem designed specifically for industries.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp">
                        <div class="icon">
                            <i class="lni lni-cog"></i>
                        </div>
                        <h3>Skill Gap Analysis</h3>
                        <p>We identify skill gaps within organizations to build focused development plans.</p>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp">
                        <div class="icon two">
                            <i class="lni lni-phone-set"></i>
                        </div>
                        <h3>Role-Based Training</h3>
                        <p>
                            Customized training modules designed according to employee roles and responsibilities.
                        </p>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp">
                        <div class="icon three">
                            <i class="lni lni-codepen"></i>
                        </div>
                        <h3>Industry Programs</h3>
                        <p>Learning programs tailored specifically for industry requirements and standards.</p>
                    </div>
                    <!-- End Single Choose -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".8s"
                        style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp">
                        <div class="icon four">
                            <i class="lni lni-rocket"></i>
                        </div>
                        <h3>On-Site Practical Training</h3>
                        <p>Hands-on practical sessions conducted directly within the workplace.</p>
                    </div>
                    <!-- End Single Choose -->
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".8s"
                        style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp">
                        <div class="icon four">
                            <i class="lni lni-rocket"></i>
                        </div>
                        <h3>Performance Evaluation</h3>
                        <p>Structured systems to measure employee performance and progress.</p>
                    </div>
                    <!-- End Single Choose -->
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Choose -->
                    <div class="single-choose wow fadeInUp" data-wow-delay=".8s"
                        style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp">
                        <div class="icon four">
                            <i class="lni lni-rocket"></i>
                        </div>
                        <h3>Continuous Improvement</h3>
                        <p>Ongoing skill development frameworks to maintain growth and productivity.</p>
                    </div>
                    <!-- End Single Choose -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Area -->

    <section id="explore" class="app-description startup-page-style section white-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="approach-header">
                    <h2>Our Approach</h2>
                    <p>We follow a step-by-step approach to ensure training delivers real results.</p>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-number">1</div>
                            <div class="timeline-content">
                                <h3>Identify Skill Gaps</h3>
                                <p>
                                    We analyze the current capabilities of employees and identify areas that need
                                    improvement.
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-number">2</div>
                            <div class="timeline-content">
                                <h3>Design Structured Training</h3>
                                <p>
                                    We develop training programs tailored to industry requirements and
                                    organizational goals.
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-number">3</div>
                            <div class="timeline-content">
                                <h3>Implement Practical Learning</h3>
                                <p>Employees receive hands-on training in real working environments.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-number">4</div>
                            <div class="timeline-content">
                                <h3>Measure Performance</h3>
                                <p>
                                    We track employee growth and ensure continuous improvement through measurable
                                    performance evaluation.
                                </p>
                            </div>
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
@endsection
@section('script')
@endsection

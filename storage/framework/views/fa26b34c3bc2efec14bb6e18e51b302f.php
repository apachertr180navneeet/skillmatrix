
<?php $__env->startSection('content'); ?>

<!-- Start Hero Area -->
<section id="hero-area" class="hero-area style3">
    <!-- <img src="assets/images/startup-shape.png" alt="#" class="custom-shape"> -->
    <!-- Single Slider -->
    <div class="hero-inner hero-inner2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 co-12">
                    <div class="home-slider">
                        <div class="hero-text hero-text2">
                            <h1
                                class="wow fadeInUp"
                                data-wow-delay=".5s"
                                style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp"
                            >
                                Contact Us
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

<section class="contact-section">
    <div class="container">
        <div
            class="contact-wrapper wow fadeInUp data-wow-delay=.5s"
            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp"
        >
            <!-- Left Contact Info -->

            <div class="contact-info">
                <h2>Let's get in touch</h2>

                <p>We're open for any suggestion or just to have a chat</p>

                <div class="info-item">
                    <div class="icon-box">
                        <i class="lni lni-map-marker"></i>
                    </div>
                    <div>
                        <h4>Location</h4>
                        <p>
                            32, Gajendra Nagar, Shobhawato ki Dhani,<br />
                            Pal road, Jodhpur, Rajasthan, 342001, India
                        </p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-box">
                        <i class="lni lni-phone"></i>
                    </div>
                    <div>
                        <h4>Call Us</h4>
                        <p>+91 85619 03387</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-box">
                        <i class="lni lni-envelope"></i>
                    </div>
                    <div>
                        <h4>Mail Us</h4>
                        <p>info@syspoly.com</p>
                    </div>
                </div>
            </div>

            <!-- Right Contact Form -->

            <div class="contact-form">
                <!-- <h2>Get in touch</h2> -->

                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" placeholder="Name" />
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" placeholder="Email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" placeholder="Subject" />
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea placeholder="Message"></textarea>
                    </div>

                    <button class="send-btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="row p-0 m-0">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3578.6507128603207!2d72.98242177419425!3d26.240536488656023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39418c2ff137ba1f%3A0xf603d7b127ed04b7!2sSYSPOLY%20MOBILE%20ANDROID%20IOS%20APP%20COMPANY!5e0!3m2!1sen!2sin!4v1773139894827!5m2!1sen!2sin"
        width="100%"
        height="450"
        style="border: 0"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
</div>
<style></style>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/web/home/contact.blade.php ENDPATH**/ ?>
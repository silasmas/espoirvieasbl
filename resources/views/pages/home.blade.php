@extends('layouts.public')

@section('title', 'Accueil - Espoir Vie ASBL')

@section('content')
    <!-- BANNER SECTION START -->
    <section class="ul-banner">
        <div class="ul-banner-container">
            <div class="row gy-4 row-cols-lg-2 row-cols-1 align-items-center flex-column-reverse flex-lg-row">
                <!-- banner text -->
                <div class="col">
                    <div class="ul-banner-txt">
                        <div class="wow animate__fadeInUp">
                            <span class="ul-banner-sub-title ul-section-sub-title">Change The World Together</span>
                            <h1 class="ul-banner-title">For The People & Cause You Care About</h1>
                            <p class="ul-banner-descr">It is a long established fact that a reader will be distracted lorem the readable content of a page when looking at layout the point lorem established fact that It is a long established</p>
                            <div class="ul-banner-btns">
                                <a href="donations.html" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Make Donation</a>

                                <div class="ul-banner-stat">
                                    <div class="imgs">
                                        <img src="{{ asset('assets/img/user-1.png') }}" alt="Person">
                                        <img src="{{ asset('assets/img/user-3.png') }}" alt="Person">
                                        <img src="{{ asset('assets/img/user-2.png') }}" alt="Person">
                                        <span class="number">2.M</span>
                                    </div>
                                    <span class="txt">Active donors</span>
                                </div>
                            </div>
                        </div>

                        <img src="{{ asset('assets/img/vector-img.png') }}" alt="Vector" class="ul-banner-txt-vector">
                    </div>
                </div>

                <!-- img -->
                <div class="col align-self-start">
                    <div class="ul-banner-img">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/img/banner-img.png') }}" alt="Banner Image">
                            <!-- <div class="ul-banner-video-btn">
                                <a href=""></a>
                            </div> -->
                        </div>
                        <div class="ul-banner-img-vectors">
                            <img src="{{ asset('assets/img/banner-img-vector-1.png') }}" alt="vector" class="vector-1 wow animate__fadeInRight">
                            <img src="{{ asset('assets/img/banner-img-vector-2.png') }}" alt="vector" class="vector-2 wow animate__fadeInDown">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BANNER SECTION END -->


    <!-- ABOUT SECTION START -->
    <section class="ul-about ul-section-spacing wow animate__fadeInUp">
        <div class="ul-container">
            <div class="row row-cols-md-2 row-cols-1 align-items-center gy-4 ul-about-row">
                <div class="col">
                    <div class="ul-about-imgs">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/img/about-img.png') }}" alt="Image">
                        </div>
                        <div class="ul-about-imgs-vectors">
                            <img src="{{ asset('assets/img/about-img-vector-1.svg') }}" alt="Image" class="vector-1">
                            <img src="{{ asset('assets/img/about-img-vector-2.svg') }}" alt="Image" class="vector-2">
                        </div>
                    </div>
                </div>

                <!-- txt -->
                <div class="col">
                    <div class="ul-about-txt">
                        <span class="ul-section-sub-title ul-section-sub-title--2">About US</span>
                        <h2 class="ul-section-title">Helping Each Other can Make World Better</h2>
                        <p class="ul-section-descr">Dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit The aspernaturaut odit aut fugit, sed quia consequuntur. Nonprofits around the world apply and join us to access more funding.</p>

                        <div class="ul-about-block">
                            <div class="block-left">
                                <div class="block-heading">
                                    <div class="icon"><i class="flaticon-love"></i></div>
                                    <h3 class="block-title">Start Helping Team</h3>
                                </div>

                                <ul class="block-list">
                                    <li>There are many variations of solve</li>
                                </ul>
                            </div>
                            <div class="block-right"><img src="{{ asset('assets/img/about-block-img.jpg') }}" alt="Image"></div>
                        </div>

                        <div class="ul-about-bottom">
                            <a href="about.html" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Explore More</a>

                            <div class="ul-about-call">
                                <div class="icon"><i class="flaticon-telephone-call"></i></div>
                                <div class="txt">
                                    <span class="call-title">Call Any Time</span>
                                    <a href="tel:+612345678990">+61 2345 678 990</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- vector -->
        <div class="ul-about-vectors">
            <img src="{{ asset('assets/img/about-vector-1.png') }}" alt="vector" class="vector-1">
        </div>
    </section>
    <!-- ABOUT SECTION END -->


    <!-- DONTATIONS SECTION START -->
    <section class="ul-donations ul-section-spacing overflow-hidden">
        <!-- heading -->
        <div class="ul-container">
            <div class="ul-section-heading ul-donations-heading justify-content-between text-center">
                <div class="left">
                    <span class="ul-section-sub-title"><span class="txt">Help & Donate us</span></span>
                    <h2 class="ul-section-title">Inspiring and Helping for Better Lifestyle</h2>
                </div>

                <div class="flex-shrink-0">
                    <div class="ul-banner-stat">
                        <div class="imgs">
                            <img src="{{ asset('assets/img/user-1.png') }}" alt="Person">
                            <img src="{{ asset('assets/img/user-3.png') }}" alt="Person">
                            <img src="{{ asset('assets/img/user-2.png') }}" alt="Person">
                            <span class="number">2.M</span>
                        </div>
                        <span class="txt text-white">Active donors</span>
                    </div>
                </div>
                <div class="ul-slider-nav ul-donations-slider-nav">
                    <button class="prev"><i class="flaticon-back"></i></button>
                    <button class="next"><i class="flaticon-next"></i></button>
                </div>
            </div>
        </div>

        <!-- DONTATIONS slider -->
        <div class="ul-container wow animate__fadeInUp">
            <div class="ul-donations-slider swiper overflow-visible">
                <div class="swiper-wrapper">
                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-1.jpg') }}" alt="donation Image">
                                <span class="tag">Foods</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="55">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Raised : $25,000</span>
                                        <span class="ul-donation-progress-label">Goal : $30,000</span>
                                    </div>
                                </div>
                                <a href="donation-details.html" class="ul-donation-title">Lifes kills for Children in South African peoples</a>
                                <p class="ul-donation-descr">We work together to make a lasting difference, helping people. With kindness and hard work</p>
                                <a href="donation-details.html" class="ul-donation-btn">Donate now <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-2.jpg') }}" alt="donation Image">
                                <span class="tag">Foods</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="95">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Raised : $25,000</span>
                                        <span class="ul-donation-progress-label">Goal : $30,000</span>
                                    </div>
                                </div>
                                <a href="donation-details.html" class="ul-donation-title">Lifes kills for Children in South African peoples</a>
                                <p class="ul-donation-descr">We work together to make a lasting difference, helping people. With kindness and hard work</p>
                                <a href="donation-details.html" class="ul-donation-btn">Donate now <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-3.jpg') }}" alt="donation Image">
                                <span class="tag">Foods</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="50">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Raised : $25,000</span>
                                        <span class="ul-donation-progress-label">Goal : $30,000</span>
                                    </div>
                                </div>
                                <a href="donation-details.html" class="ul-donation-title">Lifes kills for Children in South African peoples</a>
                                <p class="ul-donation-descr">We work together to make a lasting difference, helping people. With kindness and hard work</p>
                                <a href="donation-details.html" class="ul-donation-btn">Donate now <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-4.jpg') }}" alt="donation Image">
                                <span class="tag">Foods</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="64">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Raised : $25,000</span>
                                        <span class="ul-donation-progress-label">Goal : $30,000</span>
                                    </div>
                                </div>
                                <a href="donation-details.html" class="ul-donation-title">Lifes kills for Children in South African peoples</a>
                                <p class="ul-donation-descr">We work together to make a lasting difference, helping people. With kindness and hard work</p>
                                <a href="donation-details.html" class="ul-donation-btn">Donate now <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-1.jpg') }}" alt="donation Image">
                                <span class="tag">Foods</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="80">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Raised : $25,000</span>
                                        <span class="ul-donation-progress-label">Goal : $30,000</span>
                                    </div>
                                </div>
                                <a href="donation-details.html" class="ul-donation-title">Lifes kills for Children in South African peoples</a>
                                <p class="ul-donation-descr">We work together to make a lasting difference, helping people. With kindness and hard work</p>
                                <a href="donation-details.html" class="ul-donation-btn">Donate now <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-2.jpg') }}" alt="donation Image">
                                <span class="tag">Foods</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="95">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Raised : $25,000</span>
                                        <span class="ul-donation-progress-label">Goal : $30,000</span>
                                    </div>
                                </div>
                                <a href="donation-details.html" class="ul-donation-title">Lifes kills for Children in South African peoples</a>
                                <p class="ul-donation-descr">We work together to make a lasting difference, helping people. With kindness and hard work</p>
                                <a href="donation-details.html" class="ul-donation-btn">Donate now <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-3.jpg') }}" alt="donation Image">
                                <span class="tag">Foods</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="50">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Raised : $25,000</span>
                                        <span class="ul-donation-progress-label">Goal : $30,000</span>
                                    </div>
                                </div>
                                <a href="donation-details.html" class="ul-donation-title">Lifes kills for Children in South African peoples</a>
                                <p class="ul-donation-descr">We work together to make a lasting difference, helping people. With kindness and hard work</p>
                                <a href="donation-details.html" class="ul-donation-btn">Donate now <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-4.jpg') }}" alt="donation Image">
                                <span class="tag">Foods</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="64">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Raised : $25,000</span>
                                        <span class="ul-donation-progress-label">Goal : $30,000</span>
                                    </div>
                                </div>
                                <a href="donation-details.html" class="ul-donation-title">Lifes kills for Children in South African peoples</a>
                                <p class="ul-donation-descr">We work together to make a lasting difference, helping people. With kindness and hard work</p>
                                <a href="donation-details.html" class="ul-donation-btn">Donate now <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ul-dontations-slider-pagination d-none"></div>
            </div>
        </div>
    </section>
    <!-- DONTATIONS SECTION END -->


    <!-- DONATE SECTION START -->
    <div class="ul-section-spacing">
        <div class="ul-container">
            <div class="ul-donate-form-section">
                <div class="row justify-content-between align-items-center">
                    <!-- donate form -->
                    <div class="col-lg-6 position-relative">
                        <div class="ul-donate-form-wrapper">
                            <h3 class="ul-donate-form-title">Custome Donate Now</h3>
                            <form action="#" class="ul-donate-form">
                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-1" checked hidden>
                                    <label for="donate-amount-1" class="ul-donate-form-label">$10</label>
                                </div>

                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-2" hidden>
                                    <label for="donate-amount-2" class="ul-donate-form-label">$20</label>
                                </div>

                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-3" hidden>
                                    <label for="donate-amount-3" class="ul-donate-form-label">$30</label>
                                </div>

                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-4" hidden>
                                    <label for="donate-amount-4" class="ul-donate-form-label">$40</label>
                                </div>

                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-5" hidden>
                                    <label for="donate-amount-5" class="ul-donate-form-label">$50</label>
                                </div>

                                <div class="custom-amount-wrapper">
                                    <input type="radio" name="donate-amount" id="custom-amount">
                                    <label for="donate-amount-custom" class="ul-donate-form-label">
                                        <input type="number" name="custom-amount" id="donate-amount-custom" placeholder="Custom Amount" class="ul-donate-form-custom-input">
                                    </label>
                                </div>

                                <div>
                                    <button type="submit" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Donate Now</button>
                                </div>
                            </form>
                        </div>
                        <img src="{{ asset('assets/img/donate-form-vector.svg') }}" alt="vector" class="ul-donate-form-vector">
                    </div>

                    <!-- donate form  -->
                    <div class="col-xl-5 col-lg-6">
                        <div class="ul-donate-form-section-txt">
                            <span class="ul-section-sub-title text-white">Donate Now</span>
                            <h2 class="ul-section-title text-white">Support Kids by Raising Valuable Donations</h2>

                            <div class="ul-donation-progress">
                                <div class="donation-progress-container ul-progress-container">
                                    <div class="donation-progressbar ul-progressbar" data-ul-progress-value="64">
                                        <div class="donation-progress-label ul-progress-label"></div>
                                    </div>
                                </div>
                                <div class="ul-donation-progress-labels">
                                    <span class="ul-donation-progress-label">Raised : $25,000</span>
                                    <span class="ul-donation-progress-label">Goal : $30,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- DONATE SECTION END -->


    <!-- STATS SECTION START -->
    <div class="ul-stats ul-section-spacing">
        <div class="ul-container">
            <div class="ul-stats-wrapper wow animate__fadeInUp">
                <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-bs-row justify-content-center">
                    <div class="col">
                        <div class="ul-stats-item">
                            <i class="flaticon-costumer"></i>
                            <span class="number">260+</span>
                            <span class="txt">Total Happy Children</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="ul-stats-item">
                            <i class="flaticon-team"></i>
                            <span class="number">110+</span>
                            <span class="txt">Total Our Volunteer</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="ul-stats-item">
                            <i class="flaticon-package"></i>
                            <span class="number">190+</span>
                            <span class="txt">Our Products & Gifts</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="ul-stats-item">
                            <i class="flaticon-relationship"></i>
                            <span class="number">560+</span>
                            <span class="txt">Worldwide Donor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- STATS SECTION END -->


    <!-- EVENTS SECTION START -->
    <section class="ul-events ul-section-spacing pt-0">
        <div class="ul-container">
            <!-- heading -->
            <div class="ul-section-heading align-items-center wow animate__fadeInUp">
                <div class="left">
                    <span class="ul-section-sub-title">Upcoming Events</span>
                    <h2 class="ul-section-title text-white">Charitics Information Of Event Schedule</h2>
                </div>
                <a href="events.html" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Explore More</a>
            </div>

            <!-- events -->
            <div class="ul-events-wrapper">
                <div class="row ul-bs-row row-cols-lg-2 row-cols-1">
                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event">
                            <div class="ul-event-img">
                                <img src="{{ asset('assets/img/event-img.jpg') }}" alt="Event Image">
                                <span class="date">29 <span>July</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title"><a href="event-details.html">Manager Disapproved of the Most Recent Work.</a></h3>
                                <p class="ul-event-descr">Dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernaturaut</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Venue</span>
                                    <p class="ul-event-info-descr">350 5th AveNew York, NY 118 United States</p>
                                </div>
                                <a href="event-details.html" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Event Details</a>
                            </div>
                        </div>
                    </div>

                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event">
                            <div class="ul-event-img">
                                <img src="{{ asset('assets/img/blog-b-1.jpg') }}" alt="Event Image">
                                <span class="date">29 <span>July</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title"><a href="event-details.html">Manager Disapproved of the Most Recent Work.</a></h3>
                                <p class="ul-event-descr">Dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernaturaut</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Venue</span>
                                    <p class="ul-event-info-descr">350 5th AveNew York, NY 118 United States</p>
                                </div>
                                <a href="event-details.html" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Event Details</a>
                            </div>
                        </div>
                    </div>

                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event">
                            <div class="ul-event-img">
                                <img src="{{ asset('assets/img/blog-2.jpg') }}" alt="Event Image">
                                <span class="date">29 <span>July</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title"><a href="event-details.html">Manager Disapproved of the Most Recent Work.</a></h3>
                                <p class="ul-event-descr">Dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernaturaut</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Venue</span>
                                    <p class="ul-event-info-descr">350 5th AveNew York, NY 118 United States</p>
                                </div>
                                <a href="event-details.html" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Event Details</a>
                            </div>
                        </div>
                    </div>

                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event">
                            <div class="ul-event-img">
                                <img src="{{ asset('assets/img/blog-b-3.jpg') }}" alt="Event Image">
                                <span class="date">29 <span>July</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title"><a href="event-details.html">Manager Disapproved of the Most Recent Work.</a></h3>
                                <p class="ul-event-descr">Dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernaturaut</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Venue</span>
                                    <p class="ul-event-info-descr">350 5th AveNew York, NY 118 United States</p>
                                </div>
                                <a href="event-details.html" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Event Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- vectors -->
        <div class="ul-events-vectors">
            <img src="{{ asset('assets/img/events-vector-1.png') }}" alt="Events Image" class="vector-1">
            <img src="{{ asset('assets/img/events-vector-2.svg') }}" alt="Events Image" class="vector-2">
        </div>
    </section>
    <!-- EVENTS SECTION END -->


    <!-- WHY JOIN SECTION START -->
    <section class="ul-why-join ul-section-spacing">
        <div class="ul-why-join-wrapper ul-section-spacing">
            <div class="ul-container">
                <div class="row row-cols-md-2 row-cols-1 gy-4 align-items-center">
                    <div class="col">
                        <div class="ul-why-join-img">
                            <img src="{{ asset('assets/img/why-join.jpg') }}" alt="Image">
                        </div>
                    </div>

                    <!-- txt -->
                    <div class="col">
                        <div class="ul-why-join-txt">
                            <span class="ul-section-sub-title">Join us</span>
                            <h2 class="ul-section-title">Why We Need You Become a Volunteer</h2>
                            <p class="ul-section-descr">We help companies develop powerful corporate social responsibility, grantmaking, and employee engagement strategies.</p>

                            <div class="ul-accordion">
                                <div class="ul-single-accordion-item open">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title">Recognition and Fulfillment</h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-next"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>Aonsectetur adipiscing elit Aenean scelerisque augue vitae consequat Juisque eget congue velit in cursus leo sodales the turpis euismod quis sapien euismod quis sapien the. E-learning is suitable for students, professionals, and anyone interested.</p>
                                    </div>
                                </div>

                                <div class="ul-single-accordion-item">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title">Why Join Us as a Volunteer?</h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-next"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>Aonsectetur adipiscing elit Aenean scelerisque augue vitae consequat Juisque eget congue velit in cursus leo sodales the turpis euismod quis sapien euismod quis sapien the. E-learning is suitable for students, professionals, and anyone interested.</p>
                                    </div>
                                </div>

                                <div class="ul-single-accordion-item">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title">Be Part of a Community</h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-next"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>Aonsectetur adipiscing elit Aenean scelerisque augue vitae consequat Juisque eget congue velit in cursus leo sodales the turpis euismod quis sapien euismod quis sapien the. E-learning is suitable for students, professionals, and anyone interested.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- WHY JOIN SECTION END -->


    <!-- TEAM SECTION START -->
    <section class="ul-team ul-section-spacing pt-0">
        <div class="ul-container">
            <!-- Heading -->
            <div class="ul-section-heading justify-content-between">
                <div class="left">
                    <span class="ul-section-sub-title">Our Team</span>
                    <h2 class="ul-section-title">Skilled Legal Professionals Dedicated to You</h2>
                </div>
                <div>
                    <a href="team.html" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Join With us</a>
                </div>
            </div>

            <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-team-row justify-content-center">
                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-1.jpg') }}" alt="Team Member Image">
                            <div class="ul-team-member-socials">
                                <a href="#"><i class="flaticon-facebook"></i></a>
                                <a href="#"><i class="flaticon-twitter"></i></a>
                                <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                                <a href="#"><i class="flaticon-instagram"></i></a>
                            </div>
                        </div>
                        <div class="ul-team-member-info">
                            <h3 class="ul-team-member-name"><a href="team-details.html">John Doe</a></h3>
                            <p class="ul-team-member-designation">Attorney</p>
                        </div>
                    </div>
                </div>

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-2.jpg') }}" alt="Team Member Image">
                            <div class="ul-team-member-socials">
                                <a href="#"><i class="flaticon-facebook"></i></a>
                                <a href="#"><i class="flaticon-twitter"></i></a>
                                <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                                <a href="#"><i class="flaticon-instagram"></i></a>
                            </div>
                        </div>
                        <div class="ul-team-member-info">
                            <h3 class="ul-team-member-name"><a href="team-details.html">John Doe</a></h3>
                            <p class="ul-team-member-designation">Attorney</p>
                        </div>
                    </div>
                </div>

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-3.jpg') }}" alt="Team Member Image">
                            <div class="ul-team-member-socials">
                                <a href="#"><i class="flaticon-facebook"></i></a>
                                <a href="#"><i class="flaticon-twitter"></i></a>
                                <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                                <a href="#"><i class="flaticon-instagram"></i></a>
                            </div>
                        </div>
                        <div class="ul-team-member-info">
                            <h3 class="ul-team-member-name"><a href="team-details.html">John Doe</a></h3>
                            <p class="ul-team-member-designation">Attorney</p>
                        </div>
                    </div>
                </div>

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-4.jpg') }}" alt="Team Member Image">
                            <div class="ul-team-member-socials">
                                <a href="#"><i class="flaticon-facebook"></i></a>
                                <a href="#"><i class="flaticon-twitter"></i></a>
                                <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                                <a href="#"><i class="flaticon-instagram"></i></a>
                            </div>
                        </div>
                        <div class="ul-team-member-info">
                            <h3 class="ul-team-member-name"><a href="team-details.html">John Doe</a></h3>
                            <p class="ul-team-member-designation">Attorney</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- TEAM SECTION END -->


    <!-- TESTIMONIAL SECTION START -->
    <section class="ul-testimonial ul-section-spacing">
        <div class="ul-testimonial-container">
            <div class="ul-section-heading text-center">
                <div>
                    <span class="ul-section-sub-title">Testimonials</span>
                    <h2 class="ul-section-title">What They Are Talking About Charitics</h2>
                </div>
            </div>

            <div class="ul-testimonial-slider swiper">
                <div class="swiper-wrapper">
                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Praesent ut lacus a velit tincidunt aliquam a eget urna. Sed ullamcorper tristique nisl at pharetra turpis accumsan et etiam eu sollicitudin eros. In imperdiet accumsan.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-1.jpg') }}" alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">Esther Howard</h3>
                                        <span class="reviewer-role">Web Designer</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Praesent ut lacus a velit tincidunt aliquam a eget urna. Sed ullamcorper tristique nisl at pharetra turpis accumsan et etiam eu sollicitudin eros. In imperdiet accumsan.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-2.jpg') }}" alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">Esther Howard</h3>
                                        <span class="reviewer-role">Web Designer</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Praesent ut lacus a velit tincidunt aliquam a eget urna. Sed ullamcorper tristique nisl at pharetra turpis accumsan et etiam eu sollicitudin eros. In imperdiet accumsan.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-3.jpg') }}" alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">Esther Howard</h3>
                                        <span class="reviewer-role">Web Designer</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Praesent ut lacus a velit tincidunt aliquam a eget urna. Sed ullamcorper tristique nisl at pharetra turpis accumsan et etiam eu sollicitudin eros. In imperdiet accumsan.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-4.jpg') }}" alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">Esther Howard</h3>
                                        <span class="reviewer-role">Web Designer</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Praesent ut lacus a velit tincidunt aliquam a eget urna. Sed ullamcorper tristique nisl at pharetra turpis accumsan et etiam eu sollicitudin eros. In imperdiet accumsan.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-1.jpg') }}" alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">Esther Howard</h3>
                                        <span class="reviewer-role">Web Designer</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ul-testimonial-slider-pagination"></div>
            </div>
        </div>
    </section>
    <!-- TESTIMONIAL SECTION END -->


    <!-- BLOG SECTION START -->
    <section class="ul-blogs ul-section-spacing">
        <div class="ul-blogs-container wow animate__fadeInUp">
            <div class="row gy-3">
                <!-- section heading -->
                <div class="col-sm-5">
                    <div class="ul-section-heading">
                        <div class="left">
                            <span class="ul-section-sub-title"> Latest Blog </span>
                            <h2 class="ul-section-title">Read Our Latest News</h2>
                            <p class="ul-section-descr">We help companies develop powerful corporate social responsibility, grantmaking, and employee engagement strategies.</p>
                            <div class="ul-blogs-slider-nav ul-slider-nav">
                                <button class="prev"><i class="flaticon-back"></i></button>
                                <button class="next"><i class="flaticon-next"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- blog slider -->
                <div class="col-sm-7">
                    <div class="ul-blogs-slider swiper">
                        <div class="swiper-wrapper">
                            <!-- single blog -->
                            <div class="swiper-slide">
                                <div class="ul-blog">
                                    <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-1.jpg') }}" alt="Blog Image">
                                        <div class="date">
                                            <span class="number">15</span>
                                            <span class="txt">Dec</span>
                                        </div>
                                    </div>
                                    <div class="ul-blog-txt">
                                        <div class="ul-blog-infos">
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-account"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">By Admin</span>
                                            </div>
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Donation</span>
                                            </div>
                                        </div>
                                        <a href="blog-details.html" class="ul-blog-title">Give Education, It’s The Best Gift Ever.</a>
                                        <a href="blog-details.html" class="ul-blog-btn">Read More <span class="icon"><i class="flaticon-next"></i></span></a>
                                    </div>
                                </div>
                            </div>

                            <!-- single blog -->
                            <div class="swiper-slide">
                                <div class="ul-blog">
                                    <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-2.jpg') }}" alt="Blog Image">
                                        <div class="date">
                                            <span class="number">15</span>
                                            <span class="txt">Dec</span>
                                        </div>
                                    </div>
                                    <div class="ul-blog-txt">
                                        <div class="ul-blog-infos">
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-account"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">By Admin</span>
                                            </div>
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Donation</span>
                                            </div>
                                        </div>
                                        <a href="blog-details.html" class="ul-blog-title">Don’t treat oceans as universal garbage cans</a>
                                        <a href="blog-details.html" class="ul-blog-btn">Read More <span class="icon"><i class="flaticon-next"></i></span></a>
                                    </div>
                                </div>
                            </div>

                            <!-- single blog -->
                            <div class="swiper-slide">
                                <div class="ul-blog">
                                    <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-3.jpg') }}" alt="Blog Image">
                                        <div class="date">
                                            <span class="number">15</span>
                                            <span class="txt">Dec</span>
                                        </div>
                                    </div>
                                    <div class="ul-blog-txt">
                                        <div class="ul-blog-infos">
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-account"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">By Admin</span>
                                            </div>
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Donation</span>
                                            </div>
                                        </div>
                                        <a href="blog-details.html" class="ul-blog-title">The sun and the sand makes beaches beautiful</a>
                                        <a href="blog-details.html" class="ul-blog-btn">Read More <span class="icon"><i class="flaticon-next"></i></span></a>
                                    </div>
                                </div>
                            </div>

                            <!-- single blog -->
                            <div class="swiper-slide">
                                <div class="ul-blog">
                                    <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-1.jpg') }}" alt="Blog Image">
                                        <div class="date">
                                            <span class="number">15</span>
                                            <span class="txt">Dec</span>
                                        </div>
                                    </div>
                                    <div class="ul-blog-txt">
                                        <div class="ul-blog-infos">
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-account"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">By Admin</span>
                                            </div>
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Donation</span>
                                            </div>
                                        </div>
                                        <a href="blog-details.html" class="ul-blog-title">The sun and the sand makes beaches beautiful</a>
                                        <a href="blog-details.html" class="ul-blog-btn">Read More <span class="icon"><i class="flaticon-next"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BLOG SECTION END -->


    <!-- GALLERY SECTION START -->
    <div class="ul-gallery overflow-hidden ul-section-spacing mx-auto pt-0">
        <div class="ul-gallery-slider swiper">
            <div class="swiper-wrapper">
                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-1.png') }}" alt="Gallery Image">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-1.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-2.png') }}" alt="Gallery Image">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-2.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-3.png') }}" alt="Gallery Image">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-3.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-4.png') }}" alt="Gallery Image">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-4.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-5.png') }}" alt="Gallery Image">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-5.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-6.png') }}" alt="Gallery Image">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-6.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-1.png') }}" alt="Gallery Image">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-1.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-2.png') }}" alt="Gallery Image">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-2.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- GALLERY SECTION END -->
@endsection

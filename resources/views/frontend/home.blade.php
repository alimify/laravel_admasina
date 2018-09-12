<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>TITLE</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">


    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <!-- Stylesheets -->

    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/swiper.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/ionicons.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">

</head>
<body >

<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="#" class="logo"><img src="images/logos.png" alt="Logo Image"></a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="#">BOOK</a></li>
            <li><a href="#">ARTICLE</a></li>
            <li><a href="#">ABOUT US</a></li>
            <li><a href="#">PRIVACY</a></li>
            <li><a href="#">CONTACT US</a></li>
            <li><a href="#">LANGUAGE</a></li>
        </ul><!-- main-menu -->

        <div class="src-area">
            <form>
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" type="text" placeholder="Type of search">
            </form>
        </div>

    </div><!-- conatiner -->
</header>

<div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
         data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
         data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <a class="slider-category" href="#">
                    <div class="blog-image"><img src="{{asset('storage/book/test.jpg')}}" alt="book image"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>BOOK 1</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->

            <div class="swiper-slide">
                <a class="slider-category" href="#">
                    <div class="blog-image"><img src="{{asset('storage/book/test.jpg')}}" alt="book image"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>BOOK 2</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->

            <div class="swiper-slide">
                <a class="slider-category" href="#">
                    <div class="blog-image"><img src="{{asset('storage/book/test.jpg')}}" alt="book image"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>BOOK 3</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->

            <div class="swiper-slide">
                <a class="slider-category" href="#">
                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="book image"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>BOOK 4</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->

            <div class="swiper-slide">
                <a class="slider-category" href="#">
                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="book image"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>BOOK 5</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->

            <div class="swiper-slide">
                <a class="slider-category" href="#">
                    <div class="blog-image"><img src="{{asset('storage/book/test.jpg')}}" alt="book image"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>BOOK 6</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->

        </div><!-- swiper-wrapper -->

    </div><!-- swiper-container -->

</div>

<section class="blog-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="row">

                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->


                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->



                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->
                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->


                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->



                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->

                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->


                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->



                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="#">
                                    <div class="blog-image"><img src="{{asset('storage/book/test_book.jpg')}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>End of watch : Lifehack bbbb..</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>6</li>
                                            <li><i class="ion-eye"></i>138</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->



                </div><!-- row -->

                <a class="load-more-btn" href="#"><b>SEE MORE</b></a>

            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12">

                <div class="single-post info-area ">

                    <div class="latest-post-area about-area">
                        <h4 class="title"><b>Latest Article</b></h4>
                        <ul>
                            <li>
                                <a href="#">Manual Manual Manual Manual Manual</a>
                                <span class="color-gray d-block">Posted : 1 hours ago</span>
                            </li>
                            <li>
                                <a href="#">Manual Manual Manual Manual Manual</a>
                                <span class="color-gray d-block">Posted : 1 hours ago</span>
                            </li>
                            <li>
                                <a href="#">Manual Manual Manual Manual Manual</a>
                                <span class="color-gray d-block">Posted : 1 hours ago</span>
                            </li>
                            <li>
                                <a href="#">Manual Manual Manual Manual Manual</a>
                                <span class="color-gray d-block">Posted : 1 hours ago</span>
                            </li>

                            <li>
                                <a href="#">Manual Manual Manual Manual Manual</a>
                                <span class="color-gray d-block">Posted : 1 hours ago</span>
                            </li>

                            <li>
                                <a href="#">Manual Manual Manual Manual Manual</a>
                                <span class="color-gray d-block">Posted : 1 hours ago</span>
                            </li>
                            <li>
                                <a href="#">Manual Manual Manual Manual Manual</a>
                                <span class="color-gray d-block">Posted : 1 hours ago</span>
                            </li>


                        </ul>
                    </div>

                    <!--<div class="subscribe-area">

                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        <div class="input-area">
                            <form>
                                <input class="email-input" type="text" placeholder="Enter your email">
                                <button class="submit-btn" type="submit"><i class="ion-ios-email-outline"></i></button>
                            </form>
                        </div>

                    </div>--><!-- subscribe-area -->

                    <div class="tag-area">

                        <h4 class="title"><b>BOOK CATEGORIES</b></h4>
                        <ul>
                            <li><a href="#">Manual</a></li>
                            <li><a href="#">Liberty</a></li>
                            <li><a href="#">Recomendation</a></li>
                            <li><a href="#">Interpritation</a></li>
                            <li><a href="#">Manual</a></li>
                            <li><a href="#">Liberty</a></li>
                            <li><a href="#">Recomendation</a></li>
                            <li><a href="#">Interpritation</a></li>
                        </ul>

                    </div><!-- Tag-area -->

                    <div class="tag-area">

                        <div class="title"><b>ARTICLE CATEGORIES</b></div>
                        <ul>
                            <li><a href="#">Manual</a></li>
                            <li><a href="#">Liberty</a></li>
                            <li><a href="#">Recomendation</a></li>
                            <li><a href="#">Interpritation</a></li>
                            <li><a href="#">Manual</a></li>
                            <li><a href="#">Liberty</a></li>
                            <li><a href="#">Recomendation</a></li>
                            <li><a href="#">Interpritation</a></li>
                        </ul>

                    </div><!-- Tag-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->




<footer>

    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="font-weight-bold">About US</h4>
                    <p class="copyright">Something about admasina in simple</p>

                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="title"><b>Useful Links</b></h4>
                    <ul>
                        <li><a href="#">Contact Us</a></li>

                    </ul>
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="title"><b>Social Links</b></h4>
                    <ul class="icons">
                        <li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
                    </ul>
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

        </div><!-- row -->
    </div><!-- container -->
</footer>


<!-- SCIPTS -->

<script src="{{asset('frontend/js/jquery-3.1.1.min.js')}}"></script>

<script src="{{asset('frontend/js/tether.min.js')}}"></script>

<script src="{{asset('frontend/js/bootstrap.js')}}"></script>

<script src="{{asset('frontend/js/swiper.js')}}"></script>

<script src="{{asset('frontend/js/scripts.js')}}"></script>

</body>
</html>

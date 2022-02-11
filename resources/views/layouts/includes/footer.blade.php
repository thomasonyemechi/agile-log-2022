<div id="footer-wrapper" class="footer-dark">
    <footer id="footer">
        <div class="container">
            <div class="row">
                <ul class="col-md-3 col-sm-6 footer-widget-container clearfix">
                    <!-- .widget.widget_text -->
                    <li class="widget widget_newsletterwidget">
                        <div class="title">
                            <h3>newsletter subscribe</h3>
                        </div>

                        <p>
                            Subscribe to our newsletter and we will
                            inform you about newest projects and promotions.
                        </p>

                        <br />

                        <form class="newsletter">
                            <input class="email" type="email" placeholder="Your email...">
                            <input type="submit" class="submit" value="">
                        </form>
                    </li><!-- .widget.widget_newsletterwidget end -->
                </ul><!-- .col-md-3.footer-widget-container end -->

                <ul class="col-md-3 col-sm-6 footer-widget-container">
                    <!-- .widget-pages start -->
                    <li class="widget widget_pages">
                        <div class="title">
                            <h3>quick links</h3>
                        </div>

                        <ul>
                            <li><a href="/about">About us</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                        </ul>
                    </li><!-- .widget-pages end -->
                </ul><!-- .col-md-3.footer-widget-container end -->

                <ul class="col-md-3 col-sm-6 footer-widget-container">
                    <!-- .widget-pages start -->
                    <li class="widget widget_pages">
                        <div class="title">
                            <h3>Industry solutions</h3>
                        </div>

                        <ul>
                            <li><a href="#">Same day pick up and delivery </a></li>
                            <li><a href="#">Next day service</a></li>
                            <li><a href="#">Warehousing and storage</a></li>
                            <li><a href="#">Transloads</a></li>
                        </ul>
                    </li><!-- .widget-pages end -->
                </ul><!-- .col-md-3.footer-widget-container end -->

                <ul class="col-md-3 col-sm-6 footer-widget-container">
                    <li class="widget widget-text">
                        <div class="title">
                            <h3>contact us</h3>
                        </div>

                        <address>
                            {{ env('APP_ADDRESS') }}
                        </address>

                        <span class="text-big">
                            {{ env('APP_PHONE') }}
                        </span>
                        <br />

                        <a href="mailto:">{{ env('MAIL_USERNAME') }}</a>
                        <br />
                        <ul class="footer-social-icons">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-google-plus"></a></li>
                        </ul><!-- .footer-social-icons end -->
                    </li><!-- .widget.widget-text end -->
                </ul><!-- .col-md-3.footer-widget-container end -->
            </div><!-- .row end -->
        </div><!-- .container end -->
    </footer><!-- #footer end -->

    <div class="copyright-container">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>{{ env('APP_NAME') }} {{date('Y')}}. All RIGHTS RESERVED.</p>
                </div><!-- .col-md-6 end -->

                <div class="col-md-6">
                    <p class="align-right">Reserved.</p>
                </div><!-- .col-md-6 end -->
            </div><!-- .row end -->
        </div><!-- .container end -->
    </div><!-- .copyright-container end -->

    <a href="#" class="scroll-up">Scroll</a>
</div><!-- #footer-wrapper end -->

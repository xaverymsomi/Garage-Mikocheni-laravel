<!DOCTYPE html>

<html class="no-js"
  lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title>Garage Management system</title>
    <link rel="icon" href="{{ URL::asset('fevicol.png') }}" type="image/gif" sizes="16x16">
    <link href= "{{ URL::asset('public/css/middle_login_page/style.css') }}" rel="stylesheet">
    

  <style id="custom-background-css">
    body.custom-background {
      background-color: #ffffff;
    }

  </style>
  <link href= "{{ URL::asset('public/css/middle_login_page/garage-site.css') }}" rel="stylesheet">
</head>

<body
  class="home page-template-default page page-id-246 custom-background wp-custom-logo wp-embed-responsive singular missing-post-thumbnail has-no-pagination not-showing-comments show-avatars footer-top-hidden reduced-spacing">

  <a class="skip-link screen-reader-text"
    href="#site-content">Skip to the content</a>
  <header id="site-header"
    class="header-footer-group"
    role="banner">

    <div class="header-inner section-inner">

      <div class="header-titles-wrapper">


        <div class="header-titles">

          <div class="site-logo faux-heading"
            style="background-color: #2A3F54;"><a href="{{route('login')}}"
              class="custom-logo-link"
              rel="home"
              aria-current="page"><img width="248"
                height="248"
                src="{{ URL::asset('public/general_setting/' . getLogoSystem()) }}" /></a><span
              class="screen-reader-text">Garage Management System</span></div>
          <div class="site-description">Garage Management System</div><!-- .site-description -->
        </div><!-- .header-titles -->

      </div><!-- .header-titles-wrapper -->

      <div class="header-navigation-wrapper">


        <nav class="primary-menu-wrapper"
          aria-label="Horizontal"
          role="navigation">

          <ul class="primary-menu reset-list-style">

            <li id="menu-item-244"
              class="menu-item menu-item-type-post_type menu-item-object-page menu-item-244"><a target="_blank"
                rel="noopener noreferrer"
                href="{{ route('login') }}">Login</a></li>

          </ul>

        </nav><!-- .primary-menu-wrapper -->


      </div><!-- .header-navigation-wrapper -->

    </div><!-- .header-inner -->


  </header><!-- #site-header -->


  <main id="site-content"
    role="main">


    <article class="post-246 page type-page status-publish hentry"
      id="post-246">


      <header class="entry-header has-text-align-center header-footer-group">

        <div class="entry-header-inner section-inner medium">

          <h1 class="entry-title">Home</h1>
        </div><!-- .entry-header-inner -->

      </header><!-- .entry-header -->

      <div class="post-inner thin ">

        <div class="entry-content">


          <h2 class="spacing-head">Complete Garage Management system</h2>



          <p class="spacing-head-p">Garage management system is the ideal way to manage complete garage workshop. The
            system has capability to generate jobcard for vehicle repair, process that and generate invoice and
            quotation for tha vehicle service repairs.</p>



          <div class="wp-block-buttons">
            <div class="wp-block-button is-style-outline login-demo"><a
                class="wp-block-button__link has-accent-color has-text-color"
                href="{{ route('login') }}"
                style="border-radius:13px"
                target="_blank"
                rel="noreferrer noopener">Login to demo</a></div>
          </div>



          <figure class="wp-block-image size-large"><img loading="lazy"
              width="1024"
              height="576"
              src="{{ URL::asset('public/middle_login_page/Garage.png') }}"
              alt=""
              class="wp-image-253" /></figure>



          <div class="wp-block-buttons"></div>

        </div><!-- .entry-content -->

      </div><!-- .post-inner -->

      <div class="section-inner">

      </div><!-- .section-inner -->


    </article><!-- .post -->

  </main><!-- #site-content -->


  <footer id="site-footer"
    role="contentinfo"
    class="header-footer-group">

    <div class="section-inner">

      <div class="footer-credits">

        <p class="footer-copyright">&copy;
          2021 <a href="{{ route('login') }}">Garage Management System</a>
        </p><!-- .footer-copyright -->

      </div><!-- .footer-credits -->

      <a class="to-the-top"
        href="#site-header">
        <span class="to-the-top-long" style="background: #23a569;padding: 13px;border-radius: 15px;color: #fff;">
          To the top <span class="arrow"
            aria-hidden="true">&uarr;</span> </span><!-- .to-the-top-long -->
        <span class="to-the-top-short">
          Up <span class="arrow"
            aria-hidden="true">&uarr;</span> </span><!-- .to-the-top-short -->
      </a><!-- .to-the-top -->

    </div><!-- .section-inner -->

  </footer><!-- #site-footer -->

</body>

</html>

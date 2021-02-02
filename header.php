<!DOCTYPE html>
<html <?php language_attributes(); ?>>

  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <div id="skip-nav" class="skip-nav" role="navigation" aria-label="Skip navigation">
      <a class="button" href="#menu">Skip to Navigation</a>
      <a class="button mobile" href="#primary-ham">Skip to Navigation</a>
      <a class="button" href="#main">Skip to Main Content</a>
    	<a class="button" href="#footer">Skip to Footer Links</a>
    </div>

    <header id="header" class="">

      <div class="header-logo">
        <div class="header-logo__wrap">
       	  <a href="http://ucla.edu"><img class="header-logo__image" src="/wp-content/themes/ucla-wp/images/ucla_logo_white.svg" alt="UCLA Logo" /></a>
        </div>
      </div>

      <div class="site-name">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
      </div>

      <div class="nav-wrap">
        <button id="primary-ham" class="hamburger hamburger--squeeze" type="button" aria-label="Menu" aria-controls="navigation" alt="navigation and search">
      	  <span class="hamburger-box">
      	    <span class="hamburger-inner"></span>
      	  </span>
      	</button>

        <nav id="menu">
          <?php get_search_form(); ?>
          <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

          <div class="search-desktop">
            <button id="search-button" class="search-desktop_button">
              <svg role="img" aria-label="Search Icon" class="search-icon" width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>Search Icon</title><g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="search-nav-icon-primary" transform="translate(-15.000000, -15.000000)"><g id="Nav-Item"><g id="Icon/Search" transform="translate(12.000000, 12.000000)"><polygon class="Path-polygon" points="0 0 24 0 24 24 0 24"></polygon><path d="M15.5,14 L14.71,14 L14.43,13.73 C15.41,12.59 16,11.11 16,9.5 C16,5.91 13.09,3 9.5,3 C5.91,3 3,5.91 3,9.5 C3,13.09 5.91,16 9.5,16 C11.11,16 12.59,15.41 13.73,14.43 L14,14.71 L14,15.5 L19,20.49 L20.49,19 L15.5,14 Z M9.5,14 C7.01,14 5,11.99 5,9.5 C5,7.01 7.01,5 9.5,5 C11.99,5 14,7.01 14,9.5 C14,11.99 11.99,14 9.5,14 Z" id="Shape" fill="#00598C" fill-rule="evenodd"></path></g></g></g></g></svg>
            </button>

            <div class="search-block-form search-mobile" data-drupal-selector="search-block-form" id="block-search" role="search" style="width: 1114px; margin-left: -1122px;">

            </div>
          </div>


        </nav>
      </div>

      <!-- <div id="search"></div> -->

    </header>

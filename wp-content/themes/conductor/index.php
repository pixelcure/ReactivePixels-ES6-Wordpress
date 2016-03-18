<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
 
	get_header(); 
?>

<?php
 
if(is_home){

?>
  
<main class="outer-main home transition-experience">
  <div class="welcome title-header outer-wrapper">
    <div class="left">
      <h1><b>We are</b> Conductor.</h1>
    </div><!-- end left track -->
    <svg width="179px" height="158px" class="right" viewBox="0 0 179 158">
      <g stroke="none" stroke-width="1" fill="none">
          <g transform="translate(-1261.000000, -2.000000)" fill-opacity="0.664402174" fill="#0F2335">
              <g transform="translate(-38.000000, 2.000000)">
                  <g>
                      <path d="M1299,0 L2345.20949,0 L2422,79 L2345.20949,158 L1330.30314,158 L1299,0 Z" transform="translate(1860.500000, 79.000000) scale(-1, 1) translate(-1860.500000, -79.000000) "></path>
                  </g>
              </g>
          </g>
      </g>
    </svg>
    <div class="menu-icon right menu-trigger">
      <small>menu</small>
      <span class="top"></span>
      <span class="mid"></span>
      <span class="bottom"></span>
    </div><!-- / end menu icon -->
  </div><!-- / end welcome -->

  <section class="hero-container">
    <div class="video-player hero-video-player">
      <video poster="" src="https://player.vimeo.com/external/65310954.hd.mp4?s=5e2ae61adbfa306bbfd45d2916ada06e6a9c10d9&profile_id=113" muted autoplay loop id="heroVideo" class="span_12">
        <p>Sorry, you need an HTML5 browser to view this full experience.</p>
      </video><!-- / end video -->          
      <aside class="video-control">
        <div class="halt control" id="videoControl">
          <span class="icon-play icon hidden"></span>
          <span class="icon-pause icon"></span>            
        </div><!-- / end play pause -->
        <div class="volume control" id="volumeControl">          
          <span class="icon-volume icon hidden"></span>
          <span class="icon-volume-mute icon"></span>
        </div><!-- / end volume -->
      </aside><!-- / end hero video controls -->
    </div><!-- / end video player -->
  </section><!-- end hero container -->
    
  <section class="intro-container intro-outer">
    <div class="inner-wrapper top">
      <div class="blurb-headline">
        <ul class="work-types">
          <li>
            <a href="/work" title="Commercials">Commercials</a>
          </li>
          <li>
            <a href="/work" title="Branded Content">Branded Content</a>
          </li>
          <li>
            <a href="#" title="Direct Response">Direct Response</a>
          </li>
        </ul>  
        <h2 class="intro-left">We're Here For <a href="/contact" title="Contact">You</a>.</h2>
      </div><!-- / end blurb headline -->
      <aside class="blurb-right callout">
        <h2 class="callout-header">
          We are a company of Filmmakers, TV and Commercial Directors and Producers.
        </h2>
        <p>
          We're crazy about creative and obsessed with production value.  We have a world-class mentality and (in our minds) we are already legendary. Contact us.Let us show you our secrets, who we are, how hard we work and how wide our reach is. You'll be happy you did.
        </p>
      </aside>
    </div><!-- / end inner-wrapper -->    

    <div class="scroll-down">
      <span class="icon icon-arrow-thin-right"></span>
      <h2>
        Scroll To See More
      </h2>
    </div><!-- / end scroll down -->
  </section><!-- / end intro container -->

  <section class="work-outer work-grid outer-wrapper">      
            
      <ul class="grid-row">
        <li class="item">
          <a href="#">
            <div class="caption">
              <div class="inner">            
                <span class="icon icon-zoom-in"></span>
                <span class="title">This is a sweet caption about said kitten.</span>
                <span class="view">View Project</span>
              </div><!-- / end inner -->
            </div><!-- / end caption -->
            <div class="image-container">
              <img src="https://placekitten.com/800/420" alt="GOLF" />
            </div><!-- / end image container -->
          </a>
        </li><!-- / end item -->
        <li class="item">
          <a href="#">
            <div class="caption">
              <div class="inner">            
                <span class="icon icon-zoom-in"></span>
                <span class="title">This is a sweet caption about said kitten.</span>
                <span class="view">View Project</span>
              </div><!-- / end inner -->
            </div><!-- / end caption -->
            <div class="image-container">
              <img src="http://placezombie.com/800x420" alt="GOLF" />
            </div><!-- / end image container -->
          </a>
        </li><!-- / end item -->                
      </ul>            
              
      <ul class="grid-row">
        <li class="item">
          <a href="#">
            <div class="caption">
              <div class="inner">            
                    <span class="icon icon-zoom-in"></span>
                    <span class="title">This is a sweet caption about said kitten.</span>
                    <span class="view">View Project</span>
              </div><!-- / end inner -->
            </div><!-- / end caption -->
            <div class="image-container">
              <img src="http://placezombie.com/800x420" alt="GOLF" />
            </div><!-- / end image container -->
          </a>            
        </li><!-- / end item -->
        <li class="item">
          <a href="#">
            <div class="caption">
              <div class="inner">
                <span class="icon icon-zoom-in"></span>
                <span class="title">This is a sweet caption about said kitten.</span>
                <span class="view">View Project</span>   
              </div><!-- / end inner -->
            </div><!-- / end caption -->
            <div class="image-container">
              <img src="https://placekitten.com/800/420" alt="GOLF" />
            </div><!-- / end image container -->
          </a>
        </li><!-- / end item -->                
      </ul><!-- / end table -->

      <ul class="grid-row">
        <li class="item">
          <a href="#">
            <div class="caption">
              <div class="inner">            
                <span class="icon icon-zoom-in"></span>
                <span class="title">This is a sweet caption about said kitten.</span>
                <span class="view">View Project</span>
              </div><!-- / end inner -->
            </div><!-- / end caption -->
            <div class="image-container">
              <img src="https://placekitten.com/800/420" alt="GOLF" />
            </div><!-- / end image container -->
          </a>
        </li><!-- / end item -->
        <li class="item">
          <a href="#">
            <div class="caption">
              <div class="inner">            
                <span class="icon icon-zoom-in"></span>
                <span class="title">This is a sweet caption about said kitten.</span>
                <span class="view">View Project</span>
              </div><!-- / end inner -->
            </div><!-- / end caption -->
            <div class="image-container">
              <img src="http://placezombie.com/800x420" alt="GOLF" />
            </div><!-- / end image container -->
          </a>
        </li><!-- / end item -->                
      </ul>         
  </section><!-- / end work outer -->
  
  <section class="grid-lower-callout callout">
    <h3><a data-role="button" href="/work" title="Work">View Work.</a></h3>
  </section><!-- / end grid work lower callout -->

  <section class="atmosphere parallax" style="background: url(<?php bloginfo(template_url); ?>/images/office.jpg) no-repeat 0 0">
    <svg class="right-shape" class="left-shape" viewBox="0 0 179 158">
        <g stroke="none" stroke-width="1" fill="none">
            <g transform="translate(-1261.000000, -2.000000)" fill-opacity="0.664402174" fill="#0F2335">
                <g transform="translate(-38.000000, 2.000000)">
                    <g>
                        <path d="M1299,0 L2345.20949,0 L2422,79 L2345.20949,158 L1330.30314,158 L1299,0 Z" transform="translate(1860.500000, 79.000000) scale(-1, 1) translate(-1860.500000, -79.000000) "></path>
                    </g>
                </g>
            </g>
        </g>
    </svg><!-- / end left shape bg -->  
    <div class="office-blurb span_12">
      <h2>Lorem Ipsum Dolor Sit Amet</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam mollitia commodi corporis.
      </p>
    </div><!-- / end office blurb -->
  </section><!-- / end office atmosphere -->

  <section class="contact-us callout outer-wrapper">
    <svg class="left-shape" viewBox="0 0 179 158">
        <g stroke="none" stroke-width="1" fill="none">
            <g transform="translate(-1261.000000, -2.000000)" fill-opacity="0.664402174" fill="#0F2335">
                <g transform="translate(-38.000000, 2.000000)">
                    <g>
                        <path d="M1299,0 L2345.20949,0 L2422,79 L2345.20949,158 L1330.30314,158 L1299,0 Z" transform="translate(1860.500000, 79.000000) scale(-1, 1) translate(-1860.500000, -79.000000) "></path>
                    </g>
                </g>
            </g>
        </g>
    </svg><!-- / end left shape bg -->

    <aside class="contact">
      <h3>
        Our office is in Boston.<br />you with that next big thing?
      </h3>
      <h4>
        Let's Talk, Call Frank @ 
        <a href="tel:6173224888"/>617-322-4888</a>
      </h4>
      <a class="contact" data-role="button" href="/contact" title="Contact Us">contact</a>
    </aside><!-- / end contact left -->
    
    <div class="outer-map">
      <div class="map" id="homeMap" data-markericon="<?php bloginfo(template_url); ?>/images/google-marker.png" data-markertitle="Conductor Productions">
      </div><!-- / end google map -->
    </div><!-- / end outer map -->
    
  </section><!-- / end contact us callout -->

</main><!-- / end experience -->
		
<?php } else {

	include(get_template_directory().'/loops/loop.php');
  
}

  get_footer(); 

?>

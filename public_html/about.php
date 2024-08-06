<?php 

include("admin/config.php");
include("get_session.php");

$user_data = get_session();
$albums = [];
$albumsCat = [];


$user_state_vals = $_COOKIE["user_state_val"];

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
$sql = "SELECT a.*,b.name as categoryD,a.state_id as stateID FROM tbl_services a left join tblservice_type b on a.category = b.id WHERE a.deleted=0 and FIND_IN_SET($user_state_vals, b.state_id) ORDER BY a.id DESC";

$result = $DBC->query($sql);

$count = mysqli_num_rows($result);

$tmpData = [];

if($count > 0) {		
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($albums,$row);
    }
}

$sql3 = "SELECT * FROM tblservice_type WHERE active=0 and FIND_IN_SET($user_state_vals, state_id) ORDER BY id ASC";

$result3 = $DBC->query($sql3);

$count3 = mysqli_num_rows($result3);


if($count3 > 0) {		
    while ($row3 = mysqli_fetch_assoc($result3)) {
        array_push($albumsCat,$row3);
    }
}

include("templates/header.php");

?>
                <!-- content-holder -->
                <div class="content-holder vis-dec-anim">
                    <!-- content -->
                    <div class="content">
                        <div class="post_header fl-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="hero-title alighn-title">
                                            <h4>The Studio</h4>
                                            <h2>About MI</h2>
											
											
                                        </div>
                                        <div class="inline-facts-holder fl-wrap">
                                            <!-- inline-facts -->
                                            <div class="inline-facts">
                                                <div class="num">10</div>
                                                <h6>Years of Experience</h6>
                                            </div>
                                            <!-- inline-facts end -->
                                            <!-- inline-facts  -->
                                            <div class="inline-facts">
                                                <div class="num">12</div>
                                                <h6>Awards win</h6>
                                            </div>
                                            <!-- inline-facts end -->
                                            <!-- inline-facts  -->
                                            <div class="inline-facts">
                                                <div class="num">5M</div>
                                                <h6>Awesome Photos</h6>
                                            </div>
											<img src="images/about us/inaguration_machooos.jpg" style="width: 100%;"/>
                                            <!-- inline-facts end -->
                                        </div>
                                    </div>
                                    <!--<div class="col-md-2"></div>-->
                                    <div class="col-md-6">
                                        <h4 class="bold-text">Capture Your Love &amp; Laughter That You Can Treasure For A Lifetime, </h4>
                                        <p>"<b>S</b>tep into a world of enchantment with Machooos International Photography Company, your premier wedding planners headquartered in the heart of Trivandrum, Kerala. Since our inception, we've evolved and expanded, proudly spreading our wings with branches in Kochi(EDAPPALLY) and Bangalore (Indiranagar), making us your go-to team for crafting extraordinary weddings across South India.<br>

Our traditional business model revolves around the art of envisioning weddings, weaving dreams into reality with a passionate and dedicated team. We pride ourselves on exploring uncharted territories, infusing every celebration with new and innovative ideas. Weddings, for us, are not just events; they are a canvas of the most beautiful memories and moments waiting to be painted.<br>

With a deep understanding of customs spanning various castes and religions, we seamlessly navigate the diverse cultural tapestry that defines our incredible nation. Our commitment to excellence lies in making your dreams come true, crafting bespoke experiences that resonate with your unique love story.<br>

What sets us apart in the realm of wedding photography is our philosophy: we don't just capture moments; we create them. Each photograph is a meticulously crafted masterpiece, capturing the essence, emotion, and magic of your special day.<br>

Join us on this extraordinary journey with Machooos International Photography Company. With branches in Trivandrum, Kochi, and Bangalore, we're not just wedding planners; we're memory architects, sculpting moments that last a lifetime. Let us be the brushstrokes to your love story, turning dreams into tangible, awe-inspiring realities." </p>
										<h4 class="bold-text">Company Strategy</h4>
                                        <p>* Purpose To be a leader in the industry by providing enhanced services, relationships and profitability
                                            * Vision To provide quality services that exceeds the expectations of our esteemed customers.
                                            * Mission To build long term relationships with our customers and provide exceptional customer service by pursuing business through innovation and advanced technology.
                                            * Core Values We believe in treating our customers with respect and faith. We grow through creativity, invention and innovation. We integrate honesty, integrity and business ethics into all aspects of our business functioning.
                                            * Goals Our goal is to develop business all over India, within a time span of 2 years, our 1st step towards that is we will be opening 3 wedding studios in topmost cities of Kerala and our biggest goal in life is to establish 10 wedding studios all over India in the upcoming years.</p>
										<h4 class="bold-text">Our Topmost Weddings & Works</h4>
                                        <p>• Smt K .R. Vijaya's grandson's wedding(Tamil Actress)
                                            • Sri Dr.I.M. Vijayan's nephew marriage(2019 at Ernakulam)
                                            • International trips(Malaysia,Singapore)
                                            • Coversong Direction (More than 10)
                                            • Fashion portfolio
                                            • Almost covered 1000 Wedding
                                            • Maternity and new born baby photoshoot (New Concept For Machooos)</p>
                                    </div>
                                </div>
                                
                        <div class="clearfix"></div>
                        <section>
                            <div class="">
                                <div class="hero-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2 class="newHeading">Online Portable photobook</h2>
                                            <p>“Online Wedding Album” is another speciality of Machooos International Wedding Company.This product has been introduced by Machooos four years back There is no involvement of any third party. As of now we have 500 satisfied customers who are using this product. This product is free for lifetime. Customer is provided with a user name & password with which they can see the album sitting anywhere.
                                            </p>
                                            <iframe style="width:100%;" height="315" src="https://www.youtube.com/embed/4jTrmV2MExI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div>
                                        <div class="col-sm-6">
                                            <h2 class="newHeading">"Ten years is only the beginning. ...</h2>
                                            <p>If you are looking to create a truly unforgettable experience for a special occasion, Machooos International will be the perfect partner to help you bring your vision to life. We take the time to understand your needs and preferences, so that we can tailor the services to your specific requirements and deliver a personalized experience. Let us help you create unforgettable memories that will last a lifetime.
                                            </p>
                                            <iframe style="width:100%;" height="315" src="https://www.youtube.com/embed/8401FNc5_os" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
        								
                                    </div>
									<div style=" width: 100%;
    height: 1px;
    background-color: #eee;
    margin: 10px;
    padding: 0;"></div>
									

                                    <?php if(count($albums) > 0) { ?>

                                        <div class="row" style="padding-bottom: 25px !important;">
                                            <div class="col-md-12 mb-2 mt-2">
                                                <h2 style="font-size: 1.5rem !important;" >Services That I Provide</h2>
                                                <div class="row">
                                                    <div class="gallery-filters col-md-8" >
                                                        <a href="#" class="gallery-filter  gallery-filter-active" data-filter="*">ALL CATEGORY</a>
                                                        
                                                        <?php  foreach ($albumsCat as $key => $album) { ?>
                                                            <a href="#" class="gallery-filter" data-filter=".<?= $album['name'] ?>"><?= $album['name'] ?></a>
                                                        
                                                        <?php } ?>
                                                        
                                                        
                                                    </div>
                                                    <div class="col-md-4 d-flex justify-content-end align-items-end"  >
                                                    <span class="gfc_title">Showing <strong class="num-album">0</strong> of <span class="all-album">0</span>  Results</span>
                                                </div>
                                                </div>


                                            </div>
                                            <div class="col-md-12 mt-4 ">
                                                <!-- portfolio start -->
                                                <div class="gallery-items no-padding three-column fl-wrap lightgallery">
                                                    <!-- gallery-item-->

                                                    <?php  foreach ($albums as $key => $album) { 
                                                        
                                                        $stateID = $album['stateID'];
                                                        if( ($stateID == "" || $stateID == 0 ) ||  $stateID == $user_state_vals ){
                                                            
                                                    ?>

                                                  
                                                        <div class="gallery-item <?= $album['categoryD'] ?> ">
                                                            <div class="grid-item-holder post-item_media-new">
                                                                <a href="#" onclick="gotoviewservicepage(<?= $album['id'] ?>);" ><img  src="admin/<?= $album['cover_image_path'] ?>" alt=""></a>
                                                                <div class="grid-item-holder_title">
                                                                    <i class="ca-arrow-JNQG02 ps-arrow ps-arrow--right ps-arrow--md"></i>
                                                                    <h5><?= $album['categoryD'] ?></h5>
                                                                    <h3 class="text-white"><?= $album['main_tittle'] ?></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    

                                                    <?php   }
                                                    } ?>


                                                    <!-- <div id="infiniti_nav">
                                                        <a href="2.html"></a>
                                                    </div> -->
                                                </div>
                                                <!-- portfolio end -->					
                                                <!-- <div class="load-more-holder fl-wrap" id="infiniti">
                                                    <a class="load-more single-btn" data-ltext="Complete" href="#infiniti" onclick="window.scrollBy(0,-1)"><span>Load More Cases</span><i class="fal fa-refresh"></i></a>
                                                    <span class="portfolio-msg">All Cases Loaded</span>
                                                </div> -->
                                            </div>
                                        </div>
                                        <!-- content-holder end -->


                                    <?php     
                                        }
                                    ?>

                            




                                
								
                                <!-- <div class="row">
                                    <div class="col-md-4">
                                        <div class="column-wrapper_text services-item fl-wrap">
                                            <span class="serv-number">01.</span>
                                            <i class="fal fa-film-canister"></i>
                                            <h4> WEDDING PHOTOGRAPHY & CINEMATOGRAPHY&nbsp;</h4>
                                            <p>A wedding is once in a lifetime experience. People want to remember their special day. Photography is the best way to capture the most wonderful moments of a couples’ life. Photography has a vital role to play in preserving your wonderful memories of the special day in your life.Stunning photographs of the couples with dreamy colours combined with the mastermind of the professional can make your photography awesome.</p>
                                            <ul class="serv-list">
                                                <li><a href="portfolio-single_0_wedding.html">MORE DETAILS</a> </li>
                                            </ul>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="column-wrapper_text services-item fl-wrap">
                                            <span class="serv-number">02.</span>
                                            <i class="fal fa-camera-movie"></i>
                                            <h4> PREWEDDING & POSTWEDDING </h4>
                                            <p>Wedding itself is an amazing experience where you welcome a partner to have the life lasting journey, and the pre-wedding shoot captures the best of their first movements in beautiful themes and scenic backdrops for the cherishable memories. Post wedding Photoshoot will add intimacy between the couple and can make them feel even more comfortable with each other.</p>
                                            <ul class="serv-list">
                                                <li><a href="portfolio-single_2_prewed.html" >MORE DETAILS</a> </li>
                                               
                                            </ul>
                                        </div>
                                    </div>
									<div class="col-md-4">
                                        <div class="column-wrapper_text services-item fl-wrap">
                                            <span class="serv-number">03.</span>
                                            <i class="fal fa-camera-movie"></i>
                                            <h4> NEWBORN BABYSHOOT WITH FAMILY </h4>
                                            <p>I strongly believe in baby’s fragility and comfort, therefore offer dedicated room for the rest, feeding and soothing breaks. I do not use any harmful props or hanging elements, low quality materials, noisy lens or harsh lights whatsoever. I praise natural beauty of newborn, and strive to use light, pastel colors not to overshadow the same.  will use ample of international props, the highest quality single made cloths, pillows, blankets, mini furniture pieces,  toys, rattles, </p>
                                            <ul class="serv-list">
                                                <li><a href="portfolio-single_6_newborn.html" >MORE DETAILS</a> </li>
                                            </ul>
                                        </div>
                                    </div>
									<div class="col-md-4">
                                        <div class="column-wrapper_text services-item fl-wrap">
                                            <span class="serv-number">04.</span>
                                            <i class="fal fa-camera-movie"></i>
                                            <h4> CORPORATE PRESENTATION & CORPORATE EVENTS </h4>
                                            <p>Looking for a professional photographer for your event or an annual corporate meeting? We at MachooosInternational provide the best event photography service for seminars,conferences,conventions and summits,product launch events,training program,group discussion, business seccess parties,gala dinner for celebrations,business launch events,business meetings, exibitions brand promotions etc...</p>
											<p>Corporate Presentation is a unique way of communicating and building the brand image for a company. This effective tool can be used to promote a product, service or to simply tell something essential about your company.</p>
                                            <ul class="serv-list">
                                                <li><a href="portfolio-single_4_corporate.html" >MORE DETAILS</a> </li>
                                            </ul>
                                        </div>
                                    </div>
									<div class="col-md-4">
                                        <div class="column-wrapper_text services-item fl-wrap">
                                            <span class="serv-number">05.</span>
                                            <i class="fal fa-camera-movie"></i>
                                            <h4> CHILDHOOD PHOTOGRAPHY & MATERNITY </h4>
                                            <p>Although I receive some requests to photo-click child in his own home, I strongly recommend to do so in the studio or outside garden. In this way, we have variety of props at a hand’s reach and can set possible themes (like Tea Party) or incorporate more elements here itself in order to catch natural child’s avatar.</p>
											<p>Maternity Photo Session has dedicated time from 1 to 3 hours, based on your chosen package and  health, and can be clicked indoors or outside, in the beautiful garden or close by Pashan lake. During the session, you will be given plenty of time to change, take a break or deal with those natural moments of sudden cramps, mood swings or simple “cannot do” phases.</p>
                                            <ul class="serv-list">
                                                <li><a href="portfolio-single_1_kidsshoot.html">MORE DETAILS</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="column-wrapper_text services-item fl-wrap">
                                            <span class="serv-number">06.</span>
                                            <i class="fal fa-rings-wedding"></i>
                                            <h4> AERIAL CINEMATOGRAPHY & AERIAL PROJECTS</h4>
                                            <p>Certain shots are best taken by a drone camera and some by a traditional camera, so have the best of both worlds in your wedding album. Your drone photographer or videographer can take wide sweeping shots while your ground photographer captures close-ups and intimate moments. Make sure your ground photographer collaborates with the drone pilot, then sit down with them and go over their plans. Everyone should be on the same page.</p><p>Drones are perfect for outdoor weddings.</p> <p>Hire an experienced drone operator.</p><p>Schedule additional time for the drone during the wedding.</p><p>Check the weather.</p>
                                            <ul class="serv-list">
                                                <li><a href="#" >MORE DETAILS</a> </li>
                                            </ul>
                                        </div>
                                    </div>
							
                                </div> -->
                                <div class="clearfix"></div>
                        <section>
                            <div class="">
                                <div class="hero-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2 class="newHeading">"Unveiling a groundbreaking </h2>
                                            <p>"Unveiling a groundbreaking era in Indian photography, Machooos International emerges as the trailblazing pioneer, proudly holding the distinction of being the nation's first fully digitalized photography company, revolutionizing the art with innovation, precision, and unparalleled digital excellence."
                                            </p>
                                             <img src="images/1.jpg" alt="Description of the image" width="600" height="300"></img>
                                        </div>
                                        <div class="col-sm-6">
                                            <h2 class="newHeading">Razorpay & AWS</h2>
                                            <p>
"As the epitome of premium photography services, Machooos International Photography Company relies on Razorpay as our trusted payment gateway and AWS as our top-tier hosting provider, ensuring an unrivaled blend of secure transactions and robust infrastructure for an elevated client experience."
                                            </p>
                                            <img src="images/2.jpg" alt="Description of the image" width="600" height="300"></img>
                                        </div>
        								
                                    </div>
									<div style=" width: 100%;
    height: 1px;
    background-color: #eee;
    margin: 10px;
    padding: 0;"></div>
                            </div>
                        </section>






                    </div>
                  
                    <div class="dark-bg-wrap fl-wrap " >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="hero-title alighn-title" style="padding-bottom: 25px !important;">
                                        <h4>The Crew</h4>
                                        <h2>Our Awesome Team</h2>
                                    </div>
                                    <div class="dark-bg-text">
                                        <h4 class="bold-text">Machooos International stands as a beacon of excellence in the realm of photography, where every click tells a story and every frame captures the essence of timeless moments.  </h4>
                                        <p>Machooos International, our illustrious photography venture, is not just a company; it's a global odyssey of capturing moments that transcend borders. With an unwavering commitment to visual excellence, we have embarked on a journey of expansion, reaching every corner of the world. Led by our visionary CEO, Sarath, and our dynamic Managing Director, Arunima,Our enigmatic Co-Founder, a true luminary in the world of visual arts, infuses the team with a spirit of ingenuity. Digital products are our forte, each one meticulously designed to encapsulate the unique beauty of every captured instance. our team is not just witnessing a global evolution in photography but actively shaping it. Our lenses paint narratives that resonate universally, transcending cultural boundaries and capturing the heartbeat of diverse landscapes. As we expand our footprint across the globe, Machooos International is not just a name; it's an invitation to experience the world through the lens of artistry and creativity. Our photographs speak a language that everyone understands, making our global expansion not just a business endeavor but a celebration of the beauty that unites us all.</p>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- team-item -->
                                            <div class="team-item">
                                                <div class="team-item-img">
                                                    <img src="images/team/1.jpg"   class="respimg" alt="">
                                                    <ul class="team-social">
                                                        <li><a href="https://www.facebook.com/sarath522/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="https://instagram.com/b_white_fotografer?igshid=YmMyMTA2M2Y=" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                        <li><a href="https://www.sarathraj.in/" target="_blank"><i class="fab fa-google"></i></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="team-item-title"><span>01.</span> Sarathraj(CEO)</div>
                                            </div>
                                            <!-- team-item end -->
                                            <!-- team-item -->
                                            <div class="team-item">
                                                <div class="team-item-img">
                                                    <img src="images/team/3.jpg"   class="respimg" alt="">
                                                    <ul class="team-social">
                                                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-google"></i></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="team-item-title"><span>03.</span> (CO-FOUNDER)</div>
                                            </div>
                                            <!-- team-item end -->
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- team-item -->
                                            <div class="team-item   fl-wrap">
                                                <div class="team-item-img">
                                                    <img src="images/team/2.jpg"   class="respimg" alt="">
                                                    <ul class="team-social">
                                                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-google"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="team-item-title"><span>02.</span> ARUNIMA (MD)</div>
                                            </div>
                                            <!-- team-item end -->	
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- team-item -->
                                            
                                            <!-- team-item end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content" style="padding-top: 10px !important;">
                        <section>
                            <div class="container">
                                <div class="hero-title" style="padding-bottom: 20px !important;">
                                    <h4>Awesome Clients</h4>
                                    <h2 class="newHeading">Testimonials and Clients</h2>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="testilider fl-wrap">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <!-- swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testi-item fl-wrap">
                                                <span class="testi-number">01.</span>
                                                <div class="testi-avatar"><img src="images/avatar/shruti singh.png" alt=""></div>
                                                <h3>Shruti Singh</h3>
                                                <p>Wonderful experience! We booked their services for our daughters first birthday celebration and they did a fabulous job. What impressed us the most was their dedication & customer service, they were always responsive and accommodative to our requests and delivered the photos without any delays. Kudos Machoos ! Hope to work with you again :)</p>
                                                <a href="https://www.google.com/search?q=machooos%20reviews&sxsrf=ALiCzsb6UKsk8QDVzsd9wMVd5uWkGU0AZQ:1664959478613&ei=izw9Y5nhM77C4-EPnbGwmAo&oq=machooos+rev&gs_lp=Egdnd3Mtd2l6uAED-AEBKgIIADIFECEYoAEyBRAhGKABwgIHECMYsAMYJ8ICBBAjGCeQBgNIrCdQjgZY1BVwAXgAyAEAkAEAmAHWAaABugaqAQUwLjEuM-IDBCBBGAHiAwQgRhgAiAYB&sclient=gws-wiz&tbs=lf:1,lf_ui:2&tbm=lcl&rflfq=1&num=10&rldimm=9691727453199083548&lqi=ChBtYWNob29vcyByZXZpZXdzIgI4AUjR4ajry62AgAhaFhABGAAiEG1hY2hvb29zIHJldmlld3OSARJwaG90b2dyYXBoeV9zdHVkaW-qAQ8QASoLIgdyZXZpZXdzKAA&ved=2ahUKEwij0aay2cj6AhU7-jgGHRIxCHIQvS56BAgOEAE&sa=X&rlst=f#rlfi=hd:;si:9691727453199083548,l,ChBtYWNob29vcyByZXZpZXdzIgI4AUjR4ajry62AgAhaFhABGAAiEG1hY2hvb29zIHJldmlld3OSARJwaG90b2dyYXBoeV9zdHVkaW-qAQ8QASoLIgdyZXZpZXdzKAA;mv:[[8.5222185,76.9631022],[8.521901699999999,76.9597542]];tbs:lrf:!1m4!1u3!2m2!3m1!1e1!1m4!1u2!2m2!2m1!1e1!2m1!1e2!2m1!1e3!3sIAE,lf:1,lf_ui:2" class="teti-link" target="_blank">Via google</a>
                                            </div>
                                        </div>
                                        <!-- swiper-slide end-->
                                        <!-- swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testi-item fl-wrap">
                                                <span class="testi-number">02.</span>
                                                <div class="testi-avatar"><img src="images/avatar/sreebhadra.png" alt=""></div>
                                                <h3>Sreebhadra Madhu</h3>
                                                <p>Such a good experience with this crew... Photography and videography was upto the mark.Also am very much happy that I selected this guys for shooting my wedding and save the date ..It was such a good experience and I got a dreamy save the date shoot from these people.And also the wedding,save the photos are so so good ..And then they did my forever keepsake wedding album as perfect as usual with very much good quality..It was worthy..❤️</p>
                                                <a href="https://www.google.com/search?q=machooos%20reviews&sxsrf=ALiCzsb6UKsk8QDVzsd9wMVd5uWkGU0AZQ:1664959478613&ei=izw9Y5nhM77C4-EPnbGwmAo&oq=machooos+rev&gs_lp=Egdnd3Mtd2l6uAED-AEBKgIIADIFECEYoAEyBRAhGKABwgIHECMYsAMYJ8ICBBAjGCeQBgNIrCdQjgZY1BVwAXgAyAEAkAEAmAHWAaABugaqAQUwLjEuM-IDBCBBGAHiAwQgRhgAiAYB&sclient=gws-wiz&tbs=lf:1,lf_ui:2&tbm=lcl&rflfq=1&num=10&rldimm=9691727453199083548&lqi=ChBtYWNob29vcyByZXZpZXdzIgI4AUjR4ajry62AgAhaFhABGAAiEG1hY2hvb29zIHJldmlld3OSARJwaG90b2dyYXBoeV9zdHVkaW-qAQ8QASoLIgdyZXZpZXdzKAA&ved=2ahUKEwij0aay2cj6AhU7-jgGHRIxCHIQvS56BAgOEAE&sa=X&rlst=f#rlfi=hd:;si:9691727453199083548,l,ChBtYWNob29vcyByZXZpZXdzIgI4AUjR4ajry62AgAhaFhABGAAiEG1hY2hvb29zIHJldmlld3OSARJwaG90b2dyYXBoeV9zdHVkaW-qAQ8QASoLIgdyZXZpZXdzKAA;mv:[[8.5222185,76.9631022],[8.521901699999999,76.9597542]];tbs:lrf:!1m4!1u3!2m2!3m1!1e1!1m4!1u2!2m2!2m1!1e1!2m1!1e2!2m1!1e3!3sIAE,lf:1,lf_ui:2" class="teti-link" target="_blank">Via google</a>
                                            </div>
                                        </div>
                                        <!-- swiper-slide end-->
                                        <!-- swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testi-item fl-wrap">
                                                <span class="testi-number">03.</span>
                                                <div class="testi-avatar"><img src="images/avatar/dhivesh.png" alt=""></div>
                                                <h3>Dhivesh</h3>
                                                <p>A huge thanks for the beautiful wedding photos and videos. We absolutely loved every photos and appreciate everything you did to make our special day so memorable and we will cherish them forever. Very friendly, enthusiastic, responsible, yet professional. Will definitely be recommending to family and friends!</p>
                                                <a href="https://www.google.com/search?q=machooos%20reviews&sxsrf=ALiCzsb6UKsk8QDVzsd9wMVd5uWkGU0AZQ:1664959478613&ei=izw9Y5nhM77C4-EPnbGwmAo&oq=machooos+rev&gs_lp=Egdnd3Mtd2l6uAED-AEBKgIIADIFECEYoAEyBRAhGKABwgIHECMYsAMYJ8ICBBAjGCeQBgNIrCdQjgZY1BVwAXgAyAEAkAEAmAHWAaABugaqAQUwLjEuM-IDBCBBGAHiAwQgRhgAiAYB&sclient=gws-wiz&tbs=lf:1,lf_ui:2&tbm=lcl&rflfq=1&num=10&rldimm=9691727453199083548&lqi=ChBtYWNob29vcyByZXZpZXdzIgI4AUjR4ajry62AgAhaFhABGAAiEG1hY2hvb29zIHJldmlld3OSARJwaG90b2dyYXBoeV9zdHVkaW-qAQ8QASoLIgdyZXZpZXdzKAA&ved=2ahUKEwij0aay2cj6AhU7-jgGHRIxCHIQvS56BAgOEAE&sa=X&rlst=f#rlfi=hd:;si:9691727453199083548,l,ChBtYWNob29vcyByZXZpZXdzIgI4AUjR4ajry62AgAhaFhABGAAiEG1hY2hvb29zIHJldmlld3OSARJwaG90b2dyYXBoeV9zdHVkaW-qAQ8QASoLIgdyZXZpZXdzKAA;mv:[[8.5222185,76.9631022],[8.521901699999999,76.9597542]];tbs:lrf:!1m4!1u3!2m2!3m1!1e1!1m4!1u2!2m2!2m1!1e1!2m1!1e2!2m1!1e3!3sIAE,lf:1,lf_ui:2" class="teti-link" target="_blank">Via google</a>
                                            </div>
                                        </div>
                                        <!-- swiper-slide end-->
                                        <!-- swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testi-item fl-wrap">
                                                <span class="testi-number">04.</span>
                                                <div class="testi-avatar"><img src="images/avatar/priya j nair.png" alt=""></div>
                                                <h3>Priya J Nair</h3>
                                                <p>Im so happy with their work its so beautiful and overwhelming. highly talented,trustworthy, and super friendly. Also quality work at a very reasonable rate. I would recommand Machoos to all, absolutely no doubts. Thank you so much for making my day magical.  Thanks to Mr Sarath. LOVE from Oman 🇴🇲😙</p>
                                                <a href="https://www.google.com/search?q=machooos%20reviews&sxsrf=ALiCzsb6UKsk8QDVzsd9wMVd5uWkGU0AZQ:1664959478613&ei=izw9Y5nhM77C4-EPnbGwmAo&oq=machooos+rev&gs_lp=Egdnd3Mtd2l6uAED-AEBKgIIADIFECEYoAEyBRAhGKABwgIHECMYsAMYJ8ICBBAjGCeQBgNIrCdQjgZY1BVwAXgAyAEAkAEAmAHWAaABugaqAQUwLjEuM-IDBCBBGAHiAwQgRhgAiAYB&sclient=gws-wiz&tbs=lf:1,lf_ui:2&tbm=lcl&rflfq=1&num=10&rldimm=9691727453199083548&lqi=ChBtYWNob29vcyByZXZpZXdzIgI4AUjR4ajry62AgAhaFhABGAAiEG1hY2hvb29zIHJldmlld3OSARJwaG90b2dyYXBoeV9zdHVkaW-qAQ8QASoLIgdyZXZpZXdzKAA&ved=2ahUKEwij0aay2cj6AhU7-jgGHRIxCHIQvS56BAgOEAE&sa=X&rlst=f#rlfi=hd:;si:9691727453199083548,l,ChBtYWNob29vcyByZXZpZXdzIgI4AUjR4ajry62AgAhaFhABGAAiEG1hY2hvb29zIHJldmlld3OSARJwaG90b2dyYXBoeV9zdHVkaW-qAQ8QASoLIgdyZXZpZXdzKAA;mv:[[8.5222185,76.9631022],[8.521901699999999,76.9597542]];tbs:lrf:!1m4!1u3!2m2!3m1!1e1!1m4!1u2!2m2!2m1!1e1!2m1!1e2!2m1!1e3!3sIAE,lf:1,lf_ui:2" class="teti-link" target="_blank">Via google</a>
                                            </div>
                                        </div>
                                        <!-- swiper-slide end-->
										
										<!-- swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testi-item fl-wrap">
                                                <span class="testi-number">05.</span>
                                                <div class="testi-avatar"><img src="images/avatar/reshma.png" alt=""></div>
                                                <h3>Reshma</h3>
                                                <p>Im very much happy to write this review about the team #machooos :) after our engmnt I was in search of wedding studio and I happened to came across their fb page and found awsme..!!! Unfortunately my parents have already buked anothr studio tat made me upset and thought of suggesting it to my wudb to book frm their side..At first he was doubtful and took long tym fr a decision... Fortunately he said yes :) after the save the date shoot his doubts got cleard and thanked me for choosing them ;) :P  they have many ideas and always happy to welcome our suggestions ...!!  They hve a grp of young talented team especialy  #sarathraj #pradeep  #anoop .. we luvd the way the wedding album was set especially the weddin highlights was really awsum..:)  Thanku  machoos team fr making our wedding so special..!!  wishing them a great success in future and praying for their dreams to come true..!!</p>
                                                <a href="#" class="teti-link" target="_blank">Via google</a>
                                            </div>
                                        </div>
                                        <!-- swiper-slide end-->
										<!-- swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testi-item fl-wrap">
                                                <span class="testi-number">06.</span>
                                                <div class="testi-avatar"><img src="images/avatar/azar rawther.jpg" alt=""></div>
                                                <h3>Anaz Rawther</h3>
                                                <p>I approached sarath for the best moments to be caughted by camera on my marriage day..But he made ever memorable candids and clicks that was above my expectations...with in one word EXPLEMPERY ....in works and contacts. Every customer can trust in each photos and videos...THANKS SARATH</p>
                                                <a href="https://www.facebook.com/machooos/reviews/?ref=page_internal" class="teti-link" target="_blank">Via Facebook</a>
                                            </div>
                                        </div>
                                        <!-- swiper-slide end-->
                                    </div>
                                </div>
                                <div class="tc-pagination fl-wrap"></div>
                                <div class="fw_cb ts-button-prev"><i class="fal fa-long-arrow-left"></i></div>
                                <div class="fw_cb ts-button-next"><i class="fal fa-long-arrow-right"></i></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="container">
                                <ul class="client-list fl-wrap logo-mobile d-flex justify-content-center align-items-center">
                                    <li><a href="https://www.facebook.com/CareStackSystem" target="_blank"><img src="images/clients/care stack.png" alt=""></a></li>
                                    <li><a href="https://www.facebook.com/lakshmielectricalsofficial" target="_blank"><img src="images/clients/lekshmi_electricals.jpg" alt=""></a></li>
                                    <li><a href="https://www.facebook.com/ImSanjuSamson" target="_blank"><img src="images/clients/sanju.jpg" alt=""></a></li>
                                    <li><a href="https://www.facebook.com/BNITrivandrum" target="_blank"><img src="images/clients/2.png" alt=""></a></li>
                                    <li><a href="#" target="_blank"><img src="images/clients/1.png" alt=""></a></li>
                                </ul>
                            </div>
                            <a onclick="showEnquiryform()" class=" single-btn"><span>Start a Project</span></a> 
                        </section>
                    </div>
                    <!-- content end -->
                    <div class="clearfix"></div>
                    <?php  include("templates/footer-tpl.php"); ?>
                </div>
                <!-- content-holder end -->
 <?php 
 
 include("templates/footer.php");
 
 ?>

 <script>
        $('#navLinkMenuHome').removeClass('act-link');
        $('#navLinkMenuAbout').addClass('act-link');
        $('#navLinkMenuPortfolio').removeClass('act-link');
        $('#navLinkMenuDA').removeClass('act-link');
        $('#navLinkMenuContact').removeClass('act-link');
    function gotoviewservicepage(id){
        var currentdate = Base64.encode(Date.now()+"_"+id);
        window.location.assign("services-view.php?id="+currentdate);
    }
 </script>

 









        <!--  Contact Us  -->
        <div class="contactus-section">
        <div class="content">
            <h1>Let's Create a great communication experience together!</h1>
            <a href="#" class="main-button" type="button">Contact us</a>
        </div>
    </div>


<footer class="footer">
      <div class="container footer-container">
        <div class="footer-main">
          <div class=" column">
            <h4>About Us</h4>
            <p >There is no one who loves pain itself, who seeks after it and wants to have it. </p>
            <div class="col-md-3 text-right">
              <span class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <!-- Add more social media icons here -->
              </span>
            </div>
          </div>
          <div class=" column">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="./index.html">Home </a></li>
              <li><a href="#gallery">Gallery</a></li>
              <li><a href="#tour">Tour</a></li>
              <li><a href="#booking">Boooking</a></li>
            </ul>
          </div>
          <div class="column">
            <h4>Our Instagram</h4>
            <div class="image-gallery">
                <img src="./assets/images/image-1.jpeg" alt="Image 1">
                <img src="./assets/images/image-2.jpeg" alt="Image 2">
                <img src="./assets/images/image-3.jpeg" alt="Image 3">
                <img src="./assets/images/image-4.jpeg" alt="Image 4">
                <img src="./assets/images/image-5.jpeg" alt="Image 5">
                <img src="./assets/images/image-6.jpeg" alt="Image 6">
            </div>
        </div>
        
          <div class=" column">
            <h4>Company</h4>
            <ul>
              <li><a href="">Subscribe our network</a></li>
              <input class="footer-subscribe-email" type="email" name="" id="" placeholder="Your Email Address">
              <br/>
              <button class="main-button"> Subscribe</button>
            </ul>
          </div>
        </div>
        <div class="footer-copyright">
            <p class="footer-end-text">
              © 2024 Viator Tourism for Advanture.
            </p>
        </div>
      </div>
    </footer>








    <!-- Script Links  -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>

        $(document).ready(function () {

            const slides = document.querySelector(".hero-slides");
            const slideElems = document.querySelectorAll(".hero-slide");
            const dots = document.querySelectorAll(".dot");
            const totalSlides = slideElems.length;
            let currentIndex = 0;
            let slideInterval;

            function showSlide(index) {
                slides.style.transform = `translateX(-${index * 100}%)`;
                dots.forEach((dot) => dot.classList.remove("active"));
                dots[index].classList.add("active");
                slideElems.forEach((slide, i) => {
                    slide.classList.toggle("fadeIn", i === index);
                    slide.classList.toggle("fadeOut", i !== index);
                });
            }

            function startSlideShow() {
                slideInterval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    showSlide(currentIndex);
                }, 5000); // Change slide every 5 seconds
            }

            function stopSlideShow() {
                clearInterval(slideInterval);
            }

            document.getElementById("next-slide").addEventListener("click", () => {
                stopSlideShow();
                currentIndex = (currentIndex + 1) % totalSlides;
                showSlide(currentIndex);
                startSlideShow();
            });

            document.getElementById("previous").addEventListener("click", () => {
                stopSlideShow();
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                showSlide(currentIndex);
                startSlideShow();
            });

            dots.forEach((dot, i) => {
                dot.addEventListener("click", () => {
                    stopSlideShow();
                    currentIndex = i;
                    showSlide(currentIndex);
                    startSlideShow();
                });
            });

            // Initialize
            showSlide(currentIndex);
            startSlideShow();


            document.getElementById('contact-form').addEventListener('submit', function (e) {
                e.preventDefault();
                alert('Your message has been sent!');
            });



            //  For Employ Sticky 
            $(".sticky").each(function (index) {
                $(this).addClass("sticky-" + (index + 1))
            })


            // Slider  Section  starter
            $(".slider").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 500,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            })

            $("#prev").click(function () {
                $(".slider").slick("slickPrev")
            })

            $("#next").click(function () {
                $(".slider").slick("slickNext")
            })
            // Slider  Section  end
        })

        // Gradiant text Script starter
        document.addEventListener("DOMContentLoaded", function () {
            const observerOptions = {
                root: null,
                rootMargin: "0px",
                threshold: 0.1
            };

            const observerCallback = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-gradient');
                    } else {
                        entry.target.classList.remove('animate-gradient');
                    }
                });
            };

            const observer = new IntersectionObserver(observerCallback, observerOptions);

            document.querySelectorAll('.gradient-text').forEach(element => {
                observer.observe(element);
            });
        });
        // Gradiant text Script end
        document.addEventListener('DOMContentLoaded', (event) => {
            const loginBtn = document.getElementById('loginBtn');
            const loginPopup = document.getElementById('loginPopup');
            const closeBtn = document.getElementsByClassName('close-popup')[0];
            const showSignup = document.getElementById('showSignup');
            const showLogin = document.getElementById('showLogin');
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');

            loginBtn.onclick = function () {
                loginPopup.style.display = 'flex';
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
            }

            closeBtn.onclick = function () {
                loginPopup.style.display = 'none';
            }

            window.onclick = function (event) {
                if (event.target == loginPopup) {
                    loginPopup.style.display = 'none';
                }
            }

            showSignup.onclick = function () {
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
            }

            showLogin.onclick = function () {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
            }
        });

    </script>
</body>

</html>
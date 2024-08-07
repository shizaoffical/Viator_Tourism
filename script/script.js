


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


	  document.getElementById('contact-form').addEventListener('submit', function(e) {
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
document.addEventListener("DOMContentLoaded", function() {
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

  loginBtn.onclick = function() {
	  loginPopup.style.display = 'flex';
	  loginForm.style.display = 'block';
	  signupForm.style.display = 'none';
  }

  closeBtn.onclick = function() {
	  loginPopup.style.display = 'none';
  }

  window.onclick = function(event) {
	  if (event.target == loginPopup) {
		  loginPopup.style.display = 'none';
	  }
  }

  showSignup.onclick = function() {
	  loginForm.style.display = 'none';
	  signupForm.style.display = 'block';
  }

  showLogin.onclick = function() {
	  loginForm.style.display = 'block';
	  signupForm.style.display = 'none';
  }
});












document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    const icon = mobileMenuToggle.querySelector('i');

    mobileMenuToggle.addEventListener('click', function () {
        navLinks.classList.toggle('active');
        if (navLinks.classList.contains('active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-links a');

    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');
        });
    });
});


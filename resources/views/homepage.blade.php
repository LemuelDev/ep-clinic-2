<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo-tooth.png') }}" type="image/x-icon">
    <title>EP CLINIC</title>
    @vite('resources/css/app.css')
    @vite('resources/js/lightDark.js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
        }
        .image-wrapper {
      display: flex;
      justify-content: center;
      padding-top: 5rem;
      align-items: center;
    }
    .containerr{
        max-width: 768px;
        margin: auto;
    }
    

    .image-wrapper::before {
      content: "";
      position: absolute;
      background: rgba(80, 80, 80, 0.503);
      width: 25rem;
      height: 50px;
      bottom: 100px;
      filter: blur(20px);
      border-radius: 50%;
    }

    @media(max-width:768px){
      .image-wrapper::before {
          content: none; /* This will effectively hide the pseudo-element */
      }

      .image-wrapper{
        display: flex;
        gap: 16px;
      }

      .image-wrapper img {
        width: 28% !important;
        height: 190px !important;
        clip-path: none !important;
        margin: 0 0 1rem 0 !important;
        border-radius: 10px;
    }

          .image-wrapper .img1,
          .image-wrapper .img2,
          .image-wrapper .img3 {
              height: auto; /* Ensure heights adjust automatically */
              margin-right: 0; /* Remove any specific right margins */
          }

        
          .containerr{
              max-width: 100%;
              margin: 0;
              padding: 0; /* Adjust container padding as needed */
          }

    }

    .image-wrapper img {
      width: 270px;
      clip-path: polygon(25% 0%, 100% 0%, 75% 100%, 0% 100%);
      transition: 0.5s ease-out 100ms;
      cursor: pointer;
    }
    

    .image-wrapper img:hover, .map:hover {
      transform: scale(1.05);
    }

    .image-wrapper .img1 {
      height: 20rem;
      margin-right: -30px;
    }

    .image-wrapper .img2 {
      height: 25rem;
      margin-right: -30px;
    }

    .image-wrapper .img3 {
      height: 20rem;
    }

    .service-card:hover{
      background-color: #4158D0;
      background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
      box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, 
      rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, 
      rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, 
      rgba(0, 0, 0, 0.09) 0px 32px 16px;
      color: white;
      transition: 0.5s ease-in;
      cursor: pointer;
    }
    </style>


     <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
</head>
<body>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
       AOS.init();
     </script>

    <div class="w-full flex items-center justify-around max-sm:justify-between px-4 py-6" data-theme="light" id="navbar">
        <div class="flex items-center justify-start gap-2"  data-aos="fade-up"
        data-aos-duration="2000">
            <a href="#hero" class="md:text-2xl text-md text-[#0118D8] tracking-tighter font-bold">EP DENTAL-CLINIC</a>
            <img src="{{ asset('images/logo-tooth.png') }}" alt="logo" class="h-[50px] w-[50px] p-2 rounded-full">
        </div>
        <div class="flex items-center gap-2 justify-center text-center" data-aos="fade-up"
        data-aos-duration="2000"> 
                <a href="#about" class="md:text-xl text-md text-black transition-colors rounded-md  px-4 py-3 hover:bg-[#404fd3] hover:text-white">About</a>
                <a href="#services" class="md:text-xl text-md text-black rounded-md px-4 py-3 hover:bg-[#404fd3] hover:text-white transition-colors ">Services</a>
             
        </div>
    </div>


    <section id="hero" class="w-full min-h-[80vh] " data-theme="light">
       
        <div class="flex items-center justify-center gap-4 max-lg:flex-col max-md:gap-7  px-6  md:mx-20 md:m-auto">
            <div class="flex flex-col items-center text-center pt-[5rem] justify-end   " data-aos="fade-up"
                 data-aos-duration="2000">
                <h4 class="font-bold text-[40px] py-2 text-[#0118D8] max-sm:text-center max-sm:px-4 ">Your Smile, Our Expertise</h4>
                <p class="text-xl text-center py-2 text-black">Bringing confidence, comfort and care <br>  to every visit.</p>
                <a href="/appointment/create" class="bg-[#0118D8] hover:bg-[#404fd3] rounded-lg outline-none  text-white px-8 py-3 text-lg mt-4">Appoint Now</a>
            </div>
            <div class="containerr" >
                <div class="image-wrapper">
                  <img
                    class="img1"
                    src="/images/hero4.jpg"
                    alt=""
                  />
                  <img
                    class="img2"
                    src="/images/hero2.jpg"
                    alt=""
                  />
                  <img
                    class="img3"
                      src="/images/hero5.jpg"
                    alt=""
                  />
                </div>
              </div>
        </div>
    </section>

    <section class="w-full h-[65vh] " data-theme="light">
        <div class="flex md:items-start items-center justify-center flex-col gap-6 max-w-[700px] mx-auto pt-40 max-sm:px-4">
            <div class="flex items-start justify-center md:text-start text-center  gap-4" data-aos="fade-left"
            data-aos-duration="2000">
                <span class="text-5xl pb-4 flex items-start">
                    <box-icon type='solid' name='quote-alt-left'></box-icon>
                </span>
                <h4 class="font-bold md:text-[45px] text-4xl text-black">Your Journey to a <span class="text-[#0118D8]">Brighter</span></h4>
            </div>
            <div class="flex items-start justify-center text-centrer md:justify-end gap-4 w-full"
            data-aos="fade-right"
            data-aos-duration="2000">
                <h4 class="font-bold md:text-5xl text-4xl text-black"> and <span class="text-[#0118D8]">Healthier</span> Smile</h4>
                <span class="text-5xl pb-4 flex items-start ">
                    <box-icon type='solid' name='quote-alt-right'></box-icon>
                </span>
            </div>
            <h4 class="flex justify-center items-center text-center w-full pt-8 italic text-xl text-slate-700"
            >Let us help you achieve the smile you’ve always wanted.</h4>
        </div>      
    </section>

    <section class="w-full min-h-[80vh] bg-gray-100" id="about"  data-theme="light">
        <h4 class="py-8 text-center font-bold text-5xl text-[#0118D8]"
        data-aos="fade-up"
            data-aos-duration="1500">About</h4>
        <div class="flex max-md:flex-col items-center justify-center gap-6 pt-12 lg:py-12 max-w-[1000px] mx-auto">
            <div class="md:text-start text-center px-3 md:max-w-[60%]"
            data-aos="fade-right"
            data-aos-duration="2000">
                <h4 class="text-4xl font-bold py-4 text-[#0118D8]">Dr. Espineli-Paradeza 👋</h4>
                <p class="text-lg max-md:px-4 italic text-black text-justify">"Welcome to EP-Clinic, led by Dr. Espineli-Paradeza, a dedicated dentist committed to
                 providing exceptional dental care with a gentle touch. With a passion for helping patients 
                 achieve a healthy, beautiful smile, Dr. Espineli-Paradeza combines expertise and a patient-centered 
                 approach in a comfortable, modern setting. Whether it’s routine check-ups, preventive care, or specialized treatments, 
                 our clinic is here to support your oral health journey with professionalism and compassion."</p>
            </div>
            <div
            data-aos="fade-left"
            data-aos-duration="2000">
                <img src="{{ asset('images/dentist.jpg') }}" alt="logo" class="h-[50%] lg:max-w-[70%] max-w-[40%] mx-auto rounded-full">
            </div>
        </div>  
    </section>

    <section class="w-full min-h-[60vh] py-16" id="services"  data-theme="light">
        <h4 class="py-8 text-center font-bold text-5xl text-[#0118D8] " >Services</h4>
        <div class="grid grid-cols-3 gap-7 max-w-[1000px] mx-auto px-4 py-10">
            @forelse ($treatments as $item)
            <div class="text-center border-2 border-black rounded-md service-card" data-aos="fade-up"
            data-aos-duration="1500">
                <h4 class=" text-3xl max-md:text-xl text-center font-bold py-3">{{$item->treatment_offer}}</h4>
            </div>
            @empty
                <h4 class="text-2xl pt-10 text-center col-span-3"> No services at the moment.</h4>
            @endforelse
           
        </div>
    </section>

    <section class="w-full min-h-[100vh] py-8 bg-gray-100" id="services"  data-theme="light">
        <h4 class="py-8 text-center font-bold text-5xl text-[#0118D8]" data-aos="fade-up"
        data-aos-duration="1500">Locate Us</h4>
        <div class="flex max-md:flex-col items-center justify-center gap-10 lg:gap-6 py-12 max-w-[1000px] mx-auto">
            <div class="px-6"
            data-aos="fade-up"
            data-aos-duration="1500">
                <iframe class="rounded-lg max-w-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1846.1457326622813!2d119.93123849999996!3d15.624494300000011!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33940fb452537e0f%3A0x300cb20d4d43220!2sKABUHAYAN%20NATIN%20STORE!5e1!3m2!1sen!2sph!4v1732175881252!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="px-4 text-xl md:max-w-[45%] leading-7 text-justify"
            data-aos="fade-up"
            data-aos-duration="1500">
                Locate us near the <span class="text-[#0118D8]">Trillana Cycle Parts Store</span class="text-[#0118D8]"> at the <span class="text-[#0118D8]">Rubi Street Poblacion, Candelaria, Zambales.</span > We are open from <span class="text-[#0118D8]">Monday to Sunday at 8am to 4pm</span>. Make your appointment now and we will give you the brightest smile you will ever have!
            </div>
        </div>
    </section>

    <section class="w-full min-h-[40vh]"  data-theme="light" id="services">

      <div class="flex justify-center gap-12 items-center px-6 py-14 max-w-[1000x] mx-auto max-md:flex-col max-md:gap-5 ">
          <div class="lg:text-start text-center grid gap-3"
          data-aos="fade-up"
                 data-aos-duration="2000">
              <h4 class="text-4xl py-3 tracking-tighter font-bold text-[#0118D8]">GET IN TOUCH</h4>
              <p class="text-lg">Feel free to message us with our provided contacts <br> for your inquiries regarding with our dental clinic!</p>
              <a href="#navbar" tooltip="back to top" class="rounded-full p-3 cursor-pointer "><box-icon name='up-arrow-circle' type='solid' size='lg'></box-icon></a>
          </div>
          <div class="flex items-center gap-6 justify-center max-md:flex-col"
          data-aos="fade-up"
                 data-aos-duration="2000">
              <div class="flex items-center gap-4 justify-center flex-col border-2 border-black rounded-lg px-10 py-16">
                  <box-icon type='solid' name='phone-call' class="text-blue text-3xl"></box-icon>
                  <h4 class="text-md">09475817672</h4>
              </div>
              <div class="flex items-center gap-4 justify-center flex-col border-2 border-black rounded-lg px-10 py-16">
                <box-icon type='solid' name='envelope' class="text-blue text-3xl"></box-icon>
                <h4 class="text-sm">kharz891@gmail.com</h4>
            </div>
          </div>
      </div>

    </section>




    @if (session()->has('error'))
    <dialog id="my_modal_24" class="modal" data-theme="light">
      <div class="modal-box">
        <h3 class="text-xl font-bold">Reservation!</h3>
        <p class="py-4 pt-8 text-center text-red-600">{{session('error')}}</p>
        <div class="modal-action">
          <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button class="btn">Close</button>
          </form>
        </div>
      </div>
      </dialog>

       <!-- JavaScript to automatically open modal -->
    <script>
        // Automatically open modal on page load
        window.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('my_modal_24').showModal();
        });
    </script>
    @endif

    
    @if (session()->has('success'))
    <dialog id="my_modal_24" class="modal" data-theme="light">
      <div class="modal-box">
        <h3 class="text-xl font-bold">Success!</h3>
        <p class="py-4 pt-8 text-center text-green-600">{{session('success')}}</p>
        <div class="modal-action">
          <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button class="btn">Close</button>
          </form>
        </div>
      </div>
      </dialog>

       <!-- JavaScript to automatically open modal -->
    <script>
        // Automatically open modal on page load
        window.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('my_modal_24').showModal();
        });
    </script>
    @endif


</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        #hero {
            background-color: #111111;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='20' viewBox='0 0 100 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21.184 20c.357-.13.72-.264 1.088-.402l1.768-.661C33.64 15.347 39.647 14 50 14c10.271 0 15.362 1.222 24.629 4.928.955.383 1.869.74 2.75 1.072h6.225c-2.51-.73-5.139-1.691-8.233-2.928C65.888 13.278 60.562 12 50 12c-10.626 0-16.855 1.397-26.66 5.063l-1.767.662c-2.475.923-4.66 1.674-6.724 2.275h6.335zm0-20C13.258 2.892 8.077 4 0 4V2c5.744 0 9.951-.574 14.85-2h6.334zM77.38 0C85.239 2.966 90.502 4 100 4V2c-6.842 0-11.386-.542-16.396-2h-6.225zM0 14c8.44 0 13.718-1.21 22.272-4.402l1.768-.661C33.64 5.347 39.647 4 50 4c10.271 0 15.362 1.222 24.629 4.928C84.112 12.722 89.438 14 100 14v-2c-10.271 0-15.362-1.222-24.629-4.928C65.888 3.278 60.562 2 50 2 39.374 2 33.145 3.397 23.34 7.063l-1.767.662C13.223 10.84 8.163 12 0 12v2z' fill='%23707070' fill-opacity='0.43' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
    </style>
     <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>

    <section id="hero" class="w-full h-[80vh] bg-slate-400">
        <div class="w-full flex items-center justify-around max-sm:justify-between px-4 py-6">
            <div class="flex items-center justify-start gap-2">
                <a href="#hero" class="md:text-2xl text-md text-white">EP-CLINIC</a>
                <img src="{{ asset('images/logo-tooth.png') }}" alt="logo" class="h-[50px] w-[50px] p-2 rounded-full">

            </div>
            <div class="flex items-center justify-center text-center">
                    <a href="#about" class="md:text-xl text-md text-white rounded-md px-4 py-3 hover:bg-purple-500">About</a>
                    <a href="#services" class="md:text-xl text-md text-white rounded-md px-4 py-3 hover:bg-purple-500">Services</a>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center pt-20 md:pt-36">
            <h4 class="font-bold text-4xl py-4 text-white max-sm:text-center max-sm:px-4">Espineli-Paradeza Dental Clinic</h4>
            <a href="#" class="btn btn-secondary px-8 text-md mt-4">Book Now</a>
        </div>
    </section>

    <section class="w-full h-[80vh] ">
        <div class="flex items-start justify-center flex-col gap-6 max-w-[700px] mx-auto pt-40 max-sm:px-4">
            <div class="flex items-start justify-center text-start  gap-4">
                <span class="text-5xl pb-4 flex items-start">
                    <box-icon type='solid' name='quote-alt-left'></box-icon>
                </span>
                <h4 class="font-bold md:text-[45px] text-3xl text-black">Your Journey to a Brighter</h4>
            </div>
            <div class="flex items-start justify-center text-centrer md:justify-end gap-4 w-full">
                <h4 class="font-bold md:text-5xl text-3xl text-black"> and Healthier Smile</h4>
                <span class="text-5xl pb-4 flex items-start ">
                    <box-icon type='solid' name='quote-alt-right'></box-icon>
                </span>
            </div>
            <h4 class="flex justify-center items-center text-center w-full pt-8 italic text-xl text-slate-700">Let us help you achieve the smile you’ve always wanted.</h4>
        </div>      
    </section>

    <section class="w-full min-h-[80vh] bg-gray-50" id="about">
        <h4 class="py-8 text-center font-bold text-4xl">About</h4>
        <div class="flex max-md:flex-col items-center justify-center gap-6 pt-12 max-w-[1000px] mx-auto">
       
            <div class="md:text-start text-center px-3 md:max-w-[60%]">
                <h4 class="text-4xl font-bold py-4">Dr. Espineli-Paradeza 👋</h4>
                <p class="text-lg max-md:px-4 italic text-slate-600">"Welcome to EP-Clinic, led by Dr. Espineli-Paradeza, a dedicated dentist committed to
                 providing exceptional dental care with a gentle touch. With a passion for helping patients 
                 achieve a healthy, beautiful smile, Dr. Espineli-Paradeza combines expertise and a patient-centered 
                 approach in a comfortable, modern setting. Whether it’s routine check-ups, preventive care, or specialized treatments, 
                 our clinic is here to support your oral health journey with professionalism and compassion."</p>
            </div>
            <div>
                <img src="{{ asset('images/logo-tooth.png') }}" alt="logo" class="h-[50%] max-w-[70%] mx-auto rounded-full">
            </div>
        </div>  
    </section>

    <section class="w-full h-[80vh] pt-16" id="services">
        <h4 class="py-8 text-center font-bold text-4xl">Services</h4>
    </section>

    <section class="w-full h-[80vh] pt-16" id="services">
        <h4 class="py-8 text-center font-bold text-4xl">Locate Us</h4>
    </section>

    <section class="w-full h-[40vh] bg-violet-400" id="services">
        <h4 class="py-8 text-center font-bold text-4xl">Footer</h4>
    </section>







</body>
</html>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo-tooth.png') }}" type="image/x-icon">
    <title>EP CLINIC (RESERVATION)</title>
    @vite('resources/css/app.css')
    @vite('resources/js/lightDark.js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .glasscss{
            /* From https://css.glass */
                background: rgba(255, 255, 255, 0.19);
                border-radius: 16px;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(6.4px);
                -webkit-backdrop-filter: blur(6.4px);
                border: 1px solid rgba(255, 255, 255, 0.14);
        }

        .inputss {
            border: none;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 20px 20px 60px #c5c5c5,
                    -20px -20px 60px #ffffff;
            transition: 0.3s;
        
            }

            .inputss:focus {
            outline-color: #e8e8e8;
            box-shadow: inset 20px 20px 60px #c5c5c5,
                    inset -20px -20px 60px #ffffff;
            transition: 0.3s;
            }
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
                <a href="/" class="md:text-xl text-md text-black transition-colors rounded-md  px-4 py-3 hover:bg-[#404fd3] hover:text-white">Homepage</a>
                
            
        </div>
    </div>

    <section id="hero" class="w-full min-h-[80vh] " data-theme="light">
       
        <div class="flex items-center justify-center gap-4 max-lg:flex-col max-md:gap-7  px-6  md:mx-20 md:m-auto">
            <div class="flex flex-col items-center text-center pt-[5rem] justify-end   " data-aos="fade-up"
                 data-aos-duration="2000">
                <h4 class="font-bold text-[40px] py-2 text-[#0118D8] max-sm:text-center max-sm:px-4 ">Book Your Appointment in Minutes.</h4>
                <p class="text-xl text-center py-2 text-black">Find the perfect time for your visit and secure your spot quickly online.</p>
                {{-- <a href="#reserve" class="bg-[#E9DFC3] hover:bg-[#eddaa7] rounded-lg outline-none  text-black px-8 py-3 text-lg mt-4">Appoint Now</a> --}}
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

    <section class="w-full min-h-[65vh] py-16" data-theme="light">
        <div class="flex items-center justify-center flex-col  gap-6 max-w-[1050px] mx-auto py-20 max-sm:px-4">
            <h4 class=" font-bold text-4xl py-4 text-center pt-8 text-[#0118D8]">Get Personalized Dental Insights from Our AI Assistant</h4>
            <div class="grid gap-6 max-w-[700px] mx-auto items-center text-center p-5 rounded-lg outline-none glasscss">
                <h4 class="py-4 text-3xl text-black">DISCLAIMER:</h4>
               <p class="text-md">This AI assistant is designed to offer preliminary information and is not a substitute for professional dental consultation. 
                The insights and suggestions provided are dependent on your input and may not be entirely accurate.
                 For a comprehensive evaluation and personalized advice, always consult with a qualified dentist.</p>
            </div>
            <form action="" class="flex max-lg:flex-col items-around justify-center gap-4 p-4 max-w-[1000px] mx-auto" method="POST">
                @csrf
                <input type="text" placeholder="Enter your dental condition" class="inputss placeholder:text-slate-500 min-w-[600px] max-sm:w-full max-lg:min-w-[400px] bg-white ">
                <button class="bg-blue-600 hover:bg-blue-700 transition-colors px-8 py-3 text-white text-lg  font-bold rounded-lg shadow-xl outline-none">Submit</button>
            </form>
            <div class=" rounded-lg shadow-xl mt-8" id="result">
                
            </div>
        </div>      
    </section>
    
    <section id="reserve" class="min-h-[60vh] w-full lg:py-20 py-14 pt-10 bg-gray-100" data-theme="light">
            <h4 class=" font-bold text-4xl py-4 text-center pt-8 text-[#0118D8]">Make your Appointment now!</h4>
            <div class="mx-auto max-w-[1500px] px-4 pt-10">
                <form action="{{ route('patient.create') }}" method="GET" class="grid gap-4 px-4">
                    @csrf
                    <!-- Calendar -->
                    <div class="flex gap-4 items-center justify-center px-4">
                        <div class="grid gap-3">
                            <label for="calendar">Select a Date:</label>
                            <input type="date" id="calendar" class="px-10 py-2 rounded-md shadow-lg border bg-transparent border-gray-500 " name="reservation_date" onchange="this.form.submit()" 
                                value="{{ request('reservation_date') }}">
                        </div>

                        <!-- Time slots (displayed if a date is selected) -->
                        @if(request('reservation_date') && !empty($timeSlots))
                        <div id="time-slots" class="grid gap-7 px-4">
                            <div>
                                <label>Select a Time Slot:</label>
                                @foreach($timeSlots as $timeSlot => $details)
                                <div class="flex gap-3">
                                    <input type="radio" name="time_slot" value="{{ $timeSlot }}"
                                    {{ $details['is_occupied'] ? 'disabled' : '' }}
                                    onclick="setTimeSlot('{{ $timeSlot }}')">                                    
                                    <label >{{ $timeSlot }} <span class="{{ !$details['is_occupied'] ? 'text-green-500' : 'text-red-500' }}" >{{ !$details['is_occupied'] ? 'Available' : '(Booked)' }}</span></label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </form>

                @if(request('reservation_date') && !empty($timeSlots))
                <!-- Form for submitting the reservation -->
                <form action="{{ route('patient.store') }}" method="POST" class="grid justify-center items-start grid-cols-3 gap-4 max-w-[900px] mx-auto py-7">
                    @csrf
                    @method('POST')
                    <!-- Hidden inputs to carry over selected date and time slot -->
                    <input type="hidden" name="reservation_date" value="{{ request('reservation_date') }}">
                    <input type="hidden" id="hidden-time-slot" name="time_slot" value="{{ request('time_slot') }}">

                    <div class="grid">
                        <label for="firstname" >Firstname:</label>
                        <input type="text" name="firstname" id="firstname" value="{{old("firstname")}}"  class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                    </div>
                    <div class="grid">
                        <label for="middlename" >Middlename:</label>
                        <input type="text" name="middlename" id="middlename" value="{{old("middlename")}}"  class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                        <span class="italic text-slate-500">Optional</span>
                    </div>
                    <div class="grid">
                        <label for="lastname" >Lastname:</label>
                        <input type="text" name="lastname" id="lastname" value="{{old("lastname")}}"  class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                    </div>
                    <div class="grid">
                        <label for="extension_name" >ExtensionName:</label>
                        <input type="text" name="extension_name" id="extension_name" value="{{old("extension_name")}}"  class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                        <span class="italic text-slate-500">Optional</span>
                    </div>
                    <div class="grid">
                        <label for="phone_number" >Phone Number:</label>
                        <input type="number" name="phone_number" id="phone_number" value="{{old("phone_number")}}"  class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                    </div>
                    <div class="grid">
                        <label for="email" >Email:</label>
                        <input type="email" name="email" id="email" value="{{old("email")}}" class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                    </div>
                    <div class="grid">
                        <label for="emergency_name" >Emergency Name:</label>
                        <input type="text" name="emergency_name" id="emergency_name" value="{{old("emergency_name")}}"  class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                    </div>
                   
                    <div class="grid">
                        <label for="emergency_relationship" >Emergency Relationship:</label>
                        <input type="text" name="emergency_relationship" id="emergency_relationship" value="{{old("emergency_relationship")}}"  class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                    </div>
                    <div class="grid">
                        <label for="emergency_contact" >Emergency Contact Number:</label>
                        <input type="text" name="emergency_contact" id="emergency_contact" value="{{old("emergency_contact")}}"  class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
                    </div>
                   
                    <div class="grid">
                        <label for="treatment">Select Treatment:</label>
                        <select name="treatment_choice" class="px-6 py-3 rounded-md shadow-md bg-transparent border border-gray-500">
                           @if (count($treatments) > 0)
                               @foreach ($treatments as $treatment)
                                   <option value="{{$treatment->treatment_offer}}">{{$treatment->treatment_offer}}</option>
                               @endforeach
                           @else
                           <option value="" disabled selected>No Treatment at the moment.</option>
                           @endif
                        </select>
                    </div>

                    <div class="grid">
                        <label for="medical_history">Do you have medical history?</label>
                        <select name="medical_history" class="px-6 py-3 rounded-md shadow-md bg-transparent border border-gray-500">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="grid">
                        <label for="medical_description">If Yes, please fill this up:</label>
                        <input type="text" name="medical_description" placeholder="Medical History" class="px-6 py-3 bg-transparent rounded-md shadow-md border border-gray-500">
                    </div>

                    <button type="submit" class="btn btn-primary max-w-[500px] mx-auto mt-4 lg:col-span-3 text-md text-white">Submit Appointment</button>
                </form>
                <p class="text-center italic text-lg text-slate-700">NOTE: After appointment, there will be an email confirmation to make sure you are making an appointment to our dental clinic.</p>

                <script>
                    // Function to set the hidden time_slot input value
                    function setTimeSlot(timeSlot) {
                        document.getElementById('hidden-time-slot').value = timeSlot;
                    }
                </script>
                @endif
                
                  
                      @if (session()->has('failed'))
                      <dialog id="my_modal_24" class="modal">
                        <div class="modal-box">
                          <h3 class="text-xl font-bold">Failed!</h3>
                          <p class="py-4 pt-8 text-center text-red-600">{{session('failed')}}</p>
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
                      <dialog id="my_modal_24" class="modal">
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

                      @if ($errors->any())
                      <dialog id="my_modal_24" class="modal">
                        <div class="modal-box">
                          <h3 class="text-xl font-bold">Failed!</h3>
                          <p class="py-4 pt-8 text-center text-red-600"> @foreach ($errors->all() as $error)
                              {{ $error }}
                          @endforeach</p>
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
  

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
          const dates = @json($dates); // Ensure `$dates` is valid JSON
          flatpickr("#calendar", {
            minDate: "{{ $today }}",
            maxDate: "{{ $endDate }}",
            inline: true,
            onDayCreate: function(dObj, dStr, fp, dayElem) {
              const dateStr = dayElem.dateObj.toISOString().split('T')[0];
            },
            onChange: function(selectedDates) {
              if (selectedDates.length > 0) {
                const selectedDate = selectedDates[0].toISOString().split('T')[0];
                window.location.href = `{{ route('patient.create') }}?reservation_date=${selectedDate}`;
              }
            }
          });
        });
        </script>
    

</body>
</html>
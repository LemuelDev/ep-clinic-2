<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EP CLINIC (RESERVATION)</title>
    @vite('resources/css/app.css')
    @vite('resources/js/lightDark.js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
        #hero {
            background-color: #111111;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='20' viewBox='0 0 100 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21.184 20c.357-.13.72-.264 1.088-.402l1.768-.661C33.64 15.347 39.647 14 50 14c10.271 0 15.362 1.222 24.629 4.928.955.383 1.869.74 2.75 1.072h6.225c-2.51-.73-5.139-1.691-8.233-2.928C65.888 13.278 60.562 12 50 12c-10.626 0-16.855 1.397-26.66 5.063l-1.767.662c-2.475.923-4.66 1.674-6.724 2.275h6.335zm0-20C13.258 2.892 8.077 4 0 4V2c5.744 0 9.951-.574 14.85-2h6.334zM77.38 0C85.239 2.966 90.502 4 100 4V2c-6.842 0-11.386-.542-16.396-2h-6.225zM0 14c8.44 0 13.718-1.21 22.272-4.402l1.768-.661C33.64 5.347 39.647 4 50 4c10.271 0 15.362 1.222 24.629 4.928C84.112 12.722 89.438 14 100 14v-2c-10.271 0-15.362-1.222-24.629-4.928C65.888 3.278 60.562 2 50 2 39.374 2 33.145 3.397 23.34 7.063l-1.767.662C13.223 10.84 8.163 12 0 12v2z' fill='%23707070' fill-opacity='0.43' fill-rule='evenodd'/%3E%3C/svg%3E");
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
    <section id="hero" class="w-full h-[50vh] bg-slate-400">
        <div class="flex flex-col items-center justify-center pt-20 md:pt-28" data-aos="fade-up"
        data-aos-duration="2000">
            <h4 class="font-bold text-4xl py-4 text-white max-sm:text-center max-sm:px-4">Your Smile, Our Priority: Trusted Dental Care for a Healthier You</h4>
            <a href="/" class="btn btn-secondary px-8 text-lg mt-4">Go to homepage</a>
        </div>
    </section>
    
    <section id="reserve" class="min-h-[60vh] w-full lg:py-20 py-14 pt-10">
            <h4 class="text-black font-bold text-4xl py-4 text-center pt-8">Make your Reservations now!</h4>
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
                        <input type="text" name="email" id="email" value="{{old("email")}}" class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500">
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

                    <button type="submit" class="btn btn-primary max-w-[500px] mx-auto mt-4 lg:col-span-3 text-md text-white">Submit Reservation</button>
                </form>
                <p class="text-center italic text-lg text-slate-500">NOTE: After reservation, there will be an email confirmation to make sure you are reserving an appointment to our dental clinic.</p>

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

     <section class="w-full min-h-[40vh] bg-violet-400" id="services">
        <h4 class="py-8 text-center text-3xl font-bold"
        data-aos="fade-up"
        data-aos-duration="1500">Espineli-Paradeza Dental Clinic</h4>
            <div class="flex gap-2 items-center justify-around text-center py-8"
            data-aos="fade-up"
            data-aos-duration="1500">
                <p class="text-white text-lg">Located near the Kabuhayan natin store.</p>
                <p class="text-lg text-white">Opening Hours:Monday to Sunday, 8AM-4PM</p>
                
            </div>
        </div>
        <div class="flex justify-center items-center pt-4">
            <p class="text-xl text-white font-bold">All rights reserved @2024.</p>
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
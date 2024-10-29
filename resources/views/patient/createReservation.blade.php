@extends('layout.patient')

@section('content')
<div class="flex h-screen">
    <!-- Sidebar -->
    @include('patient.sidebar')


    <!-- Main content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Navbar -->
        @include('patient.navbar')

        
        <!-- Main content area -->
        <main class="flex-1 p-6 " id="main-content">
            <div class="w-full ">
                <!-- Your main content goes here -->
                <h1 class="text-3xl font-bold pb-4">Schedule your Reservation</h1>
                
                {{-- reservation form --}}
                <div class="grid gap-8 px-4">
                 <!-- Form for selecting the date and time slot -->
                    <form action="{{ route('patient.create') }}" method="GET" class="grid gap-4 px-4">
                        @csrf
                        <!-- Calendar -->
                        <div class="flex gap-4 items-center justify-center px-4">
                            <div class="grid gap-3">
                                <label for="calendar">Select a Date:</label>
                                <input type="text" id="calendar" class="px-10 py-2 rounded-md shadow-lg border bg-transparent border-gray-500 " name="reservation_date" onchange="this.form.submit()" 
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
                    <form action="{{ route('patient.store') }}" method="POST" class="grid justify-center grid-cols-3 gap-4 max-w-[900px] mx-auto">
                        @csrf
                        @method('POST')
                        <!-- Hidden inputs to carry over selected date and time slot -->
                        <input type="hidden" name="reservation_date" value="{{ request('reservation_date') }}">
                        <input type="hidden" id="hidden-time-slot" name="time_slot" value="{{ request('time_slot') }}">

                        <!-- Additional fields -->
                        <div class="grid">
                            <label for="treatment">Select Treatment:</label>
                            <select name="treatment_choice" class="px-6 py-2 rounded-md shadow-md bg-transparent border border-gray-500">
                                <option value="Cleaning">Cleaning</option>
                                <option value="Pasta">Pasta</option>
                                <option value="Root Canal">Root Canal</option>
                                <option value="Tooth Extraction">Tooth Extraction</option>
                            </select>
                        </div>

                        <div class="grid">
                            <label for="medical_history">Do you have medical history?</label>
                            <select name="medical_history" class="px-6 py-2 rounded-md shadow-md bg-transparent border border-gray-500">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="grid">
                            <label for="medical_description">If Yes, please fill this up:</label>
                            <input type="text" name="medical_description" placeholder="Medical History" class="px-6 py-2 bg-transparent rounded-md shadow-md border border-gray-500">
                        </div>

                        <button type="submit" class="btn btn-primary max-w-[500px] mx-auto mt-4 lg:col-span-3">Submit Reservation</button>
                    </form>

                    <script>
                        // Function to set the hidden time_slot input value
                        function setTimeSlot(timeSlot) {
                            document.getElementById('hidden-time-slot').value = timeSlot;
                        }
                    </script>
                    @endif

                    

                </div>
              
                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    const dates = @json($dates); // Ensure $dates is passed as an associative array from your controller
                    
                    flatpickr("#calendar", {
                        minDate: "{{ $today }}",
                        maxDate: "{{ $endDate }}",
                        inline: true,
                        
                        // onDayCreate function to style the days based on their status
                        onDayCreate: function(dObj, dStr, fp, dayElem) {
                            const dateStr = dayElem.dateObj.toISOString().split('T')[0];    
                            
                            // console.log(new Date());
                            
                            // dayElem.style.backgroundColor = ''; // Clear any previous background color
                            // dayElem.style.color = ''; 

                            //                     // Apply colors based on the status
                            // if (dates[dateStr] === 'available') {
                            //     dayElem.style.backgroundColor = 'lightgreen';  // Green for available dates
                            //     dayElem.style.color = 'black';          // Ensure the text color is visible
                            //     console.log(`Set ${dateStr} to lightgreen`);
                            // } else if (dates[dateStr] === 'fully-booked') {
                            //     dayElem.style.backgroundColor = 'lightsalmon';    // Red for fully-booked dates
                            //     dayElem.style.color = 'black';          // Ensure the text color is visible
                            //     console.log(`Set ${dateStr} to lightsalmon`);
                            // }

                           
                        },

                        // onChange function to handle date selection and redirect
                        onChange: function(selectedDates) {
                            if (selectedDates.length > 0) {
                                const selectedDate = selectedDates[0].toISOString().split('T')[0];
                                window.location.href = `{{ route('patient.create') }}?reservation_date=${selectedDate}`;
                            }
                        }
                    });
                });


                </script>
                
                
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
                       
        </main>
       
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>

@endsection

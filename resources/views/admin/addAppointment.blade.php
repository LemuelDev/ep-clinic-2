@extends('layout.admin')

@section('content')
<div class="flex h-screen"  data-theme="light">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main content area -->
        <main class="flex-1 p-6 " id="main-content">
            <div class="w-full">
                <!-- Your main content goes here -->
                <h1 class="text-3xl font-bold pb-4 py-2 tracking-wide max-lg:text-center">New Appointment</h1>
               
                <form action="{{ route('admin.create', $id->id) }}" method="GET" class="grid gap-4 px-4">
                    @csrf
                    <!-- Calendar -->
                    <div class="flex gap-4 items-center justify-center px-4">
                                
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        
                        const dates = @json($dates); // Ensure `$dates` is valid JSON
                        flatpickr("#calendarr", {
                            minDate: "{{ $today }}",
                            maxDate: "{{ $endDate }}",
                            inline: true,
                            onDayCreate: function(dObj, dStr, fp, dayElem) {
                            const dateStr = dayElem.dateObj.toISOString().split('T')[0];
                            },
                            onChange: function(selectedDates) {
                            if (selectedDates.length > 0) {
                                const selectedDate = selectedDates[0].toISOString().split('T')[0];
                                let currentloc = window.location.href
                                window.location.href = `${currentloc}?reservation_date=${selectedDate}`;
                            }
                            }
                        });
                        });
                        </script>
                        <div class="grid gap-3">
                            <label for="calendar">Select a Date:</label>
                            <input type="date" id="calendarr" class="px-10 py-2 rounded-md shadow-lg border bg-transparent border-gray-500 " name="reservation_date" onchange="this.form.submit()" 
                                value="{{ request('reservation_date') }}">
                        </div>

                        <!-- Time slots (displayed if a date is selected) -->
                        @if(request('reservation_date') && !empty($timeSlots))
                        <div id="time-slots" class="grid gap-4 px-4">
                            <div class="grid grid-cols-[1fr_auto] gap-x-6 text-sm font-semibold text-gray-500 uppercase">
                                <span>Time Slot</span>
                                <span>Status</span>
                            </div>

                            @foreach($timeSlots as $timeSlot => $details)
                            <div class="grid grid-cols-[1fr_auto] gap-x-6 items-center">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="time_slot" value="{{ $timeSlot }}"
                                        {{ $details['is_occupied'] ? 'disabled' : '' }}
                                        onclick="setTimeSlot('{{ $timeSlot }}')"
                                        class="form-radio h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <span>{{ $timeSlot }}</span>
                                </label>
                                <span class="{{ !$details['is_occupied'] ? 'text-green-500' : 'text-red-500' }} font-medium">
                                    {{ !$details['is_occupied'] ? 'Available' : 'Booked' }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </form>

                @if(request('reservation_date') && !empty($timeSlots))
                  <!-- Existing Patient Form -->
                <form id="existing-patient-form" action="{{ route('admin.existing') }}" method="POST" class="grid justify-center items-start grid-cols-2 gap-4 max-w-[600px] mx-auto py-7">
                    @csrf
                    @method('POST')
                    <!-- Hidden inputs to carry over selected date and time slot -->
                    <input type="hidden" name="reservation_date" value="{{ request('reservation_date') }}">
                    <input type="hidden" id="hidden-time-slot" name="time_slot" value="{{ request('time_slot') }}">
                    <input type="hidden" name="appointment_number" value="{{ $appointment_number }}">

                    <div class="grid">
                        <label for="patient_number">Patient Number:</label>
                        <input type="text" name="patient_number" id="patient_number" value="{{$id->patient_number}}" class="rounded-md px-10 py-3 bg-white hover:bg-gray-200 text-black border border-gray-500" placeholder="Enter your Patient ID">
                    </div>

                    <div class="grid">
                        <label for="medical_history">Do you have medical history?</label>
                        <select name="medical_history" class="px-6 py-3 rounded-md shadow-md bg-transparent border border-gray-500">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="grid ">
                        <label for="medical_description">If Yes, please fill this up:</label>
                        <input type="text" name="medical_description" placeholder="Medical History" class="px-6 py-3 bg-transparent rounded-md shadow-md border border-gray-500">
                    </div>

                    <div class="grid">
                        <label for="existing_treatment">Select Treatment:</label>
                        <select name="treatment_choice" class="px-6 py-3 w-full rounded-md shadow-md bg-transparent border border-gray-500">
                          @if (count($treatments) > 0)
                              @foreach ($treatments as $treatment)
                                  <option value="{{$treatment->treatment_offer}}">{{$treatment->treatment_offer}}</option>
                              @endforeach
                          @else
                          <option value="" disabled selected>No Treatment at the moment.</option>
                          @endif
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary max-w-[400px] mx-auto mt-4 col-span-2 text-md text-white">Submit Appointment</button>
                </form>
                  <script>
                    // Function to set the hidden time_slot input value
                    function setTimeSlot(timeSlot) {
                        document.getElementById('hidden-time-slot').value = timeSlot;
                    }
                </script>
                @endif

            </div>
                       
        </main>

        
        @if (session()->has('error'))
        <dialog id="my_modal_24" class="modal"  data-theme="light">
          <div class="modal-box">
            <h3 class="text-xl font-bold">Failed!</h3>
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

        @if ($errors->has('email'))
        <dialog id="my_modal_27" class="modal"  data-theme="light">
            <div class="modal-box">
            <h3 class="text-xl font-bold">Failed!</h3>
            <p class="py-4 pt-8 text-center text-red-600">{{$errors->first('email')}}</p>
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
            document.getElementById('my_modal_27').showModal();
            });
        </script>
     @endif
       
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>



@endsection

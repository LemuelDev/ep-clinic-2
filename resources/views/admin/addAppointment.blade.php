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
                    <div class="flex gap-4 items-center justify-center max-sm:flex-col  px-4">
                                
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
                            <input type="date" id="calendarr" class="px-10 py-2 rounded-md shadow-lg border bg-transparent border-gray-500 w-full " name="reservation_date" onchange="this.form.submit()" 
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
                 <form id="existing-patient-form" action="{{ route('admin.existing') }}" method="POST"
                  class="
                      flex flex-col
                      lg:grid lg:grid-cols-2 lg:gap-4
                      max-w-[700px]
                      mx-auto py-7 px-4 lg:px-8
                      shadow-xl rounded-lg
                      items-start
                  "
              >
                  @csrf
                  @method('POST')
                  <input type="hidden" name="reservation_date" value="{{ request('reservation_date') }}">
                  <input type="hidden" id="hidden-time-slot-existing" name="time_slot" value="{{ request('time_slot') }}">
                  <input type="hidden" name="appointment_number" value="{{ $appointment_number }}">

                  <div class="w-full mb-4">
                      <label for="patient_number" class="block text-sm font-medium text-gray-700">Patient Number:</label>
                      <input type="text" name="patient_number" id="patient_number"
                          class="
                              mt-1 block w-full
                              px-4 py-3
                              bg-white border border-gray-500 rounded-md
                              hover:bg-gray-200
                              placeholder-gray-400
                          "
                          placeholder="Enter your Patient ID">
                  </div>

                  <div class="w-full mb-4">
                      <label for="medical_history" class="block text-sm font-medium text-gray-700">Do you have medical history?</label>
                      <select name="medical_history"
                          class="
                              mt-1 block w-full
                              px-4 py-3
                              bg-transparent border border-gray-500 rounded-md
                              shadow-md
                          ">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                      </select>
                  </div>

                  <div class="w-full mb-4">
                      <label for="medical_description" class="block text-sm font-medium text-gray-700">If Yes, please fill this up:</label>
                      <input type="text" name="medical_description" placeholder="Medical History"
                          class="
                              mt-1 block w-full
                              px-4 py-3
                              bg-transparent border border-gray-500 rounded-md
                              shadow-md
                          ">
                  </div>

                  <div class="w-full mb-4">
                      <label for="existing_treatment" class="block text-sm font-medium text-gray-700">Select Treatment:</label>
                      <select name="treatment_choice"
                          class="
                              mt-1 block w-full
                              px-4 py-3
                              bg-transparent border border-gray-500 rounded-md
                              shadow-md
                          ">
                          @if (count($treatments) > 0)
                              @foreach ($treatments as $treatment)
                                  <option value="{{$treatment->treatment_offer}}">{{$treatment->treatment_offer}}</option>
                              @endforeach
                          @else
                              <option value="" disabled selected>No Treatment at the moment.</option>
                          @endif
                      </select>
                  </div>

                  <button type="submit"
                      class="
                          lg:col-span-2
                          w-full
                          max-w-[400px]
                          mx-auto mt-4
                          text-md text-white
                          bg-blue-600 hover:bg-blue-700
                          px-4 py-3 rounded-md
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                      ">
                      Submit Appointment
                  </button>
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

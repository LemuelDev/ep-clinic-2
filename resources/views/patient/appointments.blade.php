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
            <div class="w-full">

                <!-- Your main content goes here -->
                <div class="flex justify-center max-sm:flex-col gap-4 sm:justify-between items-center w-full">
                    <h1 class="lg:text-3xl text-2xl font-bold ">Reservations</h1>
                   @if (count($reservations) > 0)
                   <div class="flex items-center gap-3">
                    <a href="{{route('patient.create')}}" class="px-3 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Book a Reservation
                    </a>
                   <div class="flex  gap-4 items-center justify-center">
                        <select name="filter-appointment" id="" class="py-1 px-5 w-full bg-transparent shadow rounded-lg">
                            <option value="">All</option>
                            <option value="">Today</option>
                            <option value="">Next 3 days</option>
                            <option value="">This whole week</option>
                            <option value="">Next Week</option>
                            <option value="">Next Two Weeks</option>
                        </select>
                        
                   </div>
                   </div>
                   @endif
                </div>
                @include('patient.tableAppointments') 
            </div>
                       
        </main>
       
    </div>
</div>

@if (session()->has('success'))
<dialog id="my_modal_45" class="modal">
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
    document.getElementById('my_modal_45').showModal();
    });
</script>
@endif

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>

@endsection

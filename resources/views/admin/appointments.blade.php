@extends('layout.admin')

@section('content')
<div class="flex h-screen">
    <!-- Sidebar -->
    @include('admin.sidebar')


    <!-- Main content -->
    <div class="flex-1 flex flex-col w-full">
        <!-- Navbar -->
        @include('admin.navbar')        
        
        <!-- Main content area -->
        <main class="flex-1 p-6 " id="main-content">
            <div class="w-full ">
                <!-- Your main content goes here -->
                <div class="flex max-sm:flex-col justify-center max-sm:gap-5 sm:justify-between items-center">
                    <h1 class="lg:text-3xl text-2xl font-bold ">Reservations</h1>
                    {{-- route hereee --}}
                    <form action="" method="GET">
                        <input type="text" placeholder="Search Name" name="search" class="px-4 py-2 rounded-lg shadow-md border border-gray-500 bg-transparent">
                        <button class="py-3 px-6 rounded-lg bg-blue-500 text-white">Search</button>
                    </form>
                </div>
                {{-- @include('admin.tableAppointments')  --}}
            </div>
                       
        </main>

         @if (session()->has('success'))
        <dialog id="my_modal_20" class="modal">
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
            document.getElementById('my_modal_20').showModal();
            });
        </script>
        @endif

        
        @if (session()->has('failed'))
        <dialog id="my_modal_21" class="modal">
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
            document.getElementById('my_modal_21').showModal();
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

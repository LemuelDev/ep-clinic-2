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
                <h1 class="text-3xl font-bold pb-4 py-2 tracking-wide max-lg:text-center">Add Time Slot</h1>
               
                <form action="{{route("admin.storeClinicHours")}}" method="POST" class="grid gap-6 shadow-xl rounded-xl">
                    @csrf
                    <div class="shadow-sm rounded-xl p-8">
                        <div class="grid grid-cols-1 max-w-xl gap-6 pt-5 ">
                            <div class="flex gap-4 justify-start items-center">
                               <label for="start_time">Start Time</label>
                               <input type="time" class="form-control" id="start_time" name="start_time" required>
                            </div>
                             <div class="flex gap-4 justify-start items-center">
                              <label for="end_time">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" required>
                            </div>
                        </div>  
                    </div>
                    
                    <div class=" px-4 w-full max-[520px]:max-w-[600px]  max-sm:flex-col flex gap-4 items-center justify-start pb-8">
                        <button type="submit" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-[#624E88] hover:bg-[#58457b]">Add Time Slot</button>
                    </div>
            
                </form>

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

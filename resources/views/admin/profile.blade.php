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
            <div class="w-full">
                <!-- Your main content goes here -->
                <h1 class="text-3xl font-bold pb-4 py-2 tracking-wide max-lg:text-center">Profile</h1>
                
                {{-- profile content --}}
                <div class="grid gap-6 shadow-xl rounded-xl">
                    {{-- name section --}}
                    <div class="shadow-sm rounded-xl p-8">
                        <h4 class="py-4 text-xl font-bold tracking-wide">Account Information</h4>
                        <div class="grid grid-cols-1 max-w-xl gap-6 pt-5 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="" class="">Username:</label>
                                <input type="text" readonly value="{{auth()->user()->username}}" class="border-2 border-slate-400  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="" class="">Email:</label>
                                <input type="text" readonly value="{{auth()->user()->email}}" class=" border-2 border-slate-400 rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                        </div>  
                    </div>


                    <div class="mx-auto px-4 w-full max-[520px]:max-w-[600px]  max-sm:flex-col flex gap-4 items-center justify-center py-8">
                        <a href="{{route("admin.editProfile", auth()->user()->id)}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-[#624E88] hover:bg-[#58457b]">Edit Profile</a>
                        <a href="{{route("admin.editPassword", auth()->user()->id)}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-red-700 hover:bg-red-800">Change Passsword</a>
                    </div>
                

                </div>

            </div>
                       
        </main>
       
        @if (session()->has('success'))
        <dialog id="my_modal_22" class="modal">
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
            document.getElementById('my_modal_22').showModal();
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

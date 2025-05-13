@extends('layout.admin')

@section('content')
<div class="flex h-screen" data-theme="light">
    <!-- Sidebar -->
    @include('admin.sidebar')
    
    <!-- Main content -->
    <div class="flex-1 flex flex-col w-full" data-theme="light">
        <!-- Navbar -->
        @include('admin.navbar')
        
        <!-- Main content area -->
        <main class="flex-1 p-6 " id="main-content" data-theme="light">
            <div class="w-full">
                <!-- Your main content goes here -->
                <h1 class="text-3xl font-bold pb-4 py-2 tracking-wide max-lg:text-center">Track Appointment</h1>
                
                {{-- profile content --}}
                <div class="grid gap-4 shadow-xl rounded-xl">
                    {{-- name section --}}
                    <div class="shadow-sm rounded-xl p-4">
                        <h4 class="py-4 text-xl font-bold tracking-wide">Personal Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Name:</label>
                                <input type="text" readonly value="{{$id->firstname}} {{$id->middlename}} {{$id->lastname}} {{$id->extensionname}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Phone Number:</label>
                                <input type="text" readonly value="{{$id->phone_number}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Email:</label>
                                <input type="text" readonly value="{{$id->email}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                        </div>  
                    </div>

                    <div class="shadow-sm rounded-xl p-4">
                        {{-- <h4 class="py-4 text-xl font-bold tracking-wide">Other Information</h4> --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Treatment Choice:</label>
                                <input type="text" readonly value="{{$id->treatment_choice}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Date:</label>
                                <input type="text" readonly value="{{ \Carbon\Carbon::parse($id->timeSlots->date)->format('F j, Y') }}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Time:</label>
                                <input type="text" readonly value="{{$id->timeSlots->time_range}}" class="bg-transparent  rounded-lg shadow px-4 w-full py-3 text-left text-md">
                            </div>
                          
                        </div>  
                    </div>

                    <div class="shadow-sm rounded-xl p-4">
                        <h4 class="py-4 text-xl font-bold tracking-wide">Emegency Contact Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 ">
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Name:</label>
                                <input type="text" readonly value="{{$id->emergency_name}}" class=" bg-transparent rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Phone Number:</label>
                                <input type="text" readonly value="{{$id->emergency_contact}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                            <div class="flex gap-4 justify-start items-center">
                                <label for="">Relationship:</label>
                                <input type="text" readonly value="{{$id->emergency_relationship}}" class="bg-transparent  rounded-lg shadow lg:px-10 px-4 py-3 text-left text-md w-full">
                            </div>
                           
                        </div>  
                    </div>
                    
                    @if ($id->reservation_status === "ongoing")
                    <div class="mx-auto px-4 w-full max-[520px]:max-w-[600px]  max-sm:flex-col flex gap-4 items-center justify-center pb-4">
                        <a href="{{route('admin.completeReservation', $id->id)}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-[#624E88] hover:bg-[#58457b]">Complete Appointment</a>
                        <a href="{{route('admin.rejectReservation', $id->id)}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-red-700 hover:bg-red-800">No-show Appointment</a>
                    </div>
                    @elseif ($id->reservation_status === "pending")
                    <div class="mx-auto px-4 w-full max-[520px]:max-w-[600px]  max-sm:flex-col flex gap-4 items-center justify-center pb-4">
                        <a href="{{route('admin.approvedReservation', $id->id)}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-[#624E88] hover:bg-[#58457b]">Approve Appointment</a>
                        <button  onclick="my_modal_100.showModal()" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-red-700 hover:bg-red-800">Reject Appointment</button>
                    </div>
                    @else
                    <div class="mx-auto px-4 w-full max-[520px]:max-w-[600px]  max-sm:flex-col flex gap-4 items-center justify-center pb-4">
                        <a href="{{route('admin.reschedAppointment', $id->id)}}" class="px-10 py-3 rounded-md text-center border-none text-lg text-white shadow bg-[#624E88] hover:bg-[#58457b]">New Appointment</a>
                    </div>
                    @endif

                </div>

            </div>
                       
        </main>
       
    </div>
    {{-- href="{{route('admin.rejectReservation', $id->id)}}" --}}

    <dialog id="my_modal_100" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
              </form>
          <h3 class="text-xl text-center font-bold">Reject Appointment</h3>
          <p class="py-2 text-md text-center"> Kindly input the reason for the rejection of the appointment.</p>
            <form action="{{route('admin.rejectedReservation', $id->id)}}" class=" flex flex-col gap-4 items-center justify-center" method="POST">
                @csrf
                <input type="text" name="reason" class="input input-bordered w-full max-w-xs" id="reason" placeholder="Enter reason..">
                <button type="submit" class="btn btn-primary">Submit</button>
                
            </form>
          
        </div>
      </dialog>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>

@endsection

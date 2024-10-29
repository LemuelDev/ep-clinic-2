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
            <div class=" py-4 ">
                <!-- Your main content goes here -->
                <h1 class="text-3xl font-bold pb-4 text-center">Appointment Calendar</h1>
                <div class="">
                    @include('admin.date') 
                </div>
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

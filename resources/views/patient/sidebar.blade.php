<aside 
    id="sidebar" 
    class="{{request()->route()->getName() === 'patient.profile' || request()->route()->getName() === 'patient.calendar'  ? 'shadow-xl rounded-lg w-64 transition-all duration-300 ease-in-out transform lg:translate-x-0 -translate-x-full lg:relative fixed h-[100vh] lg:h-[calc(100vh+350px)]  bottom-0 z-[1000]'
    : 'shadow-xl rounded-lg w-64 transition-all duration-300 ease-in-out transform lg:translate-x-0 -translate-x-full lg:relative fixed h-full bottom-0 z-[1000]'}}">
    <div class="flex flex-col h-full p-4">
        <div class="flex justify-end">
            <button 
            id="sidebarToggle" 
            class="block lg:hidden focus:outline-none items-end"
            onclick="toggleSidebar()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />    
                </svg>
            </button>
        </div>
        
        
        <!-- Sidebar content -->
        <ul class="mt-4 flex-grow">
            <li class="mb-2 text-center">
                <a href="#" class="text-center font-bold text-lg flex justify-center items-center gap-2">PATIENT <span class="pt-2"><box-icon name='user' color="currentColor" ></box-icon></span> </a>
            </li>
            
            {{-- <li class="mb-2">
                <a href="{{route('patient.calendar')}}" class="{{ request()->route()->getName() === 'patient.calendar' ? 'block p-2 bg-gray-700 text-white rounded' : 'block p-2 hover:bg-gray-700 hover:text-white rounded' }}">
                    Appointment Calendar
                </a>
            </li> --}}
            <li class="mb-2">
                <a href="{{route('patient.reservations')}}" class="{{ request()->route()->getName() === 'patient.reservations' ? 'block p-2 bg-gray-700 text-white rounded' : 'block p-2 hover:bg-gray-700 hover:text-white rounded' }}">
                    Reservations
                </a>
            </li>

            <li class="mb-2">
                <a href="{{route('patient.treatmentHistory')}}" class="{{ request()->route()->getName() === 'patient.treatmentHistory' ? 'block p-2 bg-gray-700 text-white rounded' : 'block p-2 hover:bg-gray-700 hover:text-white rounded' }}">
                    Treatment History
                </a>
            </li>
            <li class="mb-2">
                <a href="{{route('patient.profile')}}" class="{{ request()->route()->getName() === 'patient.profile' ? 'block p-2 bg-gray-700 text-white rounded' : 'block p-2 hover:bg-gray-700 hover:text-white rounded' }}">
                    Profile
                </a>
            </li>
            <!-- Add more sidebar links as needed -->
        </ul>
        
        <!-- Footer -->
        <footer class="mt-auto text-center p-2 text-sm border-2 border-gray-400 rounded-lg">
            <p>Espineli-Paradeza</p>
            <p>Dental Clinic</p>
        </footer>
    </div>
</aside>

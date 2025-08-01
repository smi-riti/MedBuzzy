<div>
    <div x-data="{
        tab: 'about',
        isMobile: window.innerWidth < 768,
        showMobileStats: false,
        showContactModal: false,
        showAppointmentModal: false,
        doctor: {
            name: '{{ $doctor->user->name }}',
            department: '{{ $doctor->department->name ?? 'N/A' }}',
            fee: '{{ $doctor->fee ?? 'N/A' }}',
            experience: '{{ $doctor->experience ?? 'N/A' }}',
            qualification: '{{ is_array($doctor->qualification) ? implode(', ', $doctor->qualification) : $doctor->qualification }}',
            about: '{{ $doctor->about ?? 'Experienced healthcare professional dedicated to providing comprehensive medical care with a patient-centered approach. Committed to staying current with the latest medical advances and treatment options.' }}',
            locations: [{
                name: 'Main Clinic',
                address: '@if($doctor->city && $doctor->state){{ $doctor->city }}, {{ $doctor->state }}, India@else Purnea, Bihar, India @endif',
                phone: '{{ $doctor->user->phone ?? '+91 943-080-8079' }}',
                directions_link: 'https://maps.google.com/?q=@if($doctor->city && $doctor->state){{ urlencode($doctor->city . ', ' . $doctor->state . ', India') }}@else Purnea,Bihar,India @endif'
            }],
            services: [
                { name: 'General Consultation', description: 'Comprehensive health assessment and medical consultation.' },
                { name: 'Health Screening', description: 'Preventive health checkups and early disease detection.' },
                { name: 'Treatment Planning', description: 'Personalized treatment plans based on individual needs.' },
                { name: 'Follow-up Care', description: 'Ongoing monitoring and care coordination.' }
            ]
        },
        activeLocation: 0,
        showAllServices: false,
        init() {
            this.isMobile = window.innerWidth < 768;
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 768;
            });
        }
    }" 
    x-init="init()"
    class="min-h-screen bg-gray-50 relative overflow-hidden">
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-teal-100/30 to-transparent"></div>
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-teal-200 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute top-1/2 -left-32 w-80 h-80 bg-teal-300 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-teal-400 rounded-full opacity-20 blur-3xl"></div>
        </div>
        
        <div class="relative z-10">
            <!-- Mobile Header with Back Button -->
            <div class="md:hidden bg-white/95 backdrop-blur-sm border-b border-gray-200 sticky top-0 z-50">
                <div class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        <button onclick="history.back()" 
                            class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <div class="flex-1 min-w-0">
                            <h1 class="text-lg font-bold text-gray-900 truncate">Dr. {{ $doctor->user->name }}</h1>
                            <p class="text-sm text-teal-600 truncate">{{ $doctor->department->name ?? 'General Medicine' }}</p>
                        </div>
                        <button @click="showMobileStats = !showMobileStats"
                            class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Mobile Quick Stats Dropdown -->
                    <div x-show="showMobileStats" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-1"
                         class="grid grid-cols-2 gap-3 mt-4">
                        <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-xl p-3 border border-teal-200">
                            <div class="text-xl font-bold text-teal-700">{{ number_format($averageRating, 1) }}</div>
                            <div class="text-xs text-teal-600">Rating</div>
                        </div>
                        <div class="bg-gradient-to-r from-teal-100 to-teal-200 rounded-xl p-3 border border-teal-300">
                            <div class="text-xl font-bold text-teal-800">{{ $countFeedback }}</div>
                            <div class="text-xs text-teal-700">Reviews</div>
                        </div>
                        <div class="bg-gradient-to-r from-teal-200 to-teal-300 rounded-xl p-3 border border-teal-400">
                            <div class="text-xl font-bold text-teal-900">₹{{ $doctor->fee }}</div>
                            <div class="text-xs text-teal-800">Consultation</div>
                        </div>
                        <div class="bg-gradient-to-r from-teal-300 to-teal-400 rounded-xl p-3 border border-teal-500">
                            <div class="text-xl font-bold text-white">{{ $doctor->experience ?? '5+' }} yrs</div>
                            <div class="text-xs text-teal-100">Experience</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mx-auto max-w-7xl px-4 py-6">
                <!-- Doctor Profile Header -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
                    <!-- Header Background -->
                    <div class="bg-gradient-to-r from-teal-400 to-teal-600 h-32 md:h-40 relative">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    
                    <div class="relative px-6 pb-6">
                        <!-- Doctor Image and Basic Info -->
                        <div class="flex flex-col md:flex-row gap-6 items-start md:items-end -mt-16 md:-mt-20">
                            <!-- Doctor Image -->
                            <div class="relative self-center md:self-start flex-shrink-0">
                                <div class="relative group">
                                    @if ($doctor->image)
                                        <img src="{{ $doctor->image }}"
                                            alt="Dr. {{ $doctor->user->name }}"
                                            class="w-32 h-32 md:w-40 md:h-40 rounded-2xl border-4 border-white object-cover shadow-2xl group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-32 h-32 md:w-40 md:h-40 rounded-2xl bg-gradient-to-br from-teal-100 to-teal-300 border-4 border-white flex items-center justify-center shadow-2xl group-hover:scale-105 transition-transform duration-300">
                                            <span class="text-4xl md:text-5xl font-bold text-teal-700">
                                                {{ substr($doctor->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    <!-- Verified Badge -->
                                    <div class="absolute -bottom-2 -right-2 bg-green-500 text-white rounded-full p-2 shadow-lg">
                                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Doctor Info -->
                            <div class="flex-grow text-center md:text-left">
                                <div class="mb-4">
                                    <h1 class="text-2xl md:text-4xl font-bold text-gray-900 mb-2">Dr. {{ $doctor->user->name }}</h1>
                                    <p class="text-lg text-teal-600 font-medium mb-2">{{ $doctor->department->name ?? 'General Medicine' }}</p>
                                    @if($doctor->qualification)
                                        <p class="text-gray-600">
                                            {{ is_array($doctor->qualification) ? implode(', ', $doctor->qualification) : $doctor->qualification }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Rating and Reviews -->
                                <div class="flex flex-col md:flex-row md:items-center gap-4 mb-4">
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <div class="flex text-amber-400">
                                            @php
                                                $avgRating = $averageRating ?? 0;
                                                $fullStars = floor($avgRating);
                                                $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                            @endphp

                                            {{-- Full Stars --}}
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor

                                            {{-- Half Star --}}
                                            @if ($hasHalfStar)
                                                <div class="relative w-5 h-5">
                                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <svg class="absolute top-0 left-0 w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20" style="clip-path: inset(0 50% 0 0)">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                </div>
                                            @endif

                                            {{-- Empty Stars --}}
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <p class="text-gray-600">Based on {{ $countFeedback }} {{ $countFeedback == 1 ? 'review' : 'reviews' }}</p>
                                    </div>
                                </div>

                                <!-- Contact Buttons -->
                                <div class="hidden md:flex gap-4 mb-4">
                                    <button @click="showContactModal = true" 
                                            class="bg-teal-500 hover:bg-teal-600 text-white py-2 px-6 rounded-lg inline-flex items-center gap-2 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Contact
                                    </button>
                                    <a wire:navigate href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                                       class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-6 rounded-lg inline-flex items-center gap-2 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Book Appointment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-8">
                    <div class="flex overflow-x-auto scrollbar-hide">
                        <button @click="tab = 'about'" 
                                :class="tab === 'about' ? 'bg-teal-500 text-white' : 'text-gray-600 hover:bg-gray-50'"
                                class="flex-shrink-0 px-6 py-4 font-medium transition-colors min-w-fit">
                            About
                        </button>
                        <button @click="tab = 'availability'" 
                                :class="tab === 'availability' ? 'bg-teal-500 text-white' : 'text-gray-600 hover:bg-gray-50'"
                                class="flex-shrink-0 px-6 py-4 font-medium transition-colors min-w-fit">
                            Availability
                        </button>
                        <button @click="tab = 'location'" 
                                :class="tab === 'location' ? 'bg-teal-500 text-white' : 'text-gray-600 hover:bg-gray-50'"
                                class="flex-shrink-0 px-6 py-4 font-medium transition-colors min-w-fit">
                            Location
                        </button>
                        <button @click="tab = 'reviews'" 
                                :class="tab === 'reviews' ? 'bg-teal-500 text-white' : 'text-gray-600 hover:bg-gray-50'"
                                class="flex-shrink-0 px-6 py-4 font-medium transition-colors min-w-fit">
                            Reviews
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="space-y-8">
                    <!-- About Section -->
                    <div x-show="tab === 'about'" x-transition class="bg-white rounded-xl shadow-md border border-gray-200 p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            About Dr. {{ $doctor->user->name }}
                        </h2>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- About Text -->
                            <div class="lg:col-span-2">
                                <div class="prose prose-lg max-w-none">
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ $doctor->about ?? 'Experienced healthcare professional dedicated to providing comprehensive medical care with a patient-centered approach. Committed to staying current with the latest medical advances and treatment options.' }}
                                    </p>
                                </div>

                                <!-- Services -->
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Services Offered</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-data="{ showAll: false }">
                                        <template x-for="(service, index) in doctor.services" :key="index">
                                            <div x-show="showAll || index < 4" 
                                                 class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg p-4 border border-teal-200">
                                                <h4 x-text="service.name" class="font-medium text-teal-800 mb-2"></h4>
                                                <p x-text="service.description" class="text-sm text-teal-700"></p>
                                            </div>
                                        </template>
                                        <button x-show="!showAll && doctor.services.length > 4" 
                                                @click="showAll = true"
                                                class="bg-gray-100 hover:bg-gray-200 rounded-lg p-4 border border-gray-200 text-gray-600 hover:text-gray-800 transition-colors">
                                            <span class="font-medium">Show More Services</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Stats -->
                            <div class="space-y-6">
                                <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl p-6 border border-teal-200">
                                    <h3 class="font-semibold text-teal-800 mb-4">Quick Stats</h3>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-teal-700">Experience</span>
                                            <span class="font-semibold text-teal-800">{{ $doctor->experience ?? '5+' }} years</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-teal-700">Consultation Fee</span>
                                            <span class="font-semibold text-teal-800">₹{{ $doctor->fee }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-teal-700">Average Rating</span>
                                            <span class="font-semibold text-teal-800">{{ number_format($averageRating, 1) }}/5</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-teal-700">Total Reviews</span>
                                            <span class="font-semibold text-teal-800">{{ $countFeedback }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rating Breakdown -->
                                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                                    <h3 class="font-semibold text-gray-800 mb-4">Rating Breakdown</h3>
                                    <div class="space-y-2">
                                        @php
                                            $ratingCounts = $doctor->reviews()
                                                ->where('approved', true)
                                                ->selectRaw('rating, count(*) as count')
                                                ->groupBy('rating')
                                                ->pluck('count', 'rating')
                                                ->toArray();

                                            // Calculate percentages for star ratings
                                            $percentages = [];
                                            for ($i = 5; $i >= 1; $i--) {
                                                $count = $ratingCounts[$i] ?? 0;
                                                $percentages[$i] = $countFeedback > 0 ? ($count / $countFeedback) * 100 : 0;
                                            }
                                        @endphp

                                        @for ($i = 5; $i >= 1; $i--)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm text-gray-600 w-10">{{ $i }} stars</span>
                                                <div class="flex-1 bg-gray-200 rounded-full h-2.5">
                                                    <div class="bg-teal-600 h-2.5 rounded-full" style="width: {{ $percentages[$i] }}%"></div>
                                                </div>
                                                <span class="text-sm text-gray-600 w-8">{{ number_format($percentages[$i]) }}%</span>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Availability Section -->
                    <div x-show="tab === 'availability'" x-transition class="bg-white rounded-xl shadow-md border border-gray-200 p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Availability & Schedule 
                        </h2>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Weekly Schedule -->
                            <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl p-6 border border-teal-200">
                                <h3 class="font-semibold text-teal-800 mb-4">Weekly Schedule</h3>
                                <div class="space-y-3">
                                    @php
                                        $availableDays = is_array($doctor->available_days) 
                                            ? $doctor->available_days 
                                            : (is_string($doctor->available_days) 
                                                ? json_decode($doctor->available_days, true) ?? []
                                                : []);
                                        $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                        $today = date('l');
                                    @endphp

                                    @foreach ($allDays as $day)
                                        @php
                                            $isAvailable = in_array($day, $availableDays);
                                            $isToday = $day === $today;
                                        @endphp
                                        <div class="flex items-center justify-between p-3 rounded-lg {{ $isToday ? 'bg-white shadow-md border-2 border-teal-300' : ($isAvailable ? 'bg-white border border-teal-100' : 'bg-gray-50 border border-gray-100') }}">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $isAvailable ? 'bg-teal-100 text-teal-600' : 'bg-gray-200 text-gray-500' }}">
                                                    <span class="font-medium text-sm">{{ substr($day, 0, 3) }}</span>
                                                </div>
                                                <div>
                                                    <div class="font-medium {{ $isAvailable ? 'text-teal-800' : 'text-gray-500' }}">
                                                        {{ $day }}
                                                        @if ($isToday)
                                                            <span class="ml-2 bg-teal-500 text-white text-xs px-2 py-0.5 rounded-full">Today</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="{{ $isAvailable ? 'text-teal-600 font-medium' : 'text-gray-400' }}">
                                                    {{ $isAvailable ? '9:00 AM - 6:00 PM' : 'Closed' }}
                                                </div>
                                                @if ($isAvailable)
                                                    <span class="text-xs bg-teal-100 text-teal-800 px-2 py-0.5 rounded-full">Available</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Appointment Info -->
                            <div class="space-y-6">
                                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                                    <h3 class="font-semibold text-green-800 mb-4 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Appointment Information
                                    </h3>
                                    <div class="space-y-3 text-green-700">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>30-minute consultations</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span>₹{{ $doctor->fee }} consultation fee</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>Same-day appointments available</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl p-6 border border-amber-200">
                                    <h3 class="font-semibold text-amber-800 mb-3 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Emergency Contact
                                    </h3>
                                    <p class="text-amber-700">
                                        For medical emergencies outside of business hours, please call
                                        <span class="font-semibold">{{ $doctor->user->phone ?? '+91 943-080-8079' }}</span>
                                        and follow the prompts to reach the on-call provider.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Section -->
                    <div x-show="tab === 'location'" x-transition class="bg-white rounded-xl shadow-md border border-gray-200 p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Clinic Locations
                        </h2>

                        <div class="space-y-6">
                            <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-xl p-6 border border-teal-200">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="text-lg font-semibold text-teal-800 mb-2">Main Clinic</h3>
                                        <p class="text-teal-700 mb-3">
                                            @if($doctor->city && $doctor->state)
                                                {{ $doctor->city }}, {{ $doctor->state }}, India
                                                @if($doctor->pincode)
                                                    <br><span class="text-sm text-teal-600">PIN: {{ $doctor->pincode }}</span>
                                                @endif
                                            @else
                                                Purnea, Bihar, India
                                            @endif
                                        </p>
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <a href="tel:{{ $doctor->user->phone ?? '+91 943-080-8079' }}" 
                                               class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                Call
                                            </a>
                                            <a href="https://maps.google.com/?q=@if($doctor->city && $doctor->state){{ urlencode($doctor->city . ', ' . $doctor->state . ', India') }}@else Purnea,Bihar,India @endif" 
                                               target="_blank"
                                               class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                </svg>
                                                Directions
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div x-show="tab === 'reviews'" x-transition class="bg-white rounded-xl shadow-md border border-gray-200 p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Patient Reviews
                        </h2>
                        
                        <!-- Reviews List -->
                        <div class="space-y-6">
                            @forelse($approvedReviews as $review)
                                <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 hover:border-teal-300 transition-colors duration-200">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="font-medium text-gray-800">{{ $review->user->name }}</h3>
                                            <div class="flex text-amber-400 mt-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <span class="text-gray-500 text-sm">{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <p class="text-gray-600">{{ $review->comment }}</p>
                                </div>
                            @empty
                                <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    <h3 class="mt-2 text-xl font-medium text-gray-600">No Reviews Yet</h3>
                                    <p class="mt-1 text-gray-500">Be the first to share your experience with Dr. {{ $doctor->user->name }}</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Add Review Button -->
                        <div class="mt-6 text-center">
                            @auth
                                <button wire:click="$dispatch('openReviewModal', {doctorId: {{ $doctor->id }}})" 
                                        class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-6 rounded-lg inline-flex items-center gap-2 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    Write a Review
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-6 rounded-lg inline-flex items-center gap-2 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Login to Write a Review
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Modal -->
        <div x-show="showContactModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
             @click.self="showContactModal = false">
            <div class="bg-white rounded-2xl p-6 max-w-md w-full">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Contact Dr. {{ $doctor->user->name }}</h3>
                    <button @click="showContactModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="space-y-4">
                    <a href="tel:{{ $doctor->user->phone ?? '+919430808079' }}" 
                       class="flex items-center gap-3 p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Call Now</div>
                            <div class="text-sm text-gray-600">{{ $doctor->user->phone ?? '+91 943-080-8079' }}</div>
                        </div>
                    </a>
                    
                    <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $doctor->user->phone ?? '919430808079') }}" 
                       target="_blank"
                       class="flex items-center gap-3 p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.309"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">WhatsApp</div>
                            <div class="text-sm text-gray-600">Send a message</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Floating Action Button (Mobile) -->
        <div class="fixed bottom-6 right-6 z-50 md:hidden">
            <a wire:navigate href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                class="bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white p-4 rounded-full shadow-2xl flex items-center justify-center group transition-all duration-200 transform hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </a>
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Enhanced mobile tap targets */
        @media (max-width: 768px) {
            button, a {
                min-height: 44px;
            }
        }

        /* Smooth scroll behavior for better UX */
        html {
            scroll-behavior: smooth;
        }

        /* Custom backdrop blur for older browsers */
        .backdrop-blur-fallback {
            background-color: rgba(255, 255, 255, 0.85);
        }

        /* Enhanced focus states for accessibility */
        button:focus, a:focus {
            outline: 2px solid #14b8a6;
            outline-offset: 2px;
        }

        /* Smooth transitions for all interactive elements */
        button, a, .transition-all {
            transition: all 0.2s ease-in-out;
        }

        /* Loading animation for images */
        .doctor-image {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Floating action button animation */
        .floating-btn {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        /* Custom shadow for depth */
        .custom-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 128, 128, 0.1), 0 10px 10px -5px rgba(0, 128, 128, 0.04);
        }

        /* Gradient text effect */
        .gradient-text {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</div>

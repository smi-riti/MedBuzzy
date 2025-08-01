<div>
    <div>
        <section
            class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-teal-50 pt-8 pb-16 md:pt-16 md:pb-24">
            <!-- Decorative Background Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-20 right-20 w-32 h-32 bg-teal-200 rounded-full opacity-20 animate-pulse"></div>
                <div class="absolute bottom-20 left-20 w-24 h-24 bg-orange-200 rounded-full opacity-30"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-200 rounded-full opacity-25"></div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">
                    <!-- Hero Content -->
                    <div class="flex-1 text-center lg:text-left space-y-6 lg:space-y-8">
                        <div class="space-y-4">
                            <div
                                class="inline-flex items-center px-4 py-2 bg-teal-100 text-teal-700 rounded-full text-sm font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Trusted Healthcare Platform
                            </div>

                            <h1 class="text-3xl sm:text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                                Your Health,
                                <span class="text-teal-600">Simplified</span>
                            </h1>

                            <p class="text-lg sm:text-xl text-gray-600 max-w-lg mx-auto lg:mx-0 leading-relaxed">
                                Connect with trusted doctors, book appointments instantly, and manage your healthcare
                                journey all in one place.
                            </p>
                        </div>

                        <!-- Search Bar -->
                        <div class="bg-white p-4 rounded-2xl border border-gray-100 max-w-2xl mx-auto lg:mx-0">
                            <form wire:submit.prevent="search" class="space-y-4">
                                <!-- Location and Specialty Row -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Location -->
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <select name="location" wire:model="location" disabled
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 bg-gray-50 rounded-lg text-gray-600 text-sm">
                                            <option value="purnea">📍 Purnea, Bihar</option>
                                        </select>
                                    </div>

                                    <!-- Specialty -->
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <select name="specialty" wire:model.live="selectedDepartment"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 bg-white rounded-lg text-gray-700 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                            <option value="">All Specialties</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Search Input Row -->
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" wire:model.live="searchQuery"
                                        placeholder="Search doctors by name or specialty..."
                                        class="w-full pl-12 pr-32 py-4 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                    <button type="submit"
                                        class="absolute inset-y-0 right-0 px-6 py-2 m-1 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500">
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a wire:navigate href="{{ route('appointment') }}"
                                class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:from-orange-600 hover:to-red-600 transition-all duration-200 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>Book Appointment</span>
                            </a>
                            <a href="#emergency"
                                class="border-2 border-teal-600 text-teal-600 hover:bg-teal-50 px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-200 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                <span>Emergency Care</span>
                            </a>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 pt-8">
                            <div class="text-center">
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $totalDoctors }}+</div>
                                <div class="text-sm text-gray-600">Expert Doctors</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $totalPatients }}+</div>
                                <div class="text-sm text-gray-600">Happy Patients</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900">24/7</div>
                                <div class="text-sm text-gray-600">Support</div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Image -->
                    <div class="flex-1 w-full max-w-lg lg:max-w-none">
                        <div x-data="{
                            doctors: @js($doctors),
                            current: 0,
                            transitioning: false,
                            goTo(idx) {
                                if (this.transitioning || idx === this.current) return;
                                this.transitioning = true;
                                this.current = idx;
                                setTimeout(() => { this.transitioning = false }, 350);
                            },
                            next() {
                                if (this.transitioning) return;
                                this.transitioning = true;
                                this.current = (this.current + 1) % this.doctors.length;
                                setTimeout(() => { this.transitioning = false }, 350);
                            },
                            prev() {
                                if (this.transitioning) return;
                                this.transitioning = true;
                                this.current = (this.current - 1 + this.doctors.length) % this.doctors.length;
                                setTimeout(() => { this.transitioning = false }, 350);
                            }
                        }" class="relative">
                            <div class="bg-teal-100 rounded-3xl p-8 lg:p-12">
                                <div class="relative h-[340px]">
                                    @foreach ($doctors as $index => $doctor)
                                        <div x-show="current === {{ $index }}"
                                            x-transition:enter="transition-opacity duration-300"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition-opacity duration-200"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            class="absolute inset-0 bg-white rounded-2xl p-4 sm:p-6 space-y-3 sm:space-y-4"
                                            style="will-change: opacity, transform;">
                                            <div class="flex items-center gap-2 sm:gap-3">
                                                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-teal-100 rounded-full flex items-center justify-center overflow-hidden border-2 border-white shadow-sm">
                                                    @if ($doctor->image)
                                                        <img src="{{ $doctor->image }}"
                                                            alt="{{ $doctor->user->name }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <span
                                                            class="text-xl sm:text-2xl font-bold text-teal-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="font-semibold text-gray-900 text-base sm:text-lg truncate">{{ $doctor->user->name }}</div>
                                                    <div class="text-xs sm:text-sm text-teal-600 font-medium truncate">{{ $doctor->department->name ?? 'General Medicine' }}</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="flex text-yellow-400 justify-end mb-1">
                                                        @php
                                                            $avgRating = $doctor->reviews_avg_rating ?? 0;
                                                            $fullStars = floor($avgRating);
                                                            $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                                            $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                                        @endphp

                                                        {{-- Full Stars --}}
                                                        @for ($i = 0; $i < $fullStars; $i++)
                                                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                </path>
                                                            </svg>
                                                        @endfor

                                                        {{-- Half Star --}}
                                                        @if ($hasHalfStar)
                                                            <div class="relative w-3 h-3 sm:w-4 sm:h-4">
                                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-300" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                                <svg class="absolute top-0 left-0 w-3 h-3 sm:w-4 sm:h-4 text-yellow-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    style="clip-path: inset(0 50% 0 0)">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        @endif

                                                        {{-- Empty Stars --}}
                                                        @for ($i = 0; $i < $emptyStars; $i++)
                                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-300" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                </path>
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                    <div class="text-[10px] sm:text-xs text-gray-500">
                                                        @if ($avgRating > 0)
                                                            {{ number_format($avgRating, 1) }}
                                                            @if ($doctor->reviews_count > 0)
                                                                ({{ $doctor->reviews_count }})
                                                            @endif
                                                        @else
                                                            No ratings
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-y-3">
                                                <div class="text-xs sm:text-sm text-gray-700 font-medium">Next Available:</div>
                                                <div class="bg-teal-50 rounded-lg p-2 sm:p-3 border border-teal-100">
                                                    @php
                                                        $availableDays = is_array($doctor->available_days)
                                                            ? $doctor->available_days
                                                            : (is_string($doctor->available_days)
                                                                ? json_decode($doctor->available_days, true) ?? []
                                                                : []);

                                                        $nextSlot = null;
                                                        if (!empty($availableDays)) {
                                                            $today = date('l'); // Current day name
                                                            $currentHour = date('H');

                                                            // Check if doctor is available today and it's before 5 PM
    if (in_array($today, $availableDays) && $currentHour < 17) {
        $nextSlot = ['day' => 'Today', 'time' => '2:30 PM'];
    } else {
        // Find next available day
        $daysOfWeek = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ];
        $todayIndex = array_search($today, $daysOfWeek);

        for ($i = 1; $i <= 7; $i++) {
            $nextDayIndex = ($todayIndex + $i) % 7;
            $nextDay = $daysOfWeek[$nextDayIndex];

            if (in_array($nextDay, $availableDays)) {
                if ($i === 1) {
                    $nextSlot = [
                        'day' => 'Tomorrow',
                        'time' => '9:00 AM',
                    ];
                } else {
                    $nextDate = date(
                        'M j',
                        strtotime("+{$i} days"),
                    );
                    $nextSlot = [
                        'day' => $nextDate,
                        'time' => '9:00 AM',
                    ];
                }
                break;
            }
        }
    }
}

if (!$nextSlot) {
    $nextSlot = [
        'day' => 'Contact for',
        'time' => 'availability',
                                                            ];
                                                        }
                                                    @endphp

                                                    <div class="font-medium text-xs sm:text-sm text-teal-800">{{ $nextSlot['day'] }}, {{ $nextSlot['time'] }}</div>
                                                    <div class="text-[10px] sm:text-xs text-teal-600">₹{{ $doctor->fee ?? 500 }} consultation</div>
                                                </div>

                                                <div class="grid grid-cols-2 gap-2 text-sm">
                                                    <div class="bg-gray-50 rounded p-1 sm:p-2 text-center">
                                                        <div class="font-medium text-gray-800 text-xs sm:text-sm">{{ $doctor->experience ?? '5+' }} yrs</div>
                                                        <div class="text-[9px] sm:text-xs text-gray-500">Experience</div>
                                                    </div>
                                                    <div class="bg-gray-50 rounded p-1 sm:p-2 text-center">
                                                        <div class="font-medium text-gray-800 text-xs sm:text-sm">
                                                            @if (!empty($availableDays))
                                                                {{ count($availableDays) }} days
                                                            @else
                                                                By Appt
                                                            @endif
                                                        </div>
                                                        <div class="text-[9px] sm:text-xs text-gray-500">Available</div>
                                                    </div>
                                                </div>

                                                <a href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                                                    class="w-full block bg-teal-600 text-white py-2 sm:py-3 rounded-lg font-medium hover:bg-teal-700 transition-colors text-center text-sm sm:text-base">
                                                    Book Appointment
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Carousel Controls -->
                            <button @click="prev" :disabled="transitioning"
                                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white border border-teal-200 rounded-full p-1 sm:p-2 shadow hover:bg-teal-50 transition -translate-x-1/2 disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button @click="next" :disabled="transitioning"
                                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white border border-teal-200 rounded-full p-1 sm:p-2 shadow hover:bg-teal-50 transition translate-x-1/2 disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            <!-- Dots -->
                            <div class="flex justify-center gap-2 mt-4">
                                @foreach ($doctors as $index => $doctor)
                                    <button @click="goTo({{ $index }})"
                                        :class="current === {{ $index }} ? 'bg-teal-600' : 'bg-teal-200'"
                                        :disabled="transitioning"
                                        class="w-3 h-3 rounded-full transition-all duration-200"></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </section>
</div>

</div>
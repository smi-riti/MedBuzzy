<div>
    @if($show)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white w-full max-w-2xl p-6 rounded-lg relative">
                <button wire:click="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                    &times;
                </button>

                <h2 class="text-xl font-semibold mb-4">Create New Manager</h2>

                <form wire:submit.prevent="saveManager">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" wire:model="name" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500">
                            @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" wire:model="email" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500">
                            @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="text" wire:model="phone" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500">
                            @error('phone') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" wire:model="address" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500">
                            @error('address') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select wire:model="gender" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('gender') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" wire:model="dob" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500">
                            @error('dob') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select wire:model="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                        </div>

                <!-- Photo -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
    
    <!-- Show image preview if available -->
    @if($photo)
        <div class="mb-2">
            <img src="{{ $photo->temporaryUrl() }}" class="h-20 w-20 object-cover rounded-lg">
            <div wire:loading wire:target="photo" class="mt-1 text-sm text-gray-500">
                Processing image...
            </div>
        </div>
    @endif
    
    <input 
        type="file" 
        wire:model="photo" 
        accept="image/*"
        class="w-full border border-gray-300 rounded-lg text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100"
    >
    
    @error('photo') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
    
    <!-- Show the final ImageKit URL after upload -->
    @if($imageUrl)
        <div class="mt-2 text-xs text-gray-500">
            Image will be saved to: {{ \Illuminate\Support\Str::limit($imageUrl, 50) }}
        </div>
    @endif
</div>

                    <!-- Form buttons -->
                  <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                            Create Manager
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @script
    <script>
        Livewire.on('open-manager-modal', () => {
            @this.openModal();
        });
    </script>
    @endscript
</div>
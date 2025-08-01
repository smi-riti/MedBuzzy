<?php

namespace App\Livewire\Doctor\Section\Manager;

use Livewire\Component;
use App\Models\Manager;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Title('Edit Manager')]
class EditModal extends Component
{
    use WithFileUploads;

    public $show = false, $managerId;

    public $name, $email, $phone, $address, $gender, $dob, $status, $photo, $tempPhoto;

    protected $listeners = ['openEditModal'];

    public function openEditModal($managerId)
    {
        $this->resetForm();
        $this->managerId = $managerId;
        $this->loadManagerData();
        $this->show = true;
    }

  protected function loadManagerData()
{
    $manager = Manager::with('user')->findOrFail($this->managerId);

    $this->name = $manager->user->name;
    $this->email = $manager->user->email;
    $this->phone = $manager->user->phone;
    $this->address = $manager->address;
    $this->gender = $manager->gender;
    $this->dob = $manager->dob ? $manager->dob->format('Y-m-d') : '';
    $this->status = $manager->status;
    $this->tempPhoto = $manager->photo_url;
}

 public function updateManager()
{
    $manager = Manager::with('user')->findOrFail($this->managerId);

    $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$manager->user->id,
        'phone' => 'nullable|string|max:20|regex:/^[\d\-\+\(\) ]+$/',
        'address' => 'required|string|max:500',
        'gender' => 'required|in:male,female,other',
        'dob' => 'required|date|before_or_equal:today',
        'status' => 'required|in:active,inactive',
        'photo' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
    ]);

    try {
        // Update user data
        $manager->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        // Handle photo upload
        $photoPath = $manager->photo;
        if ($this->photo) {
            // Delete old photo if exists
            if ($manager->photo && Storage::disk('public')->exists($manager->photo)) {
                Storage::disk('public')->delete($manager->photo);
            }
            $photoPath = $this->photo->store('manager_photos', 'public');
        }

        // Update manager data
        $manager->update([
            'address' => $this->address,
            'photo' => $photoPath,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'status' => $this->status,
        ]);

        // Close modal and refresh
        $this->closeModal();
        $this->dispatch('refreshManagers');
        
        return redirect()->route('doctor.manager-list')
            ->with('success', 'Manager updated successfully!');

    } catch (\Exception $e) {
        $this->addError('updateError', 'Failed to update manager: ' . $e->getMessage());
    }
}

    public function closeModal()
    {
        $this->resetForm();
        $this->show = false;
    }

    public function resetForm()
    {
        $this->reset([
            'show', 'managerId', 'name', 'email', 'phone',
            'address', 'gender', 'dob', 'status', 'photo', 'tempPhoto'
        ]);
           $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.doctor.section.manager.edit-modal');
    }
}

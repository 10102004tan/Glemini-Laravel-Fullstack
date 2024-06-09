<?php

namespace App\Livewire;
use Livewire\WithFileUploads;

use Livewire\Component;

class ImageUpload extends Component
{
    public $image;

    public function mount($image=null)
    {
        $this->image = $image;
    }

    public function save()
    {
        $this->validate([
            'image' => 'image|max:1024', // 1MB Max
        ]);

        // 
        $this->image->store('images', 'public');
        $this->reset('image');
        $this->dispatch('toast',message: 'Cập nhât thumb thành công',status: 'success');
    }

    public function render()
    {
        return view('livewire.image-upload');
    }
}

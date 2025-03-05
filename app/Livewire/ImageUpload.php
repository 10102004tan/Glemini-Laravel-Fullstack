<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use Livewire\Component;

class ImageUpload extends Component
{
    use WithFileUploads;
    public $isShow = false;
    public $banner;
    public $quiz;

    public function mount($quiz=null)
    {
        $this->quiz = $quiz;
    }

    public function showModal(){
        $this->isShow = true;
    }

    public function hiddenModal(){
        $this->isShow = false;
    }

    public function save(){
        $this->validate([
            'banner' => 'image|max:1024', // 1MB Max
        ]);
        $path = $this->banner->store('images', 'public');
        if ($this->quiz->thumb != null) {
            Storage::disk('public')->delete($this->quiz->thumb);
        }
        $this->quiz->thumb = $path;
        $this->quiz->save();
        $this->dispatch('toast',message: 'Cập nhật banner thành công',status: 'success');
        $this->isShow = false;
    }
    public function render()
    {
        return view('livewire.image-upload');
    }
}

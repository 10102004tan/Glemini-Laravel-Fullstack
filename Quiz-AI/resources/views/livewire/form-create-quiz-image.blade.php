<form wire:submit="store" id="modal-show-option-image" class="modal-show-option-image" wire:ignore>
    <input type="file" wire:model="imageInput" />
    <button>Test</button>
    <span wire:loading wire:target="store">Uploading...</span>
</form>
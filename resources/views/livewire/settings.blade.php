<?php

use Livewire\Volt\Component;
use App\Models\Setting;

new class extends Component {
    public $clicks;
    public $is_active;

    public function mount()
    {
        // Initialize the properties using the database in the mount method
        $clickSetting = Setting::where('name', 'clicks')->first();
        $isActiveSetting = Setting::where('name', 'is_active')->first();

        $this->clicks = $clickSetting ? $clickSetting->value : 0;
        $this->is_active = $isActiveSetting ? $isActiveSetting->value : false;
    }

    public function boot()
    {
        // Initialize the properties using the database in the boot method
        $clickSetting = Setting::where('name', 'clicks')->first();
        $isActiveSetting = Setting::where('name', 'is_active')->first();

        $this->clicks = $clickSetting ? $clickSetting->value : 0;
        $this->is_active = $isActiveSetting ? $isActiveSetting->value : false;
    }

    public function incrementClicks()
    {
        $this->clicks++;
        Setting::where('name', 'clicks')
            ->first()
            ->update(['value' => $this->clicks]);
    }

    public function toggleIsActive()
    {
        $this->is_active = !$this->is_active;
        Setting::where('name', 'is_active')
            ->first()
            ->update(['value' => $this->is_active]);
    }
};
?>

<div wire:poll.1000ms>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Settings</h1>
        </div>
    </div>

    <div class="mt-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold">Clicks</h2>
            </div>
            <div>
                <button wire:click="incrementClicks" class="px-4 py-2 bg-blue-500 text-white rounded">Clicks:
                    {{ $clicks }}</button>
            </div>

            <div>
                <h2 class="text-lg font-bold">Toggle</h2>

                <button wire:click="toggleIsActive"
                    class="px-4 py-2 bg-blue-500 text-white rounded">{{ $is_active ? 'Disable' : 'Enable' }}</button>


            </div>
        </div>
    </div>
</div>

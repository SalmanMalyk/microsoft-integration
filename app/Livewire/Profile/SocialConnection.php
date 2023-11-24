<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class SocialConnection extends Component
{
    public function connect(string $service) {
        return redirect()->to("social/{$service}/connect");    
    }

    public function logout(string $service) {
        if ($service == 'microsoft') {
            auth()->user()->microsoftToken()->delete();

            return redirect()->to('/user/profile'); 
        }
    }

    public function render()
    {
        return view('livewire.profile.social-connection');
    }
}

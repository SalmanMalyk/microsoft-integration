<?php

namespace App\Livewire;

use App\Models\Email;
use Livewire\Component;
use App\Actions\Email\SyncEmail;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Http\Request;

class EmailList extends Component
{
    public $openSendEmail = false;

    public $subject;
    public $email;
    public $message;

    protected $rules = [
        'subject' => 'required|string',
        'email' => 'required|email',
        'message' => 'required'
    ];

    public function sendEmailNow(): void
    {
        $this->validate();

        MsGraph::emails()
            ->to([$this->email])
            ->subject($this->subject)
            ->body($this->message)
            ->send();

        $this->email = null;
        $this->subject = null;
        $this->message = null;


        $this->openSendEmail = false;
    }

    public function syncEmail(SyncEmail $syncEmail)
    {
        $emails = MsGraph::emails()->get();
        $syncEmail->save($emails['value']);

        session()->flash('success', 'Emails sync successfully.');

        return redirect()->to('/email');
    }

    public function render()
    {
        $emails = Email::where('user_id', auth()->id())->orderBy('received_at', 'DESC')->paginate(25);
        // dd($emails);
        return view('livewire.email-list', [
            'emails' => $emails
        ]);
    }
}

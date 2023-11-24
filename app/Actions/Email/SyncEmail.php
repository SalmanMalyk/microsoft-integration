<?php

namespace App\Actions\Email;

use App\Models\Email;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class SyncEmail
{
    final public function save($emails): void
    {
        if (count($emails) > 0 && !empty($emails)) {
            DB::transaction(function () use ($emails) {
                foreach ($emails as $email) {
                    $microsoftEmailId = $email['id'];

                    Email::firstOrCreate(['microsoft_email_id' => $microsoftEmailId, 'user_id' => auth()->id()], [
                        'to'          => $email['toRecipients'],
                        'from'        => $email['from']['emailAddress'],
                        'subject'     => $email['subject'],
                        'web_link'    => $email['webLink'],
                        'message'     => nl2br($email['bodyPreview']),

                        'sent_at'     => Carbon::parse($email['sentDateTime'])->format('Y-m-d H:i:s'),
                        'received_at' => Carbon::parse($email['receivedDateTime'])->format('Y-m-d H:i:s')
                    ]);
                }
            });
        }
    }
}

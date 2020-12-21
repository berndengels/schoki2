<?php

namespace App\Jobs\PayPalWebhooks;

use Spatie\WebhookClient\ProcessWebhookJob as SpatieProcessWebhookJob;

class HandleCheckoutOrderSuccess extends SpatieProcessWebhookJob //  implements ShouldQueue
{
//    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $this->webhookCall // contains an instance of `WebhookCall perform the work here
        // "event_type": "CHECKOUT.ORDER.APPROVED",
        dd($this->webhookCall);
    }
}

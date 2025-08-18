<?php

namespace App\Jobs;

use App\Models\Pizza;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Log;

class NotifyPizzaStatusChange implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    // Maybe set to high priority queue because hungry people get impatient quickly

    /**
     * @var \App\Models\Pizza
     */
    protected $pizza;

    /**
     * Create a new job instance.
     */
    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return $this->pizza->id . '-' . $this->pizza->status->name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send a request to website API
        $secret = env('WEBHOOK_SECRET');
        $payload = json_encode([
            'event' => 'pizza.updated',
            'data' => [
                'pizza_id' => $this->pizza->id,
                'status' => $this->pizza->status->name,
                'updated_at' => $this->pizza->updated_at,
            ],
        ]);

        // Compute HMAC-SHA256 signature
        $signature = hash_hmac('sha256', $payload, $secret);

        // Send webhook request
        $response = Http::withHeaders([
            'X-Signature' => $signature,
        ])->post(env('WEBHOOK_URL_STATUS_UPDATES'), $payload);

        // Should be checked in Horizon but this should suffice
        Log::info('Pizza status update sent to website');
        Log::info($payload);
    }
}

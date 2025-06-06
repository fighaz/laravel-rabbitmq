<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductUpdated implements ShouldQueue
{
    use Queueable;

    private $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product = Product::find($this->data['id']);

        $product->update([
            'title' => $this->data['title'],
            'image' => $this->data['image'],
            'created_at' => $this->data['created_at'],
            'updated_at' => $this->data['updated_at'],
        ]);
    }
}

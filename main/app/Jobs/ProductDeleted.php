<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductDeleted implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    private $id;

    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        //
        $this->id = $id;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Product::destroy($this->id);
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckProductDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:product-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $yesterday = Carbon::yesterday()->toDateString();
        $today = Carbon::today();
        $products = Product::whereDate('end','<', $today)->get();
        foreach ($products as $product)
            {
//                $product->is_active=false;
                $product->delete();
                $this->info('Product ID ' . $product->id . ' status has been updated to false.');


            }

return 0;



    }
}

<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateProductSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:calculate-sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate total sales for each product based on order items';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Calculating product sales...');

        // Calculer les ventes pour chaque produit
        $sales = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->get();

        $updated = 0;
        foreach ($sales as $sale) {
            Product::where('id', $sale->product_id)
                ->update(['total_sales' => $sale->total_quantity]);
            $updated++;
        }

        // Mettre à 0 les produits sans ventes
        Product::whereNotIn('id', $sales->pluck('product_id'))
            ->update(['total_sales' => 0]);

        $this->info("✓ Sales calculated for {$updated} products");
        $this->info('✓ Done!');

        return Command::SUCCESS;
    }
}

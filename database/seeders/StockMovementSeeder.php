<?php

namespace Database\Seeders;

use App\Models\StockMovement;
use Illuminate\Database\Seeder;


class StockMovementSeeder extends Seeder
{
public function run(): void
{
// contoh dummy 12 bulan terakhir
foreach (range(0, 11) as $i) {
$month = now()->subMonths(11 - $i)->startOfMonth();


StockMovement::create([
'type' => 'IN',
'qty' => random_int(30, 120),
'happened_at' => $month->copy()->addDays(5),
]);


StockMovement::create([
'type' => 'OUT',
'qty' => random_int(10, 100),
'happened_at' => $month->copy()->addDays(20),
]);
}
}
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User,Category,Supplier,Product,StockMovement};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);

User::create([
    'name' => 'Manajer Gudang',
    'email' => 'manajer@example.com',
    'password' => Hash::make('password'),
    'role' => 'manager',
]);

User::create([
    'name' => 'Staff Gudang',
    'email' => 'staff@example.com',
    'password' => Hash::make('password'),
    'role' => 'staff',
]);

        // Categories & Suppliers
        $cat = Category::firstOrCreate(['name'=>'Umum'], ['description'=>'Kategori default']);
        $sup = Supplier::firstOrCreate(['name'=>'Default Supplier'], ['address'=>null,'phone'=>null]);

        // Product
        $p = Product::firstOrCreate(['code'=>'SKU-001'], [
            'name'=>'Contoh Produk',
            'category_id'=>$cat->id,
            'supplier_id'=>$sup->id,
            'price_buy'=>10000,
            'price_sell'=>15000,
            'stock'=>10,
            'stock_minimum'=>2,
            'attributes'=>json_encode(['warna'=>'hitam','ukuran'=>'M']), // ✅ JSON string
        ]);


        // Sample movement
        if ($p->wasRecentlyCreated) {
            StockMovement::create([
                'product_id'=>$p->id,
                'type'=>'IN',
                'quantity'=>10,
                'happened_at'=>now(),
                'user_id'=>1,
                'note'=>'Seeder initial stock'
            ]);
        }

\App\Models\Supplier::create([
    'name'    => 'Default Supplier',
    'address' => 'Alamat Default',
    'phone'   => '08123456789',
    'contact' => 'Budi', // isi default agar tidak error
]);


    }
}

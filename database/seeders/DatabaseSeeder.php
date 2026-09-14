<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    /*
        |--------------------------------------------------------------------------
        | Package Types
        |--------------------------------------------------------------------------
        */

    $internet = PackageType::create([
      'code' => 'PT001',
      //'name' => 'Internet',
      'description' => 'Paket layanan internet',
    ]);

    $cctv = PackageType::create([
      'code' => 'PT002',
      //'name' => 'CCTV',
      'description' => 'Paket layanan CCTV',
    ]);

    $hotspot = PackageType::create([
      'code' => 'PT003',
      //'name' => 'Hotspot',
      'description' => 'Paket layanan hotspot',
    ]);

    /*
        |--------------------------------------------------------------------------
        | Packages
        |--------------------------------------------------------------------------
        */

    $package10 = Package::create([
      'code' => 'PK001',
      'package_type_code' => $internet->code,
      'name' => 'Internet 10 Mbps',
      'price' => 100000,
      'speed' => "10 Mbps",
      'description' => 'Paket internet 10 Mbps',
      'status' => '1',
    ]);

    $package20 = Package::create([
      'code' => 'PK002',
      'package_type_code' => $internet->code,
      'name' => 'Internet 20 Mbps',
      'price' => 150000,
      'speed' => "20 Mbps",
      'description' => 'Paket internet 20 Mbps',
      'status' => '1',
    ]);

    $packageCctv = Package::create([
      'code' => 'PK003',
      'package_type_code' => $cctv->code,
      'name' => 'CCTV 4 Camera',
      'price' => 100000,
      'description' => 'Paket CCTV 4 camera',
      'status' => '1',
    ]);

    $packageHotspot = Package::create([
      'code' => 'PK004',
      'package_type_code' => $hotspot->code,
      'name' => 'Hotspot Unlimited',
      'price' => 75000,
      'description' => 'Paket hotspot unlimited',
      'status' => '1',
    ]);

    /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

    $budi = Customer::create([
      'code' => 'C001',
      'name' => 'Budi Santoso',
      'phone' => '081234567890',
      'email' => 'budi@example.com',
      'address' => 'Jl. Mawar No. 10',
      'status' => 'active',
      'installation_date' => '2026-01-10',
    ]);

    $andi = Customer::create([
      'code' => 'C002',
      'name' => 'Andi Wijaya',
      'phone' => '082345678901',
      'email' => 'andi@example.com',
      'address' => 'Jl. Melati No. 20',
      'status' => 'active',
      'installation_date' => '2026-02-15',
    ]);

    $siti = Customer::create([
      'code' => 'C003',
      'name' => 'Siti Aminah',
      'phone' => '083456789012',
      'email' => 'siti@example.com',
      'address' => 'Jl. Kenanga No. 30',
      'status' => 'active',
      'installation_date' => '2026-03-01',
    ]);

    /*
        |--------------------------------------------------------------------------
        | Subscriptions
        |--------------------------------------------------------------------------
        */

    // Budi punya 2 paket
    $subsdBudi1 = Subscription::create([
      'code' => 'SUB001',
      'customer_code' => $budi->code,
      'package_code' => $package10->code,
      'tgl_mulai' => '2026-01-10',
      'tgl_akhir' => '9999-12-31',
      'price' => $package10->price,
      'status' => 'active',
    ]);

    $subsBudi2 = Subscription::create([
      'code' => 'SUB002',
      'customer_code' => $budi->code,
      'package_code' => $packageCctv->code,
      'tgl_mulai' => '2026-01-10',
      'tgl_akhir' => '9999-12-31',
      'price' => $packageCctv->price,
      'status' => 'active',
    ]);

    // Andi punya 1 paket
    $subsAndi = Subscription::create([
      'code' => 'SUB003',
      'customer_code' => $andi->code,
      'package_code' => $package20->code,
      'tgl_mulai' => '2026-02-15',
      'tgl_akhir' => '9999-12-31',
      'price' => $package20->price,
      'status' => 'active',
    ]);

    // Siti punya 1 paket
    $subsSiti = Subscription::create([
      'code' => 'SUB004',
      'customer_code' => $siti->code,
      'package_code' => $packageHotspot->code,
      'tgl_mulai' => '2026-03-01',
      'tgl_akhir' => '9999-12-31',
      'price' => $packageHotspot->price,
      'status' => 'active',
    ]);

    /*
        |--------------------------------------------------------------------------
        | Invoice
        |--------------------------------------------------------------------------
        */

    $invoiceBudi = Invoice::create([
      'code' => "INV2026090001",
      'Tgl' => '2026-09-01',
      'invoice_number' => 'INV-202609-0001',
      'customer_code' => $budi->code,
      'subscription_code' => $subsdBudi1->code,
      'periode_tagihan' => '2026-09',
      'tgl_jatuh_tempo' => '2026-09-10',
      'amount' => 200000,
      'status' => 'overdue',
      'paid_at' => null,
    ]);

    $invoiceAndi = Invoice::create([
      'code'  => "INV2026090002",
      'Tgl' => '2026-09-01',
      'invoice_number' => 'INV-202609-0002',
      'customer_code' => $andi->code,
      'subscription_code' => $subsAndi->code,
      'periode_tagihan' => '2026-09',
      'tgl_jatuh_tempo' => '2026-09-10',
      'amount' => 150000,
      'status' => 'paid',
      'paid_at' => now(),
    ]);

    $invoiceSiti = Invoice::create([
      'code'  => "INV2026090003",
      'Tgl' => '2026-09-01',
      'invoice_number' => 'INV-202609-0003',
      'customer_code' => $siti->code,
      'subscription_code' => $subsSiti->code,
      'periode_tagihan' => '2026-09',
      'tgl_jatuh_tempo' => '2026-09-10',
      'amount' => 75000,
      'status' => 'unpaid',
      'paid_at' => null,
    ]);

    /*
        |--------------------------------------------------------------------------
        | Payments
        |--------------------------------------------------------------------------
        */

    // Budi bayar 2 kali
    Payment::create([
      'code' => 'PY2026090001',
      'invoice_code' => $invoiceBudi->code,
      'tgl_bayar' => '2026-09-03',
      'amount' => 100000,
      'metode_pembayaran' => 'cash',
      'reference' => null,
      'notes' => 'Pembayaran pertama',
    ]);

    Payment::create([
      'code' => 'PY2026090002',
      'invoice_code' => $invoiceBudi->code,
      'tgl_bayar' => '2026-09-05',
      'amount' => 50000,
      'metode_pembayaran' => 'transfer',
      'reference' => 'TRX-BUDI-002',
      'notes' => 'Pembayaran kedua',
    ]);

    // Andi langsung lunas
    Payment::create([
      'code' => 'PY2026090003',
      'invoice_code' => $invoiceAndi->code,
      'tgl_bayar' => '2026-09-05',
      'amount' => 150000,
      'metode_pembayaran' => 'qris',
      'reference' => 'QRIS-ANDI-001',
      'notes' => null,
    ]);
  }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HeaderMainMenu extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        // DB::table('list_menus')->insert([
        //     'name' => 'Dashboard',
        //     'route_name' => 'dashboard',
        //     'link' => '/dashboard',
        // ]);

        $lastID = DB::table('list_menus')->insertGetId([
            'name' => 'Master Data',
            'is_parent' => 1,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Obat',
            'route_name' => 'master-data.obat',
            'link' => '/master-data/obat',
            'icon' => 'assets/images/icons/1529570.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Golongan Darah',
            'route_name' => 'master-data.golongan-darah',
            'link' => '/master-data/golongan-darah',
            'icon' => 'assets/images/icons/4633210.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Wilayah',
            'route_name' => 'master-data.wilayah',
            'link' => '/master-data/wilayah',
            'icon' => 'assets/images/icons/9747001.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Jenis Kelamin',
            'route_name' => 'master-data.jenis-kelamin',
            'link' => '/master-data/jenis-kelamin',
            'icon' => 'assets/images/icons/2517445.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'User System',
            'route_name' => 'master-data.user-system',
            'link' => '/master-data/user-system',
            'icon' => 'assets/images/icons/8965339.png',
            'id_parent' => $lastID,
        ]);

        $lastID = DB::table('list_menus')->insertGetId([
            'name' => 'Transaksi',
            'is_parent' => 1,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Pelaksanaan Pelayanan',
            'route_name' => 'transaksi.pelaksanaan-pelayanan',
            'link' => '/transaksi/pelaksanaan-pelayanan',
            'icon' => 'assets/images/icons/6898949.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Pembayaran',
            'route_name' => 'transaksi.pembayaran',
            'link' => '/transaksi/pembayaran',
            'icon' => 'assets/images/icons/10535988.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Billing',
            'route_name' => 'transaksi.billing',
            'link' => '/transaksi/billing',
            'icon' => 'assets/images/icons/1651907.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Pendaftaran Pasien',
            'route_name' => 'transaksi.pendaftaran-pasien',
            'link' => '/transaksi/pendaftaran-pasien',
            'icon' => 'assets/images/icons/3456388.png',
            'id_parent' => $lastID,
        ]);

        $lastID = DB::table('list_menus')->insertGetId([
            'name' => 'Inventory',
            'is_parent' => 1,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Stok Barang',
            'route_name' => 'inventory.stok-barang',
            'link' => '/inventory/stok-barang',
            'icon' => 'assets/images/icons/7656409.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Stok Obat',
            'route_name' => 'inventory.stok-obat',
            'link' => '/inventory/stok-obat',
            'icon' => 'assets/images/icons/1529570.png',
            'id_parent' => $lastID,
        ]);

        $lastID = DB::table('list_menus')->insertGetId([
            'name' => 'Informasi',
            'is_parent' => 1,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Kunjungan Pasien',
            'route_name' => 'informasi.kunjungan-pasien',
            'link' => '/informasi/kunjungan-pasien',
            'icon' => 'assets/images/icons/11411453.png',
            'id_parent' => $lastID,
        ]);

        $lastID = DB::table('list_menus')->insertGetId([
            'name' => 'Seklinik',
            'is_parent' => 1,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Pengaturan',
            'route_name' => 'seklinik.pengaturan',
            'link' => '/seklinik/pengaturan',
            'icon' => 'assets/images/icons/3953226.png',
            'id_parent' => $lastID,
        ]);

        DB::table('list_menus')->insert([
            'name' => 'Pegawai',
            'route_name' => 'pengaturan.pegawai',
            'link' => '/pengaturan/pegawai',
            'icon' => 'assets/images/icons/17941466.png',
            'id_parent' => $lastID,
        ]);
    }
}

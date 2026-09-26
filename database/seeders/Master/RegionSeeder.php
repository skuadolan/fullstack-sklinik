<?php

namespace Database\Seeders\Master;

use Illuminate\Database\Seeder;

use App\Models\Master\RegionModel;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info("🚀 Memulai proses seeding wilayah...");

        ini_set('memory_limit', '7G');

        // 1. Seed berurutan dari level tertinggi ke terendah
        $this->seedLevel('province', 'database/seeders/Master/Regoins/province.json');
        $this->seedLevel('regency', 'database/seeders/Master/Regoins/regency.json');
        $this->seedLevel('district', 'database/seeders/Master/Regoins/district.json');
        $this->seedLevel('village', 'database/seeders/Master/Regoins/postal_code_village.json');

        // 2. Mapping parent_id menggunakan SQL (Sangat Cepat)
        $this->mapParentId();

        $this->command->info("✅ Selesai! Semua data wilayah berhasil di-seed dan parent_id sudah terpetakan.");
    }

    /**
     * Method untuk memproses dan insert data per level
     */
    private function seedLevel(string $level, string $filePath): void
    {
        if (!file_exists($filePath)) {
            $this->command->error("File tidak ditemukan: {$filePath}");
            return;
        }

        // Asumsi convertToArry() mengembalikan array asosiatif/indexed
        $data = $this->convertToArry($filePath); 
        $totalData = count($data);
        
        $this->command->info("📥 Memproses {$totalData} data untuk level: {$level}...");

        $chunk = [];
        $chunkSize = 2000; // Insert 2000 baris sekaligus
        $inserted = 0;

        $dataToInsert = [];
        foreach ($data as $item) {
            $code = (string) $item['code'];
            
            if (isValNotEmpty($item, 'name') && isValEmpty($dataToInsert, $code)) {
                $chunk[] = [
                    'parent_code'      => $this->getParentCode($code),
                    'code'             => $code,
                    'alternative_code' => $item['alternative_code'] ?? null,
                    'name'             => $item['name'],
                    'level'            => $level, // Gunakan parameter level
                    'postal_code'      => $item['postal_code'] ?? null,
                    'created_at'       => now(),
                ];

                $dataToInsert[$code] = $code;
            }

            // Jika chunk sudah penuh, insert ke database
            if (count($chunk) >= $chunkSize) {
                DB::table('regions')->insert($chunk);
                
                $inserted += count($chunk);
                $chunk = []; // Kosongkan chunk untuk menghemat RAM
            }
        }

        // Insert sisa data yang belum mencapai chunkSize
        if (!empty($chunk)) {
            DB::table('regions')->insert($chunk);
            $inserted += count($chunk);
        }

        $this->command->info("✅ Level {$level} selesai. Total: {$inserted} data.");
        
        // Bebaskan memori segera setelah selesai per level
        unset($data, $chunk); 
    }

    /**
     * Menghitung parent_code berdasarkan format string (11.09.07.2008)
     */
    private function getParentCode(string $code): ?string
    {
        if (!str_contains($code, '.')) {
            return null; // Provinsi (misal "11") tidak punya parent
        }
        
        $parts = explode('.', $code);
        array_pop($parts); // Hapus bagian paling kanan
        return implode('.', $parts);
    }

    /**
     * Mapping parent_code menjadi parent_id menggunakan SQL Query
     */
    private function mapParentId(): void
    {
        $this->command->info("🔄 Memetakan parent_id dari parent_code...");

        // Syntax SQL ini kompatibel dengan PostgreSQL (dan MySQL)
        // Query ini akan mencocokkan child.parent_code dengan parent.code, 
        // lalu mengisi child.parent_id dengan parent.id
        DB::statement("
            UPDATE regions AS child
            SET parent_id = parent.id
            FROM regions AS parent
            WHERE child.parent_code = parent.code
            AND child.parent_code IS NOT NULL
        ");
        
        // Catatan: Jika Anda menggunakan MySQL, gunakan syntax ini:
        /*
        DB::statement("
            UPDATE regions AS child
            JOIN regions AS parent ON child.parent_code = parent.code
            SET child.parent_id = parent.id
            WHERE child.parent_code IS NOT NULL
        ");
        */

        $this->command->info("✅ Mapping parent_id selesai!");
    }

    // Dummy method untuk simulasi, hapus jika Anda sudah punya di class lain
    private function convertToArry($path) {
        return array_values(json_decode(file_get_contents($path), true));
    }
}

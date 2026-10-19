<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\TahunAjaran;

$terhapus = DB::table('tahun_ajarans')->where('id', '>', 4)->delete();

echo "Duplikat terhapus: {$terhapus}\n";
echo 'Sisa TA: '.TahunAjaran::count()."\n";
echo 'Aktif: '.TahunAjaran::where('is_aktif', true)->pluck('tahun_ajaran')."\n";

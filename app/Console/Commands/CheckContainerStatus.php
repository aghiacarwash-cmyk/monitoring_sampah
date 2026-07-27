<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Container;

class CheckContainerStatus extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:check-container-status';

    /**
     * The console command description.
     */
    protected $description = 'Mengubah status system menjadi Offline jika tidak ada update data';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Container::where('updated_at', '<', now()->subMinutes(60))
            ->update([
                'status_system' => 'Offline',
            ]);

        $this->info('Status container berhasil diperbarui.');

        return self::SUCCESS;
    }
}
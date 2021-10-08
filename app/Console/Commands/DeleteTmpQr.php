<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteTmpQr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp-qr:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаляет временные файлы картинок QR-кодов.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        File::cleanDirectory(public_path('../public/images/qr/tmp'));
    }
}

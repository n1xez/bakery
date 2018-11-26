<?php

namespace App\Console\Commands;

use App\Services\SyncAssortmentService;
use Illuminate\Console\Command;

class SyncAssortment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:assortment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var SyncAssortmentService
     */
    private $service;

    /**
     * Create a new command instance.
     *
     * @param SyncAssortmentService $service
     */
    public function __construct(SyncAssortmentService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->service->handle();

        return 'complete';
    }
}

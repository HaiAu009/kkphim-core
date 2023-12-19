<?php

namespace KKPhim\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use KKPhim\Core\Models\Episode;

class ChangeDomainEpisodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kkphim:episode:change_domain_play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change episode domain play stream';

    protected $progressBar;


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
     * @return int
     */
    public function handle()
    {
        $domains = array(
            /*'s1.phim1280.tv' => 'vn1.dulieuphim.tv',
            's2.phim1280.tv' => 'vn2.dulieuphim.tv'*/
        );

        foreach ($domains as $oldDomain => $newDomain) {
            $this->info("Replace: $oldDomain => $newDomain");
            Episode::where('link', 'LIKE', '%' . $oldDomain . '%')->update(['link' => DB::raw("REPLACE(link, '$oldDomain', '$newDomain')")]);
        }

        $this->info("Replace Done!");
        return 0;
    }
}
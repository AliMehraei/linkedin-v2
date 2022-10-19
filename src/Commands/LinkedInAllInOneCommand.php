<?php

namespace alimehraei\LinkedInAllInOne\Commands;

use Illuminate\Console\Command;

class LinkedInAllInOneCommand extends Command
{
    public $signature = 'linkedin-v2';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

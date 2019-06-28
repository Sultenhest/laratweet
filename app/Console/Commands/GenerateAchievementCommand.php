<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateAchievementCommand extends Command
{
    protected $signature = 'make:achievement {name}';

    protected $description = 'Generate a new achievement class stub';

    public function handle()
    {
        $path = app_path('Achievements/'. $this->argument('name') . '.php');

        file_put_contents($path, $this->compileTemplate());

        $this->info($path . ' created successfully.');
    }

    public function compileTemplate()
    {
        $stub = file_get_contents(app_path('Console/Stubs/achievement.stub'));

        return str_replace('{{ CLASS }}', $this->argument('name'), $stub);
    }
}

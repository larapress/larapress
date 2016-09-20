<?php

namespace Larapress\Admin\Jobs;

use App\Jobs\Job;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Request;

class CreateModel extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $input;

    protected $model;

    protected $models;

    protected $modelDir;

    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $packageDir = $this->input['root'] . '/' . $this->input['vendor'] . '/' . $this->input['package'];

        $this->modelDir = $packageDir . '/src/' . ucfirst($this->input['models']);

        $this->model = $this->input['model'];

        $this->models = $this->input['models'];

        \Storage::makeDirectory($this->modelDir);

        $this->recurse_copy(__DIR__ . '/VanillaModel', $this->modelDir);

        $this->changeFilenames();

        $this->updateFiles($this->input['vendor'], $this->input['package']);

        dd('sdsds');
    }

    protected function changeFilenames()
    {
        \Storage::rename($this->modelDir . '/Config/authorization/pages.php', $this->modelDir . '/Config/authorization/' . $this->models . '.php');

        \Storage::rename($this->modelDir . '/Config/validation/page.php', $this->modelDir . '/Config/validation/' . $this->models . '.php');

        \Storage::rename($this->modelDir . '/Database/Factories/PageFactory.php', $this->modelDir . '/Database/Factories/' . ucfirst($this->model) . 'Factory.php');

        \Storage::rename($this->modelDir . '/Database/Seeds/PagesTableSeeder.php', $this->modelDir . '/Database/Seeds/' . ucfirst($this->models) . 'TableSeeder.php');

        \Storage::rename($this->modelDir . '/Database/Migrations/create_pages_table.php', $this->modelDir . '/Database/Migrations/' . date('Y_m_d') . '_create_' . $this->models . '_table.php');

        \Storage::rename($this->modelDir . '/Events/PageWasSaved.php', $this->modelDir . '/Events/' . ucfirst($this->model) . 'WasSaved.php');

        \Storage::rename($this->modelDir . '/Http/Controllers/PagesController.php', $this->modelDir . '/Http/Controllers/' . ucfirst($this->models) . 'Controller.php');

        \Storage::rename($this->modelDir . '/Jobs/SaveNewPage.php', $this->modelDir . '/Jobs/SaveNew' . ucfirst($this->model) . '.php');

        \Storage::rename($this->modelDir . '/Jobs/UpdateExistingPage.php', $this->modelDir . '/Jobs/UpdateExisting' . ucfirst($this->model) . '.php');

        \Storage::rename($this->modelDir . '/Listeners/PageSavedListener.php', $this->modelDir . '/Listeners/' . ucfirst($this->model) . 'SavedListener.php');

        \Storage::rename($this->modelDir . '/Models/Page.php', $this->modelDir . '/Models/' . ucfirst($this->model) . '.php');

        \Storage::rename($this->modelDir . '/Policies/PagePolicy.php', $this->modelDir . '/Policies/' . ucfirst($this->model) . 'Policy.php');

        \Storage::rename($this->modelDir . '/Providers/LarapressPagesServiceProvider.php', $this->modelDir . '/Providers/' . ucfirst($this->models) . 'ServiceProvider.php');
    }

    protected function updateFiles($vendor, $package){
        $content = \Storage::get($this->modelDir.'/Database/Factories/'.ucfirst($this->model).'Factory.php');

        $content = str_replace('{models}', $this->models, $content);
        $content = str_replace('{Models}', ucfirst($this->models), $content);
        $content = str_replace('{model}', $this->model, $content);
        $content = str_replace('{Model}', ucfirst($this->model), $content);
        $content = str_replace('{vendor}', ucfirst($vendor), $content);
        $content = str_replace('{package}', ucfirst($package), $content);
        $content = str_replace('--php', '<?php', $content);

        \Storage::put($this->modelDir.'/Database/Factories/'.ucfirst($this->model).'Factory.php', $content);
    }

    protected function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}

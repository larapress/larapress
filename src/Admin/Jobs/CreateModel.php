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

    protected $files = [];

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
        $this->packageDir = $this->input['root'] . '/' . $this->input['vendor'] . '/' . $this->input['package'];

        $this->modelDir = $this->packageDir . '/src/' . ucfirst($this->input['models']);

        $this->model = $this->input['model'];

        $this->models = $this->input['models'];

        \Storage::makeDirectory($this->packageDir);

        $this->recurse_copy(__DIR__ . '/TemplateModel', $this->packageDir);

        $this->setFiles();

        $this->changeFilenames();

        $this->updateFiles($this->input['vendor'], $this->input['package']);

        dd('sdsds');
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

    protected function setFiles()
    {
        $this->files['config.authorization'] = $this->modelDir . '/Config/authorization/' . $this->models . '.php';

        $this->files['config.validation'] = $this->modelDir . '/Config/validation/' . $this->models . '.php';

        $this->files['database.factory'] = $this->modelDir . '/Database/Factories/' . ucfirst($this->model) . 'Factory.php';

        $this->files['database.seeds'] = $this->modelDir . '/Database/Seeds/' . ucfirst($this->models) . 'TableSeeder.php';

        $this->files['database.migration'] = $this->modelDir . '/Database/Migrations/' . date('Y_m_d') . '_000001_create_' . $this->models . '_table.php';

        $this->files['events.saved'] = $this->modelDir . '/Events/' . ucfirst($this->model) . 'WasSaved.php';

        $this->files['http.controller'] = $this->modelDir . '/Http/Controllers/' . ucfirst($this->models) . 'Controller.php';

        $this->files['jobs.save'] = $this->modelDir . '/Jobs/SaveNew' . ucfirst($this->model) . '.php';

        $this->files['jobs.update'] = $this->modelDir . '/Jobs/UpdateExisting' . ucfirst($this->model) . '.php';

        $this->files['listeners.saved'] = $this->modelDir . '/Listeners/' . ucfirst($this->model) . 'SavedListener.php';

        $this->files['model'] = $this->modelDir . '/Models/' . ucfirst($this->model) . '.php';

        $this->files['policy'] = $this->modelDir . '/Policies/' . ucfirst($this->model) . 'Policy.php';

        $this->files['provider'] = $this->modelDir . '/Providers/' . ucfirst($this->models) . 'ServiceProvider.php';

        $this->files['routes'] = $this->modelDir .'/Routes/routes.php';

        $this->files['views.create'] = $this->modelDir .'/Resources/Views/'.$this->models.'/create.blade.php';
        $this->files['views.edit'] = $this->modelDir .'/Resources/Views/'.$this->models.'/edit.blade.php';
        $this->files['views.form'] = $this->modelDir .'/Resources/Views/'.$this->models.'/form.blade.php';
        $this->files['views.index'] = $this->modelDir .'/Resources/Views/'.$this->models.'/index.blade.php';
        $this->files['views.panel'] = $this->modelDir .'/Resources/Views/'.$this->models.'/panel.blade.php';

        $this->files['composer'] = $this->packageDir .'/composer.json';
    }

    protected function changeFilenames()
    {
        //folder names
        \Storage::rename($this->packageDir . '/src/VanillaModel', $this->modelDir);

        \Storage::rename($this->modelDir . '/Resources/Views/pages', $this->modelDir. '/Resources/Views/'.$this->models);

        \Storage::rename($this->modelDir . '/Config/pages', $this->modelDir. '/Config/'.$this->models);


        //file names

        \Storage::rename($this->modelDir . '/Config/authorization/pages.php', $this->files['config.authorization']);

        \Storage::rename($this->modelDir . '/Config/validation/page.php', $this->files['config.validation']);

        \Storage::rename($this->modelDir . '/Database/Factories/PageFactory.php', $this->files['database.factory']);

        \Storage::rename($this->modelDir . '/Database/Seeds/PagesTableSeeder.php', $this->files['database.seeds']);

        \Storage::rename($this->modelDir . '/Database/Migrations/create_pages_table.php', $this->files['database.migration']);

        \Storage::rename($this->modelDir . '/Events/PageWasSaved.php', $this->files['events.saved']);

        \Storage::rename($this->modelDir . '/Http/Controllers/PagesController.php', $this->files['http.controller']);

        \Storage::rename($this->modelDir . '/Jobs/SaveNewPage.php', $this->files['jobs.save']);

        \Storage::rename($this->modelDir . '/Jobs/UpdateExistingPage.php', $this->files['jobs.update']);

        \Storage::rename($this->modelDir . '/Listeners/PageSavedListener.php', $this->files['listeners.saved']);

        \Storage::rename($this->modelDir . '/Models/Page.php', $this->files['model']);

        \Storage::rename($this->modelDir . '/Policies/PagePolicy.php', $this->files['policy']);

        \Storage::rename($this->modelDir . '/Providers/LarapressPagesServiceProvider.php', $this->files['provider']);
    }

    /**
     * Goes through each file and changes the strings to make model
     * @param $vendor
     * @param $package
     */
    protected function updateFiles($vendor, $package)
    {
        foreach ($this->files as $file) {
            $content = \Storage::get($file);

            $content = str_replace('{models}', $this->models, $content);
            $content = str_replace('{Models}', ucfirst($this->models), $content);
            $content = str_replace('{model}', $this->model, $content);
            $content = str_replace('{Model}', ucfirst($this->model), $content);
            $content = str_replace('{Vendor}', ucfirst($vendor), $content);
            $content = str_replace('{vendor}', $vendor, $content);
            $content = str_replace('{package}', $package, $content);
            $content = str_replace('{Package}', ucfirst($package), $content);
            $content = str_replace('--php', '<?php', $content);

            \Storage::put($file, $content);
        }
    }
}

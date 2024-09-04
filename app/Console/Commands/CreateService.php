<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service File';

    protected $type = 'Service';

    /**
     * Filesystem instance for file operations.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->getPath($name);

        if ($this->files->exists($path)) {
            $this->error($this->type . ' already exists!');
            return 1;
        }

        // Create directory if it doesn't exist
        $this->makeDirectory($path);

        // Replace placeholders in stub and write the file
        $stub = $this->files->get($this->getStub());
        $stub = $this->replaceNamespace($stub, $name);
        $stub = $this->replaceClass($stub, $name);

        $this->files->put($path, $stub);

        $this->info($this->type . ' created successfully.');

        return 0;
    }

    protected function getStub()
    {
        return base_path('stubs/service.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }

    protected function replaceNamespace($stub, $name)
    {
        $namespace = $this->getDefaultNamespace('App');
        return str_replace('{{ namespace }}', $namespace, $stub);
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getDefaultNamespace('App') . '\\', '', $name);
        return str_replace('{{ class }}', $class, $stub);
    }

    protected function getPath($name)
    {
        $name = str_replace('\\', '/', $name);
        return base_path('app/Services') . '/' . $name . '.php';
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }
}

<?php

namespace MarkRady\OneARTConsole\Commands;

use Exception;
use OneART\Console\Generators\ModelGenerator;
use OneART\Console\Command;
use OneART\Console\Filesystem;
use OneART\Console\Finder;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;


/**
 * Class ModelMakeCommand
 *
 * @author Bernat Jufré <info@behind.design>
 *
 * @package OneART\Console\Commands
 */
class ModelMakeCommand extends SymfonyCommand
{
    use Finder;
    use Command;
    use Filesystem;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent Model.';

    /**
     * The type of class being generated
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $generator = new ModelGenerator();

        $name = $this->argument('model');

        try {
            $model = $generator->generate($name);

            $this->info('Model class created successfully.' .
                "\n" .
                "\n" .
                'Find it at <comment>' . $model->relativePath . '</comment>' . "\n"
            );
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'The Model\'s name.']
        ];
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . '/../Generators/stubs/model.stub';
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MigrateMediaFiles extends Command
{
    protected $signature = 'files:migrate 
                            {path : Directory path relative to the storage disk} 
                            {model : Fully qualified model class (e.g., App\\Models\\WebPost)} 
                            {extension=jpg : File extension to match (default: jpg)}';

    protected $description = 'Migrate media files into Spatie Media Library based on file name ID.';

    public function handle()
    {
        $path = $this->argument('path');
        $modelClass = $this->argument('model');
        $extension = strtolower($this->argument('extension'));

        if (!class_exists($modelClass)) {
            $this->error("Model class '{$modelClass}' does not exist.");
            return 1;
        }

        if (!is_subclass_of($modelClass, \Illuminate\Database\Eloquent\Model::class)) {
            $this->error("Model class '{$modelClass}' is not a subclass of Eloquent Model.");
            return 1;
        }

        $absolutePath = Storage::path($path);

        if (!File::isDirectory($absolutePath)) {
            $this->error("Directory not found: {$absolutePath}");
            return 1;
        }

        $files = File::files($absolutePath);
        $filteredFiles = array_filter($files, function ($file) use ($extension) {
            return strtolower($file->getExtension()) === $extension;
        });

        $bar = $this->output->createProgressBar(count($filteredFiles));
        $bar->start();

        foreach ($filteredFiles as $file) {
            $filename = $file->getFilename(); // e.g. "123.jpg"

            if (!preg_match("/^(\d+)\.{$extension}$/i", $filename, $matches)) {
                $this->warn("Skipping invalid file name: {$filename}");
                continue;
            }

            $modelId = (int) $matches[1];
            $model = $modelClass::find($modelId);

            if (!$model) {
                $this->warn("Model not found for ID: {$modelId}");
                continue;
            }

            if (!$model->hasMedia('file')) {
                $model->addMedia($file->getRealPath())
                    ->preservingOriginal()
                    ->toMediaCollection();
            }

            $bar->advance();
        }

        $bar->finish();
        $this->info("\nMigration complete.");

        return 0;
    }
}

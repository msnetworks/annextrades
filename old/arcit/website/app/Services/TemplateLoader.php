<?php namespace App\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Storage;

class TemplateLoader
{
    const DEFAULT_THUMBNAIL = 'default_project_thumbnail.png';
    /**
     * @var FilesystemAdapter
     */
    private $storage;

    public function __construct()
    {
        $this->storage = Storage::disk('builder');
    }

    /**
     * Load all available templates.
     *
     * @return Collection
     */
    public function loadAll()
    {
        $paths = $this->storage->directories('templates');

        return collect($paths)->map(function($path) {
            $name = basename($path);

            $updatedAt = Carbon::createFromTimestamp($this->storage->lastModified($path))->toDateTimeString();

            return [
                'name' => $name,
                'updated_at' => $updatedAt,
                'config' => $this->getTemplateConfig(basename($path)),
                'thumbnail' => $this->getTemplateImagePath($name)
            ];
        });
    }

    /**
     * Load specified template from the disk.
     *
     * @param string $name
     * @return array
     */
    public function load($name)
    {
        $paths = $this->storage->files("templates/$name");

        $pages = collect($paths)->filter(function($path) {
            return str_contains($path, '.html');
        })->map(function($path) use($name) {
            return [
                'name' => basename($path, '.html'),
                'html' => $this->storage->get($path),
            ];
        })->values();

        return [
            'name' => $name,
            'config' => $this->getTemplateConfig($name),
            'thumbnail' => $this->getTemplateImagePath($name),
            'pages' => $pages,
            'css' => $this->getTemplateAsset("templates/$name/css/styles.css"),
            'js' => $this->getTemplateAsset("templates/$name/js/scripts.js"),
        ];
    }

    /**
     * Check if specified template exists.
     *
     * @param string $name
     * @return bool
     */
    public function exists($name)
    {
        return $this->storage->exists("templates/$name");
    }

    /**
     * Get template asset at specified path or default.
     *
     * @param string $path
     * @return string
     */
    private function getTemplateAsset($path)
    {
        if ($this->storage->exists($path)) {
            return $this->storage->get($path);
        }

        return null;
    }

    /**
     * Get template image path or default.
     *
     * @param string $name
     * @return string
     */
    private function getTemplateImagePath($name)
    {
        $path = "templates/$name/thumbnail.png";

        if ($this->storage->exists($path)) {
            return $this->storage->url($path);
        }

        return Storage::disk('builder')->url(self::DEFAULT_THUMBNAIL);
    }

    /**
     * Get template configuration.
     *
     * @param string $name
     * @return array
     */
    private function getTemplateConfig($name)
    {
        $path = "templates/$name/config.json";
        $config = [];

        if ($this->storage->exists($path)) {
            $config = json_decode($this->storage->get($path), true);
        }

        $config['framework'] = Arr::get($config, 'framework');

        return $config;
    }
}

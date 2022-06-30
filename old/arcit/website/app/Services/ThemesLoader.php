<?php namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Storage;

class ThemesLoader
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Load all available themes.
     *
     * @return Collection
     */
    public function loadAll()
    {
        $paths = Storage::disk('builder')->directories('themes');

        return collect($paths)->map(function($path) {
            $name = basename($path);

            return [
                'name' => $name,
                'thumbnail' => $this->getThemeImagePath($name)
            ];
        });
    }

    /**
     * Get template image path or default.
     *
     * @param string $name
     * @return string
     */
    private function getThemeImagePath($name)
    {
        $path = "themes/$name/image.png";

        if ( ! Storage::disk('builder')->exists($path)) {
            $path = TemplateLoader::DEFAULT_THUMBNAIL;
        }

        return Storage::disk('builder')->url($path);
    }
}

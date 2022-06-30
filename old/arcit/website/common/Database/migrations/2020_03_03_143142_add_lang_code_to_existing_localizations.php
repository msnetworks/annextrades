<?php

use Common\Core\Values\ValueLists;
use Common\Localizations\Localization;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Arr;

class AddLangCodeToExistingLocalizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $languages = app(ValueLists::class)->languages();

        app(Localization::class)->get()->each(function(Localization $localization) use($languages) {
            if ( ! $localization->language) {
                $lang = Arr::first($languages, function($lang) use($localization) {
                    return str_slug($lang['name']) === str_slug($localization->name);
                });
                if ( ! $lang) {
                    $lang = array_random($languages);
                }
                $localization->language = $lang['code'];
                $localization->save();
            }

            $slugName = str_slug($localization->name);
            $oldPath = resource_path("lang/$slugName.json");

            if (file_exists($oldPath)) {
                rename($oldPath, resource_path("lang/$localization->language.json"));
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

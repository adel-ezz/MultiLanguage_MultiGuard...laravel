<?php

namespace App;

use App\Translation;
use Illuminate\Support\Facades\App;

trait Translatable
{
    /**
     * Get all of the models's translations.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Get the translation attribute.
     *
     * @return \App\Translation
     */
    public function getTranslationAttribute($colTitle)
    {
        return $this->translations->firstWhere('col_title', $colTitle);
    }


}
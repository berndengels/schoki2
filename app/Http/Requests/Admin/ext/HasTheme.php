<?php
namespace App\Http\Requests\Admin\ext;

trait HasTheme
{
    public function getThemeId()
    {
        if ($this->has('theme') && $this->has('themes')) {
            return $this->get('themes')['id'];
        }
        return $this->get('theme_id');
    }
}

<?php
namespace App\Http\Requests\Admin\ext;

trait HasCategory
{
    public function getCategoryId()
    {
        if ($this->has('category') && $this->has('categories')) {
            return $this->get('categories')['id'];
        }
        return $this->get('category_id');
    }
}

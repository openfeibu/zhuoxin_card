<?php

namespace App\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class PageShowTransformer extends TransformerAbstract
{
    public function transform(\App\Models\Page $page)
    {
        return [
            'id'      => $page->id,
            'slug'    => $page->slug,
            'url'     => $page->slug . '.html',
            'name'    => $page->name,
            'sm_image'   => $page->image ? url("/image/sm".$page->image) : '',
            'image'   => $page->image ? url("/image/original".$page->image) : '',
            'title'   => $page->title,
            'description'   => $page->description,
            'status'  => $page->status,
            'order'   => $page->order,
            'home_recommend' => $page->recommend_type == 'home' ? true : false,
            'category_id' => $page->category_id,
            'created_at' => format_date($page->created_at,'Y-m-d H:i:s'),
            'updated_at' => format_date($page->updated_at,'Y-m-d H:i:s'),
            'category_name' => $page->category->name,
        ];
    }
}
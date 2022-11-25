<?php

namespace App\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class AdminUserTransformer extends TransformerAbstract
{
    public function transform(\App\Models\AdminUser $user)
    {
        return [
            //'id'                => $user->getRouteKey(),
            'id' => $user->id,
            'name'              => $user->name,
            'email'             => $user->email,
            'parent_id'         => $user->parent_id,
            'api_token'         => $user->api_token,
            'remember_token'    => $user->remember_token,
            'sex'               => $user->sex,
            'dob'               => $user->dob,
            'designation'       => $user->designation,
            'mobile'            => $user->mobile,
            'phone'             => $user->phone,
            'address'           => $user->address,
            'street'            => $user->street,
            'city'              => $user->city,
            'district'          => $user->district,
            'state'             => $user->state,
            'country'           => $user->country,
            'photo'             => $user->photo,
            'web'               => $user->web,
            'permissions'       => $user->permissions,
            'status'            => $user->status,
            'roles' => $user->roles,
            'role_names' => implode('，',$user->roles->pluck('name')->all()),
            'created_at'        => format_date($user->created_at),
            'updated_at'        => format_date($user->updated_at),
        ];
    }
}
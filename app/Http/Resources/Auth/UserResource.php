<?php

namespace App\Http\Resources\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'user_status' => (bool)$this->user_status,
            'role' => $this->roles->first()->name,
            'permissions' => $this->roles->first()->permissions->pluck('name'),
        ];
    }
}

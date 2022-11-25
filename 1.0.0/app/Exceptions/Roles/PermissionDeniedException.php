<?php

namespace App\Exceptions\Roles;

class PermissionDeniedException extends AccessDeniedException
{
    /**
     * Create a new permission denied exception instance.
     *
     * @param string $permission
     */
    public function __construct($permission)
    {
        $this->message = sprintf("没有权限", $permission);
    }
}

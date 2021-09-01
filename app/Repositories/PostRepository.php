<?php
 
namespace App\Repositories;
 
use App\Models\User;
 
class PostRepository
{

    public function forUser(User $user)
    {
        return $user->posts()->orderBy('created_at' , 'desc')->get();

    }

}











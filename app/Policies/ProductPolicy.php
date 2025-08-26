<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    public function viewAny(User $user): bool {
        return in_array($user->role, ['Admin','Manajer Gudang','Staff Gudang']);
    }

    public function view(User $user, Product $product): bool {
        return $this->viewAny($user);
    }

    public function create(User $user): bool {
        return in_array($user->role, ['Admin','Manajer Gudang']);
    }

    public function update(User $user, Product $product): bool {
        return in_array($user->role, ['Admin','Manajer Gudang']);
    }

    public function delete(User $user, Product $product): bool {
        return $user->role === 'Admin'; // Manajer TIDAK boleh hapus
    }
}

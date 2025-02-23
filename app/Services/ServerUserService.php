<?php

// app/Services/ServerUserService.php

namespace App\Services;

use App\Models\Server;
use App\Models\ServerUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ServerUserService
{
    public function listUsers(Server $server): Collection
    {
        return ServerUser::with('user')
            ->where('server_id', $server->id)
            ->get();
    }

    public function createUser(Server $server, User $user, ?string $registerAt = null): ServerUser
    {
        $existingUser = ServerUser::where('server_id', $server->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingUser) {
            throw new \Exception('Cet utilisateur est déjà enregistré sur ce serveur.');
        }

        return ServerUser::create([
            'server_id' => $server->id,
            'user_id' => $user->id,
            'register_at' => $registerAt ?? now(),
        ]);
    }

    public function updateUser(Server $server, ServerUser $serverUser, ?string $registerAt = null): ServerUser
    {
        if ($server->id !== $serverUser->server_id) {
            throw new \Exception('Cet utilisateur n\'appartient pas à ce serveur.');
        }

        $serverUser->update([
            'register_at' => $registerAt ?? $serverUser->register_at,
        ]);
        return $serverUser;
    }

    public function deleteUser(Server $server, ServerUser $serverUser): bool
    {
        if ($server->id !== $serverUser->server_id) {
            throw new \Exception('Cet utilisateur n\'appartient pas à ce serveur.');
        }

        return $serverUser->delete();
    }
}

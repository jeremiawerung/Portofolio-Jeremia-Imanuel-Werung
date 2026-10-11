<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class MakeAdmin extends Command
{
    protected $signature = 'portfolio:make-admin';

    protected $description = 'Bikin atau update akun admin buat moderasi Chat Room';

    public function handle(): int
    {
        $name = $this->ask('Nama yang tampil di chat', config('portfolio.owner.short_name'));
        $email = $this->ask('Email login');
        $password = $this->secret('Password (minimal 12 karakter)');
        $confirm = $this->secret('Ulangi password');

        $validator = Validator::make(
            ['name' => $name, 'email' => $email, 'password' => $password, 'password_confirmation' => $confirm],
            [
                'name' => ['required', 'string', 'max:40'],
                'email' => ['required', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:12', 'confirmed'],
            ],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::firstOrNew(['email' => $email]);
        $user->name = $name;
        $user->password = $password; // otomatis di-hash lewat cast 'hashed'
        $user->is_admin = true;
        $user->save();

        $this->info("Akun admin {$email} siap. Login di /admin/login");

        return self::SUCCESS;
    }
}

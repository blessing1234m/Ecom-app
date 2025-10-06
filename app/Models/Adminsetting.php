<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSetting extends Model
{
    protected $table = 'admin_settings';

    protected $fillable = ['key', 'value'];

    /**
     * Verify admin password
     */
    public static function verifyPassword($password): bool
    {
        $hashedPassword = DB::table('admin_settings')
            ->where('key', 'admin_password')
            ->value('value');

        if (!$hashedPassword) {
            return Hash::check($password, Hash::make('admin123'));
        }

        return Hash::check($password, $hashedPassword);
    }

    /**
     * Update admin password
     */
    public static function updatePassword($newPassword): bool
    {
        $hashedPassword = Hash::make($newPassword);

        $exists = DB::table('admin_settings')
            ->where('key', 'admin_password')
            ->exists();

        if ($exists) {
            return DB::table('admin_settings')
                ->where('key', 'admin_password')
                ->update(['value' => $hashedPassword]);
        } else {
            return DB::table('admin_settings')
                ->insert([
                    'key' => 'admin_password',
                    'value' => $hashedPassword,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
    }
}

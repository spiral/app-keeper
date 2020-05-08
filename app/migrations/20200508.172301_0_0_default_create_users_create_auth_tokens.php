<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault051eebb15f80002ca7b02665c8e55f5f extends Migration
{
    protected const DATABASE = 'default';

    public function up()
    {
        $this->table('users')
            ->addColumn('id', 'bigPrimary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('email', 'string', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('password', 'string', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('first_name', 'string', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('last_name', 'string', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('roles', 'string', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('created_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('updated_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addIndex(["email"], [
                'name'   => 'users_index_email_5eb5957567507',
                'unique' => true
            ])
            ->setPrimaryKeys(["id"])
            ->create();
        
        $this->table('auth_tokens')
            ->addColumn('id', 'string', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('hashed_value', 'string', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('created_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('expires_at', 'datetime', [
                'nullable' => true,
                'default'  => null
            ])
            ->addColumn('payload', 'binary', [
                'nullable' => false,
                'default'  => null
            ])
            ->setPrimaryKeys(["id"])
            ->create();
    }

    public function down()
    {
        $this->table('auth_tokens')->drop();
        
        $this->table('users')->drop();
    }
}

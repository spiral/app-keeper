<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefaultFbfb062fd99ec33370318688c060f745 extends Migration
{
    protected const DATABASE = 'default';

    public function up()
    {
        $this->table('images')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('width', 'integer', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('height', 'integer', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('size', 'integer', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('ratio', 'float', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('thumbnail', 'text', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('original', 'text', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('time_created', 'datetime', [
                'nullable' => true,
                'default'  => null,
            ])
            ->addColumn('time_updated', 'datetime', [
                'nullable' => true,
                'default'  => null,
            ])
            ->setPrimaryKeys(['id'])
            ->create();

        $this->table('pieces')
            ->addColumn('data', 'longText', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('meta', 'longText', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('id', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('name', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('type', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('time_created', 'datetime', [
                'nullable' => true,
                'default'  => null,
            ])
            ->addColumn('time_updated', 'datetime', [
                'nullable' => true,
                'default'  => null,
            ])
            ->addIndex(['name', 'type'], [
                'name'   => 'pieces_index_name_type_5fb2a3fbeaf0f',
                'unique' => true,
            ])
            ->setPrimaryKeys(['id'])
            ->create();

        $this->table('piece_locations')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('namespace', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('view', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('piece_id', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addIndex(['piece_id'], [
                'name'   => 'piece_locations_index_piece_id_5fb2a3fbe691b',
                'unique' => false,
            ])
            ->addForeignKey(['piece_id'], 'pieces', ['id'], [
                'name'   => 'piece_locations_piece_id_fk',
                'delete' => 'CASCADE',
                'update' => 'CASCADE',
            ])
            ->setPrimaryKeys(['id'])
            ->create();
    }

    public function down()
    {
        $this->table('piece_locations')->drop();

        $this->table('pieces')->drop();

        $this->table('images')->drop();
    }
}

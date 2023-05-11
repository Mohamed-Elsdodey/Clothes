<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();

            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(1);

            $table->timestamps();
        });

        $sql=[
            ['id'=>1,'name'=>'Mohamed EL sdodey','email'=>'admin@admin.com','password'=>bcrypt(123456)]
        ];
        \Illuminate\Support\Facades\DB::table('admins')->insert($sql);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}

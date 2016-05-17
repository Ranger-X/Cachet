<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableComponentsAddSLAColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->decimal('sla', 7, 4)->after('enabled')->default(0);
            $table->decimal('acceptable_sla', 7, 4)->after('sla')->default(99.9900);
            $table->boolean('show_sla')->after('acceptable_sla')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn('sla');
            $table->dropColumn('acceptable_sla');
            $table->dropColumn('show_sla');
        });
    }
}

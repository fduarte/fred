<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use \Illuminate\Foundation\Testing\DatabaseTransactions;

return new class extends Migration
{
    use DatabaseTransactions;

    public function up(): void
    {
        // Add a temporary column to hold the original strings
        Schema::table('news_items', function (Blueprint $table) {
            $table->string('published_at_raw', 255)
                ->nullable()
                ->after('published_at');
        });

        // Copy current strings into the temp column
        DB::statement('UPDATE news_items SET published_at_raw = published_at');

        // 3️⃣  Convert ISO strings to MySQL DATETIME(6) **in the temp column**
        //     Save the converted value directly into published_at *as VARCHAR* for now.
        //     REPLACE T→space and Z→nothing, then feed to STR_TO_DATE.
        DB::statement("
            UPDATE news_items
            SET published_at =
                STR_TO_DATE(
                    REGEXP_REPLACE(
                        REPLACE(published_at_raw, 'T', ' '),
                        '([+-][0-9]{2}:[0-9]{2}|Z)$',
                        ''
                    ),
                    '%Y-%m-%d %H:%i:%s.%f'
                )
            WHERE published_at_raw IS NOT NULL
        ");

        // Now that every row is a MySQL‑friendly date string, change the column type.
        Schema::table('news_items', function (Blueprint $table) {
            // DATETIME(6) keeps microseconds
            $table->dateTime('published_at', 6)->nullable()->change();
        });

        // Optionally make it NOT NULL and drop the temp column
        Schema::table('news_items', function (Blueprint $table) {
            $table->dateTime('published_at', 6)->nullable(false)->change();
            $table->dropColumn('published_at_raw');
        });
    }

    public function down(): void
    {
        Schema::table('news_items', function (Blueprint $table) {
            $table->string('published_at', 255)->change();
        });
    }

};

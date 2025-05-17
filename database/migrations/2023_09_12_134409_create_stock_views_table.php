<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            "CREATE
                OR REPLACE VIEW stock_view as
                SELECT
                    p.id as product_id,
                    COALESCE(p.stock, 0) as stok,
                    SUM(COALESCE(sd.qty, 0)) as terjual,
                    COALESCE(p.stock, 0) - SUM(COALESCE(sd.qty, 0)) as sisa
                FROM products as p
                    LEFT JOIN sale_details as sd ON p.id = sd.product_id
                        AND sd.deleted_at is null
                WHERE p.stock IS NOT NULL
                AND p.deleted_at IS NULL
                GROUP BY
                    p.id,
                    p.stock,
                    p.`name`
            "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW stock_view");
    }
};

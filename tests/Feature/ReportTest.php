<?php

namespace Tests\Feature;

class ReportTest extends SimkodesTestCase
{
    public function test_report_index_accessible(): void
    {
        $this->authGet('/report')->assertStatus(200);
    }

    public function test_report_filter_by_date_range(): void
    {
        $response = $this->authGet('/report/filter?start_date=2026-01-01&end_date=2026-12-31');
        $response->assertStatus(200);
    }

    public function test_report_print_recapitulation(): void
    {
        $response = $this->authGet('/report/print/2026-01-01/2026-12-31');
        $response->assertStatus(200);
    }
}


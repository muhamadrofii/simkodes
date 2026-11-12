<?php

namespace Tests\Feature;

class SubsidyTest extends SimkodesTestCase
{
    public function test_subsidies_index_accessible(): void
    {
        $this->authGet('/subsidies')->assertStatus(200);
    }

    public function test_subsidies_reports_accessible(): void
    {
        $this->authGet('/subsidies/reports')->assertStatus(200);
    }

    public function test_subsidy_checks_accessible(): void
    {
        $this->authGet('/subsidychecks')->assertStatus(200);
    }
}


<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Supervisor;
use App\Models\Inventory;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimkodesModuleTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Buat user autentikasi untuk pengujian
        $this->user = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            ['name' => 'Admin Tester', 'password' => bcrypt('password123')]
        );
    }

    /** 1. Test Landing Page & Guest Protection */
    public function test_guest_can_access_landing_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SIMKODES');
    }

    public function test_guest_is_redirected_to_login_when_accessing_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    protected function authGet(string $uri)
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->get($uri);
    }

    /** 2. Test Dashboard Access */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        $response = $this->authGet('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    /** 3. Test Modul Kategori */
    public function test_category_module_crud(): void
    {
        $category = Category::firstOrCreate(
            ['name' => 'Kategori Uji Coba'],
            ['description' => 'Deskripsi Kategori Test', 'image' => 'dummy_category.png']
        );

        $response = $this->authGet('/categories');
        $response->assertStatus(200);
        $response->assertSee('Kategori');

        $createResponse = $this->authGet('/categories/create');
        $createResponse->assertStatus(200);
    }

    /** 4. Test Modul Anggota & Cetak KTA */
    public function test_member_module_and_kta(): void
    {
        $response = $this->authGet('/members');
        $response->assertStatus(200);
        $response->assertSee('Data Anggota');

        $createResponse = $this->authGet('/members/create');
        $createResponse->assertStatus(200);

        $member = Member::first();
        if ($member) {
            $ktaResponse = $this->authGet("/members/{$member->id}/kta");
            $ktaResponse->assertStatus(200);
        }
    }

    /** 5. Test Modul Pengurus & Pengawas */
    public function test_officers_and_supervisors_modules(): void
    {
        $officers = $this->authGet('/officers');
        $officers->assertStatus(200);
        $officers->assertSee('Pengurus');

        $supervisors = $this->authGet('/supervisors');
        $supervisors->assertStatus(200);
        $supervisors->assertSee('Pengawas');
    }

    /** 6. Test Modul Persuratan (Surat Masuk & Surat Keluar) */
    public function test_letters_modules(): void
    {
        $incoming = $this->authGet('/incomingletters');
        $incoming->assertStatus(200);

        $outgoing = $this->authGet('/outgoingletters');
        $outgoing->assertStatus(200);
    }

    /** 7. Test Modul Inventaris & Export */
    public function test_inventory_module_and_exports(): void
    {
        $inventoryIndex = $this->authGet('/inventories');
        $inventoryIndex->assertStatus(200);

        $pdfExport = $this->authGet('/inventories/export/pdf');
        $pdfExport->assertStatus(200);
    }

    /** 8. Test Modul Subsidi & Bantuan */
    public function test_subsidies_and_checks_modules(): void
    {
        $subsidyIndex = $this->authGet('/subsidies');
        $subsidyIndex->assertStatus(200);

        $subsidyReports = $this->authGet('/subsidies/reports');
        $subsidyReports->assertStatus(200);

        $subsidyChecks = $this->authGet('/subsidychecks');
        $subsidyChecks->assertStatus(200);
    }

    /** 9. Test Modul Laporan Periode */
    public function test_reports_module(): void
    {
        $reportIndex = $this->authGet('/report');
        $reportIndex->assertStatus(200);
    }

    /** 10. Test Halaman Tentang Aplikasi (About) */
    public function test_about_page(): void
    {
        $about = $this->authGet('/about');
        $about->assertStatus(200);
    }
}

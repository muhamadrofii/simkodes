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
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SimkodesFullCrudTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            ['name' => 'Admin Tester', 'password' => bcrypt('password123')]
        );
    }

    protected function authGet(string $uri)
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->get($uri);
    }

    protected function authPost(string $uri, array $data = [])
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->post($uri, $data);
    }

    protected function authPut(string $uri, array $data = [])
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->put($uri, $data);
    }

    protected function authDelete(string $uri)
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->delete($uri);
    }

    // ==========================================
    // 1. KATEGORI (Full CRUD: Index, Create, Store, Show, Edit, Update, Destroy)
    // ==========================================
    public function test_category_full_crud_functions(): void
    {
        // INDEX & CREATE
        $this->authGet('/categories')->assertStatus(200);
        $this->authGet('/categories/create')->assertStatus(200);

        // STORE
        $file = UploadedFile::fake()->image('test_cat.png', 100, 100);
        $storeRes = $this->authPost('/categories', [
            'name' => 'Kategori CRUD Test ' . time(),
            'description' => 'Deskripsi Kategori CRUD',
            'image' => $file,
        ]);
        $storeRes->assertRedirect(route('categories.index'));

        $category = Category::where('description', 'Deskripsi Kategori CRUD')->latest()->first();
        $this->assertNotNull($category);

        // SHOW & EDIT
        $this->authGet("/categories/{$category->id}")->assertStatus(200);
        $this->authGet("/categories/{$category->id}/edit")->assertStatus(200);

        // UPDATE (Category update redirects to show)
        $updateRes = $this->authPut("/categories/{$category->id}", [
            'name' => 'Kategori CRUD Updated ' . time(),
            'description' => 'Deskripsi Updated',
        ]);
        $updateRes->assertRedirect(route('categories.show', $category->id));

        // DESTROY
        $deleteRes = $this->authDelete("/categories/{$category->id}");
        $deleteRes->assertRedirect(route('categories.index'));
    }

    // ==========================================
    // 2. ANGGOTA (Full CRUD + Cetak KTA)
    // ==========================================
    public function test_member_full_crud_functions(): void
    {
        $category = Category::first() ?? Category::create([
            'name' => 'Cat ' . time(), 'description' => 'Desc', 'image' => 'dummy.png'
        ]);

        // INDEX & CREATE
        $this->authGet('/members')->assertStatus(200);
        $this->authGet('/members/create')->assertStatus(200);

        // STORE
        $storeRes = $this->authPost('/members', [
            'category_id' => $category->id,
            'nama' => 'Anggota Test ' . time(),
            'jenis_kelamin' => 'L',
            'umur' => 30,
            'mata_pencaharian' => 'Wiraswasta',
            'tempat_tinggal' => 'Desa Sranak',
            'tanggal_masuk' => '2026-01-01',
        ]);
        $storeRes->assertRedirect(route('members.index'));

        $member = Member::where('mata_pencaharian', 'Wiraswasta')->latest()->first();
        $this->assertNotNull($member);

        // SHOW, EDIT & CETAK KTA
        $this->authGet("/members/{$member->id}")->assertStatus(200);
        $this->authGet("/members/{$member->id}/edit")->assertStatus(200);
        $this->authGet("/members/{$member->id}/kta")->assertStatus(200);

        // UPDATE (Member update redirects to show)
        $updateRes = $this->authPut("/members/{$member->id}", [
            'category_id' => $category->id,
            'nama' => 'Anggota Updated ' . time(),
            'jenis_kelamin' => 'L',
            'umur' => 31,
            'mata_pencaharian' => 'Wiraswasta Baru',
            'tempat_tinggal' => 'Desa Sranak Baru',
        ]);
        $updateRes->assertRedirect(route('members.show', $member->id));

        // DESTROY
        $deleteRes = $this->authDelete("/members/{$member->id}");
        $deleteRes->assertRedirect(route('members.index'));
    }

    // ==========================================
    // 3. PENGURUS & PENGAWAS (Full CRUD + Cetak KTA)
    // ==========================================
    public function test_officer_full_crud_functions(): void
    {
        // INDEX & CREATE
        $this->authGet('/officers')->assertStatus(200);
        $this->authGet('/officers/create')->assertStatus(200);

        // STORE (Officer requires image)
        $image = UploadedFile::fake()->image('officer.png', 100, 100);
        $storeRes = $this->authPost('/officers', [
            'nama' => 'Pengurus Test ' . time(),
            'jabatan' => 'Sekretaris',
            'jenis_kelamin' => 'P',
            'umur' => 35,
            'tempat_tinggal' => 'Desa Sranak',
            'tanggal_diangkat' => '2026-01-01',
            'image' => $image,
        ]);
        $storeRes->assertRedirect(route('officers.index'));

        $officer = Officer::where('jabatan', 'Sekretaris')->latest()->first();
        $this->assertNotNull($officer);

        // SHOW, EDIT & CETAK KTA
        $this->authGet("/officers/{$officer->id}")->assertStatus(200);
        $this->authGet("/officers/{$officer->id}/edit")->assertStatus(200);
        $this->authGet("/officers/{$officer->id}/kta")->assertStatus(200);

        // UPDATE
        $updateRes = $this->authPut("/officers/{$officer->id}", [
            'nama' => 'Pengurus Updated ' . time(),
            'jabatan' => 'Sekretaris Utama',
            'jenis_kelamin' => 'P',
        ]);
        $updateRes->assertRedirect(route('officers.show', $officer->id));

        // DESTROY
        $this->authDelete("/officers/{$officer->id}")->assertRedirect(route('officers.index'));
    }

    public function test_supervisor_full_crud_functions(): void
    {
        // INDEX & CREATE
        $this->authGet('/supervisors')->assertStatus(200);
        $this->authGet('/supervisors/create')->assertStatus(200);

        // STORE (Supervisor requires image)
        $image = UploadedFile::fake()->image('supervisor.png', 100, 100);
        $storeRes = $this->authPost('/supervisors', [
            'nama' => 'Pengawas Test ' . time(),
            'jabatan' => 'Ketua Pengawas',
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'Guru',
            'tempat_tinggal' => 'Desa Sranak',
            'tanggal_dipilih' => '2026-01-01',
            'image' => $image,
        ]);
        $storeRes->assertRedirect(route('supervisors.index'));

        $supervisor = Supervisor::where('jabatan', 'Ketua Pengawas')->latest()->first();
        $this->assertNotNull($supervisor);

        // SHOW, EDIT & CETAK KTA
        $this->authGet("/supervisors/{$supervisor->id}")->assertStatus(200);
        $this->authGet("/supervisors/{$supervisor->id}/edit")->assertStatus(200);
        $this->authGet("/supervisors/{$supervisor->id}/kta")->assertStatus(200);

        // UPDATE
        $updateRes = $this->authPut("/supervisors/{$supervisor->id}", [
            'nama' => 'Pengawas Updated ' . time(),
            'jabatan' => 'Anggota Pengawas',
            'jenis_kelamin' => 'L',
        ]);
        $updateRes->assertRedirect(route('supervisors.show', $supervisor->id));

        // DESTROY
        $this->authDelete("/supervisors/{$supervisor->id}")->assertRedirect(route('supervisors.index'));
    }

    // ==========================================
    // 4. PERSURATAN (Incoming & Outgoing Letters)
    // ==========================================
    public function test_incoming_letters_crud(): void
    {
        // INDEX & CREATE
        $this->authGet('/incomingletters')->assertStatus(200);
        $this->authGet('/incomingletters/create')->assertStatus(200);

        // STORE
        $file = UploadedFile::fake()->create('surat_masuk.pdf', 100, 'application/pdf');
        $res = $this->authPost('/incomingletters', [
            'title' => 'Surat Masuk Test ' . time(),
            'reference_number' => 'SM-' . time(),
            'category' => 'Undangan',
            'file' => $file,
        ]);
        $res->assertRedirect(route('incomingletters.index'));

        $letter = IncomingLetter::latest()->first();
        $this->assertNotNull($letter);

        // SHOW & EDIT
        $this->authGet("/incomingletters/{$letter->id}")->assertStatus(200);
        $this->authGet("/incomingletters/{$letter->id}/edit")->assertStatus(200);

        // UPDATE
        $updateRes = $this->authPut("/incomingletters/{$letter->id}", [
            'title' => 'Surat Masuk Updated ' . time(),
            'reference_number' => 'SM-UPD-' . time(),
            'category' => 'Pemberitahuan',
        ]);
        $updateRes->assertRedirect(route('incomingletters.index'));

        // DESTROY
        $this->authDelete("/incomingletters/{$letter->id}")->assertRedirect(route('incomingletters.index'));
    }

    public function test_outgoing_letters_crud(): void
    {
        // INDEX & CREATE
        $this->authGet('/outgoingletters')->assertStatus(200);
        $this->authGet('/outgoingletters/create')->assertStatus(200);

        // STORE
        $file = UploadedFile::fake()->create('surat_keluar.pdf', 100, 'application/pdf');
        $res = $this->authPost('/outgoingletters', [
            'title' => 'Surat Keluar Test ' . time(),
            'reference_number' => 'SK-' . time(),
            'category' => 'Pemberitahuan',
            'file' => $file,
        ]);
        $res->assertRedirect(route('outgoingletters.index'));

        $letter = OutgoingLetter::latest()->first();
        $this->assertNotNull($letter);

        // SHOW & EDIT
        $this->authGet("/outgoingletters/{$letter->id}")->assertStatus(200);
        $this->authGet("/outgoingletters/{$letter->id}/edit")->assertStatus(200);

        // UPDATE
        $updateRes = $this->authPut("/outgoingletters/{$letter->id}", [
            'title' => 'Surat Keluar Updated ' . time(),
            'reference_number' => 'SK-UPD-' . time(),
            'category' => 'Instruksi',
        ]);
        $updateRes->assertRedirect(route('outgoingletters.index'));

        // DESTROY
        $this->authDelete("/outgoingletters/{$letter->id}")->assertRedirect(route('outgoingletters.index'));
    }

    // ==========================================
    // 5. INVENTARIS (CRUD + Export PDF & Excel)
    // ==========================================
    public function test_inventory_crud_and_exports(): void
    {
        // INDEX & CREATE
        $this->authGet('/inventories')->assertStatus(200);
        $this->authGet('/inventories/create')->assertStatus(200);

        // STORE
        $storeRes = $this->authPost('/inventories', [
            'nama_barang' => 'Laptop Inventaris ' . time(),
            'kode_barang' => 'INV-' . time(),
            'jumlah' => 5,
            'satuan' => 'Unit',
            'kondisi' => 'Baik',
            'tanggal_pengadaan' => '2026-01-01',
        ]);
        $storeRes->assertRedirect(route('inventories.index'));

        $inventory = Inventory::latest()->first();
        $this->assertNotNull($inventory);

        // SHOW & EDIT
        $this->authGet("/inventories/{$inventory->id}")->assertStatus(200);
        $this->authGet("/inventories/{$inventory->id}/edit")->assertStatus(200);
        
        // Ekspor Dokumen
        $this->authGet('/inventories/export/pdf')->assertStatus(200);
        $this->authGet('/inventories/export/excel')->assertStatus(200);

        // DESTROY
        $this->authDelete("/inventories/{$inventory->id}")->assertRedirect(route('inventories.index'));
    }

    // ==========================================
    // 6. LAPORAN & SUBSIDI
    // ==========================================
    public function test_subsidy_and_reports_functions(): void
    {
        $this->authGet('/subsidies')->assertStatus(200);
        $this->authGet('/subsidies/reports')->assertStatus(200);
        $this->authGet('/subsidychecks')->assertStatus(200);

        // Laporan Umum
        $this->authGet('/report')->assertStatus(200);
        $this->authGet('/report/filter?start_date=2026-01-01&end_date=2026-12-31')->assertStatus(200);
        $this->authGet('/report/print/2026-01-01/2026-12-31')->assertStatus(200);
    }
}

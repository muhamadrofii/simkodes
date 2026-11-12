import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage';

test.describe('SIMKODES End-to-End Full Features Suite', () => {

  test.beforeEach(async ({ page }) => {
    // 1. Kunjungi Halaman Login
    const loginPage = new LoginPage(page);
    await loginPage.goto();

    // 2. Login menggunakan kredensial default admin
    await loginPage.login('admin@example.com', 'kopmerahputih');
  });

  test('Modul 1: Dashboard dan Statistik Utama', async ({ page }) => {
    await expect(page).toHaveURL(/.*dashboard/);
    await expect(page.locator('body')).toContainText('Dashboard');
  });

  test('Modul 2: Data Master Anggota & Kategori', async ({ page }) => {
    // Kunjungi Halaman Anggota
    await page.goto('/members');
    await expect(page.locator('body')).toContainText('Anggota');

    // Kunjungi Halaman Kategori
    await page.goto('/categories');
    await expect(page.locator('body')).toContainText('Kategori');
  });

  test('Modul 3: Pengurus & Pengawas', async ({ page }) => {
    // Data Pengurus
    await page.goto('/officers');
    await expect(page.locator('body')).toContainText('Pengurus');

    // Data Pengawas
    await page.goto('/supervisors');
    await expect(page.locator('body')).toContainText('Pengawas');
  });

  test('Modul 4: Persuratan (Surat Masuk & Surat Keluar)', async ({ page }) => {
    // Surat Masuk
    await page.goto('/incomingletters');
    await expect(page.locator('body')).toContainText('Surat Masuk');

    // Surat Keluar
    await page.goto('/outgoingletters');
    await expect(page.locator('body')).toContainText('Surat Keluar');
  });

  test('Modul 5: Manajemen Inventaris', async ({ page }) => {
    await page.goto('/inventories');
    await expect(page.locator('body')).toContainText('Inventaris');
  });

  test('Modul 6: Modul Subsidi & Rekap Laporan', async ({ page }) => {
    // Halaman Subsidi
    await page.goto('/subsidies');
    await expect(page.locator('body')).toContainText('Subsidi');

    // Halaman Laporan Subsidi
    await page.goto('/subsidies/reports');
    await expect(page.locator('body')).toContainText('Laporan');

    // Halaman Cek Subsidi
    await page.goto('/subsidychecks');
    await expect(page.locator('body')).toContainText('Subsidi');
  });

  test('Modul 7: Laporan Rekapitulasi Umum & Halaman Tentang', async ({ page }) => {
    // Laporan Umum
    await page.goto('/report');
    await expect(page).toHaveURL(/.*report/);

    // Halaman Tentang
    await page.goto('/about');
    await expect(page.locator('body')).toContainText('SIMKODES');
  });

});


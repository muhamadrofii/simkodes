import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage';
import { DashboardPage } from '../pages/DashboardPage';

test.describe('E2E - Modul Autentikasi SIMKODES', () => {

  test('Harus menampilkan halaman login dengan elemen lengkap', async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();

    await expect(loginPage.emailInput).toBeVisible();
    await expect(loginPage.passwordInput).toBeVisible();
    await expect(loginPage.submitButton).toBeVisible();
  });

  test('Harus menolak login jika password salah', async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();

    await loginPage.login('kdmpsranak@gmail.com', 'passwordsalah123');
    await expect(page).toHaveURL(/.*login/);
    await loginPage.expectLoginError();
  });

  test('Harus menolak login jika email tidak terdaftar', async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();

    await loginPage.login('tidak_terdaftar@example.com', 'bebas123');
    await expect(page).toHaveURL(/.*login/);
    await loginPage.expectLoginError();
  });

  test('Harus berhasil login dengan akun admin default (kdmpsranak@gmail.com) dan masuk ke Dashboard', async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();

    await loginPage.login('kdmpsranak@gmail.com', 'kopmerahputih');
    await page.waitForURL('**/dashboard');
    await expect(page).toHaveURL(/.*dashboard/);

    const dashboardPage = new DashboardPage(page);
    await dashboardPage.assertDashboardLoaded();
  });

  test('Harus berhasil login dengan akun admin QA (admin@test.com) dan masuk ke Dashboard', async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();

    await loginPage.login('admin@test.com', 'password123');
    await page.waitForURL('**/dashboard');
    await expect(page).toHaveURL(/.*dashboard/);

    const dashboardPage = new DashboardPage(page);
    await dashboardPage.assertDashboardLoaded();
  });

  test('Harus mempertahankan sesi otentikasi saat dashboard di-refresh', async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();
    await loginPage.login('kdmpsranak@gmail.com', 'kopmerahputih');
    await page.waitForURL('**/dashboard');

    // Reload halaman dan pastikan tetap di dashboard (tidak ditendang ke login)
    await page.reload();
    await expect(page).toHaveURL(/.*dashboard/);

    const dashboardPage = new DashboardPage(page);
    await dashboardPage.assertDashboardLoaded();
  });

});

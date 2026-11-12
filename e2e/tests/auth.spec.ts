import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage';

test.describe('Autentikasi Pengguna SIMKODES', () => {

  test('Harus menampilkan halaman login dengan elemen lengkap', async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();

    await expect(loginPage.emailInput).toBeVisible();
    await expect(loginPage.passwordInput).toBeVisible();
    await expect(loginPage.submitButton).toBeVisible();
  });

  test('Harus menampilkan error jika password salah', async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();

    await loginPage.login('wrong@email.com', 'passwordsalah123');
    // Verifikasi tetap di halaman login atau muncul pesan error
    await expect(page).toHaveURL(/.*login/);
  });

});


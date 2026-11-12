import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage';

test.describe('E2E - Modul Autentikasi', () => {

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

    await loginPage.login('wrong@email.com', 'passwordsalah123');
    await expect(page).toHaveURL(/.*login/);
  });

});


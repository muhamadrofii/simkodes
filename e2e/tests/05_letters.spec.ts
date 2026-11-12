import { test } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage';
import { LetterPage } from '../pages/LetterPage';

test.describe('E2E - Modul Persuratan', () => {

  test.beforeEach(async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();
    await loginPage.login('admin@test.com', 'password123');
  });

  test('Harus dapat membuka arsip surat masuk', async ({ page }) => {
    const letterPage = new LetterPage(page);
    await letterPage.gotoIncoming();
    await letterPage.assertPageLoaded();
  });

  test('Harus dapat membuka arsip surat keluar', async ({ page }) => {
    const letterPage = new LetterPage(page);
    await letterPage.gotoOutgoing();
    await letterPage.assertPageLoaded();
  });

});


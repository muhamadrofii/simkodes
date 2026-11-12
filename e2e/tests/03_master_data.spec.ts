import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage';
import { CategoryPage } from '../pages/CategoryPage';
import { MemberPage } from '../pages/MemberPage';

test.describe('E2E - Data Master (Kategori & Anggota)', () => {

  test.beforeEach(async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();
    await loginPage.login('admin@test.com', 'password123');
  });

  test('Harus dapat membuka daftar kategori', async ({ page }) => {
    const categoryPage = new CategoryPage(page);
    await categoryPage.goto();
    await categoryPage.assertTableVisible();
  });

  test('Harus dapat membuka daftar anggota dan form create', async ({ page }) => {
    const memberPage = new MemberPage(page);
    await memberPage.goto();
    await expect(page).toHaveURL(/.*members/);

    await page.goto('/members/create');
    await expect(memberPage.namaInput).toBeVisible();
  });

});


import { test } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage';
import { OfficerPage } from '../pages/OfficerPage';

test.describe('E2E - Modul Pengurus & Pengawas', () => {

  test.beforeEach(async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();
    await loginPage.login('admin@test.com', 'password123');
  });

  test('Harus dapat membuka tabel pengurus koperasi', async ({ page }) => {
    const officerPage = new OfficerPage(page);
    await officerPage.gotoOfficers();
    await officerPage.assertTableVisible();
  });

  test('Harus dapat membuka tabel pengawas koperasi', async ({ page }) => {
    const officerPage = new OfficerPage(page);
    await officerPage.gotoSupervisors();
    await officerPage.assertTableVisible();
  });

});


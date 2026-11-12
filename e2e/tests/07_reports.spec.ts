import { test } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage';
import { ReportPage } from '../pages/ReportPage';

test.describe('E2E - Modul Laporan & Subsidi', () => {

  test.beforeEach(async ({ page }) => {
    const loginPage = new LoginPage(page);
    await loginPage.goto();
    await loginPage.login('admin@test.com', 'password123');
  });

  test('Harus dapat membuka data penyaluran subsidi', async ({ page }) => {
    const reportPage = new ReportPage(page);
    await reportPage.gotoSubsidies();
    await reportPage.assertSubsidiesTableVisible();
  });

  test('Harus dapat membuka filter rekapitulasi laporan', async ({ page }) => {
    const reportPage = new ReportPage(page);
    await reportPage.gotoReports();
    await reportPage.assertReportFormVisible();
  });

});

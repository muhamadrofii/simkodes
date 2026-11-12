import { Page, Locator, expect } from '@playwright/test';

/**
 * Page Object Model (POM) untuk Laporan & Subsidi
 */
export class ReportPage {
  readonly page: Page;

  constructor(page: Page) {
    this.page = page;
  }

  async gotoSubsidies() {
    await this.page.goto('/subsidies');
    await expect(this.page).toHaveURL(/.*subsidies/);
  }

  async gotoReports() {
    await this.page.goto('/report');
    await expect(this.page).toHaveURL(/.*report/);
  }

  async assertSubsidiesTableVisible() {
    await expect(this.page.locator('table').first()).toBeVisible();
  }

  async assertReportFormVisible() {
    await expect(this.page.locator('form[action*="/report/filter"]')).toBeVisible();
    await expect(this.page.locator('button:has-text("Tampilkan")')).toBeVisible();
  }
}

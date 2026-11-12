import { Page, Locator, expect } from '@playwright/test';

/**
 * Page Object Model (POM) untuk Pengurus & Pengawas
 */
export class OfficerPage {
  readonly page: Page;

  constructor(page: Page) {
    this.page = page;
  }

  async gotoOfficers() {
    await this.page.goto('/officers');
    await expect(this.page).toHaveURL(/.*officers/);
  }

  async gotoSupervisors() {
    await this.page.goto('/supervisors');
    await expect(this.page).toHaveURL(/.*supervisors/);
  }

  async assertTableVisible() {
    await expect(this.page.locator('table')).toBeVisible();
  }
}


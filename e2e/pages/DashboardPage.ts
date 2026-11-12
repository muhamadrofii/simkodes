import { Page, Locator, expect } from '@playwright/test';

/**
 * Page Object Model (POM) untuk Dashboard SIMKODES
 */
export class DashboardPage {
  readonly page: Page;
  readonly pageHeading: Locator;
  readonly welcomeBanner: Locator;

  constructor(page: Page) {
    this.page = page;
    this.pageHeading = page.locator('text=Dashboard').first();
    this.welcomeBanner = page.locator('text=Selamat datang').first();
  }

  async goto() {
    await this.page.goto('/dashboard');
    await expect(this.page).toHaveURL(/.*dashboard/);
  }

  async assertDashboardLoaded() {
    await expect(this.welcomeBanner).toBeVisible();
  }
}

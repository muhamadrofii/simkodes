import { Page, Locator, expect } from '@playwright/test';

/**
 * Page Object Model (POM) untuk Kategori SIMKODES
 */
export class CategoryPage {
  readonly page: Page;
  readonly table: Locator;

  constructor(page: Page) {
    this.page = page;
    this.table = page.locator('table');
  }

  async goto() {
    await this.page.goto('/categories');
    await expect(this.page).toHaveURL(/.*categories/);
  }

  async assertTableVisible() {
    await expect(this.table).toBeVisible();
  }
}


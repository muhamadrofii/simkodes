import { Page, Locator, expect } from '@playwright/test';

/**
 * Page Object Model (POM) untuk Inventaris
 */
export class InventoryPage {
  readonly page: Page;
  readonly table: Locator;
  readonly exportPdfBtn: Locator;
  readonly exportExcelBtn: Locator;

  constructor(page: Page) {
    this.page = page;
    this.table = page.locator('table');
    this.exportPdfBtn = page.locator('a[href*="/inventories/export/pdf"]');
    this.exportExcelBtn = page.locator('a[href*="/inventories/export/excel"]');
  }

  async goto() {
    await this.page.goto('/inventories');
    await expect(this.page).toHaveURL(/.*inventories/);
  }

  async assertInventoryLoaded() {
    await expect(this.table).toBeVisible();
    await expect(this.exportPdfBtn).toBeVisible();
    await expect(this.exportExcelBtn).toBeVisible();
  }
}


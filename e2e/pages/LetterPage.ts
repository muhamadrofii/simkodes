import { Page, Locator, expect } from '@playwright/test';

/**
 * Page Object Model (POM) untuk Persuratan
 */
export class LetterPage {
  readonly page: Page;

  constructor(page: Page) {
    this.page = page;
  }

  async gotoIncoming() {
    await this.page.goto('/incomingletters');
    await expect(this.page).toHaveURL(/.*incomingletters/);
  }

  async gotoOutgoing() {
    await this.page.goto('/outgoingletters');
    await expect(this.page).toHaveURL(/.*outgoingletters/);
  }

  async assertPageLoaded() {
    await expect(this.page.locator('table')).toBeVisible();
  }
}


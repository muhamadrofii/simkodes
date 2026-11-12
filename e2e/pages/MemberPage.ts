import { Page, Locator, expect } from '@playwright/test';

export interface MemberData {
  nama: string;
  category_id?: string;
  tanggal_masuk?: string;
}

/**
 * Page Object Model (POM) untuk Halaman Manajemen Anggota
 */
export class MemberPage {
  readonly page: Page;
  readonly pageHeading: Locator;
  readonly namaInput: Locator;
  readonly categorySelect: Locator;
  readonly submitButton: Locator;
  readonly membersTable: Locator;

  constructor(page: Page) {
    this.page = page;
    this.pageHeading = page.locator('h3:has-text("Data Anggota"), .page-title:has-text("Data Anggota")');
    this.namaInput = page.locator('input[name="nama"]');
    this.categorySelect = page.locator('select[name="category_id"]');
    this.submitButton = page.locator('button:has-text("Simpan")');
    this.membersTable = page.locator('table');
  }

  /**
   * Buka daftar anggota
   */
  async goto() {
    await this.page.goto('/members');
  }

  /**
   * Buka form dan submit anggota baru
   */
  async createMember(data: MemberData) {
    await this.page.goto('/members/create');
    if (data.category_id) {
      await this.categorySelect.selectOption(data.category_id);
    }
    await this.namaInput.fill(data.nama);
    await this.submitButton.click();
  }

  /**
   * Assertion apakah nama anggota ada di dalam tabel
   */
  async expectMemberInTable(nama: string) {
    await expect(this.membersTable).toContainText(nama);
  }
}


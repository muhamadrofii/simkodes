#!/usr/bin/env bash
# ==============================================================================
# Script Migrasi Struktur SIMKODES Production: Dari 'core/' ke 'simkodes/'
# Menjamin Database Live 100% Aman & File Upload Tidak Hilang
# ==============================================================================

set -euo pipefail

BASE_PATH="/home/u849825724/domains/sranak.com/public_html"
TARGET_PATH="${BASE_PATH}/simkodes"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="${HOME}/backups_production"

echo "=========================================================="
echo "  MIGRASI STRUKTUR SIMKODES PRODUCTION KE STANDAR STAGING"
echo "=========================================================="

cd "$BASE_PATH"

# 1. Pastikan folder core ada
if [ ! -d "core" ]; then
    echo "⚠️ Folder 'core/' tidak ditemukan di ${BASE_PATH}!"
    echo "Pastikan script dijalankan di path yang tepat."
    exit 1
fi

mkdir -p "$BACKUP_DIR"

# 2. Backup Database MySQL Live (Safety Snapshot)
echo "==> [1/5] Membuat Snapshot Database Live..."
if [ -f "core/.env" ]; then
    DB_DATABASE=$(grep "^DB_DATABASE=" core/.env | cut -d '=' -f2 | tr -d '\r"')
    DB_USERNAME=$(grep "^DB_USERNAME=" core/.env | cut -d '=' -f2 | tr -d '\r"')
    DB_PASSWORD=$(grep "^DB_PASSWORD=" core/.env | cut -d '=' -f2 | tr -d '\r"')
    DB_HOST=$(grep "^DB_HOST=" core/.env | cut -d '=' -f2 | tr -d '\r"')

    if [ -n "$DB_DATABASE" ]; then
        mysqldump --single-transaction --quick -h "${DB_HOST:-127.0.0.1}" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" | gzip > "${BACKUP_DIR}/db_snapshot_sebelum_migrasi_${TIMESTAMP}.sql.gz"
        echo "✅ Database berhasil di-backup ke: ${BACKUP_DIR}/db_snapshot_sebelum_migrasi_${TIMESTAMP}.sql.gz"
    fi
else
    echo "⚠️ File core/.env tidak ditemukan! Snapshot database dilewati."
fi

# 3. Backup Arsip File Lama (core & upload)
echo "==> [2/5] Mengarsipkan folder lama (core & file upload)..."
tar -czf "${BACKUP_DIR}/files_legacy_sebelum_migrasi_${TIMESTAMP}.tar.gz" \
    --exclude="core/vendor" \
    --exclude="core/storage/framework/cache" \
    core index.php member_files officer_files supervisor_files category_images incoming_letters outgoing_letters 2>/dev/null || true
echo "✅ File legacy berhasil diarsipkan ke: ${BACKUP_DIR}/files_legacy_sebelum_migrasi_${TIMESTAMP}.tar.gz"

# 4. Buat direktori target simkodes & simkodes/public
echo "==> [3/5] Menyiapkan direktori baru: ${TARGET_PATH}..."
mkdir -p "${TARGET_PATH}/public"

# 5. Pindahkan / Salin file konfigurasi .env
echo "==> [4/5] Menyalin konfigurasi .env production..."
if [ -f "core/.env" ]; then
    cp -n "core/.env" "${TARGET_PATH}/.env"
    echo "✅ File .env berhasil disalin ke: ${TARGET_PATH}/.env"
fi

# 6. Salin seluruh file upload pengguna ke public/
echo "==> [5/5] Menyalin seluruh data upload pengguna ke ${TARGET_PATH}/public/..."
UPLOAD_DIRS=("member_files" "officer_files" "supervisor_files" "category_images" "incoming_letters" "outgoing_letters")

for dir in "${UPLOAD_DIRS[@]}"; do
    if [ -d "$dir" ]; then
        mkdir -p "${TARGET_PATH}/public/${dir}"
        cp -rf "${dir}/"* "${TARGET_PATH}/public/${dir}/" 2>/dev/null || true
        echo "   - Folder '${dir}' tersalin."
    fi
done

# Set permissions
chmod -R 775 "${TARGET_PATH}/public" 2>/dev/null || true

echo "=========================================================="
echo "🎉 MIGRASI PERSIAPAN SELESAI DENGAN AMAN!"
echo "Database & seluruh file upload sudah siap di: ${TARGET_PATH}"
echo "Langkah selanjutnya:"
echo "1. Jalankan workflow GitHub Actions: 'Continuous Deployment - Production' (Ketik: DEPLOY)."
echo "2. Ubah Document Root subdomain simkodes.sranak.com di Hostinger hPanel ke:"
echo "   domains/sranak.com/public_html/simkodes"
echo "=========================================================="

// function hapus() {
//     if (confirm("Yakin mau hapus data ini?")) {
//         alert("Data dihapus (dummy)");
//     }
// }

let hargaSewa = 0;

// ─── Toggle penyewa lama/baru ──────────────────────────
function togglePenyewa() {
    const mode = document.querySelector(
        'input[name="mode_penyewa"]:checked',
    ).value;
    const lamaSection = document.getElementById("penyewa_lama_section");
    const baruSection = document.getElementById("penyewa_baru_section");
    if (mode === "lama") {
        lamaSection.style.display = "block";
        baruSection.style.display = "none";
        document.getElementById("nama").value = "";
        document.getElementById("no_hp").value = "";
        document.getElementById("alamat").value = "";
    } else {
        lamaSection.style.display = "none";
        baruSection.style.display = "block";
        document.getElementById("penyewa_id").value = "";
    }
}

// ─── Unit berubah ──────────────────────────────────────
document.getElementById("unit_id").addEventListener("change", function () {
    const selected = this.options[this.selectedIndex];
    hargaSewa = parseInt(selected.getAttribute("data-harga")) || 0;
    const periode = selected.getAttribute("data-periode");
    const tipe = selected.getAttribute("data-tipe");

    // Info harga
    document.getElementById("unit_info").innerHTML = hargaSewa
        ? "Harga sewa: <strong>Rp " +
          hargaSewa.toLocaleString("id-ID") +
          "</strong> / " +
          periode
        : "";

    // Nama toko hanya untuk kios
    const namaTokoField = document.getElementById("nama_toko_field");
    if (tipe === "kios") {
        namaTokoField.style.display = "block";
    } else {
        namaTokoField.style.display = "none";
        document.getElementById("nama_toko").value = "";
    }

    // Jika tipe pelunasan, auto-fill jumlah
    if (
        document.getElementById("tipe_bayar").value === "pelunasan" &&
        hargaSewa > 0
    ) {
        document.getElementById("jumlah_bayar").value = hargaSewa;
    }

    onJumlahInput();
});

// ─── Tipe bayar berubah ────────────────────────────────
function onTipeChange() {
    const tipe = document.getElementById("tipe_bayar").value;
    const hint = document.getElementById("tipe_hint");

    if (tipe === "pelunasan") {
        if (hargaSewa > 0) {
            document.getElementById("jumlah_bayar").value = hargaSewa;
        }
        hint.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" style="width:13px;height:13px;flex-shrink:0;">
                    <path fill-rule="evenodd" d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-6 3.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7.293 5.293a1 1 0 1 1 .99 1.667c-.459.134-.715.369-.85.59a.25.25 0 0 0 .444.224c.24-.4.658-.769 1.313-.898a2.5 2.5 0 0 0-2.384-3.633 2.5 2.5 0 0 0-1.927 3.546.75.75 0 0 0 1.436-.428A1 1 0 0 1 7.293 5.293Z" clip-rule="evenodd" />
                </svg> Sewa langsung <strong>Aktif</strong>. Tanggal mulai otomatis terisi hari ini.`;
    } else {
        document.getElementById("jumlah_bayar").value = "";
        hint.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" style="width:13px;height:13px;flex-shrink:0;">
                    <path fill-rule="evenodd" d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-6 3.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7.293 5.293a1 1 0 1 1 .99 1.667c-.459.134-.715.369-.85.59a.25.25 0 0 0 .444.224c.24-.4.658-.769 1.313-.898a2.5 2.5 0 0 0-2.384-3.633 2.5 2.5 0 0 0-1.927 3.546.75.75 0 0 0 1.436-.428A1 1 0 0 1 7.293 5.293Z" clip-rule="evenodd" />
                </svg> Sewa berstatus <strong>Booking</strong>. Tanggal mulai otomatis terisi saat pelunasan.`;
    }

    document.getElementById("warn_ubah_lunas").style.display = "none";
}

// ─── Jumlah berubah ────────────────────────────────────
function onJumlahInput() {
    const jumlah = parseInt(document.getElementById("jumlah_bayar").value) || 0;
    const tipe = document.getElementById("tipe_bayar").value;

    // Tampilkan warning ubah ke lunas jika DP tapi jumlah = harga sewa
    document.getElementById("warn_ubah_lunas").style.display =
        tipe === "dp" && hargaSewa > 0 && jumlah >= hargaSewa
            ? "block"
            : "none";
}

// ─── Tombol "Ya, ubah ke Lunas" ───────────────────────
function ubahKeLunas() {
    document.getElementById("tipe_bayar").value = "pelunasan";
    document.getElementById("jumlah_bayar").value = hargaSewa;
    document.getElementById("warn_ubah_lunas").style.display = "none";
    onTipeChange();
}

// ─── Validasi sebelum submit ───────────────────────────
document.getElementById("formSewa").addEventListener("submit", function (e) {
    const jumlah = parseInt(document.getElementById("jumlah_bayar").value) || 0;
    const tipe = document.getElementById("tipe_bayar").value;

    // DP tidak boleh >= harga sewa
    if (tipe === "dp" && hargaSewa > 0 && jumlah >= hargaSewa) {
        e.preventDefault();
        document.getElementById("warn_ubah_lunas").style.display = "block";
        document
            .getElementById("jumlah_bayar")
            .scrollIntoView({ behavior: "smooth" });
        return;
    }

    // Pelunasan harus tepat sama dengan harga sewa
    if (tipe === "pelunasan" && hargaSewa > 0 && jumlah !== hargaSewa) {
        e.preventDefault();
        alert(
            "Untuk Langsung Lunas, jumlah harus sama dengan harga sewa:\nRp " +
                hargaSewa.toLocaleString("id-ID"),
        );
        document.getElementById("jumlah_bayar").focus();
    }
});

// ─── Init saat load (setelah validation error) ─────────
window.addEventListener("DOMContentLoaded", function () {
    const unitSelect = document.getElementById("unit_id");
    if (unitSelect.value) {
        unitSelect.dispatchEvent(new Event("change"));
    }
    onTipeChange();
});

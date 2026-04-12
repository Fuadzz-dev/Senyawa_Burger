<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Menu – Admin</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Nunito:wght@400;600;700;800&display=swap"
      rel="stylesheet"
  />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --orange: #e8500a;
        --orange-bg: #ff6b2b;
        --orange-light: #ff6b2b;
        --green: #4caf50;
        --green-dark: #3d8b40;
        --red: #e85555;
        --red-dark: #c83c3c;
        --purple: #7B61FF;
        --purple-dark: #6348E0;
        --surface: #ffffff;
        --border: #eeeeee;
        --text-dark: #1a1008;
        --text-muted: #888888;
        --radius: 16px;
        --pill: 100px;
        --cream: #faefe2;
        --dark: #1a1008;
        --card-bg: #ffffff;
        --text: #1a1008;
        --gray: #888;
    }

    html, body { height: 100%; }

    body {
        font-family: "Nunito", sans-serif;
        background: var(--cream);
        color: var(--text-dark);
        display: flex;
        min-height: 100vh;
    }

    /* ══ SIDEBAR ══ */
    .sidebar {
      width: 240px; min-height: 100vh;
      background: var(--orange-bg);
      display: flex; flex-direction: column;
      align-items: center;
      padding: 36px 20px 28px;
      flex-shrink: 0;
    }

    .avatar {
      width: 96px; height: 96px; border-radius: 50%;
      background: rgba(0,0,0,0.22);
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 14px;
    }
    .avatar svg { width: 58px; height: 58px; fill: rgba(0,0,0,0.55); }

    .sidebar-name {
      font-size: 17px; font-weight: 700;
      color: #fff; text-align: center;
    }
    .sidebar-id {
      font-size: 13.5px; font-weight: 600;
      color: rgba(255,255,255,0.85);
      margin-top: 4px; margin-bottom: 28px;
      letter-spacing: 0.5px;
    }

    .nav-item {
      display: flex; align-items: center; gap: 10px;
      width: 100%; padding: 11px 14px;
      border-radius: var(--radius);
      cursor: pointer; margin-bottom: 4px;
      font-size: 14.5px; font-weight: 700;
      color: #fff; text-decoration: none;
      transition: background 0.2s;
    }
    .nav-item:hover  { background: rgba(0,0,0,0.12); }
    .nav-item.active { background: rgba(0,0,0,0.20); }
    .nav-item svg { width: 18px; height: 18px; stroke: #fff; stroke-width: 2; fill: none; flex-shrink: 0; }

    .sidebar-footer { margin-top: auto; }

    .btn-logout {
        background: var(--red);
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 9px 24px;
        font-family: "Nunito", sans-serif;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition:
            background 0.2s,
            transform 0.15s;
    }
    .btn-logout:hover {
        background: var(--red-dark);
        box-shadow: 0 4px 12px rgba(232, 85, 85, 0.3);
        transform: translateY(-2px);
    }
    .btn-logout:active { transform: scale(0.96); }

    /* ══ MAIN ══ */
    .main { flex: 1; padding: 32px 36px 40px; overflow-y: auto; }

    .page-title {
        font-family: "Bebas Neue", cursive;
        font-size: 42px;
        font-weight: 400;
        color: var(--text-dark);
        letter-spacing: 2px;
        text-transform: uppercase;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--orange);
        margin-bottom: 28px;
    }

    /* ══ FORM CARD ══ */
    .form-card {
      background: var(--surface);
      border: 2px solid var(--border);
      border-radius: var(--radius);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
      padding: 36px;
    }

    .form-group { margin-bottom: 24px; }
    .form-label { display: block; font-size: 13.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px; }

    .form-input, .form-textarea {
      width: 100%; border: 1.5px solid var(--border); border-radius: 8px;
      padding: 12px 14px;
      font-family: "Nunito", sans-serif; font-size: 14px; color: var(--text-dark);
      outline: none; background: #fff;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input:focus, .form-textarea:focus {
      border-color: var(--orange);
      box-shadow: 0 0 0 3px rgba(232,80,10,0.2);
    }
    .form-textarea { resize: vertical; min-height: 100px; }

    /* Photo upload area */
    .photo-upload {
      border: 2px dashed var(--border); border-radius: 8px;
      padding: 24px; text-align: center; cursor: pointer;
      transition: border-color 0.2s, background 0.2s;
      position: relative;
    }
    .photo-upload:hover { border-color: var(--orange); background: #FFF8EE; }
    .photo-upload input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .photo-upload-icon { font-size: 36px; margin-bottom: 12px; }
    .photo-upload-text { font-size: 14px; color: var(--text-muted); font-weight: 600; }
    .photo-upload-preview {
      width: 120px; height: 120px; border-radius: 12px;
      object-fit: cover; margin: 0 auto 12px;
      display: block;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Tags input for bahan */
    .tags-container {
      border: 1.5px solid var(--border); border-radius: 8px;
      padding: 10px 12px; background: #fff; min-height: 54px;
      display: flex; flex-wrap: wrap; gap: 8px; cursor: text;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .tags-container:focus-within {
      border-color: var(--orange);
      box-shadow: 0 0 0 3px rgba(232,80,10,0.2);
    }
    .tag-item {
      background: var(--cream); border: 1px solid #ECD7C3; border-radius: 20px;
      padding: 6px 12px; font-size: 13px; font-weight: 700;
      color: var(--text-dark); display: flex; align-items: center; gap: 6px;
    }
    .tag-remove {
      cursor: pointer; color: var(--text-muted); font-size: 16px; line-height: 1;
      transition: color 0.15s;
    }
    .tag-remove:hover { color: var(--red); }
    .tag-input {
      border: none; outline: none; flex: 1; min-width: 120px;
      font-family: "Nunito", sans-serif; font-size: 14px; color: var(--text-dark);
      background: transparent; padding: 4px 2px;
    }

    /* Autocomplete dropdown */
    .bahan-autocomplete-wrapper { position: relative; }
    .bahan-dropdown {
      display: none; position: absolute; top: 100%; left: 0; right: 0;
      background: #fff; border: 1.5px solid var(--border); border-top: none;
      border-radius: 0 0 8px 8px;
      max-height: 200px; overflow-y: auto; z-index: 100;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    .bahan-dropdown.open { display: block; }
    .bahan-dropdown-item {
      padding: 10px 14px; font-size: 13.5px; font-weight: 600;
      color: var(--text-dark); cursor: pointer;
      display: flex; align-items: center; justify-content: space-between;
      transition: background 0.12s;
    }
    .bahan-dropdown-item:hover { background: var(--cream); }
    .bahan-dropdown-item.disabled {
      opacity: 0.4; pointer-events: none;
    }
    .bahan-dropdown-item .bahan-satuan {
      font-size: 11.5px; color: var(--text-muted); font-weight: 500;
    }
    .bahan-dropdown-empty {
      padding: 14px; text-align: center; font-size: 13px;
      color: var(--text-muted); font-weight: 600;
    }

    .form-actions { display: flex; gap: 14px; margin-top: 32px; border-top: 1.5px solid var(--border); padding-top: 24px; }
    .btn {
      flex: 1; padding: 12px; border: none; border-radius: 8px;
      font-family: "Nunito", sans-serif; font-size: 14.5px; font-weight: 800;
      text-transform: uppercase; letter-spacing: 0.5px;
      cursor: pointer; transition: background 0.2s, transform 0.15s; text-align: center; text-decoration: none;
    }
    .btn:active { transform: scale(0.97); }
    .btn-cancel { background: #EEE; color: var(--text-dark); }
    .btn-cancel:hover { background: #E0DCD8; }
    .btn-submit { background: var(--orange); color: #fff; box-shadow: 0 4px 12px rgba(232, 80, 10, 0.25); }
    .btn-submit:hover { background: var(--orange-bg); }

    /* Kategori select */
    .form-select {
      width: 100%; border: 1.5px solid var(--border); border-radius: 8px;
      padding: 12px 14px;
      font-family: "Nunito", sans-serif; font-size: 14px; color: var(--text-dark);
      outline: none; background: #fff;
      transition: border-color 0.2s, box-shadow 0.2s;
      cursor: pointer;
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23888' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
    }
    .form-select:focus {
      border-color: var(--orange);
      box-shadow: 0 0 0 3px rgba(232,80,10,0.2);
    }

    /* ══ TOAST ══ */
    .toast {
      position: fixed; bottom: 28px; left: 50%;
      transform: translateX(-50%) translateY(16px);
      background: #1A1512; color: #fff;
      padding: 11px 22px; border-radius: 100px;
      font-size: 14px; font-weight: 500;
      opacity: 0; pointer-events: none;
      transition: opacity 0.3s, transform 0.3s;
      z-index: 999; white-space: nowrap;
    }
    .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

    /* Loading overlay */
    .loading-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,0.3); z-index: 500;
      align-items: center; justify-content: center;
    }
    .loading-overlay.show { display: flex; }
    .loading-spinner {
      width: 48px; height: 48px;
      border: 4px solid #fff;
      border-top-color: var(--orange);
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
  </style>
</head>
<body>

<!-- ═══ SIDEBAR ═══ -->
<aside class="sidebar">
  <div class="avatar">
    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
  </div>
  <p class="sidebar-name">Owner</p>
  <p class="sidebar-id"></p>

  <a class="nav-item" href="#">
    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
    Laporan
  </a>
  <a class="nav-item active" href="/owner/menu">
    <svg viewBox="0 0 24 24">
      <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
      <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
    </svg>
    Mengelola Menu
  </a>
  <a class="nav-item" href="/owner/bahan">
    <svg viewBox="0 0 24 24">
      <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
    </svg>
    Mengelola Stok
  </a>

  <div class="sidebar-footer">
    <button class="btn-logout" onclick="alert('👋 Berhasil logout')">Logout</button>
  </div>
</aside>

<!-- ═══ MAIN ═══ -->
<main class="main">
  <h1 class="page-title">Tambah Menu Baru</h1>

  <div class="form-card">
    <div class="form-group">
      <label class="form-label">Foto Menu</label>
      <div class="photo-upload" id="photoUploadArea">
        <input type="file" accept="image/*" id="photoInput" onchange="handlePhoto(event)" />
        <img id="photoPreview" class="photo-upload-preview" style="display:none;" />
        <div id="photoPlaceholder">
          <div class="photo-upload-icon">📷</div>
          <div class="photo-upload-text">Klik untuk upload foto</div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Nama Menu</label>
      <input class="form-input" id="inputNama" type="text" placeholder="cth. Cheese Burger, Beef Burger…" />
    </div>

    <div class="form-group">
      <label class="form-label">Harga (Rp)</label>
      <input class="form-input" id="inputHarga" type="number" min="0" step="500" placeholder="cth. 24500" />
    </div>

    <div class="form-group">
      <label class="form-label">Kategori</label>
      <select class="form-select" id="inputKategori">
        <option value="" disabled selected>Pilih kategori…</option>
        <option value="Makanan">Makanan</option>
        <option value="Minuman">Minuman</option>
        <option value="Snack">Snack</option>
        <option value="Dessert">Dessert</option>
      </select>
    </div>

    <div class="form-group">
      <label class="form-label">Bahan yang Diperlukan <span style="color:var(--text-muted);font-weight:600;">(ketik untuk mencari bahan)</span></label>
      <div class="bahan-autocomplete-wrapper">
        <div class="tags-container" id="tagsContainer" onclick="document.getElementById('tagInput').focus()">
          <input class="tag-input" id="tagInput" placeholder="Cari bahan…" oninput="filterBahan()" onfocus="openDropdown()" autocomplete="off" />
        </div>
        <div class="bahan-dropdown" id="bahanDropdown"></div>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Deskripsi <span style="color:var(--text-muted);font-weight:600;">(opsional)</span></label>
      <textarea class="form-textarea" id="inputDesc" placeholder="Deskripsi singkat menu…"></textarea>
    </div>

    <div class="form-actions">
      <a href="/owner/menu" class="btn btn-cancel">Batal</a>
      <button class="btn btn-submit" onclick="submitForm()">Simpan Menu</button>
    </div>
  </div>
</main>

<!-- Loading overlay -->
<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-spinner"></div>
</div>

<div class="toast" id="toast"></div>

<script>
  const allBahan = @json($bahanList);
  let tags = [];
  let photoFile = null;

  function renderTags() {
    const container = document.getElementById('tagsContainer');
    const input = document.getElementById('tagInput');
    container.innerHTML = '';
    tags.forEach((tag, i) => {
      const span = document.createElement('span');
      span.className = 'tag-item';
      span.innerHTML = `${tag} <span class="tag-remove" onclick="removeTag(${i})">×</span>`;
      container.appendChild(span);
    });
    container.appendChild(input);
  }

  function removeTag(i) {
    tags.splice(i, 1);
    renderTags();
    filterBahan();
  }

  function addTag(name) {
    const val = name.trim().toUpperCase();
    if (val && !tags.includes(val)) {
      tags.push(val);
      renderTags();
    }
    document.getElementById('tagInput').value = '';
    closeDropdown();
  }

  function filterBahan() {
    const query = document.getElementById('tagInput').value.trim().toLowerCase();
    const dropdown = document.getElementById('bahanDropdown');
    const filtered = allBahan.filter(b =>
      b.nama_bahan.toLowerCase().includes(query)
    );

    if (filtered.length === 0) {
      dropdown.innerHTML = '<div class="bahan-dropdown-empty">Tidak ada bahan ditemukan</div>';
    } else {
      dropdown.innerHTML = filtered.map(b => {
        const isSelected = tags.includes(b.nama_bahan.toUpperCase());
        return `<div class="bahan-dropdown-item ${isSelected ? 'disabled' : ''}" onclick="${isSelected ? '' : `addTag('${b.nama_bahan}')`}">
          <span>${b.nama_bahan} ${isSelected ? '✓' : ''}</span>
          <span class="bahan-satuan">${b.satuan || ''}</span>
        </div>`;
      }).join('');
    }
    dropdown.classList.add('open');
  }

  function openDropdown() {
    filterBahan();
  }

  function closeDropdown() {
    setTimeout(() => {
      document.getElementById('bahanDropdown').classList.remove('open');
    }, 150);
  }

  // Close dropdown when clicking outside
  document.addEventListener('click', (e) => {
    const wrapper = document.querySelector('.bahan-autocomplete-wrapper');
    if (wrapper && !wrapper.contains(e.target)) {
      document.getElementById('bahanDropdown').classList.remove('open');
    }
  });

  function handlePhoto(e) {
    const file = e.target.files[0];
    if (!file) return;
    photoFile = file;
    const reader = new FileReader();
    reader.onload = ev => {
      document.getElementById('photoPreview').src = ev.target.result;
      document.getElementById('photoPreview').style.display = 'block';
      document.getElementById('photoPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(file);
  }

  async function submitForm() {
    const nama     = document.getElementById('inputNama').value.trim();
    const harga    = document.getElementById('inputHarga').value;
    const kategori = document.getElementById('inputKategori').value;
    const desc     = document.getElementById('inputDesc').value.trim();



    // Validation
    if (!nama)                          { showToast('⚠️ Masukkan nama menu'); return; }
    if (!harga || parseInt(harga) < 0)  { showToast('⚠️ Masukkan harga valid'); return; }
    if (!kategori)                      { showToast('⚠️ Pilih kategori menu'); return; }

    // Build FormData
    const formData = new FormData();
    formData.append('nama_menu', nama.toUpperCase());
    formData.append('harga', harga);
    formData.append('Kategori', kategori);
    formData.append('deskripsi', desc);
    formData.append('bahan', JSON.stringify(tags));

    if (photoFile) {
      formData.append('foto', photoFile);
    }

    // Show loading
    document.getElementById('loadingOverlay').classList.add('show');

    try {
      const res = await fetch('/owner/menu', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      });

      const data = await res.json();

      if (data.success) {
        showToast('✅ Menu berhasil ditambahkan!');
        setTimeout(() => {
          window.location.href = '/owner/menu';
        }, 1200);
      } else {
        showToast('❌ ' + (data.message || 'Gagal menyimpan menu'));
      }
    } catch (e) {
      showToast('❌ Terjadi kesalahan server');
      console.error(e);
    } finally {
      document.getElementById('loadingOverlay').classList.remove('show');
    }
  }

  /* ── Toast ── */
  let toastTimer;
  function showToast(msg) {
    clearTimeout(toastTimer);
    const el = document.getElementById('toast');
    el.textContent = msg;
    el.classList.add('show');
    toastTimer = setTimeout(() => el.classList.remove('show'), 2400);
  }

  renderTags();
</script>
</body>
</html>

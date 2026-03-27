<!doctype html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0"
        />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Pembayaran</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Nunito:wght@400;600;700;800&display=swap"
            rel="stylesheet"
        />
    </head>
    <body>
        <!-- Header -->
        <div class="header">
            <button class="btn-back" onclick="goBack()" aria-label="Kembali">
                <svg viewBox="0 0 24 24" fill="none">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>
            <h1>Pembayaran</h1>
        </div>

        <!-- Order Type -->
        <div class="section" style="padding-top: 18px">
            <div class="order-type-badge" onclick="toggleOrderType()">
                <span class="order-type-left">Tipe Pemesanan</span>
                <div class="order-type-right">
                    <span id="orderTypeText">Makan di tempat</span>
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Informasi Pemesanan -->
        <div class="section" style="padding-top: 20px; padding-bottom: 20px">
            <p class="section-title">Informasi Pemesanan</p>

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-wrap">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <input type="text" id="inputNama" placeholder="" />
                </div>
            </div>

            <div class="form-group">
                <label class="form-label"
                    >Nomor Ponsel (untuk info promo)</label
                >
                <div class="input-wrap">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 10a19.79 19.79 0 0 1-3-8.57A2 2 0 0 1 3.62 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"
                        />
                    </svg>
                    <input type="tel" id="inputPhone" placeholder="" />
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0">
                <label class="form-label">Kirim struk ke email</label>
                <div class="input-wrap">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path
                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                        />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    <input type="email" id="inputEmail" placeholder="" />
                </div>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="section" style="padding-top: 20px; padding-bottom: 16px">
            <p class="section-title">Metode Pembayaran</p>

            <div class="method-grid">
                <div
                    class="method-card active"
                    id="methodOnline"
                    onclick="selectMethod('online')"
                >
                    <div class="method-icon">💳</div>
                    <span class="method-label">Pembayaran Online</span>
                </div>
                <div
                    class="method-card"
                    id="methodKasir"
                    onclick="selectMethod('kasir')"
                >
                    <div class="method-icon cash">🤝</div>
                    <span class="method-label">Bayar di Kasir</span>
                </div>
            </div>
        </div>

        <div class="divider-line"></div>

        <!-- Selesaikan Pembayaran -->
        <div
            class="section"
            style="padding-top: 16px; padding-bottom: 4px"
            id="onlineSection"
        >
            <p
                style="
                    font-size: 0.85rem;
                    color: var(--gray);
                    margin-bottom: 12px;
                    font-weight: 600;
                "
            >
                Selesaikan Pembayaran
            </p>

            <div class="pay-option selected" onclick="selectPay(this, 'QRIS')">
                <div class="pay-option-icon">📱</div>
                <span class="pay-option-name">QRIS</span>
                <div class="radio-circle"><div class="radio-dot"></div></div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="bottom-bar">
            <div class="total-block">
                <div class="total-label-row">Total Pembayaran</div>
                <span class="total-amount">Rp53.000</span>
            </div>
            <button class="btn-pay" onclick="checkout()">
                Lanjut Pembayaran
            </button>
        </div>

        <!-- QRIS Modal -->
        <div class="modal-overlay" id="qrisModal" onclick="if(event.target === this) closeModal('qrisModal')">
            <div class="modal" onclick="event.stopPropagation()">
                <div class="modal-handle"></div>
                <h2 class="modal-title" style="text-align: center; margin-bottom: 8px;">Scan QRIS</h2>
                <p id="qrisStatusText" style="text-align: center; font-size: 0.9rem; color: var(--gray); margin-bottom: 20px;">
                    Silakan scan QR Code di bawah ini untuk menyelesaikan pembayaran.
                </p>
                <div id="qrisImageContainer" style="display: flex; justify-content: center; align-items: center; background: #fff; padding: 16px; border-radius: 16px; border: 2px solid #eee; margin-bottom: 16px; min-height: 236px;">
                    <img id="qrisImage" src="" alt="QRIS Code" onerror="this.onerror=null; this.src='https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=error';" style="width: 200px; height: 200px; display: block; object-fit: contain;" />
                </div>
                <div id="qrisSuccessAnim" style="display: none; justify-content: center; align-items: center; background: #fff; padding: 16px; border-radius: 16px; border: 2px solid var(--orange); margin-bottom: 16px; height: 236px;">
                    <svg viewBox="0 0 24 24" fill="none" style="width: 100px; height: 100px; stroke: var(--orange); stroke-width: 3.5; stroke-linecap: round; stroke-linejoin: round;">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                </div>
                <div style="text-align: center; margin-bottom: 24px;">
                    <span style="font-size: 0.85rem; color: var(--gray);">Total Pembayaran</span>
                    <div id="qrisAmount" style="font-size: 1.4rem; font-weight: 800; color: var(--dark);">Rp0</div>
                </div>
                <button id="btnCancelQris" class="btn-pay" style="width: 100%; background: #eee; color: var(--dark); box-shadow: none;" onclick="closeModal('qrisModal')">
                    Batalkan
                </button>
            </div>
        </div>

        <!-- Toast -->
        <div class="toast" id="toast"></div>
    </body>
</html>

<!--CSS-->
<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --orange: #e8500a;
        --orange-light: #ff6b2b;
        --dark: #1a1008;
        --cream: #f5f0eb;
        --card-bg: #ffffff;
        --text: #1a1008;
        --gray: #888;
        --radius: 16px;
    }

    body {
        font-family: "Nunito", sans-serif;
        background: var(--cream);
        color: var(--text);
        max-width: 480px;
        margin: 0 auto;
        min-height: 100vh;
        overflow-x: hidden;
        padding-bottom: 120px;
    }

    /* ── Header ── */
    .header {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        border-bottom: 2px solid #eee;
        top: 0;
        z-index: 10;
        background: var(--card-bg);
    }

    .header h1 {
        font-family: "Bebas Neue", cursive;
        font-size: 1.3rem;
        font-weight: 400;
        color: var(--dark);
        letter-spacing: 2px;
    }

    .btn-back {
        position: absolute;
        left: 14px;
        width: 40px;
        height: 40px;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition:
            background 0.2s,
            transform 0.2s;
    }
    .btn-back:hover {
        background: var(--cream);
        transform: scale(1.08);
    }
    .btn-back:active {
        transform: scale(0.95);
    }
    .btn-back svg {
        width: 18px;
        height: 18px;
        stroke: var(--dark);
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        fill: none;
    }

    /* ── Sections ── */
    .section {
        padding: 18px 16px 0;
    }

    /* Order Type */
    .order-type-badge {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: rgba(232, 80, 10, 0.08);
        border: 1.8px solid var(--orange);
        border-radius: 50px;
        padding: 12px 18px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .order-type-badge:hover {
        background: rgba(232, 80, 10, 0.14);
    }

    .order-type-left {
        font-size: 0.82rem;
        color: var(--gray);
        font-weight: 600;
    }
    .order-type-right {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        font-weight: 800;
        color: var(--dark);
    }
    .order-type-right svg {
        width: 20px;
        height: 20px;
        stroke: var(--orange);
        stroke-width: 2.2;
        fill: none;
    }

    /* Section Title */
    .section-title {
        font-family: "Bebas Neue", cursive;
        font-size: 1.2rem;
        letter-spacing: 2px;
        color: var(--dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title::after {
        content: "";
        flex: 1;
        height: 3px;
        background: linear-gradient(to right, var(--orange), transparent);
        border-radius: 3px;
    }

    /* ── Dividers ── */
    .divider-line {
        height: 2px;
        background: #eee;
        margin: 0 16px;
    }

    /* ── Form ── */
    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 7px;
        display: block;
    }

    .input-wrap {
        display: flex;
        align-items: center;
        border: 2px solid #eee;
        border-radius: 10px;
        background: var(--card-bg);
        padding: 0 14px;
        transition:
            border-color 0.2s,
            box-shadow 0.2s;
    }
    .input-wrap:focus-within {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(232, 80, 10, 0.15);
    }

    .input-wrap svg {
        width: 18px;
        height: 18px;
        stroke: var(--gray);
        stroke-width: 1.8;
        fill: none;
        flex-shrink: 0;
        margin-right: 10px;
    }

    .input-wrap input {
        flex: 1;
        border: none;
        outline: none;
        font-family: "Nunito", sans-serif;
        font-size: 0.88rem;
        color: var(--text);
        padding: 12px 0;
        background: transparent;
    }
    .input-wrap input::placeholder {
        color: #bbb;
    }

    /* ── Payment Method ── */
    .method-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 4px;
    }

    .method-card {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1.8px solid #eee;
        border-radius: var(--radius);
        padding: 12px 14px;
        cursor: pointer;
        transition:
            border-color 0.2s,
            background 0.2s,
            box-shadow 0.2s;
        background: var(--card-bg);
    }
    .method-card.active {
        border-color: var(--orange);
        background: rgba(232, 80, 10, 0.08);
        box-shadow: 0 0 0 3px rgba(232, 80, 10, 0.15);
    }
    .method-card:hover:not(.active) {
        border-color: #ccc;
        background: var(--cream);
    }

    .method-icon {
        width: 42px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        background: linear-gradient(135deg, #2e6fd9, #5b9bf5);
        flex-shrink: 0;
    }
    .method-icon.cash {
        background: linear-gradient(135deg, #3cb878, #7fd17f);
    }

    .method-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1.3;
    }

    /* ── Payment Options ── */
    .pay-option {
        display: flex;
        align-items: center;
        border: 2px solid #eee;
        border-radius: var(--radius);
        padding: 14px 16px;
        margin-bottom: 10px;
        cursor: pointer;
        transition:
            border-color 0.2s,
            background 0.2s;
    }
    .pay-option:hover {
        background: var(--cream);
    }
    .pay-option.selected {
        border-color: var(--orange);
        background: rgba(232, 80, 10, 0.08);
    }

    .pay-option-icon {
        width: 38px;
        height: 38px;
        background: var(--cream);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        margin-right: 12px;
    }

    .pay-option-name {
        flex: 1;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--dark);
    }

    /* Radio */
    .radio-circle {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 2px solid #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: border-color 0.2s;
        flex-shrink: 0;
    }
    .pay-option.selected .radio-circle {
        border-color: var(--orange);
    }
    .radio-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: var(--orange);
        display: none;
    }
    .pay-option.selected .radio-dot {
        display: block;
    }

    /* ── Promo Row ── */
    .promo-row {
        display: flex;
        align-items: center;
        padding: 14px 16px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .promo-row:hover {
        background: var(--cream);
    }
    .promo-row svg {
        width: 20px;
        height: 20px;
        stroke: var(--orange);
        stroke-width: 1.8;
        fill: none;
        margin-right: 10px;
        flex-shrink: 0;
    }
    .promo-text {
        flex: 1;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--orange);
    }
    .promo-arrow {
        font-size: 16px;
        color: var(--gray);
    }

    /* ── Bottom Bar ── */
    .bottom-bar {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        max-width: 480px;
        background: var(--card-bg);
        border-top: 2px solid #eee;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px calc(14px + env(safe-area-inset-bottom));
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
        z-index: 50;
    }

    .total-block {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .total-label-row {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray);
        cursor: pointer;
    }
    .total-label-row svg {
        width: 14px;
        height: 14px;
        stroke: var(--gray);
        stroke-width: 2;
        fill: none;
    }

    .total-amount {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--dark);
    }

    .btn-pay {
        padding: 14px 22px;
        background: var(--orange);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-family: "Nunito", sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 6px 30px rgba(232, 80, 10, 0.4);
        transition:
            transform 0.15s,
            box-shadow 0.15s,
            background 0.2s;
        white-space: nowrap;
    }
    .btn-pay:hover {
        background: var(--orange-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(232, 80, 10, 0.5);
    }
    .btn-pay:active {
        transform: scale(0.96);
    }

    /* ── Modal Overlay ── */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(26, 16, 8, 0.55);
        z-index: 100;
        align-items: flex-end;
        justify-content: center;
    }
    .modal-overlay.open {
        display: flex;
        animation: fadeIn 0.25s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .modal {
        background: var(--card-bg);
        border-radius: 20px 20px 0 0;
        width: 100%;
        max-width: 480px;
        padding: 24px 16px 36px;
        animation: slideUp 0.3s cubic-bezier(0.22, 1, 0.36, 1);
    }
    @keyframes slideUp {
        from {
            transform: translateY(40px);
        }
        to {
            transform: translateY(0);
        }
    }

    .modal-handle {
        width: 36px;
        height: 4px;
        background: #eee;
        border-radius: 2px;
        margin: 0 auto 20px;
    }

    .modal-title {
        font-family: "Bebas Neue", cursive;
        font-size: 1.2rem;
        letter-spacing: 2px;
        color: var(--dark);
        margin-bottom: 16px;
    }

    .modal-option {
        display: flex;
        align-items: center;
        padding: 13px 0;
        border-bottom: 2px solid #eee;
        cursor: pointer;
    }
    .modal-option:last-child {
        border-bottom: none;
    }
    .modal-option-label {
        flex: 1;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--dark);
    }
    .modal-check {
        color: var(--orange);
        font-size: 18px;
        font-weight: 800;
        display: none;
    }
    .modal-option.active .modal-check {
        display: block;
    }

    /* ── Page enter animation ── */
    .header {
        animation: fadeUp 0.3s ease both;
    }
    .section {
        animation: fadeUp 0.4s ease both;
    }
    .divider {
        animation: fadeUp 0.4s ease 0.05s both;
    }
    .method-grid {
        animation: fadeUp 0.4s ease 0.1s both;
    }
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Toast */
    .toast {
        position: fixed;
        top: 16px;
        left: 50%;
        transform: translateX(-50%) translateY(-80px);
        background: var(--dark);
        color: white;
        border-radius: 30px;
        padding: 10px 22px;
        font-size: 0.88rem;
        font-weight: 600;
        z-index: 200;
        transition: transform 0.35s cubic-bezier(0.77, 0, 0.18, 1);
        white-space: nowrap;
    }
    .toast.show {
        transform: translateX(-50%) translateY(0);
    }
</style>

<!--Javascript-->
<script>
    let paymentTimeout; // Variabel timeout simulasi qris

    /* ── Order Type ── */
    function openOrderTypeModal() {
        document.getElementById("orderTypeModal").classList.add("open");
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove("open");
        if(id === 'qrisModal') {
            clearTimeout(paymentTimeout); // Batalkan simulasi jika ditutup
        }
    }
    function setOrderType(label, el) {
        document
            .querySelectorAll("#orderTypeModal .modal-option")
            .forEach((o) => o.classList.remove("active"));
        el.classList.add("active");
        document.getElementById("orderTypeText").textContent = label;
        setTimeout(() => closeModal("orderTypeModal"), 200);
    }

    /* ── Payment Method ── */
    let currentMethod = "online";
    function selectMethod(method) {
        currentMethod = method;
        document
            .getElementById("methodOnline")
            .classList.toggle("active", method === "online");
        document
            .getElementById("methodKasir")
            .classList.toggle("active", method === "kasir");
        document.getElementById("onlineSection").style.display =
            method === "online" ? "" : "none";
        document.getElementById("dividerPromo").style.display =
            method === "online" ? "" : "none";
    }

    /* ── Pay Option ── */
    function selectPay(el, name) {
        document
            .querySelectorAll(".pay-option")
            .forEach((o) => o.classList.remove("selected"));
        el.classList.add("selected");
        showToast(`Metode: ${name}`);
    }

    /* ── Checkout ── */
    async function checkout() {
        const nama = document.getElementById("inputNama").value.trim();
        const phone = document.getElementById("inputPhone").value.trim();
        if (!nama) {
            showToast("Masukkan nama lengkap");
            return;
        }
        if (!phone) {
            showToast("Masukkan nomor ponsel");
            return;
        }

        const totalText = document.querySelector(".total-amount").textContent;
        const amount = totalText.replace(/[^0-9]/g, '');
        const email = document.getElementById("inputEmail").value.trim();
        const orderType = document.getElementById("orderTypeText").textContent.trim();
        const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

        if (cartItems.length === 0) {
            showToast("Keranjang belanja kosong!");
            return;
        }

        const payload = {
            nama: nama,
            phone: phone,
            email: email,
            orderType: orderType,
            amount: amount,
            paymentMethod: currentMethod,
            cart: cartItems
        };

        showToast("Sedang memproses pesanan...");
        
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const response = await fetch('/api/pembayaran/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Clear cart after successful order creation
                localStorage.removeItem('cart');

                if (data.method === 'kasir') {
                    showToast("Pesanan berhasil disimpan! Silakan menuju kasir.");
                    setTimeout(() => {
                        window.location.href = `/menunggu-kasir`;
                    }, 2000);
                } else if (data.qrString) {
                    const qrUrl = `https://quickchart.io/qr?size=250&text=${encodeURIComponent(data.qrString)}`;
                    
                    document.getElementById("qrisImage").src = qrUrl;
                    document.getElementById("qrisAmount").textContent = totalText;
                    document.getElementById("qrisImageContainer").style.display = "flex";
                    document.getElementById("qrisSuccessAnim").style.display = "none";
                    document.getElementById("qrisStatusText").innerHTML = "Menunggu pembayaran via QRIS...<br><small style='color:var(--orange)'>Status akan diperbarui otomatis</small>";
                    document.getElementById("qrisStatusText").style.color = "var(--gray)";
                    document.getElementById("qrisStatusText").style.fontWeight = "normal";
                    document.getElementById("qrisStatusText").style.fontSize = "0.9rem";
                    document.getElementById("btnCancelQris").style.display = "block";
                    
                    document.getElementById("qrisModal").classList.add("open");

                    pollPaymentStatus(data.reference);
                }
            } else {
                showToast(data.message || "Gagal memproses Checkout, silakan coba lagi");
            }
        } catch (error) {
            console.error(error);
            showToast("Terjadi kesalahan sistem saat memproses checkout.");
        }
    }

    function pollPaymentStatus(reference) {
        clearTimeout(paymentTimeout);
        paymentTimeout = setTimeout(async () => {
            if (!document.getElementById("qrisModal").classList.contains("open")) {
                return;
            }
            
            try {
                const response = await fetch(`/api/pembayaran/status/${reference}`);
                const data = await response.json();
                
                if (data.success && data.statusCode === "00") {
                    document.getElementById("qrisImageContainer").style.display = "none";
                    document.getElementById("qrisSuccessAnim").style.display = "flex";
                    document.getElementById("btnCancelQris").style.display = "none";
                    
                    document.getElementById("qrisStatusText").textContent = "Pembayaran Berhasil Diverifikasi!";
                    document.getElementById("qrisStatusText").style.color = "var(--orange)";
                    document.getElementById("qrisStatusText").style.fontWeight = "bold";
                    document.getElementById("qrisStatusText").style.fontSize = "1.1rem";
                    
                    showToast("Pembayaran QRIS berhasil diterima!");
                    
                    setTimeout(() => {
                        window.location.href = "{{ url('/') }}";
                    }, 2500);
                } else {
                    pollPaymentStatus(reference);
                }
            } catch (error) {
                console.error("Polling error", error);
                pollPaymentStatus(reference);
            }
        }, 5000);
    }

    function goBack() {
        window.location.href = "{{ url('/keranjang') }}";
    }

    /* ── Toast ── */
    let toastTimer;
    function showToast(msg) {
        clearTimeout(toastTimer);
        const el = document.getElementById("toast");
        el.textContent = msg;
        el.classList.add("show");
        toastTimer = setTimeout(() => el.classList.remove("show"), 2200);
    }

    /* ── Init Total ── */
    document.addEventListener("DOMContentLoaded", function() {
        const storedTotal = localStorage.getItem("checkout_total");
        if (storedTotal) {
            document.querySelector(".total-amount").textContent = storedTotal;
        } else {
            const params = new URLSearchParams(window.location.search);
            const total = params.get("total");
            if (total) {
                document.querySelector(".total-amount").textContent = total;
            }
        }
    });
</script>

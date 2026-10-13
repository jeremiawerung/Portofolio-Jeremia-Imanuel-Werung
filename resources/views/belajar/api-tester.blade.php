@extends('belajar.layout')

@section('title', 'Mini API Tester')

@section('content')
  <div class="hero-kicker">
    <a href="{{ route('belajar.index') }}">&larr; kembali ke roadmap</a>
  </div>
  <h1>Mini API Tester</h1>
  <p class="lede">Latihan cepat: masukkan URL API publik, pilih method, lihat responsenya langsung di halaman ini.</p>

  <div class="api-tester">
    <div class="api-row">
      <select id="apiMethod">
        <option>GET</option>
        <option>POST</option>
        <option>PUT</option>
        <option>DELETE</option>
      </select>
      <input type="text" id="apiUrl" placeholder="https://reqres.in/api/users/2">
      <button class="btn" id="apiSend">Kirim</button>
    </div>
    <textarea class="api-body" id="apiBody" placeholder='Body JSON (opsional, dipakai untuk POST / PUT), contoh: {"name":"qa"}'></textarea>
    <div class="api-result" id="apiResult" style="display:none;"></div>
    <p class="api-note">Kalau muncul error <code>Failed to fetch</code>, kemungkinan besar itu masalah CORS dari API tujuan. Halaman ini sudah berjalan lewat <code>http://localhost</code> (server Laravel), jadi masalah CORS murni dari sisi API tujuan.</p>
  </div>

<script>
  function escapeHtml(str) {
    return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
  }

  const sendBtn = document.getElementById("apiSend");
  const urlInput = document.getElementById("apiUrl");
  const methodSelect = document.getElementById("apiMethod");
  const bodyArea = document.getElementById("apiBody");
  const resultBox = document.getElementById("apiResult");

  sendBtn.addEventListener("click", async () => {
    const url = urlInput.value.trim();
    if (!url) {
      resultBox.style.display = "block";
      resultBox.innerHTML = `<div class="api-status err">Isi dulu URL API-nya.</div>`;
      return;
    }

    const method = methodSelect.value;
    const bodyText = bodyArea.value.trim();
    const opts = { method };
    if ((method === "POST" || method === "PUT") && bodyText) {
      opts.headers = { "Content-Type": "application/json" };
      opts.body = bodyText;
    }

    resultBox.style.display = "block";
    resultBox.innerHTML = `<div class="api-status">Mengirim request...</div>`;
    sendBtn.disabled = true;

    const started = performance.now();
    try {
      const res = await fetch(url, opts);
      const elapsed = Math.round(performance.now() - started);
      const rawText = await res.text();
      let displayBody = rawText;
      try { displayBody = JSON.stringify(JSON.parse(rawText), null, 2); } catch (e) {}

      const headerLines = [];
      res.headers.forEach((v, k) => headerLines.push(`${k}: ${v}`));

      resultBox.innerHTML = `
        <div class="api-status ${res.ok ? "ok" : "err"}">${res.status} ${res.statusText} - ${elapsed}ms</div>
        <pre class="api-response">${escapeHtml(headerLines.join("\n"))}\n\n${escapeHtml(displayBody || "(response kosong)")}</pre>
      `;
    } catch (err) {
      resultBox.innerHTML = `
        <div class="api-status err">Request gagal: ${escapeHtml(err.message)}</div>
        <pre class="api-response">Kemungkinan penyebab:
- API tujuan memblokir cross-origin request (CORS)
- URL salah ketik atau API sedang down</pre>
      `;
    } finally {
      sendBtn.disabled = false;
    }
  });
</script>
@endsection

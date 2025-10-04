<footer class="admin-footer text-center mt-auto py-3">
  <div class="container">
    <p class="mb-1">
      <strong>© <?php echo date('Y'); ?> Asiatek</strong> — All Rights Reserved.
    </p>
    <small class="text-muted">
      Built with ❤️ by <span class="footer-brand">Asiatek Developer Team</span>
    </small>
  </div>
</footer>

<style>
  /* ===== FOOTER STYLE ===== */
  .admin-footer {
    background: linear-gradient(135deg, #b8860b, #ffd700);
    color: #fff;
    box-shadow: 0 -3px 8px rgba(0, 0, 0, 0.2);
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    letter-spacing: 0.3px;
    position: relative;
    z-index: 10;
  }

  .admin-footer p {
    font-weight: 600;
    margin: 0;
    color: #fff;
  }

  .admin-footer small {
    display: block;
    color: #fffbea;
    font-size: 0.85rem;
    margin-top: 4px;
  }

  .admin-footer .footer-brand {
    color: #fff;
    font-weight: 700;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
  }

  .admin-footer .footer-brand:hover {
    color: #fffacd;
  }

  /* Efek glow lembut di bagian atas footer */
  .admin-footer::before {
    content: "";
    position: absolute;
    top: -4px;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, rgba(255,255,255,0.5), rgba(255,255,255,0.1));
  }
</style>

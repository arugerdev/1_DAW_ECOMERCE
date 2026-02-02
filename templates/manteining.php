<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .maintenance-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        padding: 60px 40px;
        max-width: 500px;
        text-align: center;
        animation: slideIn 0.6s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .maintenance-icon {
        font-size: 80px;
        margin-bottom: 30px;
        animation: spin 3s linear infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    h1 {
        color: #333;
        font-size: 36px;
        margin-bottom: 20px;
    }

    .subtitle {
        color: #666;
        font-size: 18px;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .message {
        background: #f0f4ff;
        border-left: 4px solid #667eea;
        padding: 20px;
        margin-bottom: 30px;
        border-radius: 5px;
        color: #555;
    }

    .contact-info {
        color: #999;
        font-size: 14px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
</style>

<section class=" p-1 p-lg-4 w-100 d-flex place-items-center justify-content-center" id="grant-container">
    <div class="maintenance-container">
        <div class="maintenance-icon">🔧</div>
        <h1>Estamos en Mantenimiento</h1>
        <p class="subtitle">Nos disculpamos por cualquier inconveniente</p>
        <div class="message">
            <p>Nuestra tienda se encuentra temporalmente en mantenimiento para mejorar tu experiencia de compra.</p>
            <p style="margin-top: 15px;">Esperamos estar de vuelta muy pronto con mejoras emocionantes.</p>
        </div>
        <div class="contact-info">
            <p>Gracias por tu paciencia y tu confianza.</p>
        </div>
    </div>
</section>
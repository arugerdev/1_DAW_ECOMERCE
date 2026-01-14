<div class="modal-wrapper modal" id="modal-product-creator">
    <div class="modal-body card">
        <div class="modal-header">
            <h2 class="heading">Crear producto</h2>
            <a href="#" role="button" class="close" aria-label="close this modal">
                <svg viewBox="0 0 24 24">
                    <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" />
                </svg>
            </a>
        </div>

        <form action="">
            <input type="text" placeholder="Nombre del producto" require>
            <input type="number" placeholder="Precio del producto (€)" require>
            <input type="number" placeholder="Cantidad stock" require>

            <textarea rows="10" name="" id="" placeholder="Descripción del producto"></textarea>

            <input type="text" placeholder="Nombre del producto" require>

        </form>

        <section class="buttons-group">
            <a href="#" role="button" class="button danger">Cancelar</a>
            <button class="success">Crear</button>
        </section>
    </div>
    <a href="#" class="outside-trigger"></a>
</div>

<style>
    .buttons-group {
        display: flex;
        flex-direction: row;
        padding: 1rem;
        gap: 24px;
        justify-content: end;
    }

    button,
    .button {
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        display: flex;
        padding: 8px 16px;
        outline: none;
        border: 2px solid black;
        border-radius: 12px;
        background-color: transparent;
        cursor: pointer;
        margin: 0;
        text-decoration: none;
        text-align: center;
        font-size: medium;
        transition: all 0.3s ease-in-out;
    }

    .success {
        border: 2px solid rgb(80, 192, 130);
        color: rgb(80, 192, 130);

    }

    .success:hover {
        background-color: rgb(214, 248, 229);
    }

    .danger {
        border: 2px solid rgb(192, 80, 80);
        color: rgb(192, 80, 80);

    }

    .danger:hover {
        background-color: rgb(248, 214, 214);
    }

    .modal-header {
        align-items: baseline;
        display: flex;
        justify-content: space-between;
    }

    .close {
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        height: 16px;
        text-decoration: none;
        width: 16px;
    }

    .close svg {
        width: 16px;
    }

    .modal-wrapper {
        align-items: center;
        background: rgba(0, 0, 0, 0.7);
        bottom: 0;
        display: flex;
        justify-content: center;
        left: 0;
        position: fixed;
        right: 0;
        top: 0;
    }

    .modal {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        visibility: hidden;
    }

    .modal:target {
        opacity: 1;
        visibility: visible;
    }

    .modal:target .modal-body {
        opacity: 1;
        transform: translateY(1);
    }

    .modal .modal-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        max-width: 60vw;
        opacity: 0;
        transform: translateY(-100px);
        transition: opacity 0.3s ease-in-out;
        width: 100%;
        z-index: 1;
        background-color: white;
        padding: 2rem;
        border-radius: 24px;
        max-height: 70vh;
        height: 100%;
    }

    .modal .modal-body form {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
        gap: 12px;
    }

    .outside-trigger {
        bottom: 0;
        cursor: default;
        left: 0;
        position: fixed;
        right: 0;
        top: 0;
    }

    .button__link {
        text-decoration: none;
    }

    input {
        display: flex;
        padding: 8px 12px;
        border-radius: 24px;
        outline: none;
        border: 1px solid black;
    }
</style>
<?php
$chatId = $_GET['id'] ?? null;
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="far fa-comments mr-2"></i>Chat de clientes
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-4">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-inbox mr-1"></i>
                            Conversaciones
                        </h3>
                    </div>

                    <div class="card-body p-0" style="max-height: 70vh; overflow-y:auto">
                        <ul class="list-group list-group-flush" id="chat-list">
                            <li class="list-group-item text-center text-muted py-4">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Cargando chats...
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title" id="chat-title">
                            <i class="fas fa-user mr-1"></i>
                            Selecciona un chat
                        </h3>
                    </div>

                    <div class="card-body direct-chat-messages direct-chat-primary" style="height: 55vh; overflow-x:hidden; overflow-y:auto" id="chat-messages">
                        <div class="text-center text-muted mt-5">
                            <i class="far fa-comments fa-2x mb-3"></i>
                            <p>Selecciona un chat para empezar</p>
                        </div>
                    </div>

                    <div class="card-footer">
                        <form action="javascript:void(0)" id="chat-sender" class="input-group">
                            <input type="text" id="chat-input" class="form-control" placeholder="Escribe un mensaje..." disabled>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-success" id="send-msg" disabled>
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    let currentChat = <?php echo $chatId ? intval($chatId) : 'null' ?>;

    $(document).ready(function() {

        loadChats();

        if (currentChat) {
            openChat(currentChat);
        }

        $('#send-msg').on('click', sendMessage);
        $('#chat-input').on('keypress', e => {
            if (e.key === 'Enter') sendMessage();
        });

        // setInterval(() => {
        loadChats();
        if (currentChat) loadMessages(currentChat, false);
        // }, 1000);

    });


    /* =========================
    CHATS
    ========================= */

    function loadChats(showLoader = true) {
        selectData(
            "c.id, c.readed, cu.name",
            "chat c LEFT JOIN customers cu ON cu.id = c.customerId",
            "ORDER BY c.updated_at DESC",
            (res) => {
                let html = '';

                if (res.data.length === 0) {
                    html = `
                            <li class="list-group-item text-center text-muted py-4">
                                <i class="far fa-folder-open mr-2"></i>
                                No hay chats
                            </li>
                            `;
                } else {
                    res.data.forEach(chat => {
                        html += `
                                <li class="list-group-item chat-item ${chat.id == currentChat ? '" style="background-color:#eee;' : ''}"
                                    onclick="openChat(${chat.id})"
                                    style="cursor:pointer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>${chat.name}</strong><br>
                                            <small class="text-muted">Chat #${chat.id}</small>
                                        </div>
                                        ${chat.readed == 0
                                        ? `<span class="badge badge-danger">Nuevo</span>`
                                        : `<span class="badge badge-secondary">Leído</span>`
                                        }
                                    </div>
                                </li>`;
                    });
                }

                $('#chat-list').html(html);
            }
        );
    }

    /* =========================
    MENSAJES
    ========================= */

    function openChat(chatId) {
        currentChat = chatId;
        lastMsgId = 0;

        $('#chat-input, #send-msg').prop('disabled', false);

        selectData(
            "cu.name",
            "chat c LEFT JOIN customers cu ON cu.id = c.customerId",
            `WHERE c.id = ${chatId}`,
            (res) => {
                $('#chat-title').html(`<i class="fas fa-user mr-1"></i>${res.data[0].name}`);
            }
        );

        markAsRead(chatId);
        loadMessages(chatId);

    }

    function loadMessages(chatId, scroll = true) {
        selectData(
            "m.id, m.from_admin, m.created_at, m.text",
            "msg m ",
            `WHERE m.chatId = ${chatId} ORDER BY m.created_at`,
            (res) => {
                let html = '';

                res.data.forEach(msg => {
                    html += `
    <div class="direct-chat-msg ${msg.from_admin == 1 ? 'right" style="display: flex;flex-direction: column;align-items: flex-end;" ' : '" style="display: flex;flex-direction: column;align-items: flex-start;"'}>
        <div class="direct-chat-text float-${msg.from_admin == 1 ? 'right' : 'left'}" style="width:max-content; margin:0; max-width: 90%; display:block;">
            ${msg.text}
        </div>
        <div class="direct-chat-infos clearfix" style="margin:0;">
            <span class="direct-chat-timestamp text-sm float-${msg.from_admin == 1 ? 'right' : 'left'}" style="margin:0;">${timeAgo(new Date(msg.created_at))}</span>
        </div>
    </div>`;


                    `
    <div class="direct-chat-msg right">
        <div class="direct-chat-text">
            You better believe it!
        </div>
    </div>
    `
                });

                $('#chat-messages').html(html);
                if (scroll) $('#chat-messages').scrollTop(999999);
            }
        );
    }

    /* =========================
    ENVIAR
    ========================= */

    function sendMessage() {
        const text = $('#chat-input').val().trim();
        if (!text || !currentChat) return;

        insertData(
            "msg",
            "text, chatId, from_admin",
            `"${text}", ${currentChat}, 1`,
            "",
            (data) => {
                $('#chat-input').val('');
                loadMessages(currentChat);
                loadChats(false);
            }
        );

    }

    /* =========================
    UTIL
    ========================= */

    function markAsRead(chatId) {
        updateData(
            "chat",
            `readed = 1`,
            `WHERE id = ${chatId}`,
        )
    }
</script>
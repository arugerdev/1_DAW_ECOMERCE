function getRowActions(id, onClickEdit = null, onClickDelete = null, onClickView = null) {
    let html = ''
    html += '<div class="btn-group" role="group">';
    if (onClickEdit != null) {
        html += `<button class="${id}-editer btn btn-sm btn-outline-primary edit-btn" 
                        data-toggle="tooltip" 
                        title="Editar"  
                        onClick="${onClickEdit}">
                    <i class="fas fa-edit"></i>
                </button>`
    }
    if (onClickView != null) {
        html += `<button class="${id}-viewer btn btn-sm btn-outline-info view-btn" 
                        data-toggle="tooltip" 
                        title="Ver Detalles" 
                        onClick="${onClickView}">
                    <i class="fa-solid fa-eye"></i>
                </button>`
    }

    if (onClickDelete != null) {
        html += `<button class="${id}-remover btn btn-sm btn-outline-danger delete-btn" 
                        data-toggle="tooltip" 
                        title="Eliminar" 
                        onClick="${onClickDelete}">
                    <i class="fas fa-trash"></i>
                </button>`
    }
    html += '</div>';

    return html;
}

function getCheckBox(value, callback = null) {
    return `
        <div class="form-check w-100 d-flex justify-content-center">
            <input class="form-check-input" type='checkbox' value='${value}' onChange="${callback}" ${value == 1 ? 'checked' : ''} ${callback == null ? 'disabled' : ''} >
        </div>
        `
}

function getStatus(value) {
    const colors = {
        pending: 'warning',
        paid: 'info',
        sent: 'primary',
        completed: 'success',
        cancelled: 'danger'
    }
    const traduction = {
        pending: 'En proceso',
        paid: 'Pagado',
        sent: 'Enviado',
        completed: 'Completado',
        cancelled: 'Cancelado'
    }

    return `<span class="badge badge-${colors[value] || 'secondary'}">${traduction[value]}</span>`
}

function loader() {
    return `
            <li class="text-center py-2">
                <div class="spinner-border spinner-border-sm" style="color:var(--primary-color);" role="status">
                    <span class="visually-hidden">Cargando categorías...</span>
                </div>
            </li>
        `
}

function autoLoader(promise, callback, element) {
    element.html(loader())
    promise.then((e) => {
        element.html(``)
        callback(e)
    })
}

function timeAgo(time) {

    let value = ''
    let now = new Date()

    var seconds = Math.floor((now - time) / 1000);

    var interval = seconds / 31536000;
    if (interval > 1) {
        value = Math.floor(interval) + " años.";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
        value = Math.floor(interval) + " meses.";
    }
    interval = seconds / 86400;
    if (interval > 1) {
        value = Math.floor(interval) + " dias.";
    }
    interval = seconds / 3600;
    if (interval > 1) {
        value = Math.floor(interval) + " horas.";
    }
    interval = seconds / 60;
    if (interval > 1) {
        value = Math.floor(interval) + " minutos.";
    }
    else {
        value = Math.floor(seconds) + " segundos.";
    }

    return `<p class="text-sm text-muted" style="margin:0;"><i class="far fa-clock mr-1"></i>Hace ${value}</p>`

}

function getMessageNotification(msg, displayName) {
    return `
            <a href="/admin/chat?id=${msg.chatId}" id="msg-${msg.id}" class="dropdown-item">
                <div class="media">
                    <div class="media-body">
                        ${(displayName) ? `<h3 class="dropdown-item-title">${msg.author}</h3>` : ''}
                        <p class="text-sm" >${msg.text}</p>
                        ${timeAgo(new Date(msg.created_at))}
                    </div >
                </div >
            </a >
    `
}
<script>
    function getRowActions(id, onClickEdit = null, onClickDelete = null) {
        let html = ''
        html += '<div class="btn-group" role="group">';
        if (onClickEdit != null) {
            html += `<button class="${id}-editer btn btn-sm btn-outline-primary edit-product-btn" 
                        data-toggle="tooltip" 
                        title="Editar"  
                        onClick="${onClickEdit}">
                    <i class="fas fa-edit"></i>
                </button>`
        }
        if (onClickDelete != null) {
            html += `<button class="${id}-remover btn btn-sm btn-outline-danger delete-product-btn" 
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
</script>
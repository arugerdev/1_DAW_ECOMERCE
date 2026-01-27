function deleteImages(id, callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "deleteImage",
            "id": id
        },
        success: (data) => {
            callback((data))
        }
    });
}

function uploadTempImage(data, callback = () => { }) {

    const xhr = new XMLHttpRequest();
    const formData = new FormData();
    formData.append('action', 'uploadTempImage');
    formData.append('token', data.token);

    for (let i = 0; i < data.files.length; i++) {
        formData.append('images[]', data.files[i]);
    }
    xhr.open('POST', '../../utils/images_utils.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            callback(JSON.parse(xhr.responseText));
        } else {
            console.error('Error uploading images');
        }
    };
    xhr.send(formData);
}

function deleteTempImage(token, filename, callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "deleteTempImage",
            "token": token,
            "filename": filename
        },
        success: (data) => {
            callback((data))
        }
    })
}

function deleteAllTempImages(token, callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "deleteAllTempImages",
            "token": token
        },
        success: (data) => {
            callback((data))
        }
    })
}

function clearTemp(callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "clearTemp"
        },
        success: (data) => {
            callback((data))
        }
    })
}

function finalizeProductImages(productId, token, images = [], cb = () => { }) {
    $.post("../../utils/images_utils.php", {
        action: "finalizeProductImages",
        product_id: productId,
        token,
        imagesToUpload: images
    }, res => cb((res)));
}

function getProductImages(id, callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "getProductImages",
            "id": id
        },
        success: (data) => {
            callback((data))
        }
    })
}

function moveImagesToTemp(product_id, token, callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "moveImagesToTemp",
            "product_id": product_id,
            "token": token
        },
        success: (data) => {
            callback((data))
        }
    })
}

function getShopImage(callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "getShopImage"
        },
        success: (data) => {
            callback((data))
        }
    })
}

function renderImage(container, img, onRemove) {
    container.append(`
        <div class="image-box" data-id="${img.id}">
            <img src="${img.url}" />
            <button class="remove">×</button>
        </div>
    `);

    container.find(`[data-id="${img.id}"] .remove`).on('click', () => onRemove(img));
}
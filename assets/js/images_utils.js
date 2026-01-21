function deleteImages(id, callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "deleteImage",
            "id": id
        },
        success: (data) => {
            callback(JSON.parse(data))
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
            callback(JSON.parse(data))
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
            callback(JSON.parse(data))
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
            callback(JSON.parse(data))
        }
    })
}

function finalizeProductImages(product_id, token, callback = () => { }) {
    $.ajax({
        url: "../../utils/images_utils.php",
        type: "POST",
        data: {
            "action": "finalizeProductImages",
            "product_id": product_id,
            "token": token
        },
        success: (data) => {
            callback(JSON.parse(data))
        }
    })
}
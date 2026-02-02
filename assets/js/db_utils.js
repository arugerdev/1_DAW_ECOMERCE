var pendingAjax = 0

function selectData(select, table, extra = "", callback = () => { }) {
    pendingAjax++;
    return $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "select",
            "select": select,
            "table": table,
            "extra": extra
        },
        success: (data) => {
            callback(JSON.parse(data))
        },
        complete: () => pendingAjax--
    });
}

function deleteData(table, filterParam, filterValue, extra = "", callback = () => { }) {
    pendingAjax++;
    return $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "delete",
            "table": table,
            "filterParam": filterParam,
            "filterValue": filterValue,
            "extra": extra,
        },
        success: (data) => {
            callback(JSON.parse(data))
        },
        complete: () => pendingAjax--
    });
}

function insertData(table, keys, values, extra = "", callback = () => { }) {
    pendingAjax++;
    return $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "insert",
            "table": table,
            "keys": keys,
            "values": values,
            "extra": extra
        },
        success: (data) => {
            callback(JSON.parse(data))
        },
        complete: () => pendingAjax--
    });
}


function updateData(table, values, extra = "", callback = () => { }) {
    pendingAjax++;
    return $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "update",
            "table": table,
            "values": values,
            "extra": extra
        },
        success: (data) => {
            callback(JSON.parse(data))
        },
        complete: () => pendingAjax--
    });
}

function loginAdmin(username, password, callback = () => { }) {
    pendingAjax++;
    return $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "loginAdmin",
            "username": username,
            "password": password
        },
        success: (data) => {
            callback(JSON.parse(data))
        },
        complete: () => pendingAjax--
    });
}

function createUser(username, password, callback = () => { }) {
    pendingAjax++;
    return $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "createUser",
            "username": username,
            "password": password
        },
        success: (data) => {
            callback(JSON.parse(data))
        },
        complete: () => pendingAjax--
    });
}

function editUser(id, username, password, callback = () => { }) {
    pendingAjax++;
    return $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "editUser",
            "id": id,
            "username": username,
            "password": password
        },
        success: (data) => {
            callback(JSON.parse(data))
        },
        complete: () => pendingAjax--
    });
}

function clearSession() {
    pendingAjax++;
    return $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "clearSession"
        },
        success: (data) => {
            callback(JSON.parse(data))
        },
        complete: () => pendingAjax--
    });
}
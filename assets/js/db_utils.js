function selectData(select, table, extra = "", callback = () => { }) {
    $.ajax({
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
        }
    });

}
function deleteData(table, filterParam, filterValue, extra = "", callback = () => { }) {
    $.ajax({
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
        }
    });

}

function insertData(table, keys, values, extra = "", callback = () => { }) {
    $.ajax({
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
        }
    });

}

function updateData(table, values, extra = "", callback = () => { }) {
    $.ajax({
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
        }
    });

}
function loginAdmin(username, password, callback = () => { }) {
    $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "loginAdmin",
            "username": username,
            "password": password
        },
        success: (data) => {
            callback(JSON.parse(data))
        }
    });

}

function createUser(username, password, callback = () => { }) {
    $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "createUser",
            "username": username,
            "password": password
        },
        success: (data) => {
            callback(JSON.parse(data))
        }
    });

}
function clearSession() {
    $.ajax({
        url: "/utils/db_utils.php",
        type: "POST",
        data: {
            "action": "clearSession"
        },
        success: (data) => {
            callback(JSON.parse(data))
        }
    });
}
function selectData(select, table, extra = "", callback) {
    $.ajax({
        url: "../../utils/db_utils.php",
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


function insertData(table, keys, values, extra = "", callback) {
    $.ajax({
        url: "../../utils/db_utils.php",
        type: "POST",
        data: {
            "action": "insert",
            "table": table,
            "keys": keys,
            "values": values,
            "extra": extra
        },
        success: (data) => {
            console.log(data)
            callback(JSON.parse(data))
        }
    });

}

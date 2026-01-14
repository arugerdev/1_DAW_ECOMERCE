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

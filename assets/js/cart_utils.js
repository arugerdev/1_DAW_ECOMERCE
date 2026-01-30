
function addToCart(item, callback = () => { }) {
    $.ajax({
        url: "/utils/cart_utils.php",
        type: "POST",
        data: {
            "action": "add",
            "item": item
        },
        success: (data) => {
            callback(JSON.parse(data))
        }
    });

}

function deleteFromCart(productId, callback = () => { }) {
    $.ajax({
        url: "/utils/cart_utils.php",
        type: "POST",
        data: {
            "action": "delete",
            "product_id": productId
        },
        success: (data) => {
            callback(JSON.parse(data))
        }
    });

}

function loadOrderSummary(callback = () => { }) {
    $.ajax({
        url: "/utils/cart_utils.php",
        type: "POST",
        data: {
            "action": "select"
        },
        success: (data) => callback(JSON.parse(data))
    });
}

function updateCheckoutTotals(callback = () => { }) {
    $.ajax({
        url: "/utils/cart_utils.php",
        type: "POST",
        data: {
            "action": "get_cart_total"
        },
        success: (data) => callback(JSON.parse(data))
    });
}
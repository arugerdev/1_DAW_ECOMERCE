
function addToCart(item, callback = () => { }) {
    console.log(item)
    $.ajax({
        url: "../../utils/cart_utils.php",
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
    console.log(productId)
    $.ajax({
        url: "../../utils/cart_utils.php",
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